<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use DataTables;
use Illuminate\Support\Collection;
use App\Jenjang;
use App\Pejabat;

class JenjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pejabat = Pejabat::orderBy('pejabat_id','desc')->get();
        return view('admin.jenjang.index', compact('pejabat'));

        // dd($pejabat);
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
      $jenjang = new Jenjang;
      $jenjang->jenjang_nama = $request['jenjang_nama'];
      $jenjang->pejabat_id = $request['pejabat_id'];
      $jenjang-> save();
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
      $jenjang = Jenjang::find($id);
      echo json_encode($jenjang);
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
      $jenjang = Jenjang::find($id);
      $jenjang ->jenjang_nama = $request['jenjang_nama'];
      $jenjang ->pejabat_id = $request['pejabat_id'];
      $jenjang -> update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $jenjang = Jenjang::find($id);
      $jenjang -> delete();
    }

    public function listData()
    {
      $jenjang = Jenjang::join('pejabat','jenjang.pejabat_id','=','pejabat.pejabat_id')
                  ->orderBy('jenjang_id', 'ASC')
                  ->get();
      $kepada = "";
      $no = 0;
      $arr = array();
      foreach ($jenjang as $list) {

        if (count($jenjang) > 0) {

          $no++;
          $arr[] = array(
              'no'=> $no,
              'jenjang_nama'=> $list->jenjang_nama,
              'pejabat_nama'=> $list->pejabat_nama,
              'aksi'=> '<a onclick="editForm('.$list->jenjang_id.')" class="btn btn-primary" data-toggle="tooltip" data-placement="botttom" title="Edit Data"  style="color:white;"><i class="fa  fa-edit"></i></a>
              <a onclick="deleteData('.$list->jenjang_id.')" class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Hapus Data" style="color:white;"><i class="fa  fa-trash"></i></a>',
            );

          }else {
            $arr = array();
          }

        }

        $datas = new Collection($arr);
        return Datatables::of($datas)->rawColumns(['no','jenjang_nama','pejabat_nama','aksi'])->make(true);

      }

}
