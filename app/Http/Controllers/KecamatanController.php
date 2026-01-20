<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Kecamatan;

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
            'kecamatan_kode_wilayah' => 'required|string|max:50',
            'kecamatan_nama' => 'required|string|max:255',
        ]);

        Kecamatan::create([
            'kecamatan_kode_wilayah' => $validated['kecamatan_kode_wilayah'],
            'kecamatan_nama' => $validated['kecamatan_nama'],
        ]);

        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        return response()->json($kecamatan);
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
        $validated = $request->validate([
            'kecamatan_kode_wilayah' => 'required|string|max:50',
            'kecamatan_nama' => 'required|string|max:255',
        ]);

        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->update([
            'kecamatan_kode_wilayah' => $validated['kecamatan_kode_wilayah'],
            'kecamatan_nama' => $validated['kecamatan_nama'],
        ]);

        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->delete();

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }

    /**
     * Get datatable listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listData()
    {
        $kecamatan = Kecamatan::query()->orderBy('kecamatan_id', 'ASC');

        return DataTables::of($kecamatan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return sprintf(
                    '<a onclick="editForm(%d)" class="btn-modern btn-warning-modern text-center" data-toggle="tooltip" data-placement="bottom" title="Edit Data" style="color:white;"><i class="fa fa-edit"></i></a>
                    <a onclick="deleteData(%d)" class="btn-modern btn-danger-modern text-center" data-toggle="tooltip" data-placement="bottom" title="Hapus Data" style="color:white;"><i class="fa fa-trash"></i></a>',
                    $row->kecamatan_id,
                    $row->kecamatan_id
                );
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}