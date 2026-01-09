<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use DataTables;
use Illuminate\Support\Collection;
use App\Kecamatan;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kecamatan.index');
        // return "oke kecamatan";
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
      $kecamatan = new Kecamatan;
      $kecamatan->kecamatan_kode_wilayah = $request['kecamatan_kode_wilayah'];
      $kecamatan->kecamatan_nama = $request['kecamatan_nama'];
      $kecamatan-> save();
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
      $kecamatan = Kecamatan::find($id);
      echo json_encode($kecamatan);
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
      $kecamatan = Kecamatan::find($id);
      $kecamatan ->kecamatan_kode_wilayah = $request['kecamatan_kode_wilayah'];
      $kecamatan ->kecamatan_nama = $request['kecamatan_nama'];
      $kecamatan -> update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $kecamatan = Kecamatan::find($id);
      $kecamatan -> delete();
    }

    public function listData()
    {
      $kecamatan = Kecamatan::orderBy('kecamatan_id', 'ASC')->get();
      $kepada = "";
      $no = 0;
      $arr = array();
      foreach ($kecamatan as $list) {

        if (count($kecamatan) > 0) {

          $no++;
          $arr[] = array(
              'no'=> $no,
              'kecamatan_kode_wilayah'=> $list->kecamatan_kode_wilayah,
              'kecamatan_nama'=> $list->kecamatan_nama,
              'aksi'=> '<a onclick="editForm('.$list->kecamatan_id.')" class="btn btn-primary" data-toggle="tooltip" data-placement="botttom" title="Edit Data"  style="color:white;"><i class="fa  fa-edit"></i></a>
              <a onclick="deleteData('.$list->kecamatan_id.')" class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Hapus Data" style="color:white;"><i class="fa  fa-trash"></i></a>',
            );

          }else {
            $arr = array();
          }

        }

        $datas = new Collection($arr);
        return Datatables::of($datas)->rawColumns(['no','kecamatan_kode_wilayah','kecamatan_nama','aksi'])->make(true);

      }

}
