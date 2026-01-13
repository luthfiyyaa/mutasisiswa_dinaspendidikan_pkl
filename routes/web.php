<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PembacaQrController;
use App\Http\Controllers\PecahTemplateAdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\PejabatController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\MutasiMasukController;
use App\Http\Controllers\MutasiKeluarController;
use App\Http\Controllers\LaporanMutasiMasukController;
use App\Http\Controllers\LaporanMutasiKeluarController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MasterUserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

// Public Routes - QR Reader
Route::get('qr_read/{mutasi_kode_scan}', [PembacaQrController::class, 'index']);
Route::get('getDataMutasi', [PembacaQrController::class, 'getDataMutasi'])->name('getDataMutasi');
Route::get('getDataMutasiCek/{mutasi_kode_scan}', [PembacaQrController::class, 'getDataMutasiCek']);

// Authenticated Routes
Route::middleware(['auth'])->group(function () {

    Route::get('/', [PecahTemplateAdminController::class, 'index']);
    Route::resource('admin_user', AdminUserController::class);

    // ========== MASTER DATA ==========
    
    // Kecamatan
    Route::resource('kecamatan', KecamatanController::class);
    Route::get('data_kecamatan', [KecamatanController::class, 'listData'])->name('data_kecamatan');
    
    // Pejabat
    Route::resource('pejabat', PejabatController::class);
    Route::get('data_pejabat', [PejabatController::class, 'listData'])->name('data_pejabat');
    
    // Jenjang
    Route::resource('jenjang', JenjangController::class);
    Route::get('data_jenjang', [JenjangController::class, 'listData'])->name('data_jenjang');
    
    // Sekolah
    Route::resource('sekolah', SekolahController::class);
    Route::get('data_sekolah', [SekolahController::class, 'listData'])->name('data_sekolah');

    // ========== MUTASI SISWA ==========
    
    // Mutasi Masuk
    Route::resource('mutasi_masuk', MutasiMasukController::class);
    Route::get('data_mutasi_masuk', [MutasiMasukController::class, 'listData'])->name('data_mutasi_masuk');
    Route::get('data_mutasi_masuk_jenjang/{id}', [MutasiMasukController::class, 'listDataJenjang']);
    Route::get('search_sekolah', [MutasiMasukController::class, 'search_sekolah'])->name('search_sekolah');
    Route::get('sukses_tambah_mutasi_masuk/{mutasi_id}', [MutasiMasukController::class, 'sukses_tambah_mutasi_masuk']);
    Route::get('suket_mutasi_masuk_pdf/{mutasi_id}', [MutasiMasukController::class, 'suket_mutasi_masuk_pdf']);
    
    // Mutasi Keluar
    Route::resource('mutasi_keluar', MutasiKeluarController::class);
    Route::get('data_mutasi_keluar', [MutasiKeluarController::class, 'listData'])->name('data_mutasi_keluar');
    Route::get('data_mutasi_keluar_jenjang/{id}', [MutasiKeluarController::class, 'listDataJenjang']);
    Route::get('sukses_tambah_mutasi_keluar/{mutasi_id}', [MutasiKeluarController::class, 'sukses_tambah_mutasi_keluar']);
    Route::get('suket_mutasi_keluar_pdf/{mutasi_id}', [MutasiKeluarController::class, 'suket_mutasi_keluar_pdf']);

    // ========== LAPORAN ==========
    
    // Laporan Mutasi Masuk
    Route::resource('laporan_mutasi_masuk', LaporanMutasiMasukController::class);
    Route::get('data_laporan_mutasi_masuk', [LaporanMutasiMasukController::class, 'listData'])->name('data_laporan_mutasi_masuk');
    Route::get('data_laporan_mutasi_masuk_filter/{tanggal_awal}/{tanggal_akhir}/{jenjang_id}/{query}', [LaporanMutasiMasukController::class, 'listDataFilter']);
    Route::get('laporan_mutasi_masuk_excel_file/{tanggal_awal}/{tanggal_akhir}/{jenjang_id}/{query}', [LaporanMutasiMasukController::class, 'laporan_mutasi_masuk_excel_file'])->name('laporan_mutasi_masuk.downloadExcel');
    
    // Laporan Mutasi Keluar
    Route::resource('laporan_mutasi_keluar', LaporanMutasiKeluarController::class);
    Route::get('data_laporan_mutasi_keluar', [LaporanMutasiKeluarController::class, 'listData'])->name('data_laporan_mutasi_keluar');
    Route::get('data_laporan_mutasi_keluar_filter/{tanggal_awal}/{tanggal_akhir}/{jenjang_id}/{query}', [LaporanMutasiKeluarController::class, 'listDataFilter']);
    Route::get('laporan_mutasi_keluar_excel_file/{tanggal_awal}/{tanggal_akhir}/{jenjang_id}/{query}', [LaporanMutasiKeluarController::class, 'laporan_mutasi_keluar_excel_file'])->name('laporan_mutasi_keluar.downloadExcel');

    // ========== MANAJEMEN USER ==========
    
    // Group
    Route::resource('group', GroupController::class);
    Route::get('data_group', [GroupController::class, 'listData'])->name('data_group');
    
    // Master User
    Route::resource('master_user', MasterUserController::class);
    Route::get('data_master_user', [MasterUserController::class, 'listData'])->name('data_master_user');
    
    // Menu
    Route::resource('menu', MenuController::class);
    Route::get('data_menu', [MenuController::class, 'listData'])->name('data_menu');
    
    // T User
    Route::resource('t_user', TUserController::class);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
