<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Group;
use App\Models\Siswa;
use App\Models\SuratMutasi;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
         $user = Auth::user();
        
        // Get statistics for dashboard
        $statistics = $this->getDashboardStatistics($user);
        
        // Get recent activities
        $recentActivities = $this->getRecentActivities($user);

        return view('home', compact('user', 'statistics', 'recentActivities'));
    }

    /**
     * Get dashboard statistics based on user role
     *
     * @param  \App\Models\User  $user
     * @return array
     */
    private function getDashboardStatistics($user): array
    {
        $statistics = [];

        // Check if models exist, otherwise return empty statistics
        try {
            // Total users (only for admin)
            if ($this->isAdmin($user)) {
                $statistics['total_users'] = User::count();
                $statistics['total_groups'] = class_exists(Group::class) ? Group::count() : 0;
            }
            // Total siswa
            $statistics['total_siswa'] = class_exists(Siswa::class) ? Siswa::count() : 0;

            // Total surat mutasi
            if (class_exists(SuratMutasi::class)) {
                $statistics['total_surat'] = SuratMutasi::count();
                $statistics['surat_pending'] = SuratMutasi::where('status', 'pending')->count();
                $statistics['surat_approved'] = SuratMutasi::where('status', 'approved')->count();
                $statistics['surat_rejected'] = SuratMutasi::where('status', 'rejected')->count();
                
                // Surat bulan ini
                $statistics['surat_bulan_ini'] = SuratMutasi::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count();
            }
        } catch (\Exception $e) {
            // If tables don't exist yet, return default values
            $statistics = [
                'total_siswa' => 0,
                'total_surat' => 0,
                'surat_pending' => 0,
                'surat_approved' => 0,
                'surat_rejected' => 0,
                'surat_bulan_ini' => 0,
            ];
        }
         return $statistics;
    }
    
     /**
     * Get recent activities/mutations
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    private function getRecentActivities($user)
    {
        try {
            if (class_exists(SuratMutasi::class)) {
                return SuratMutasi::with(['siswa', 'user'])
                    ->orderBy('created_at', 'DESC')
                    ->limit(10)
                    ->get();
            }
        } catch (\Exception $e) {
            return collect([]);
        }

        return collect([]);
    }


    /**
     * Get chart data for dashboard
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChartData()
    {
        try {
            if (!class_exists(SuratMutasi::class)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Model SuratMutasi belum ada'
                ]);
            }
            // Get mutation data per month for the current year
            $mutations = SuratMutasi::select(
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('COUNT(*) as total')
                )
                ->whereYear('created_at', now()->year)
                ->groupBy('month')
                ->orderBy('month')
                ->get();
            // Prepare data for chart
            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Oct', 'Nov', 'Des'];
            $data = array_fill(0, 12, 0);

            foreach ($mutations as $mutation) {
                $data[$mutation->month - 1] = $mutation->total;
            }

            return response()->json([
                'success' => true,
                'labels' => $months,
                'data' => $data
            ]);
         } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get statistics by status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatisticsByStatus()
    {
        try {
            if (!class_exists(SuratMutasi::class)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Model SuratMutasi belum ada'
                ]);
            }
            $statistics = SuratMutasi::select('status', DB::raw('COUNT(*) as total'))
                ->groupBy('status')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $statistics
            ]);
         } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}   
