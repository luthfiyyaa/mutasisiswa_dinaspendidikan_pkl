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
     // Get mutasi statistics
        $statistics = $this->getMutasiStatistics();
        
        // Get recent mutasi data
        $recentMutasi = $this->getRecentMutasi();
        
        // Get monthly chart data
        $chartData = $this->getMonthlyChartData();

        return view('admin.index', [
            'mutasi_masuk' => $statistics['mutasi_masuk'],
            'mutasi_keluar' => $statistics['mutasi_keluar'],
            'total_mutasi' => $statistics['total_mutasi'],
            'mutasi_pending' => $statistics['mutasi_pending'],
            'recent_mutasi' => $recentMutasi,
            'chart_data' => $chartData,
        ]);
  }
  /**
     * Get mutasi statistics
     */
    private function getMutasiStatistics(): array
    {
        // Cache untuk 5 menit agar dashboard load lebih cepat
        return Cache::remember('dashboard_statistics', 300, function () {
            return [
                'mutasi_masuk' => Mutasi::where('mutasi_jenis', 1)->count(),
                'mutasi_keluar' => Mutasi::where('mutasi_jenis', 2)->count(),
                'total_mutasi' => Mutasi::count(),
                'mutasi_pending' => Mutasi::where('mutasi_status', 'pending')
                    ->orWhereNull('mutasi_status')
                    ->count(),
            ];
        });
    }

    /**
     * Get recent mutasi (last 10)
     */
    private function getRecentMutasi()
    {
        return Mutasi::with(['sekolahAsal', 'sekolahTujuan'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($mutasi) {
                return [
                    'id' => $mutasi->mutasi_id,
                    'nama_siswa' => $mutasi->mutasi_nama_siswa,
                    'nisn' => $mutasi->mutasi_nisn,
                    'jenis' => $mutasi->mutasi_jenis == 1 ? 'Masuk' : 'Keluar',
                    'jenis_badge' => $mutasi->mutasi_jenis == 1 ? 'success' : 'warning',
                    'sekolah_asal' => $mutasi->mutasi_sekolah_asal_nama,
                    'sekolah_tujuan' => $mutasi->mutasi_sekolah_tujuan_nama,
                    'tanggal' => $mutasi->created_at->format('d/m/Y'),
                    'tanggal_relative' => $mutasi->created_at->diffForHumans(),
                ];
            });
    }

    /**
     * Get monthly chart data for current year
     */
    private function getMonthlyChartData(): array
    {
        $currentYear = Carbon::now()->year;
        
        $monthlyData = Mutasi::selectRaw('
                MONTH(created_at) as month,
                mutasi_jenis,
                COUNT(*) as total
            ')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month', 'mutasi_jenis')
            ->get();

        // Initialize arrays for 12 months
        $masuk = array_fill(1, 12, 0);
        $keluar = array_fill(1, 12, 0);

        // Fill data
        foreach ($monthlyData as $data) {
            if ($data->mutasi_jenis == 1) {
                $masuk[$data->month] = $data->total;
            } else {
                $keluar[$data->month] = $data->total;
            }
        }

        return [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Oct', 'Nov', 'Des'],
            'masuk' => array_values($masuk),
            'keluar' => array_values($keluar),
        ];
    }

    /**
     * Get statistics by jenjang
     */
    public function getStatisticsByJenjang(): array
    {
        return DB::table('mutasi')
            ->join('sekolah as s_asal', 'mutasi.mutasi_sekolah_asal_id', '=', 's_asal.sekolah_id')
            ->join('jenjang', 's_asal.jenjang_id', '=', 'jenjang.jenjang_id')
            ->select('jenjang.jenjang_nama', DB::raw('COUNT(*) as total'))
            ->groupBy('jenjang.jenjang_id', 'jenjang.jenjang_nama')
            ->orderBy('total', 'desc')
            ->get()
            ->toArray();
    }

    /**
     * Get statistics by kecamatan
     */
    public function getStatisticsByKecamatan(): array
    {
        return DB::table('mutasi')
            ->join('sekolah as s_asal', 'mutasi.mutasi_sekolah_asal_id', '=', 's_asal.sekolah_id')
            ->join('kecamatan', 's_asal.kecamatan_id', '=', 'kecamatan.kecamatan_id')
            ->select('kecamatan.kecamatan_nama', DB::raw('COUNT(*) as total'))
            ->groupBy('kecamatan.kecamatan_id', 'kecamatan.kecamatan_nama')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get()
            ->toArray();
    }

    /**
     * Clear dashboard cache
     */
    public function clearCache(): void
    {
        Cache::forget('dashboard_statistics');
    }

    /**
     * Get dashboard data as JSON (for AJAX refresh)
     */
    public function getDashboardData()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'statistics' => $this->getMutasiStatistics(),
                'recent_mutasi' => $this->getRecentMutasi(),
                'chart_data' => $this->getMonthlyChartData(),
            ]
        ]);
    }

    /**
     * Export dashboard statistics
     */
    public function exportStatistics(Request $request)
    {
        $format = $request->get('format', 'pdf'); // pdf, excel, csv
        
        $data = [
            'statistics' => $this->getMutasiStatistics(),
            'by_jenjang' => $this->getStatisticsByJenjang(),
            'by_kecamatan' => $this->getStatisticsByKecamatan(),
            'generated_at' => now()->format('d/m/Y H:i:s'),
            'generated_by' => Auth::user()->name ?? 'System',
        ];

        // Implementasi export sesuai format
        switch ($format) {
            case 'pdf':
                return $this->exportToPdf($data);
            case 'excel':
                return $this->exportToExcel($data);
            case 'csv':
                return $this->exportToCsv($data);
            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Format tidak valid'
                ], 400);
        }
    }

    /**
     * Export to PDF (placeholder - implement sesuai library yang dipakai)
     */
    private function exportToPdf(array $data)
    {
        // Implementasi dengan DomPDF atau mPDF
        // return PDF::loadView('admin.reports.statistics', $data)
        //     ->download('statistik-mutasi.pdf');
    }

    /**
     * Export to Excel (placeholder - implement sesuai library yang dipakai)
     */
    private function exportToExcel(array $data)
    {
        // Implementasi dengan Laravel Excel
        // return Excel::download(new StatisticsExport($data), 'statistik-mutasi.xlsx');
    }

    /**
     * Export to CSV (placeholder - implement sesuai library yang dipakai)
     */
    private function exportToCsv(array $data)
    {
        // Implementasi CSV export
    }

}
