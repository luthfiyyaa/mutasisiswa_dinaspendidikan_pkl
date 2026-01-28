<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Mutasi;
use App\Models\Bidang;
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

        
    return view('admin.index', compact(
        'mutasi_masuk', 
        'mutasi_keluar', 
        'kecamatan_data',
        'statistik_bidang'
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
        $groupId = $user->group_id ?? null;
        
        // Query bidang dengan filter berdasarkan group_id
        $bidangQuery = Bidang::with('jenjang');
        
        // group_id 1 = admin, group_id 13 = op_usc -> bisa lihat semua
        if (!in_array($groupId, [1, 13])) {
            // group_id 4 = op_bidang -> filter berdasarkan nama user
            if ($groupId == 4) {
                $userName = strtoupper($user->name ?? '');
                
                // Deteksi bidang dari nama user
                if (str_contains($userName, 'PAUD')) {
                    $bidangQuery->where('bidang_id', 1);
                } elseif (str_contains($userName, 'SD')) {
                    $bidangQuery->where('bidang_id', 2);
                } elseif (str_contains($userName, 'SMP')) {
                    $bidangQuery->where('bidang_id', 3);
                } else {
                    // Nama user tidak mengandung bidang, return empty
                    return [];
                }
            } else {
                // Group ID tidak dikenali, return empty
                return [];
            }
        }
        
        $bidangList = $bidangQuery->get();
        $statistik = [];
        
        foreach ($bidangList as $bidang) {
            // Ambil ID jenjang dalam bidang ini
            $jenjangIds = $bidang->jenjang->pluck('jenjang_id')->toArray();
            
            if (empty($jenjangIds)) {
                continue; // Skip jika tidak ada jenjang
            }
            
            // Hitung mutasi MASUK
            $mutasiMasuk = DB::table('mutasi')
                ->join('sekolah', 'mutasi.mutasi_sekolah_tujuan_id', '=', 'sekolah.sekolah_id')
                ->where('mutasi.mutasi_jenis', '1')
                ->whereIn('sekolah.jenjang_id', $jenjangIds)
                ->count();
            
            // Hitung mutasi KELUAR
            $mutasiKeluar = DB::table('mutasi')
                ->join('sekolah', 'mutasi.mutasi_sekolah_asal_id', '=', 'sekolah.sekolah_id')
                ->where('mutasi.mutasi_jenis', '2')
                ->whereIn('sekolah.jenjang_id', $jenjangIds)
                ->count();
            
            $key = strtolower($bidang->bidang_nama);
            
            $statistik[$key] = [
                'nama' => strtoupper($bidang->bidang_nama),
                'jenjang' => $bidang->jenjang->pluck('jenjang_nama')->implode(', '),
                'mutasi_masuk' => $mutasiMasuk,
                'mutasi_keluar' => $mutasiKeluar,
                'total' => $mutasiMasuk + $mutasiKeluar
            ];
        }
        
        return $statistik;
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
