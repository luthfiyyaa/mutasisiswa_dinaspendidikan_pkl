<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\GroupModel;
use App\Models\MasterUserModel;

class MasterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = GroupModel::all();
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
        $validated = $request->validate([
            'group_id' => 'required|exists:tbl_group,group_id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'users_email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        MasterUserModel::create([
            'group_id' => $validated['group_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'users_email' => $validated['users_email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json(['success' => true, 'message' => 'User berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $master_user = MasterUserModel::findOrFail($id);
        return response()->json($master_user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $master_user = MasterUserModel::findOrFail($id);

        $validated = $request->validate([
            'group_id' => 'required|exists:tbl_group,group_id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'users_email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        $updateData = [
            'group_id' => $validated['group_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'users_email' => $validated['users_email'],
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $master_user->update($updateData);

        return response()->json(['success' => true, 'message' => 'User berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $master_user = MasterUserModel::findOrFail($id);
        $master_user->delete();

        return response()->json(['success' => true, 'message' => 'User berhasil dihapus']);
    }

    /**
     * Get datatable listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listData()
    {
        $satuan = MasterUserModel::query()
            ->join('tbl_group', 'tbl_group.group_id', '=', 'users.group_id')
            ->select('users.*', 'tbl_group.group_nama')
            ->orderBy('users.id', 'DESC')
            ->get();

        $data = $satuan->map(function ($list, $index) {
            return [
                $index + 1,
                $list->name,
                $list->group_nama,
                $list->users_email,
                $list->email,
                '*************',
                sprintf(
                    '<a onclick="editForm(%d)" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit Data" style="color:white;"><i class="fa fa-edit"></i></a>
                    <a onclick="deleteData(%d)" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus Data" style="color:white;"><i class="fa fa-trash"></i></a>',
                    $list->id,
                    $list->id
                )
            ];
        })->toArray();

        return response()->json(['data' => $data]);
    }
}