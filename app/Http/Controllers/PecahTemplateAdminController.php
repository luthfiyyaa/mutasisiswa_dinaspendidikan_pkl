<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Mutasi;
use App\Models\Sekolah;
use Carbon\Carbon;


class PecahTemplateAdminController extends Controller
{
  public function index(): View
  {
    $mutasi_masuk = Mutasi::where('mutasi_jenis', '=', '1')->count();
    $mutasi_keluar = Mutasi::where('mutasi_jenis', '=', '2')->count();

    $kecamatan_data = $this->getMutasiByKecamatan(true);
    $statistik_bidang = $this->getStatistikBidang();
    $can_see_all = $this->canSeeAllBidang();

        
    return view('admin.index', compact(
        'mutasi_masuk', 
        'mutasi_keluar', 
        'kecamatan_data',
        'statistik_bidang',
        'can_see_all'
        ));
    }

    /**
     * Get statistics by kecamatan with jenis mutasi - ALL kecamatan
     */
    private function getMutasiByKecamatan(): array
    {
        // Ambil semua kecamatan
        $allKecamatan = DB::table('kecamatan')
            ->orderBy('kecamatan_nama', 'asc')
            ->get();

        // Ambil data mutasi MASUK per kecamatan (berdasarkan sekolah TUJUAN)
        $mutasiMasuk = DB::table('mutasi')
            ->join('sekolah as s_tujuan', 'mutasi.mutasi_sekolah_tujuan_id', '=', 's_tujuan.sekolah_id')
            ->where('mutasi.mutasi_jenis', '1')
            ->selectRaw('s_tujuan.kecamatan_id, COUNT(*) as total')
            ->groupBy('s_tujuan.kecamatan_id')
            ->pluck('total', 'kecamatan_id');

        // Ambil data mutasi KELUAR per kecamatan (berdasarkan sekolah ASAL)
        $mutasiKeluar = DB::table('mutasi')
            ->join('sekolah as s_asal', 'mutasi.mutasi_sekolah_asal_id', '=', 's_asal.sekolah_id')
            ->where('mutasi.mutasi_jenis', '2')
            ->selectRaw('s_asal.kecamatan_id, COUNT(*) as total')
            ->groupBy('s_asal.kecamatan_id')
            ->pluck('total', 'kecamatan_id');

        // Gabungkan data
        $labels = [];
        $masuk = [];
        $keluar = [];

        foreach ($allKecamatan as $kecamatan) {
            $labels[] = $kecamatan->kecamatan_nama;
            $masuk[] = $mutasiMasuk->get($kecamatan->kecamatan_id, 0);
            $keluar[] = $mutasiKeluar->get($kecamatan->kecamatan_id, 0);
        }

        return [
            'labels' => $labels,
            'masuk' => $masuk,
            'keluar' => $keluar,
        ];
    }

