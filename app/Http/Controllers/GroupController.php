<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use App\Models\GroupModel;

class GroupController extends Controller
{
    /**
     * Validation messages
     *
     * @var array
     */
    protected $pesan = [
        'group_nama.required' => 'Nama group harus diisi',
        'group_nama.string' => 'Nama group harus berupa teks',
        'group_nama.max' => 'Nama group maksimal 100 karakter',
        'group_nama.unique' => 'Nama group sudah digunakan',
    ];

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        // Tambahkan middleware role jika perlu
        // $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.group.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Validate request
            $validator = Validator::make($request->all(), [
                'group_nama' => ['required', 'string', 'max:100', 'unique:groups,group_nama']
            ], $this->pesan);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Create new group
            $group = GroupModel::create([
                'group_nama' => $request->group_nama
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Group berhasil ditambahkan',
                'data' => $group
            ], 201);

           } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
     public function edit($id): JsonResponse
    {
        try {
            $group = GroupModel::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $group
            ]);
         } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Group tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
      try {
            // Find group
            $group = GroupModel::findOrFail($id);

            // Validate request - unique except current id
            $validator = Validator::make($request->all(), [
                'group_nama' => ['required', 'string', 'max:100', 'unique:groups,group_nama,' . $id . ',group_id']
            ], $this->pesan);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }
            // Update group
            $group->group_nama = $request->group_nama;
            $group->save();

            return response()->json([
                'success' => true,
                'message' => 'Group berhasil diupdate',
                'data' => $group
            ]);
          } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
     
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
     public function destroy($id): JsonResponse
    {
        try {
            $group = GroupModel::findOrFail($id);
            
            // Check if group has users
            if ($group->users()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Group tidak dapat dihapus karena masih memiliki user'
                ], 400);
            }

            $group->delete();

            return response()->json([
                'success' => true,
                'message' => 'Group berhasil dihapus'
            ]);
           } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get list data for DataTables
     *
     * @return \Illuminate\Http\JsonResponse
     */
     public function listData(): JsonResponse
    {
        try {
            $groups = GroupModel::orderBy('group_id', 'DESC')->get();
            $no = 0;
            $data = [];

            foreach ($groups as $group) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = htmlspecialchars($group->group_nama);
                $row[] = '
                    <div class="btn-group-modern text-center" role="group">
                        <a href="' . route('t_user.show', $group->group_id) . '" 
                           class="btn-modern btn-secondary-modern text-center" 
                           data-toggle="tooltip" 
                           data-placement="top" 
                           title="Setting Menu">
                            <i class="fa fa-gear"></i>
                        </a>
                        <button onclick="editForm(' . $group->group_id . ')" 
                                class="btn-modern btn-warning-modern text-center" 
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="Edit Data">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button onclick="deleteData(' . $group->group_id . ')" 
                                class="btn-modern btn-danger-modern text-center" 
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="Hapus Data">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                ';
                $data[] = $row;
            }

            return response()->json([
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'data' => [],
                'error' => $e->getMessage()
            ], 500);
        }
    }
}



     


    

   
    
  