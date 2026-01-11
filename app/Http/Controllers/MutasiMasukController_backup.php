<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
// use Illuminate\Support\Collection;
use App\Models\Mutasi;
use App\Models\Jenjang;
use App\Models\Kecamatan;
use App\Models\Sekolah;
use App\Models\Pejabat;
use App\Models\NomorSuratMutasi;
use Carbon\Carbon;

class MutasiMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $jenjang = Jenjang::all();
        return view('admin.mutasi_masuk.index', compact('jenjang'));
        // return "oke mutasi masuk";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $jenjang = Jenjang::all();
        $kecamatan = Kecamatan::all();
        return view('admin.mutasi_masuk.create', compact('jenjang','kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
      $request->validate([
        'sekolah_id' => 'required|exists:sekolah,sekolah_id',
        'mutasi_nama_siswa' => 'required|string|max:255',
        'mutasi_nisn' => 'required|string|max:20',
        'mutasi_noinduk' => 'required|string|max:50',
        'mutasi_tempat_lahir' => 'required|string|max:100',
        'mutasi_tanggal_lahir' => 'required|date',
        'mutasi_tingkat_kelas' => 'required|string|max:10',
        'mutasi_nama_wali' => 'required|string|max:255',
        'mutasi_alamat' => 'required|string',
        'mutasi_sekolah_asal_nama' => 'required|string|max:255',
        'mutasi_sekolah_asal_no_surat' => 'required|string|max:100',
        'mutasi_tanggal_mutasi' => 'required|date',
        'mutasi_sekolah_tujuan_no_surat' => 'required|string|max:100',
        'mutasi_tanggal_surat_diterima' => 'required|date',
        'jenjang_id' => 'required|exists:jenjang,jenjang_id',
      ]);

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
      $mutasi_masuk->save();

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
          'nomor_surat' => '400.3.1/'.$nomor.'/406.009/'.$tahun_ini
        ]);
      }

      // return view('admin.mutasi_masuk.sukses_tambah');
      return redirect('sukses_tambah_mutasi_masuk/' . $mutasi_id)
        ->with('success', 'Data mutasi masuk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
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
    public function edit($id): View
    {
        $mutasi = Mutasi::FindOrFail($id);
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
    public function update(Request $request, $id): RedirectResponse
    {
      $request->validate([
            'sekolah_id' => 'required|exists:sekolah,sekolah_id',
            'mutasi_nama_siswa' => 'required|string|max:255',
            'mutasi_nisn' => 'required|string|max:20',
            'mutasi_noinduk' => 'required|string|max:50',
            'mutasi_tempat_lahir' => 'required|string|max:100',
            'mutasi_tanggal_lahir' => 'required|date',
            'mutasi_tingkat_kelas' => 'required|string|max:10',
            'mutasi_nama_wali' => 'required|string|max:255',
            'mutasi_alamat' => 'required|string',
            'mutasi_sekolah_asal_nama' => 'required|string|max:255',
            'mutasi_sekolah_asal_no_surat' => 'required|string|max:100',
            'mutasi_tanggal_mutasi' => 'required|date',
            'mutasi_sekolah_tujuan_no_surat' => 'required|string|max:100',
            'mutasi_tanggal_surat_diterima' => 'required|date',
            'jenjang_id' => 'required|exists:jenjang,jenjang_id',
      ]);

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



      $mutasi_masuk = Mutasi::findOrFail($id);
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
      $mutasi_masuk->update();

      return redirect()->route('mutasi_masuk.index')
            ->with('success', 'Data mutasi masuk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
      $mutasi_masuk = Mutasi::findOrFail($id);
      $mutasi_masuk -> delete();

      $nomor_surat_mutasi = NomorSuratMutasi::where('mutasi_id','=',$id);
      $nomor_surat_mutasi -> delete();

      return response()->json([
            'success' => true,
            'message' => 'Data mutasi berhasil dihapus'
        ]);
    }

    public function listData()
    {
     $mutasi_masuk = Mutasi::join('jenjang', 'mutasi.jenjang_id', '=', 'jenjang.jenjang_id')
            ->where('mutasi.mutasi_jenis', '=', '1')
            ->orderBy('mutasi.mutasi_id', 'DESC')
            ->select('mutasi.*', 'jenjang.jenjang_nama');
     
      return DataTables::eloquent($mutasi_masuk)
            ->addIndexColumn()
            ->addColumn('aksi', function ($list) {
                return '
                    <div class="btn-group" role="group">
                        <a href="' . route('mutasi_masuk.show', $list->mutasi_id) . '" 
                           class="btn btn-sm btn-warning" 
                           data-toggle="tooltip" 
                           title="Cetak Surat">
                            <i class="fa fa-print"></i>
                        </a>
                        <a href="' . route('mutasi_masuk.edit', $list->mutasi_id) . '" 
                           class="btn btn-sm btn-primary" 
                           data-toggle="tooltip" 
                           title="Edit Data">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button onclick="deleteData(' . $list->mutasi_id . ')" 
                                class="btn btn-sm btn-danger" 
                                data-toggle="tooltip" 
                                title="Hapus Data">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

      public function listDataJenjang(int $id)
      {

        $mutasi_masuk = Mutasi::join('jenjang','mutasi.jenjang_id','=','jenjang.jenjang_id')
                          ->where([
                                ['mutasi.mutasi_jenis','=','1'],
                                ['mutasi.jenjang_id', '=', $id],
                            ])
                          ->orderBy('mutasi.mutasi_id', 'DESC')
                          ->get();
        return DataTables::eloquent($mutasi_masuk)
            ->addIndexColumn()
            ->addColumn('aksi', function ($list) {
                return '
                    <div class="btn-group" role="group">
                        <a href="' . route('mutasi_masuk.show', $list->mutasi_id) . '" 
                           class="btn btn-sm btn-warning">
                            <i class="fa fa-print"></i>
                        </a>
                        <a href="' . route('mutasi_masuk.edit', $list->mutasi_id) . '" 
                           class="btn btn-sm btn-primary">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button onclick="deleteData(' . $list->mutasi_id . ')" 
                                class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

        public function search_sekolah(Request $request): JsonResponse
        {
          $search        = $request->select;
          $kecamatan_id  = $request->kecamatan_id;
          $jenjang_id    = $request->jenjang_id;

          $sekolah = Sekolah::where([
              ['kecamatan_id','=',$kecamatan_id],
              ['jenjang_id', '=', $jenjang_id],
              ['sekolah_nama', 'like', '%'.$search.'%'],
          ])->get();
          return response()->json($sekolah);
        }

        public function sukses_tambah_mutasi_masuk($mutasi_id): View
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
               'nomor_surat' => '421.2/'.$nomor.'/406.009/'.$tahun_ini
            ]);
            $no_usulan_tampil = DB::table('nomor_surat_mutasi')->where('mutasi_id',$mutasi_id)->get();
          }else {
            $no_usulan_tampil = DB::table('nomor_surat_mutasi')->where('mutasi_id',$mutasi_id)->get();
          }

          $mutasi = Mutasi::join('nomor_surat_mutasi','mutasi.mutasi_id','=','nomor_surat_mutasi.mutasi_id')
                    ->where('mutasi.mutasi_id','=',$mutasi_id)
                    ->get();

          $mutasi_kode_scan = Mutasi::where('mutasi.mutasi_id','=',$mutasi_id)->value('mutasi_kode_scan');

          $qrCode = QrCode::style('round')->size(75)->generate(url('qr_read')."/".$mutasi_kode_scan);
          $qrCode = str_replace('<?xml version="1.0" encoding="UTF-8"?>','', $qrCode);


          $data = [
            'mutasi' => $mutasi,
            'no_usulan_tampil' => $no_usulan_tampil,
            'qrCode' => $qrCode
          ];

          $pdf = Pdf::loadView('admin.mutasi_masuk.suket_mutasi_masuk_pdf', $data)
            ->setPaper('folio', 'portrait');

        return $pdf->stream('suket_mutasi_masuk_pdf.pdf');
    }
}
