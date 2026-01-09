<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use DataTables;
use PDF;
use Excel;
use QrCode;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Mutasi;
use App\Jenjang;
use App\Kecamatan;
use App\Sekolah;
use App\Pejabat;
use App\NomorSuratMutasi;

class LaporanMutasiMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $jenjang = Jenjang::All();
      return view('admin.laporan_mutasi_masuk.index', compact('jenjang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $mutasi_id = $id;
      $mutasi = Mutasi::where('mutasi_id','=',$mutasi_id)->get();
      // dd($mutasi);
      return view('admin.laporan_mutasi_masuk.detail', compact('mutasi_id','mutasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listData()
    {

      $mutasi_masuk = Mutasi::join('jenjang','mutasi.jenjang_id','=','jenjang.jenjang_id')
      ->join('nomor_surat_mutasi','mutasi.mutasi_id','=','nomor_surat_mutasi.mutasi_id')
      ->where([
        ['mutasi.mutasi_jenis','=','1'],
      ])
      ->orderBy('mutasi.mutasi_id', 'DESC')->get();

      $no = 0;
      $arr = array();
      foreach ($mutasi_masuk as $list) {

        if (count($mutasi_masuk) > 0) {

          $no++;
          $arr[] = array(
            'no'=> $no,
            'mutasi_nama_siswa'=> $list->mutasi_nama_siswa,
            'mutasi_noinduk'=> $list->mutasi_noinduk,
            'mutasi_nisn'=> $list->mutasi_nisn,
            'mutasi_sekolah_asal_nama'=> $list->mutasi_sekolah_asal_nama,
            'mutasi_sekolah_tujuan_nama'=> $list->mutasi_sekolah_tujuan_nama,
            'aksi'=> '<a href="'.route('laporan_mutasi_masuk.show',$list->mutasi_id).'" class="btn btn-success" data-toggle="tooltip" data-placement="botttom" title="Lihat Detail"><i class="fa fa-eye"></i></a>',
          );

        }else {
          $arr = array();
        }

      }

      $datas = new Collection($arr);
      return Datatables::of($datas)->rawColumns(['no','mutasi_nama_siswa','mutasi_noinduk','mutasi_nisn','mutasi_sekolah_asal_nama','mutasi_sekolah_tujuan_nama','aksi'])->make(true);

    }

    public function listDataFilter($tanggal_awal, $tanggal_akhir, $jenjang_id, $query)
    {

      $mutasi_jenis = "1";

      if ($query == "q1") {
        $mutasi_masuk = Mutasi::join('jenjang','mutasi.jenjang_id','=','jenjang.jenjang_id')
        ->join('nomor_surat_mutasi','mutasi.mutasi_id','=','nomor_surat_mutasi.mutasi_id')
        ->where([
          ['mutasi.mutasi_jenis','=',$mutasi_jenis],
        ])
        ->orderBy('mutasi.mutasi_id', 'DESC')->get();
      }elseif ($query == "q2") {
        $mutasi_masuk = Mutasi::join('jenjang','mutasi.jenjang_id','=','jenjang.jenjang_id')
        ->join('nomor_surat_mutasi','mutasi.mutasi_id','=','nomor_surat_mutasi.mutasi_id')
        ->where([
          ['mutasi.mutasi_jenis','=',$mutasi_jenis],
          ['mutasi.jenjang_id', '=', $jenjang_id],
        ])
        ->orderBy('mutasi.mutasi_id', 'DESC')->get();
      }elseif ($query == "q3") {
        $mutasi_masuk = Mutasi::join('jenjang','mutasi.jenjang_id','=','jenjang.jenjang_id')
        ->join('nomor_surat_mutasi','mutasi.mutasi_id','=','nomor_surat_mutasi.mutasi_id')
        ->whereBetween('nomor_surat_mutasi.tanggal', [$tanggal_awal, $tanggal_akhir])
        ->where([
          ['mutasi.mutasi_jenis','=',$mutasi_jenis],
        ])
        ->orderBy('mutasi.mutasi_id', 'DESC')->get();
      }else {
        $mutasi_masuk = Mutasi::join('jenjang','mutasi.jenjang_id','=','jenjang.jenjang_id')
        ->join('nomor_surat_mutasi','mutasi.mutasi_id','=','nomor_surat_mutasi.mutasi_id')
        ->whereBetween('nomor_surat_mutasi.tanggal', [$tanggal_awal, $tanggal_akhir])
        ->where([
          ['mutasi.mutasi_jenis','=',$mutasi_jenis],
          ['mutasi.jenjang_id', '=', $jenjang_id],
        ])
        ->orderBy('mutasi.mutasi_id', 'DESC')->get();
      }

      $no = 0;
      $arr = array();
      foreach ($mutasi_masuk as $list) {

        if (count($mutasi_masuk) > 0) {

          $no++;
          $arr[] = array(
            'no'=> $no,
            'mutasi_nama_siswa'=> $list->mutasi_nama_siswa,
            'mutasi_noinduk'=> $list->mutasi_noinduk,
            'mutasi_nisn'=> $list->mutasi_nisn,
            'mutasi_sekolah_asal_nama'=> $list->mutasi_sekolah_asal_nama,
            'mutasi_sekolah_tujuan_nama'=> $list->mutasi_sekolah_tujuan_nama,
            'aksi'=> '<a href="'.route('laporan_mutasi_masuk.show',$list->mutasi_id).'" class="btn btn-success" data-toggle="tooltip" data-placement="botttom" title="Lihat Detail"><i class="fa fa-eye"></i></a>',
          );

        }else {
          $arr = array();
        }

      }

      $datas = new Collection($arr);
      return Datatables::of($datas)->rawColumns(['no','mutasi_nama_siswa','mutasi_noinduk','mutasi_nisn','mutasi_sekolah_asal_nama','mutasi_sekolah_tujuan_nama','aksi'])->make(true);

    }

    public function laporan_mutasi_masuk_excel_file($tanggal_awal,$tanggal_akhir,$jenjang_id,$query)
    {
      $data = new LaporanMasukExport($tanggal_awal, $tanggal_akhir, $jenjang_id, $query);
      return ($data)->download('laporan_mutasi_masuk.xlsx');
    }

}

class LaporanMasukExport implements FromView
{
  use Exportable;

  public function __construct(string $tanggal_begin, string $tanggal_end, string $jenjang, string $qry)
    {
        $this->tanggal_begin = $tanggal_begin;
        $this->tanggal_end = $tanggal_end;
        $this->jenjang = $jenjang;
        $this->qry = $qry;
    }

    public function view(): View
    {
      $tanggal_awal = $this->tanggal_begin;
      $tanggal_akhir = $this->tanggal_end;
      $jenjang_id = $this->jenjang;
      $query = $this->qry;

      $mutasi_jenis = "1";

      if ($tanggal_awal == 0) {
        $begin_date = "-";
      }else {
        $begin_date = tanggal_indonesia($tanggal_awal, false);
      }

      if ($tanggal_akhir == 0) {
        $end_date = "-";
      }else {
        $end_date = tanggal_indonesia($tanggal_akhir, false);
      }

      if ($jenjang_id == "all") {
        $jenjang_nama = "Semua Jenjang";
      }else {
        $jenjang_nama = Jenjang::where('jenjang_id','=',$jenjang_id)->value('jenjang_nama');
      }


      if ($query == "q1") {
        $data_xl = Mutasi::join('jenjang','mutasi.jenjang_id','=','jenjang.jenjang_id')
                  ->join('nomor_surat_mutasi','mutasi.mutasi_id','=','nomor_surat_mutasi.mutasi_id')
                  ->where([
                    ['mutasi.mutasi_jenis','=',$mutasi_jenis],
                  ])
                  ->select('mutasi.mutasi_nama_siswa', 'mutasi.mutasi_sekolah_asal_nama','mutasi.mutasi_sekolah_asal_no_surat',
                  'mutasi.mutasi_tanggal_mutasi', 'mutasi.mutasi_nisn', 'mutasi.mutasi_noinduk', 'mutasi.mutasi_tempat_lahir',
                  'mutasi.mutasi_tanggal_lahir','mutasi.mutasi_tingkat_kelas','mutasi.mutasi_nama_wali','mutasi.mutasi_alamat',
                  'mutasi.mutasi_sekolah_tujuan_nama','mutasi.mutasi_sekolah_tujuan_no_surat','mutasi.mutasi_tanggal_surat_diterima')
                  ->get();
      }elseif ($query == "q2") {
        $data_xl = Mutasi::join('jenjang','mutasi.jenjang_id','=','jenjang.jenjang_id')
                  ->join('nomor_surat_mutasi','mutasi.mutasi_id','=','nomor_surat_mutasi.mutasi_id')
                  ->where([
                    ['mutasi.mutasi_jenis','=',$mutasi_jenis],
                    ['mutasi.jenjang_id', '=', $jenjang_id],
                  ])
                  ->select('mutasi.mutasi_nama_siswa', 'mutasi.mutasi_sekolah_asal_nama','mutasi.mutasi_sekolah_asal_no_surat',
                  'mutasi.mutasi_tanggal_mutasi', 'mutasi.mutasi_nisn', 'mutasi.mutasi_noinduk', 'mutasi.mutasi_tempat_lahir',
                  'mutasi.mutasi_tanggal_lahir','mutasi.mutasi_tingkat_kelas','mutasi.mutasi_nama_wali','mutasi.mutasi_alamat',
                  'mutasi.mutasi_sekolah_tujuan_nama','mutasi.mutasi_sekolah_tujuan_no_surat','mutasi.mutasi_tanggal_surat_diterima')
                  ->get();
      }elseif ($query == "q3") {
        $data_xl = Mutasi::join('jenjang','mutasi.jenjang_id','=','jenjang.jenjang_id')
                  ->join('nomor_surat_mutasi','mutasi.mutasi_id','=','nomor_surat_mutasi.mutasi_id')
                  ->whereBetween('nomor_surat_mutasi.tanggal', [$tanggal_awal, $tanggal_akhir])
                  ->where([
                    ['mutasi.mutasi_jenis','=',$mutasi_jenis],
                  ])
                  ->select('mutasi.mutasi_nama_siswa', 'mutasi.mutasi_sekolah_asal_nama','mutasi.mutasi_sekolah_asal_no_surat',
                  'mutasi.mutasi_tanggal_mutasi', 'mutasi.mutasi_nisn', 'mutasi.mutasi_noinduk', 'mutasi.mutasi_tempat_lahir',
                  'mutasi.mutasi_tanggal_lahir','mutasi.mutasi_tingkat_kelas','mutasi.mutasi_nama_wali','mutasi.mutasi_alamat',
                  'mutasi.mutasi_sekolah_tujuan_nama','mutasi.mutasi_sekolah_tujuan_no_surat','mutasi.mutasi_tanggal_surat_diterima')
                  ->get();
      }else {
        $data_xl = Mutasi::join('jenjang','mutasi.jenjang_id','=','jenjang.jenjang_id')
                  ->join('nomor_surat_mutasi','mutasi.mutasi_id','=','nomor_surat_mutasi.mutasi_id')
                  ->whereBetween('nomor_surat_mutasi.tanggal', [$tanggal_awal, $tanggal_akhir])
                  ->where([
                    ['mutasi.mutasi_jenis','=',$mutasi_jenis],
                    ['mutasi.jenjang_id', '=', $jenjang_id],
                  ])
                  ->select('mutasi.mutasi_nama_siswa', 'mutasi.mutasi_sekolah_asal_nama','mutasi.mutasi_sekolah_asal_no_surat',
                  'mutasi.mutasi_tanggal_mutasi', 'mutasi.mutasi_nisn', 'mutasi.mutasi_noinduk', 'mutasi.mutasi_tempat_lahir',
                  'mutasi.mutasi_tanggal_lahir','mutasi.mutasi_tingkat_kelas','mutasi.mutasi_nama_wali','mutasi.mutasi_alamat',
                  'mutasi.mutasi_sekolah_tujuan_nama','mutasi.mutasi_sekolah_tujuan_no_surat','mutasi.mutasi_tanggal_surat_diterima')
                  ->get();
      }


      // dd($query);
      return view('admin.laporan_mutasi_masuk.laporan_mutasi_masuk_excel', [
           'mutasi_masuk' => $data_xl,
           'begin_date' => $begin_date,
           'end_date' => $end_date,
           'jenjang_nama' => $jenjang_nama,
       ]);
    }
}
