<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Redirect;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Collection;
use App\Models\Jenjang;
use App\Models\Kecamatan;
use App\Models\Sekolah;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
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
    public function create(): View
    {
        //
        $jenjang = Jenjang::orderBy('jenjang_nama')->get();
        $kecamatan = Kecamatan::orderBy('kecamatan_nama')->get();
        
        return view('admin.sekolah.create', compact('jenjang', 'kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
      $validated = $request->validate([
            'kecamatan_id' => 'required|exists:kecamatan,kecamatan_id',
            'jenjang_id' => 'required|exists:jenjang,jenjang_id',
            'sekolah_npsn' => 'required|string|max:20|unique:sekolah,sekolah_npsn',
            'sekolah_nama' => 'required|string|max:255',
            'sekolah_alamat' => 'required|string',
        ]);

        $sekolah = Sekolah::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data sekolah berhasil ditambahkan',
            'data' => $sekolah
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
        //
        $sekolah = Sekolah::with(['kecamatan', 'jenjang'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $sekolah
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
      $sekolah = Sekolah::with(['kecamatan', 'jenjang'])
            ->findOrFail($id);
      return response()->json($sekolah);
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
      $sekolah = Sekolah::findOrFail($id);
      
      $validated = $request->validate([
            'kecamatan_id' => 'required|exists:kecamatan,kecamatan_id',
            'jenjang_id' => 'required|exists:jenjang,jenjang_id',
            'sekolah_npsn' => 'required|string|max:20|unique:sekolah,sekolah_npsn,' . $id . ',sekolah_id',
            'sekolah_nama' => 'required|string|max:255',
            'sekolah_alamat' => 'required|string',
        ]);
      
        $sekolah -> update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data sekolah berhasil diperbarui',
            'data' => $sekolah
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
      $sekolah = Sekolah::findOrFail($id);
      $sekolah -> delete();

      return response()->json([
            'success' => true,
            'message' => 'Data sekolah berhasil dihapus'
        ]);
    }

    public function listData()
    {
      $sekolah = Sekolah::with(['kecamatan', 'jenjang'])
            ->select('sekolah.*')
            ->orderBy('sekolah_id', 'ASC');

      return DataTables::eloquent($sekolah)
            ->addIndexColumn()
            ->addColumn('jenjang_nama', function ($row) {
                return $row->jenjang->jenjang_nama ?? '-';
            })
            ->addColumn('kecamatan_nama', function ($row) {
                return $row->kecamatan->kecamatan_nama ?? '-';
            })
            ->addColumn('aksi', function ($row) {
                return '
                    <div class="btn-group" role="group">
                        <button onclick="editForm(' . $row->sekolah_id . ')" 
                                class="btn btn-sm btn-primary" 
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="Edit Data">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button onclick="deleteData(' . $row->sekolah_id . ')" 
                                class="btn btn-sm btn-danger" 
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

    /**
     * Get sekolah by jenjang (untuk keperluan filter)
     */
    public function getByJenjang(Request $request): JsonResponse
    {
        $jenjangId = $request->get('jenjang_id');
        
        $sekolah = Sekolah::where('jenjang_id', $jenjangId)
            ->orderBy('sekolah_nama')
            ->get(['sekolah_id', 'sekolah_nama', 'sekolah_npsn']);

        return response()->json($sekolah);
    }

    /**
     * Get sekolah by kecamatan (untuk keperluan filter)
     */
    public function getByKecamatan(Request $request): JsonResponse
    {
        $kecamatanId = $request->get('kecamatan_id');
        
        $sekolah = Sekolah::where('kecamatan_id', $kecamatanId)
            ->orderBy('sekolah_nama')
            ->get(['sekolah_id', 'sekolah_nama', 'sekolah_npsn']);

        return response()->json($sekolah);
    }

    /**
     * Export data sekolah (contoh untuk Excel/PDF)
     */
    public function export(Request $request)
    {
        // Implementasi export jika diperlukan
        // Bisa pakai Laravel Excel atau TCPDF
    }
}