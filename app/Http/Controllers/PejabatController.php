<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
// use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Collection;
use App\Models\Pejabat;

class PejabatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('admin.pejabat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.pejabat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
      $request->validate([
        'pejabat_nip' => 'required|string|max:50|unique:pejabat,pejabat_nip',
        'pejabat_nama' => 'required|string|max:255',
        'pejabat_pangkat' => 'required|string|max:100',
        'pejabat_jabatan' => 'required|string|max:255',
      ]);

      $pejabat = new Pejabat;
      $pejabat->pejabat_nip = $request['pejabat_nip'];
      $pejabat->pejabat_nama = $request['pejabat_nama'];
      $pejabat->pejabat_pangkat = $request['pejabat_pangkat'];
      $pejabat->pejabat_jabatan = $request['pejabat_jabatan'];
      $pejabat-> save();

      return response()->json([
        'success' => true,
        'message' => 'Data pejabat berhasil ditambahkan',
        'data' => $pejabat
      ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
      $pejabat = Pejabat::findOrFail($id);

      return response()->json([
        'success' => true,
        'data' => $pejabat
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): JsonResponse
    {
      $pejabat = Pejabat::findOrFail($id);
      return response()->json($pejabat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): JsonResponse
    {
      $pejabat = Pejabat::findOrFail($id);

      $request->validate([
        'pejabat_nip' => 'required|string|max:50|unique:pejabat,pejabat_nip,' . $id . ',pejabat_id',
        'pejabat_nama' => 'required|string|max:255',
        'pejabat_pangkat' => 'required|string|max:100',
        'pejabat_jabatan' => 'required|string|max:255',
      ]);

      $pejabat->pejabat_nip = $request['pejabat_nip'];
      $pejabat->pejabat_nama = $request['pejabat_nama'];
      $pejabat->pejabat_pangkat = $request['pejabat_pangkat'];
      $pejabat->pejabat_jabatan = $request['pejabat_jabatan'];
      $pejabat-> update();

      return response()->json([
            'success' => true,
            'message' => 'Data pejabat berhasil diperbarui',
            'data' => $pejabat
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
      $pejabat = Pejabat::findOrFail($id);
      $pejabat -> delete();

      return response()->json([
        'success' => true,
        'message' => 'Data pejabat berhasil dihapus'
      ]);
    }

    public function listData()
    {
      $pejabat = Pejabat::orderBy('pejabat_id', 'DESC');

      return DataTables::eloquent($pejabat)
        ->addIndexColumn()
        ->addColumn('aksi', function ($list) {
          return '
            <div class="btn-group-modern" role="group">
                <button onclick="editForm(' . $list->pejabat_id . ')" 
                    class="btn-modern btn-warning-modern" 
                    data-toggle="tooltip" 
                    data-placement="top" 
                    title="Edit Data">
                  <i class="fa fa-edit"></i>
                </button>
                <button onclick="deleteData(' . $list->pejabat_id . ')" 
                    class="btn-modern btn-danger-modern" 
                    data-toggle="tooltip" 
                    data-placement="top" 
                    title="Hapus Data">
                    <i class="fa fa-trash"></i>
                </button>
              </div>
                ';
            })
    ->rawColumns(['aksi'])
    ->make(true);
    }
}
