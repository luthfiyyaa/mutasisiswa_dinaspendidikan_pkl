<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use DataTables;
use Illuminate\Support\Collection;
use App\Jenjang;
use App\Kecamatan;
use App\Sekolah;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $jenjang = Jenjang::orderBy('jenjang_id','desc')->get();
      $kecamatan = Kecamatan::orderBy('kecamatan_id','desc')->get();
      return view('admin.sekolah.index', compact('jenjang','kecamatan'));
      // return "oke sekolah";
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
      $sekolah = new Sekolah;
      $sekolah->kecamatan_id = $request['kecamatan_id'];
      $sekolah->jenjang_id = $request['jenjang_id'];
      $sekolah->sekolah_npsn = $request['sekolah_npsn'];
      $sekolah->sekolah_nama = $request['sekolah_nama'];
      $sekolah->sekolah_alamat = $request['sekolah_alamat'];
      $sekolah-> save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $sekolah = Sekolah::find($id);
      echo json_encode($sekolah);
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
      $sekolah = Sekolah::find($id);
      $sekolah ->kecamatan_id = $request['kecamatan_id'];
      $sekolah ->jenjang_id = $request['jenjang_id'];
      $sekolah ->sekolah_npsn = $request['sekolah_npsn'];
      $sekolah ->sekolah_nama = $request['sekolah_nama'];
      $sekolah ->sekolah_alamat = $request['sekolah_alamat'];
      $sekolah -> update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $sekolah = Sekolah::find($id);
      $sekolah -> delete();
    }

    public function listData()
    {
      $sekolah = Sekolah::leftjoin('kecamatan','sekolah.kecamatan_id','=','kecamatan.kecamatan_id')
                  ->leftjoin('jenjang','sekolah.jenjang_id','=','jenjang.jenjang_id')
                  ->orderBy('sekolah_id', 'ASC')
                  ->get();
      $kepada = "";
      $no = 0;
      $arr = array();
      foreach ($sekolah as $list) {

        if (count($sekolah) > 0) {

          $no++;
          $arr[] = array(
              'no'=> $no,
              'sekolah_nama'=> $list->sekolah_nama,
              'sekolah_npsn'=> $list->sekolah_npsn,
              'jenjang_nama'=> $list->jenjang_nama,
              'kecamatan_nama'=> $list->kecamatan_nama,
              'sekolah_alamat'=> $list->sekolah_alamat,
              'aksi'=> '<a onclick="editForm('.$list->sekolah_id.')" class="btn btn-primary" data-toggle="tooltip" data-placement="botttom" title="Edit Data"  style="color:white;"><i class="fa  fa-edit"></i></a>
              <a onclick="deleteData('.$list->sekolah_id.')" class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Hapus Data" style="color:white;"><i class="fa  fa-trash"></i></a>',
            );

          }else {
            $arr = array();
          }

        }

        $datas = new Collection($arr);
        return Datatables::of($datas)->rawColumns(['no','jenjang_nama','pejabat_nama','aksi'])->make(true);

      }

}
