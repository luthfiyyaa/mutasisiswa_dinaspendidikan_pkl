<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use DataTables;
use App\Mutasi;

class PembacaQrController extends Controller
{
  public function index($mutasi_kode_scan)
  {
    // return "oke".$mutasi_id;
    return view('admin.qr_read.index', compact('mutasi_kode_scan'));
  }

  function getDataMutasi()
  {

    $arr = array();
    $datas = new Collection($arr);
    return Datatables::of($datas)->rawColumns(['detail','isi'])->make(true);

    // dd($datas);
  }

  function getDataMutasiCek($mutasi_kode_scan)
  {

    $mutasi = Mutasi::where('mutasi_kode_scan','=',$mutasi_kode_scan)->get();
    if (count($mutasi) > 0) {
    foreach ($mutasi as  $value) {
      $mutasi_nama_siswa = ": ".$value->mutasi_nama_siswa;
      $mutasi_noinduk = ": ".$value->mutasi_noinduk;
      $mutasi_nisn = ": ".$value->mutasi_nisn;
      $mutasi_tingkat_kelas = ": ".$value->mutasi_tingkat_kelas;
      $mutasi_ttl = ": ".$value->mutasi_tempat_lahir.' / '.tanggal_indonesia($value->mutasi_tanggal_lahir,false);
      $mutasi_nama_wali = ": ".$value->mutasi_nama_wali;
      $mutasi_alamat = ": ".$value->mutasi_alamat;
      $mutasi_sekolah_asal_nama = ": ".$value->mutasi_sekolah_asal_nama;
      $mutasi_sekolah_asal_no_surat = ": ".$value->mutasi_sekolah_asal_no_surat;
      $mutasi_tanggal_mutasi = ": ".tanggal_indonesia($value->mutasi_tanggal_mutasi,false);
      $mutasi_sekolah_tujuan_nama = ": ".$value->mutasi_sekolah_tujuan_nama;
      $mutasi_sekolah_tujuan_no_surat = ": ".$value->mutasi_sekolah_tujuan_no_surat;
      $mutasi_tanggal_surat_diterima = ": ".tanggal_indonesia($value->mutasi_tanggal_surat_diterima, false);
    }

    // dd($mutasi_nama_siswa);

    $detail  = array('Nama','No. Induk','NISN','Tingkat Kelas','Tempat/Tgl Lahir',
    'Nama Wali','Alamat','Nama Sekolah (Asal)','Nomor Surat (Sekolah Asal)','Tanggal Surat (Sekolah Asal)',
    'Nama Sekolah (Tujuan)','Nomor Surat (Sekolah Tujuan)', 'Tanggal Surat (Sekolah Tujuan)');
    $isi  = array($mutasi_nama_siswa, $mutasi_noinduk, $mutasi_nisn, $mutasi_tingkat_kelas, $mutasi_ttl,
    $mutasi_nama_wali, $mutasi_alamat,
    $mutasi_sekolah_asal_nama, $mutasi_sekolah_asal_no_surat, $mutasi_tanggal_mutasi,
    $mutasi_sekolah_tujuan_nama, $mutasi_sekolah_tujuan_no_surat, $mutasi_tanggal_surat_diterima);


      for ($i=0; $i < count($detail); $i++) {
        $arr[] = array(
          'detail'=> $detail[$i],
          'isi'=> $isi[$i]
        );
      }
    }else {
      $arr = array();
    }

    // dd($arr);

    $datas = new Collection($arr);
    return Datatables::of($datas)->rawColumns(['detail','isi'])->make(true);

  }

}
