<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Mutasi;
use App\Models\Jenjang;
use App\Models\Kecamatan;
use App\Models\Sekolah;
use App\Models\Pejabat;
use App\Models\NomorSuratMutasi;

class MutasiKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenjang = Jenjang::orderBy('jenjang_nama')->get();
        return view('admin.mutasi_keluar.index', compact('jenjang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenjang = Jenjang::orderBy('jenjang_nama')->get();
        $kecamatan = Kecamatan::orderBy('kecamatan_nama')->get();
        return view('admin.mutasi_keluar.create', compact('jenjang', 'kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'sekolah_id' => 'required|exists:sekolah,sekolah_id',
                'mutasi_nama_siswa' => 'required|string|max:255',
                'mutasi_sekolah_asal_no_surat' => 'required|string|max:255',
                'mutasi_tanggal_mutasi' => 'required|date',
                'mutasi_nisn' => 'required|string|max:200',
                'mutasi_noinduk' => 'required|string|max:200',
                'mutasi_tempat_lahir' => 'required|string|max:200',
                'mutasi_tanggal_lahir' => 'required|date',
                'mutasi_tingkat_kelas' => 'required|string|max:200',
                'mutasi_nama_wali' => 'required|string|max:200',
                'mutasi_alamat' => 'required|string|max:200',
                'mutasi_sekolah_tujuan_nama' => 'required|string|max:255',
                'mutasi_sekolah_tujuan_no_surat' => 'nullable|string|max:255',
                'mutasi_tanggal_surat_diterima' => 'nullable|date',
                'jenjang_id' => 'required|exists:jenjang,jenjang_id',
            ]);

            $sekolah = Sekolah::with(['kecamatan'])->findOrFail($validated['sekolah_id']);

            $sekolah_asal_nama = "{$sekolah->sekolah_nama} {$sekolah->kecamatan->kecamatan_nama} Kabupaten Trenggalek";
            $sekolah_asal_alamat = $sekolah->sekolah_alamat;
            $jenjang_id = $sekolah->jenjang_id;

            // Get pejabat data
            $pejabat_id = Jenjang::where('jenjang_id', $jenjang_id)->value('pejabat_id');
            $pejabat = Pejabat::find($pejabat_id);

            // Create mutasi
            $mutasi_keluar = Mutasi::create([
                'mutasi_jenis' => '2',
                'mutasi_nama_siswa' => $validated['mutasi_nama_siswa'],
                'mutasi_sekolah_asal_id' => $validated['sekolah_id'],
                'mutasi_sekolah_asal_nama' => $sekolah_asal_nama,
                'mutasi_sekolah_asal_alamat' => $sekolah_asal_alamat,
                'mutasi_sekolah_asal_no_surat' => $validated['mutasi_sekolah_asal_no_surat'],
                'mutasi_tanggal_mutasi' => $validated['mutasi_tanggal_mutasi'],
                'mutasi_nisn' => $validated['mutasi_nisn'],
                'mutasi_noinduk' => $validated['mutasi_noinduk'],
                'mutasi_tempat_lahir' => $validated['mutasi_tempat_lahir'],
                'mutasi_tanggal_lahir' => $validated['mutasi_tanggal_lahir'],
                'mutasi_tingkat_kelas' => $validated['mutasi_tingkat_kelas'],
                'mutasi_nama_wali' => $validated['mutasi_nama_wali'],
                'mutasi_alamat' => $validated['mutasi_alamat'],
                'mutasi_sekolah_tujuan_id' => null,
                'mutasi_sekolah_tujuan_nama' => $validated['mutasi_sekolah_tujuan_nama'],
                'mutasi_sekolah_tujuan_alamat' => null,
                'mutasi_sekolah_tujuan_no_surat' => $validated['mutasi_sekolah_tujuan_no_surat'],
                'mutasi_tanggal_surat_diterima' => $validated['mutasi_tanggal_surat_diterima'],
                'jenjang_id' => $validated['jenjang_id'],
                'mutasi_luar_kota' => null,
                'mutasi_pejabat_nip' => optional($pejabat)->pejabat_nip,
                'mutasi_pejabat_nama' => optional($pejabat)->pejabat_nama,
                'mutasi_pejabat_pangkat' => optional($pejabat)->pejabat_pangkat,
                'mutasi_pejabat_jabatan' => optional($pejabat)->pejabat_jabatan,
            ]);

            // Create nomor surat
            $this->generateNomorSurat($mutasi_keluar->mutasi_id, '421.1');

            return redirect()->route('mutasi_keluar.index')
                ->with('success', 'Data mutasi keluar berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            \Log::error('Error creating mutasi keluar: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $mutasi_id = $id;
        $mutasi = Mutasi::where('mutasi_id', $mutasi_id)->get();
        
        return view('admin.mutasi_keluar.detail', compact('mutasi_id', 'mutasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $mutasi = Mutasi::findOrFail($id);
        $jenjang = Jenjang::all();
        $kecamatan = Kecamatan::all();

        $mutasi_sekolah_asal_id = $mutasi->mutasi_sekolah_asal_id;
        $kecamatan_id = Sekolah::where('sekolah_id', $mutasi_sekolah_asal_id)
            ->value('kecamatan_id');
        $sekolah_nama = Sekolah::where('sekolah_id', $mutasi_sekolah_asal_id)
            ->value('sekolah_nama');

        return view('admin.mutasi_keluar.edit', compact(
            'mutasi',
            'jenjang',
            'kecamatan',
            'kecamatan_id',
            'sekolah_nama',
            'mutasi_sekolah_asal_id'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'sekolah_id' => 'required|exists:sekolah,sekolah_id',
            'mutasi_nama_siswa' => 'required|string|max:255',
            'mutasi_sekolah_asal_no_surat' => 'required|string|max:255',
            'mutasi_tanggal_mutasi' => 'required|date',
            'mutasi_nisn' => 'required|string|max:200',
            'mutasi_noinduk' => 'required|string|max:200',
            'mutasi_tempat_lahir' => 'required|string|max:200',
            'mutasi_tanggal_lahir' => 'required|date',
            'mutasi_tingkat_kelas' => 'required|string|max:200',
            'mutasi_nama_wali' => 'required|string|max:200',
            'mutasi_alamat' => 'required|string|max:200',
            'mutasi_sekolah_tujuan_nama' => 'required|string|max:255',
            'mutasi_sekolah_tujuan_no_surat' => 'nullable|string|max:255',
            'mutasi_tanggal_surat_diterima' => 'nullable|date',
            'jenjang_id' => 'required|exists:jenjang,jenjang_id',
        ]);

        // Get sekolah asal data
        $sekolah = Sekolah::with(['kecamatan'])->findOrFail($validated['sekolah_id']);
        $sekolah_asal_nama = "{$sekolah->sekolah_nama} {$sekolah->kecamatan->kecamatan_nama} Kabupaten Trenggalek";
        $sekolah_asal_alamat = $sekolah->sekolah_alamat;
        $jenjang_id = $sekolah->jenjang_id;

        // Get pejabat data
        $pejabat_id = Jenjang::where('jenjang_id', $jenjang_id)->value('pejabat_id');
        $pejabat = Pejabat::find($pejabat_id);

        // Update mutasi
        $mutasi_keluar = Mutasi::findOrFail($id);
        $mutasi_keluar->update([
            'mutasi_jenis' => '2',
            'mutasi_nama_siswa' => $validated['mutasi_nama_siswa'],
            'mutasi_sekolah_asal_id' => $validated['sekolah_id'],
            'mutasi_sekolah_asal_nama' => $sekolah_asal_nama,
            'mutasi_sekolah_asal_alamat' => $sekolah_asal_alamat,
            'mutasi_sekolah_asal_no_surat' => $validated['mutasi_sekolah_asal_no_surat'],
            'mutasi_tanggal_mutasi' => $validated['mutasi_tanggal_mutasi'],
            'mutasi_nisn' => $validated['mutasi_nisn'],
            'mutasi_noinduk' => $validated['mutasi_noinduk'],
            'mutasi_tempat_lahir' => $validated['mutasi_tempat_lahir'],
            'mutasi_tanggal_lahir' => $validated['mutasi_tanggal_lahir'],
            'mutasi_tingkat_kelas' => $validated['mutasi_tingkat_kelas'],
            'mutasi_nama_wali' => $validated['mutasi_nama_wali'],
            'mutasi_alamat' => $validated['mutasi_alamat'],
            'mutasi_sekolah_tujuan_id' => null,
            'mutasi_sekolah_tujuan_nama' => $validated['mutasi_sekolah_tujuan_nama'],
            'mutasi_sekolah_tujuan_alamat' => null,
            'mutasi_sekolah_tujuan_no_surat' => $validated['mutasi_sekolah_tujuan_no_surat'],
            'mutasi_tanggal_surat_diterima' => $validated['mutasi_tanggal_surat_diterima'],
            'jenjang_id' => $validated['jenjang_id'],
            'mutasi_luar_kota' => null,
            'mutasi_pejabat_nip' => $pejabat->pejabat_nip ?? null,
            'mutasi_pejabat_nama' => $pejabat->pejabat_nama ?? null,
            'mutasi_pejabat_pangkat' => $pejabat->pejabat_pangkat ?? null,
            'mutasi_pejabat_jabatan' => $pejabat->pejabat_jabatan ?? null,
        ]);

        return redirect()->route('mutasi_keluar.index')->with('success', 'Data mutasi keluar berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $mutasi_keluar = Mutasi::findOrFail($id);
        $mutasi_keluar->delete();

        NomorSuratMutasi::where('mutasi_id', $id)->delete();

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }

    /**
     * Get datatable listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listData()
    {
        $mutasi_keluar = Mutasi::query()
            ->where('mutasi.mutasi_jenis', '2')
            ->orderBy('mutasi.mutasi_id', 'DESC');

        return DataTables::of($mutasi_keluar)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return sprintf(
                    '<div class="btn-group-modern">
                    <a href="%s" class="btn-modern btn-secondary-modern"  data-toggle="tooltip" data-placement="bottom" title="Cetak Surat Rekomendasi"><i class="fa fa-print"></i></a>
                    <a href="%s" class="btn-modern btn-warning-modern" data-toggle="tooltip" data-placement="bottom" title="Edit Data" style="color:white;"><i class="fa fa-edit"></i></a>
                    <a onclick="deleteData(%d)" class="btn-modern btn-danger-modern" data-toggle="tooltip" data-placement="bottom" title="Hapus Data" style="color:white;"><i class="fa fa-trash"></i></a></div>',
                    route('mutasi_keluar.show', $row->mutasi_id),
                    route('mutasi_keluar.edit', $row->mutasi_id),
                    $row->mutasi_id
                );
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Get filtered datatable listing by jenjang
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function listDataJenjang(int $id)
    {
        $mutasi_keluar = Mutasi::query()
            ->join('jenjang', 'mutasi.jenjang_id', '=', 'jenjang.jenjang_id')
            ->where('mutasi.mutasi_jenis', '2')
            ->where('mutasi.jenjang_id', $id)
            ->select('mutasi.*', 'jenjang.jenjang_nama')
            ->orderBy('mutasi.mutasi_id', 'DESC');

        return DataTables::of($mutasi_keluar)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return sprintf(
                    '<div class="btn-group-modern">
                    <a href="%s" class="btn-modern btn-secondary-modern" data-toggle="tooltip" data-placement="bottom" title="Cetak Surat Rekomendasi"><i class="fa fa-print"></i></a>
                    <a href="%s" class="btn-modern btn-warning-modern" data-toggle="tooltip" data-placement="bottom" title="Edit Data" style="color:white;"><i class="fa fa-edit"></i></a>
                    <a onclick="deleteData(%d)" class="btn-modern btn-danger-modern" data-toggle="tooltip" data-placement="bottom" title="Hapus Data" style="color:white;"><i class="fa fa-trash"></i></a></div>',
                    route('mutasi_keluar.show', $row->mutasi_id),
                    route('mutasi_keluar.edit', $row->mutasi_id),
                    $row->mutasi_id
                );
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Generate PDF surat keterangan mutasi keluar
     *
     * @param  int  $mutasi_id
     * @return \Illuminate\Http\Response
     */
    public function suket_mutasi_keluar_pdf(int $mutasi_id)
    {
        try {
            // Set timeout dan memory
            set_time_limit(300);
            ini_set('memory_limit', '512M');

            // Create nomor surat if not exists
            $this->generateNomorSurat($mutasi_id, '421.1');

            // Get nomor surat
            $mutasi = Mutasi::findOrFail($mutasi_id);
            $nomorSurat = NomorSuratMutasi::where('mutasi_id', $mutasi_id)->firstOrFail();

            $pdf = Pdf::loadView(
                'admin.mutasi_keluar.suket_mutasi_keluar_pdf',
                compact('mutasi', 'nomorSurat')
            )->setPaper('A4', 'portrait');

            return $pdf->stream('Surat_Keterangan_Mutasi_'.$mutasi->mutasi_nama_siswa.'.pdf');

        } catch (\Exception $e) {
            // Log error
            \Log::error('PDF Generation Error: ' . $e->getMessage());
            
            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Gagal generate PDF: ' . $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    public function download_suket_mutasi_keluar_pdf(int $mutasi_id)
    {
        try {
            set_time_limit(300);
            ini_set('memory_limit', '512M');

            $this->generateNomorSurat($mutasi_id, '421.1');

            $mutasi = Mutasi::findOrFail($mutasi_id);
            $nomorSurat = NomorSuratMutasi::where('mutasi_id', $mutasi_id)->firstOrFail();

            $pdf = Pdf::loadView(
                'admin.mutasi_keluar.suket_mutasi_keluar_pdf',
                compact('mutasi', 'nomorSurat')
            )
            ->setPaper('A4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'sans-serif'
            ]);

            return $pdf->download('Surat_Keterangan_Mutasi_' . $mutasi->mutasi_nama_siswa . '.pdf');

        } catch (\Exception $e) {
            \Log::error('PDF Download Error: ' . $e->getMessage());
            
            return back()->with('error', 'Gagal download PDF: ' . $e->getMessage());
        }
    }

    /**
     * Create nomor surat mutasi
     *
     * @param  int  $mutasi_id
     * @param  string  $kode_surat
     * @return void
     */
    private function generateNomorSurat(int $mutasi_id, string $kode_surat): void
    {
        $tahun_ini = now()->year;
        $tanggal_ini = now()->format('Y-m-d');

        // Check if nomor surat already exists
        $exists = NomorSuratMutasi::where('mutasi_id', $mutasi_id)->exists();

        if (!$exists) {
            $no_surat = NomorSuratMutasi::whereYear('tanggal', $tahun_ini)->max('nomor');
            $nomor = ($no_surat ?? 0) + 1;

            NomorSuratMutasi::create([
                'mutasi_id' => $mutasi_id,
                'nomor' => $nomor,
                'tanggal' => $tanggal_ini,
                'nomor_surat' => "{$kode_surat}/______/406.009/{$tahun_ini}"
            ]);
        }
    }
}