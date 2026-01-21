<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Jenjang;
use App\Models\Pejabat;

class JenjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pejabat = Pejabat::orderBy('pejabat_id', 'desc')->get();
        return view('admin.jenjang.index', compact('pejabat'));
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
            'jenjang_nama' => 'required|string|max:255',
            'pejabat_id' => 'required|exists:pejabat,pejabat_id',
        ]);

        Jenjang::create([
            'jenjang_nama' => $validated['jenjang_nama'],
            'pejabat_id' => $validated['pejabat_id'],
        ]);

        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
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
        $jenjang = Jenjang::findOrFail($id);
        return response()->json($jenjang);
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
            'jenjang_nama' => 'required|string|max:255',
            'pejabat_id' => 'required|exists:pejabat,pejabat_id',
        ]);

        $jenjang = Jenjang::findOrFail($id);
        $jenjang->update([
            'jenjang_nama' => $validated['jenjang_nama'],
            'pejabat_id' => $validated['pejabat_id'],
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
        $jenjang = Jenjang::findOrFail($id);
        $jenjang->delete();

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }

    /**
     * Get datatable listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listData()
    {
        $jenjang = Jenjang::query()
            ->join('pejabat', 'jenjang.pejabat_id', '=', 'pejabat.pejabat_id')
            ->select('jenjang.*', 'pejabat.pejabat_nama')
            ->orderBy('jenjang_id', 'ASC');

        return DataTables::of($jenjang)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return sprintf(
                    '<div class="btn-group-modern">
                    <a onclick="editForm(%d)" class="btn-modern btn-warning-modern" data-toggle="tooltip" data-placement="bottom" title="Edit Data" style="color:white;"><i class="fa fa-edit"></i></a>
                    <a onclick="deleteData(%d)" class="btn-modern btn-danger-modern" data-toggle="tooltip" data-placement="bottom" title="Hapus Data" style="color:white;"><i class="fa fa-trash"></i></a></div>',
                    $row->jenjang_id,
                    $row->jenjang_id
                );
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}