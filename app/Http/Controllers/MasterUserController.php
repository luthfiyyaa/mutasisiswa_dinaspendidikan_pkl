<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use App\GroupModel;
use App\MasterUserModel;

class MasterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = GroupModel::All();
        return view('admin.master_user.index', compact('group'));
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
      $master_user = new MasterUserModel;
      $master_user ->group_id = $request['group_id'];
      $master_user ->name = $request['name'];
      $master_user ->email = $request['email'];
      $master_user ->users_email = $request['users_email'];
      $master_user ->password = bcrypt($request['password']);
      $master_user -> save();
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
      $master_user = MasterUserModel::find($id);
      echo json_encode($master_user);
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
      $master_user = MasterUserModel::find($id);
      $master_user ->group_id = $request['group_id'];
      $master_user ->name = $request['name'];
      $master_user ->email = $request['email'];
      $master_user ->users_email = $request['users_email'];
      $master_user ->password = bcrypt($request['password']);
      $master_user -> update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $master_user = MasterUserModel::find($id);
      $master_user -> delete();
    }

    public function listData()
    {
        $satuan = MasterUserModel::join('tbl_group', 'tbl_group.group_id','=','users.group_id')->orderBy('id', 'DESC')->get();
        $no = 0;
        $data = array();
        foreach ($satuan as $list) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->name;
            $row[] = $list->group_nama;
            $row[] = $list->users_email;
            $row[] = $list->email;
            $row[] = "*************";
            $row[] = '<a onclick="editForm('.$list->id.')" class="btn btn-primary" data-toggle="tooltip" data-placement="botttom" title="Edit Data"  style="color:white;"><i class="fa  fa-edit"></i></a>
            <a onclick="deleteData('.$list->id.')" class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Hapus Data" style="color:white;"><i class="fa  fa-trash"></i></a>';
            $data[] = $row;

        }

        $output = array("data" => $data);
        return response()->json($output);

    }
}
