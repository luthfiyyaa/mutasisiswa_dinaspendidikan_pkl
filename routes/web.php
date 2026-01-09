<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('qr_read/{mutasi_kode_scan}', 'PembacaQrController@index');
Route::get('getDataMutasi', 'PembacaQrController@getDataMutasi')->name('getDataMutasi');
Route::get('getDataMutasiCek/{mutasi_kode_scan}', 'PembacaQrController@getDataMutasiCek');

Route::group(['middleware' => 'auth'], function () {

  Route::get('/', 'PecahTemplateAdminController@index');
  Route::resource('admin_user', 'AdminUserController');

//MASTER ===================================================================================================================================

//  ================================================ Kecamatan ==========================================================
Route::resource('kecamatan', 'KecamatanController');
Route::get('data_kecamatan', 'KecamatanController@listData')->name('data_kecamatan');
//  ================================================ END Kecamatan ==========================================================

//  ================================================ Pejabat ==========================================================
Route::resource('pejabat', 'PejabatController');
Route::get('data_pejabat', 'PejabatController@listData')->name('data_pejabat');
//  ================================================ End Pejabat==========================================================

//  ================================================ Jenjang ==========================================================
Route::resource('jenjang', 'JenjangController');
Route::get('data_jenjang', 'JenjangController@listData')->name('data_jenjang');
//  ================================================ End Jenjang==========================================================

//  ================================================ Sekolah ==========================================================
Route::resource('sekolah', 'SekolahController');
Route::get('data_sekolah', 'SekolahController@listData')->name('data_sekolah');
//  ================================================ End Sekolah==========================================================

//END MASTER ===================================================================================================================================


//MUTASI SISWA ===================================================================================================================================

//  ================================================ Mutasi Masuk ==========================================================
Route::resource('mutasi_masuk', 'MutasiMasukController');
Route::get('data_mutasi_masuk', 'MutasiMasukController@listData')->name('data_mutasi_masuk');
Route::get('/data_mutasi_masuk_jenjang/{id}', 'MutasiMasukController@listDataJenjang');
Route::get('search_sekolah', 'MutasiMasukController@search_sekolah')->name('search_sekolah');
Route::get('sukses_tambah_mutasi_masuk/{mutasi_id}', 'MutasiMasukController@sukses_tambah_mutasi_masuk');
Route::get('suket_mutasi_masuk_pdf/{mutasi_id}', 'MutasiMasukController@suket_mutasi_masuk_pdf');
//  ================================================ End Mutasi Masuk==========================================================

//  ================================================ Mutasi Keluar ==========================================================
Route::resource('mutasi_keluar', 'MutasiKeluarController');
Route::get('data_mutasi_keluar', 'MutasiKeluarController@listData')->name('data_mutasi_keluar');
Route::get('/data_mutasi_keluar_jenjang/{id}', 'MutasiKeluarController@listDataJenjang');
Route::get('sukses_tambah_mutasi_keluar/{mutasi_id}', 'MutasiKeluarController@sukses_tambah_mutasi_keluar');
Route::get('suket_mutasi_keluar_pdf/{mutasi_id}', 'MutasiKeluarController@suket_mutasi_keluar_pdf');
//  ================================================ End Mutasi Keluar==========================================================



//END MUTASI SISWA ===================================================================================================================================

//LAPORAN ===================================================================================================================================

//  ================================================ Laporan Mutasi Masuk ==========================================================
Route::resource('laporan_mutasi_masuk', 'LaporanMutasiMasukController');
Route::get('data_laporan_mutasi_masuk', 'LaporanMutasiMasukController@listData')->name('data_laporan_mutasi_masuk');
Route::get('data_laporan_mutasi_masuk_filter/{tanggal_awal}/{tanggal_akhir}/{jenjang_id}/{query}', 'LaporanMutasiMasukController@listDataFilter');
Route::get('/laporan_mutasi_masuk_excel_file/{tanggal_awal}/{tanggal_akhir}/{jenjang_id}/{query}', 'LaporanMutasiMasukController@laporan_mutasi_masuk_excel_file')->name('laporan_mutasi_masuk.downloadExcel');
//  ================================================ End Laporan Mutasi Masuk==========================================================

//  ================================================ Laporan Mutasi Keluar ==========================================================
Route::resource('laporan_mutasi_keluar', 'LaporanMutasiKeluarController');
Route::get('data_laporan_mutasi_keluar', 'LaporanMutasiKeluarController@listData')->name('data_laporan_mutasi_keluar');
Route::get('data_laporan_mutasi_keluar_filter/{tanggal_awal}/{tanggal_akhir}/{jenjang_id}/{query}', 'LaporanMutasiKeluarController@listDataFilter');
Route::get('/laporan_mutasi_keluar_excel_file/{tanggal_awal}/{tanggal_akhir}/{jenjang_id}/{query}', 'LaporanMutasiKeluarController@laporan_mutasi_keluar_excel_file')->name('laporan_mutasi_keluar.downloadExcel');
//  ================================================ End Laporan Mutasi Keluar==========================================================


//END LAPORAN ===================================================================================================================================



//MANAJEMEN USER ===================================================================================================================================

//  ================================================ GROUP ==========================================================
  Route::resource('group', 'GroupController');
  Route::get('data_group', 'GroupController@listData')->name('data_group');
//  ================================================ END GROUP ==========================================================

//  ================================================ MASTER USER ==========================================================
  Route::resource('master_user', 'MasterUserController');
  Route::get('data_master_user', 'MasterUserController@listData')->name('data_master_user');
//  ================================================ END MASTER USER ==========================================================

//  ================================================ MENU ==========================================================
  Route::resource('menu', 'MenuController');
  Route::get('data_menu', 'MenuController@listData')->name('data_menu');
//  ================================================ END MENU ==========================================================

//  ================================================ T USER ==========================================================
  Route::resource('t_user', 'TUserController');
//  ================================================ END T USER ==========================================================

//END MANAJEMEN USER ===================================================================================================================================




});
