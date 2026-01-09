<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use DataTables;
use PDF;
use QrCode;
use Illuminate\Support\Collection;
use App\Mutasi;
use App\Jenjang;
use App\Kecamatan;
use App\Sekolah;
use App\Pejabat;
use App\NomorSuratMutasi;

class MutasiMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenjang = Jenjang::All();
        return view('admin.mutasi_masuk.index', compact('jenjang'));
        // return "oke mutasi masuk";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenjang = Jenjang::All();
        $kecamatan = Kecamatan::All();
        return view('admin.mutasi_masuk.create', compact('jenjang','kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $sekolah_tujuan_id = $request['sekolah_id'];
      $sekolah_tujuan_nama = "";
      $sekolah_tujuan_alamat = "";
      $jenjang_id = "";
      $kecamatan_id = Sekolah::where('sekolah_id','=',$sekolah_tujuan_id)->value('kecamatan_id');
      $kecamatan_nama = Kecamatan::where('kecamatan_id','=',$kecamatan_id)->value('kecamatan_nama');
      $sekolah = Sekolah::where('sekolah_id','=',$sekolah_tujuan_id)->get();
      foreach ($sekolah as $data) {
        $sekolah_tujuan_nama = $data->sekolah_nama.' '.$kecamatan_nama.' Kabupaten Trenggalek';
        $sekolah_tujuan_alamat = $data->sekolah_alamat;
        $jenjang_id = $data->jenjang_id;
      }

      $ldate = date('Y-m-d H:i:s');
      $kode_scan = md5(uniqid($ldate, true));

      $pejabat_id = Jenjang::where('jenjang_id','=',$jenjang_id)->value('pejabat_id');
      $pejabat = Pejabat::where('pejabat_id','=',$pejabat_id)->get();
      $pejabat_nip = "";
      $pejabat_nama = "";
      $pejabat_pangkat = "";
      $pejabat_jabatan = "";
      foreach ($pejabat as $data2) {
        $pejabat_nip = $data2->pejabat_nip;
        $pejabat_nama = $data2->pejabat_nama;
        $pejabat_pangkat = $data2->pejabat_pangkat;
        $pejabat_jabatan = $data2->pejabat_jabatan;
      }

      // dd($pejabat_jabatan);



      $mutasi_masuk = new Mutasi;
      $mutasi_masuk->mutasi_jenis = "1";
      $mutasi_masuk->mutasi_nama_siswa = $request['mutasi_nama_siswa'];
      $mutasi_masuk->mutasi_sekolah_asal_id = "";
      $mutasi_masuk->mutasi_sekolah_asal_nama = $request['mutasi_sekolah_asal_nama'];
      $mutasi_masuk->mutasi_sekolah_asal_alamat = "";
      $mutasi_masuk->mutasi_sekolah_asal_no_surat = $request['mutasi_sekolah_asal_no_surat'];
      $mutasi_masuk->mutasi_tanggal_mutasi = $request['mutasi_tanggal_mutasi'];
      $mutasi_masuk->mutasi_nisn = $request['mutasi_nisn'];
      $mutasi_masuk->mutasi_noinduk = $request['mutasi_noinduk'];
      $mutasi_masuk->mutasi_tempat_lahir = $request['mutasi_tempat_lahir'];
      $mutasi_masuk->mutasi_tanggal_lahir = $request['mutasi_tanggal_lahir'];
      $mutasi_masuk->mutasi_tingkat_kelas = $request['mutasi_tingkat_kelas'];
      $mutasi_masuk->mutasi_nama_wali = $request['mutasi_nama_wali'];
      $mutasi_masuk->mutasi_alamat = $request['mutasi_alamat'];
      $mutasi_masuk->mutasi_sekolah_tujuan_id = $sekolah_tujuan_id;
      $mutasi_masuk->mutasi_sekolah_tujuan_nama = $sekolah_tujuan_nama;
      $mutasi_masuk->mutasi_sekolah_tujuan_alamat = $sekolah_tujuan_alamat;
      $mutasi_masuk->mutasi_sekolah_tujuan_no_surat = $request['mutasi_sekolah_tujuan_no_surat'];
      $mutasi_masuk->mutasi_tanggal_surat_diterima = $request['mutasi_tanggal_surat_diterima'];
      $mutasi_masuk->jenjang_id = $request['jenjang_id'];
      $mutasi_masuk->mutasi_luar_kota = "";
      $mutasi_masuk->mutasi_kode_scan = $kode_scan;

      $mutasi_masuk->mutasi_pejabat_nip = $pejabat_nip;
      $mutasi_masuk->mutasi_pejabat_nama = $pejabat_nama;
      $mutasi_masuk->mutasi_pejabat_pangkat = $pejabat_pangkat;
      $mutasi_masuk->mutasi_pejabat_jabatan = $pejabat_jabatan;
      $mutasi_masuk-> save();

      // dd($mutasi_masuk->mutasi_id);

      $mutasi_id = $mutasi_masuk->mutasi_id;

      $nomor = 0;
      $tahun_ini = date("Y");
      $tanggal_ini = date("Y-m-d");

      $nomor_surat_mutasi = DB::table('nomor_surat_mutasi')->where('mutasi_id',$mutasi_id)->get();
      $no_surat = DB::table('nomor_surat_mutasi')->where(DB::raw('YEAR(tanggal)'), '=', $tahun_ini)->max('nomor');

      if (count($nomor_surat_mutasi) == 0) {
        $nomor = $no_surat+1;
        $query = DB::table('nomor_surat_mutasi')->insert([
          'mutasi_id' => $mutasi_id,
          'nomor' => $nomor,
          'tanggal' => $tanggal_ini,
          'nomor_surat' => '400.3.1/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/406.009/'.$tahun_ini
          // dirubah agar nomor menjadi fleksibel 
          // 'nomor_surat' => '400.3.1/'.$nomor.'/406.009/'.$tahun_ini
        ]);
      }

      // return view('admin.mutasi_masuk.sukses_tambah');
      return redirect('sukses_tambah_mutasi_masuk/'.$mutasi_id);
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
      return view('admin.mutasi_masuk.detail', compact('mutasi_id','mutasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mutasi = Mutasi::Find($id);
        $jenjang = Jenjang::All();
        $kecamatan = Kecamatan::All();

        $mutasi_sekolah_tujuan_id = Mutasi::where('mutasi_id','=',$id)->value('mutasi_sekolah_tujuan_id');
        $kecamatan_id = Sekolah::where('sekolah_id','=',$mutasi_sekolah_tujuan_id)->value('kecamatan_id');

        $sekolah_nama = Sekolah::where('sekolah_id','=',$mutasi_sekolah_tujuan_id)->value('sekolah_nama');
        // dd($kecamatan_id);

        return view('admin.mutasi_masuk.edit', compact('mutasi','jenjang','kecamatan','kecamatan_id','sekolah_nama','mutasi_sekolah_tujuan_id'));
        // return $mutasi;
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
      $sekolah_tujuan_id = $request['sekolah_id'];
      $sekolah_tujuan_nama = "";
      $sekolah_tujuan_alamat = "";
      $jenjang_id = "";
      $sekolah = Sekolah::where('sekolah_id','=',$sekolah_tujuan_id)->get();
      foreach ($sekolah as $data) {
        $sekolah_tujuan_nama = $data->sekolah_nama.' Kabupaten Trenggalek';
        $sekolah_tujuan_alamat = $data->sekolah_alamat;
        $jenjang_id = $data->jenjang_id;
      }

      $ldate = date('Y-m-d H:i:s');
      $kode_scan = md5(uniqid($ldate, true));

      $pejabat_id = Jenjang::where('jenjang_id','=',$jenjang_id)->value('pejabat_id');
      $pejabat = Pejabat::where('pejabat_id','=',$pejabat_id)->get();
      $pejabat_nip = "";
      $pejabat_nama = "";
      $pejabat_pangkat = "";
      $pejabat_jabatan = "";
      foreach ($pejabat as $data2) {
        $pejabat_nip = $data2->pejabat_nip;
        $pejabat_nama = $data2->pejabat_nama;
        $pejabat_pangkat = $data2->pejabat_pangkat;
        $pejabat_jabatan = $data2->pejabat_jabatan;
      }

      // dd($pejabat_jabatan);



      $mutasi_masuk = Mutasi::find($id);
      $mutasi_masuk->mutasi_jenis = "1";
      $mutasi_masuk->mutasi_nama_siswa = $request['mutasi_nama_siswa'];
      $mutasi_masuk->mutasi_sekolah_asal_id = "";
      $mutasi_masuk->mutasi_sekolah_asal_nama = $request['mutasi_sekolah_asal_nama'];
      $mutasi_masuk->mutasi_sekolah_asal_alamat = "";
      $mutasi_masuk->mutasi_sekolah_asal_no_surat = $request['mutasi_sekolah_asal_no_surat'];
      $mutasi_masuk->mutasi_tanggal_mutasi = $request['mutasi_tanggal_mutasi'];
      $mutasi_masuk->mutasi_nisn = $request['mutasi_nisn'];
      $mutasi_masuk->mutasi_noinduk = $request['mutasi_noinduk'];
      $mutasi_masuk->mutasi_tempat_lahir = $request['mutasi_tempat_lahir'];
      $mutasi_masuk->mutasi_tanggal_lahir = $request['mutasi_tanggal_lahir'];
      $mutasi_masuk->mutasi_tingkat_kelas = $request['mutasi_tingkat_kelas'];
      $mutasi_masuk->mutasi_nama_wali = $request['mutasi_nama_wali'];
      $mutasi_masuk->mutasi_alamat = $request['mutasi_alamat'];
      $mutasi_masuk->mutasi_sekolah_tujuan_id = $sekolah_tujuan_id;
      $mutasi_masuk->mutasi_sekolah_tujuan_nama = $sekolah_tujuan_nama;
      $mutasi_masuk->mutasi_sekolah_tujuan_alamat = $sekolah_tujuan_alamat;
      $mutasi_masuk->mutasi_sekolah_tujuan_no_surat = $request['mutasi_sekolah_tujuan_no_surat'];
      $mutasi_masuk->mutasi_tanggal_surat_diterima = $request['mutasi_tanggal_surat_diterima'];
      $mutasi_masuk->jenjang_id = $request['jenjang_id'];
      $mutasi_masuk->mutasi_luar_kota = "";
      // $mutasi_masuk->mutasi_kode_scan = $kode_scan;

      $mutasi_masuk->mutasi_pejabat_nip = $pejabat_nip;
      $mutasi_masuk->mutasi_pejabat_nama = $pejabat_nama;
      $mutasi_masuk->mutasi_pejabat_pangkat = $pejabat_pangkat;
      $mutasi_masuk->mutasi_pejabat_jabatan = $pejabat_jabatan;
      $mutasi_masuk-> update();

      return redirect()->route('mutasi_masuk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $mutasi_masuk = Mutasi::find($id);
      $mutasi_masuk -> delete();

      $nomor_surat_mutasi = NomorSuratMutasi::where('mutasi_id','=',$id);
      $nomor_surat_mutasi -> delete();
    }

    public function listData()
    {
      $mutasi_masuk = Mutasi::join('jenjang','mutasi.jenjang_id','=','jenjang.jenjang_id')
                        ->where('mutasi.mutasi_jenis','=','1')
                        ->orderBy('mutasi.mutasi_id', 'DESC')->get();
      $kepada = "";
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
              'aksi'=> '<a href="'.route('mutasi_masuk.show',$list->mutasi_id).'" class="btn btn-warning" data-toggle="tooltip" data-placement="botttom" title="Cetak Surat Rekomendasi"><i class="fa fa-print"></i></a>
              <a href="'.route('mutasi_masuk.edit',$list->mutasi_id).'" class="btn btn-primary" data-toggle="tooltip" data-placement="botttom" title="Edit Data"  style="color:white;"><i class="fa  fa-edit"></i></a>
              <a onclick="deleteData('.$list->mutasi_id.')" class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Hapus Data" style="color:white;"><i class="fa  fa-trash"></i></a>',
            );

          }else {
            $arr = array();
          }

        }

        $datas = new Collection($arr);
        return Datatables::of($datas)->rawColumns(['no','mutasi_nama_siswa','mutasi_noinduk','mutasi_nisn','mutasi_sekolah_asal_nama','mutasi_sekolah_tujuan_nama','aksi'])->make(true);

      }

      public function listDataJenjang($id)
      {

        $mutasi_masuk = Mutasi::join('jenjang','mutasi.jenjang_id','=','jenjang.jenjang_id')
                          ->where([
                                ['mutasi.mutasi_jenis','=','1'],
                                ['mutasi.jenjang_id', '=', $id],
                            ])
                          ->orderBy('mutasi.mutasi_id', 'DESC')
                          ->get();
        $kepada = "";
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
                'aksi'=> '<a href="'.route('mutasi_masuk.show',$list->mutasi_id).'" class="btn btn-warning" data-toggle="tooltip" data-placement="botttom" title="Cetak Surat Rekomendasi"><i class="fa fa-print"></i></a>
                <a href="'.route('mutasi_masuk.edit',$list->mutasi_id).'" class="btn btn-primary" data-toggle="tooltip" data-placement="botttom" title="Edit Data"  style="color:white;"><i class="fa  fa-edit"></i></a>
                <a onclick="deleteData('.$list->mutasi_id.')" class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Hapus Data" style="color:white;"><i class="fa  fa-trash"></i></a>',
              );

            }else {
              $arr = array();
            }

          }

          $datas = new Collection($arr);
          return Datatables::of($datas)->rawColumns(['no','mutasi_nama_siswa','mutasi_noinduk','mutasi_nisn','mutasi_sekolah_asal_nama','mutasi_sekolah_tujuan_nama','aksi'])->make(true);

        }

        function search_sekolah(Request $request)
        {

          $search         = $request->select;
          $kecamatan_id    = $request->kecamatan_id;
          $jenjang_id    = $request->jenjang_id;

          $sekolah = Sekolah::where([
                          ['kecamatan_id','=',$kecamatan_id],
                          ['jenjang_id', '=', $jenjang_id],
                          ['sekolah_nama', 'like', '%'.$search.'%'],
                      ])
                    ->get();
          return response()->json($sekolah);
        }

        public function sukses_tambah_mutasi_masuk($mutasi_id)
        {
          $mutasi = Mutasi::where('mutasi_id','=',$mutasi_id)->get();
          // dd($mutasi);
          return view('admin.mutasi_masuk.sukses_tambah', compact('mutasi_id','mutasi'));
        }

        public function suket_mutasi_masuk_pdf($mutasi_id)
        {

          $nomor = 0;
          $tahun_ini = date("Y");
          $tanggal_ini = date("Y-m-d");

          $nomor_surat_mutasi = DB::table('nomor_surat_mutasi')->where('mutasi_id',$mutasi_id)->get();
          $no_surat = DB::table('nomor_surat_mutasi')->where(DB::raw('YEAR(tanggal)'), '=', $tahun_ini)->max('nomor');

          if (count($nomor_surat_mutasi) == 0) {
            $nomor = $no_surat+1;
            $query = DB::table('nomor_surat_mutasi')->insert([
              'mutasi_id' => $mutasi_id,
              'nomor' => $nomor,
              'tanggal' => $tanggal_ini,
              'nomor_surat' => '421.2/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/406.009/'.$tahun_ini
              // dirubah agar nomor menjadi fleksibel 
              // 'nomor_surat' => '421.2/'.$nomor.'/406.009/'.$tahun_ini
            ]);
            $no_usulan_tampil = DB::table('nomor_surat_mutasi')->where('mutasi_id',$mutasi_id)->get();
          }else {
            $no_usulan_tampil = DB::table('nomor_surat_mutasi')->where('mutasi_id',$mutasi_id)->get();
          }

          $mutasi = Mutasi::join('nomor_surat_mutasi','mutasi.mutasi_id','=','nomor_surat_mutasi.mutasi_id')
                    ->where('mutasi.mutasi_id','=',$mutasi_id)
                    ->get();
                    
                    //dd($mutasi);

          $mutasi_kode_scan = Mutasi::where('mutasi.mutasi_id','=',$mutasi_id)->value('mutasi_kode_scan');

          $qrCode = QrCode::style('round')->size(75)->generate(url('qr_read')."/".$mutasi_kode_scan);
          $qrCode = str_replace('<?xml version="1.0" encoding="UTF-8"?>','', $qrCode);


          $data = [
            'mutasi' => $mutasi,
            'no_usulan_tampil' => $no_usulan_tampil,
            'qrCode' => $qrCode
          ];
          
          //dd($data);

          $options = array("format" => "A4",'orientation' => 'P');
          $pdf = PDF::loadView('admin.mutasi_masuk.suket_mutasi_masuk_pdf', $data, [], $options);
          return $pdf->stream('suket_mutasi_masuk_pdf.pdf');


        }



}