    /**
     * Get statistics by bidang (PAUD, SD, SMP)
     */
    private function getStatistikBidang()
    {
        $user = Auth::user();
        $userRole = $user->role ?? 'administrator';
        
        // Tentukan bidang yang ditampilkan
        if (in_array($userRole, ['administrator', 'usc'])) {
            $bidangToShow = ['paud', 'sd', 'smp'];
        } else {
            $bidangToShow = [];
            if (str_contains($userRole, 'paud')) {
                $bidangToShow[] = 'paud';
            } elseif (str_contains($userRole, 'sd')) {
                $bidangToShow[] = 'sd';
            } elseif (str_contains($userRole, 'smp')) {
                $bidangToShow[] = 'smp';
            }
        }
        
        // Fungsi untuk menentukan bidang berdasarkan nama jenjang
        $getBidangFromJenjang = function($jenjangNama) {
            if (!$jenjangNama) return null;
            
            $jenjangUpper = strtoupper(trim($jenjangNama));
            
            // PAUD group
            if (str_contains($jenjangUpper, 'PAUD') || 
                str_contains($jenjangUpper, 'TK') || 
                str_contains($jenjangUpper, 'KB') ||
                str_contains($jenjangUpper, 'TPA') ||
                str_contains($jenjangUpper, 'SKB') ||
                str_contains($jenjangUpper, 'PKBM')) {
                return 'paud';
            }
            
            // SD group
            if (str_contains($jenjangUpper, 'SD') || 
                str_contains($jenjangUpper, 'MI')) {
                return 'sd';
            }
            
            // SMP group
            if (str_contains($jenjangUpper, 'SMP') || 
                str_contains($jenjangUpper, 'MTS') ||
                str_contains($jenjangUpper, 'TSANAWIYAH')) {
                return 'smp';
            }
            
            return null;
        };
        
        // Inisialisasi statistik
        $statistik = [];
        foreach ($bidangToShow as $bidang) {
            $statistik[$bidang] = [
                'nama' => strtoupper($bidang),
                'jenjang' => '',
                'mutasi_masuk' => 0,
                'mutasi_keluar' => 0,
                'total' => 0,
                'jenjang_list' => []
            ];
        }
        
        // Query untuk MUTASI MASUK (gunakan sekolah TUJUAN)
        $mutasiMasuk = DB::table('mutasi')
            ->leftJoin('sekolah', 'mutasi.mutasi_sekolah_tujuan_id', '=', 'sekolah.sekolah_id')
            ->leftJoin('jenjang', 'sekolah.jenjang_id', '=', 'jenjang.jenjang_id')
            ->where('mutasi.mutasi_jenis', '1')
            ->select('jenjang.jenjang_nama')
            ->get();
        
        // Query untuk MUTASI KELUAR (gunakan sekolah ASAL)
        $mutasiKeluar = DB::table('mutasi')
            ->leftJoin('sekolah', 'mutasi.mutasi_sekolah_asal_id', '=', 'sekolah.sekolah_id')
            ->leftJoin('jenjang', 'sekolah.jenjang_id', '=', 'jenjang.jenjang_id')
            ->where('mutasi.mutasi_jenis', '2')
            ->select('jenjang.jenjang_nama')
            ->get();
        
        // Hitung mutasi masuk per bidang
        foreach ($mutasiMasuk as $mutasi) {
            $bidang = $getBidangFromJenjang($mutasi->jenjang_nama);
            
            if ($bidang && in_array($bidang, $bidangToShow)) {
                if ($mutasi->jenjang_nama && !in_array($mutasi->jenjang_nama, $statistik[$bidang]['jenjang_list'])) {
                    $statistik[$bidang]['jenjang_list'][] = $mutasi->jenjang_nama;
                }
                $statistik[$bidang]['mutasi_masuk']++;
            }
        }
        
        // Hitung mutasi keluar per bidang
        foreach ($mutasiKeluar as $mutasi) {
            $bidang = $getBidangFromJenjang($mutasi->jenjang_nama);
            
            if ($bidang && in_array($bidang, $bidangToShow)) {
                if ($mutasi->jenjang_nama && !in_array($mutasi->jenjang_nama, $statistik[$bidang]['jenjang_list'])) {
                    $statistik[$bidang]['jenjang_list'][] = $mutasi->jenjang_nama;
                }
                $statistik[$bidang]['mutasi_keluar']++;
            }
        }
        
        // Finalisasi data
        foreach ($statistik as $key => $data) {
            $statistik[$key]['total'] = $data['mutasi_masuk'] + $data['mutasi_keluar'];
            $statistik[$key]['jenjang'] = implode(', ', $data['jenjang_list']) ?: 'Tidak ada data';
            unset($statistik[$key]['jenjang_list']);
        }
        
        return $statistik;
    }

    /**
     * Check if user can see all bidang
     */
    private function canSeeAllBidang(): bool
    {
        $user = Auth::user();
        $userRole = $user->role ?? 'administrator';
        
        return in_array($userRole, ['administrator', 'usc']);
    }

    /**
     * Get dashboard data as JSON (for AJAX refresh)
     */
    public function getDashboardData()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'kecamatan_data' => $this->getMutasiByKecamatan(),
            ]
        ]);
    }

}
