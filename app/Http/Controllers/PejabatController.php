<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use DataTables;
use Illuminate\Support\Collection;
use App\Pejabat;

class PejabatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pejabat.index');
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
      $pejabat = new Pejabat;
      $pejabat->pejabat_nip = $request['pejabat_nip'];
      $pejabat->pejabat_nama = $request['pejabat_nama'];
      $pejabat->pejabat_pangkat = $request['pejabat_pangkat'];
      $pejabat->pejabat_jabatan = $request['pejabat_jabatan'];
      $pejabat-> save();
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
      $pejabat = Pejabat::find($id);
      echo json_encode($pejabat);
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
      $pejabat = Pejabat::find($id);
      $pejabat ->pejabat_nip = $request['pejabat_nip'];
      $pejabat ->pejabat_nama = $request['pejabat_nama'];
      $pejabat ->pejabat_pangkat = $request['pejabat_pangkat'];
      $pejabat ->pejabat_jabatan = $request['pejabat_jabatan'];
      $pejabat -> update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $pejabat = Pejabat::find($id);
      $pejabat -> delete();
    }

    public function listData()
    {
      $pejabat = Pejabat::orderBy('pejabat_id', 'DESC')->get();
      $kepada = "";
      $no = 0;
      $arr = array();
      foreach ($pejabat as $list) {

        if (count($pejabat) > 0) {

          $no++;
          $arr[] = array(
              'no'=> $no,
              'pejabat_nip'=> $list->pejabat_nip,
              'pejabat_nama'=> $list->pejabat_nama,
              'pejabat_pangkat'=> $list->pejabat_pangkat,
              'pejabat_jabatan'=> $list->pejabat_jabatan,
              'aksi'=> '<a onclick="editForm('.$list->pejabat_id.')" class="btn btn-primary" data-toggle="tooltip" data-placement="botttom" title="Edit Data"  style="color:white;"><i class="fa  fa-edit"></i></a>
              <a onclick="deleteData('.$list->pejabat_id.')" class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Hapus Data" style="color:white;"><i class="fa  fa-trash"></i></a>',
            );

          }else {
            $arr = array();
          }

        }

        $datas = new Collection($arr);
        return Datatables::of($datas)->rawColumns(['no','kecamatan_kode_wilayah','kecamatan_nama','aksi'])->make(true);

      }

}
