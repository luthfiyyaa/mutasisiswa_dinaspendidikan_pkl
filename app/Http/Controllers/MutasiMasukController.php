<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Mutasi;
use App\Models\Jenjang;
use App\Models\Kecamatan;
use App\Models\Sekolah;
use App\Models\Pejabat;
use App\Models\NomorSuratMutasi;

class MutasiMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $jenjang = Jenjang::orderBy('jenjang_nama')->get();
        return view('admin.mutasi_masuk.index', compact('jenjang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $jenjang = Jenjang::orderBy('jenjang_nama')->get();
        $kecamatan = Kecamatan::orderBy('kecamatan_nama')->get();
        return view('admin.mutasi_masuk.create', compact('jenjang','kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'sekolah_id' => 'required|exists:sekolah,sekolah_id',
            'mutasi_nama_siswa' => 'required|string|max:255',
            'mutasi_nisn' => 'required|string|max:200',
            'mutasi_noinduk' => 'required|string|max:200',
            'mutasi_tempat_lahir' => 'required|string|max:200',
            'mutasi_tanggal_lahir' => 'required|date',
            'mutasi_tingkat_kelas' => 'required|string|max:200',
            'mutasi_nama_wali' => 'required|string|max:200',
            'mutasi_alamat' => 'required|string|max:200',
            'mutasi_sekolah_asal_nama' => 'required|string|max:255',
            'mutasi_sekolah_asal_no_surat' => 'required|string|max:255',
            'mutasi_tanggal_mutasi' => 'required|date',
            'mutasi_sekolah_tujuan_no_surat' => 'required|string|max:255',
            'mutasi_tanggal_surat_diterima' => 'required|date',
            'jenjang_id' => 'required|exists:jenjang,jenjang_id',
        ]);

        $sekolah = Sekolah::with(['kecamatan'])
            ->findOrFail($validated['sekolah_id']);

        $sekolahTujuanNama = "{$sekolah->sekolah_nama} {$sekolah->kecamatan->kecamatan_nama} Kabupaten Trenggalek";

        // Get pejabat data
        $pejabat = $this->getPejabatByJenjang($sekolah->jenjang_id);

        // Generate QR code
        $kodeScan = md5(uniqid(now()->format('Y-m-d H:i:s'), true));

        // Create mutasi
        $mutasi = Mutasi::create([
            'mutasi_jenis' => '1', // Mutasi Masuk
            'mutasi_nama_siswa' => $validated['mutasi_nama_siswa'],
            'mutasi_sekolah_asal_id' => null,
            'mutasi_sekolah_asal_nama' => $validated['mutasi_sekolah_asal_nama'],
            'mutasi_sekolah_asal_alamat' => null,
            'mutasi_sekolah_asal_no_surat' => $validated['mutasi_sekolah_asal_no_surat'],
            'mutasi_tanggal_mutasi' => $validated['mutasi_tanggal_mutasi'],
            'mutasi_nisn' => $validated['mutasi_nisn'],
            'mutasi_noinduk' => $validated['mutasi_noinduk'],
            'mutasi_tempat_lahir' => $validated['mutasi_tempat_lahir'],
            'mutasi_tanggal_lahir' => $validated['mutasi_tanggal_lahir'],
            'mutasi_tingkat_kelas' => $validated['mutasi_tingkat_kelas'],
            'mutasi_nama_wali' => $validated['mutasi_nama_wali'],
            'mutasi_alamat' => $validated['mutasi_alamat'],
            'mutasi_sekolah_tujuan_id' => $sekolah->sekolah_id,
            'mutasi_sekolah_tujuan_nama' => $sekolahTujuanNama,
            'mutasi_sekolah_tujuan_alamat' => $sekolah->sekolah_alamat,
            'mutasi_sekolah_tujuan_no_surat' => $validated['mutasi_sekolah_tujuan_no_surat'],
            'mutasi_tanggal_surat_diterima' => $validated['mutasi_tanggal_surat_diterima'],
            'jenjang_id' => $validated['jenjang_id'],
            'mutasi_luar_kota' => '0',
            'mutasi_kode_scan' => $kodeScan,
            'mutasi_pejabat_nip' => $pejabat['nip'],
            'mutasi_pejabat_nama' => $pejabat['nama'],
            'mutasi_pejabat_pangkat' => $pejabat['pangkat'],
            'mutasi_pejabat_jabatan' => $pejabat['jabatan'],
        ]);

        // Generate nomor surat
        $this->generateNomorSurat($mutasi->mutasi_id, '400.3.1');

        return redirect()->route('mutasi_masuk.index')
            ->with('success', 'Data mutasi masuk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $mutasi = Mutasi::findOrFail($id);
        
        return view('admin.mutasi_masuk.detail', [
            'mutasi_id' => $id,
            'mutasi' => collect([$mutasi]) // For backward compatibility with view
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $mutasi = Mutasi::findOrFail($id);
        $jenjang = Jenjang::orderBy('jenjang_nama')->get();
        $kecamatan = Kecamatan::orderBy('kecamatan_nama')->get();

        $sekolahTujuan = Sekolah::with('kecamatan')
            ->find($mutasi->mutasi_sekolah_tujuan_id);

        return view('admin.mutasi_masuk.edit', [
            'mutasi' => $mutasi,
            'jenjang' => $jenjang,
            'kecamatan' => $kecamatan,
            'kecamatan_id' => $sekolahTujuan?->kecamatan_id,
            'sekolah_nama' => $sekolahTujuan?->sekolah_nama,
            'mutasi_sekolah_tujuan_id' => $mutasi->mutasi_sekolah_tujuan_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'sekolah_id' => 'required|exists:sekolah,sekolah_id',
            'mutasi_nama_siswa' => 'required|string|max:255',
            'mutasi_nisn' => 'required|string|max:200',
            'mutasi_noinduk' => 'required|string|max:200',
            'mutasi_tempat_lahir' => 'required|string|max:200',
            'mutasi_tanggal_lahir' => 'required|date',
            'mutasi_tingkat_kelas' => 'required|string|max:200',
            'mutasi_nama_wali' => 'required|string|max:200',
            'mutasi_alamat' => 'required|string|max:200',
            'mutasi_sekolah_asal_nama' => 'required|string|max:255',
            'mutasi_sekolah_asal_no_surat' => 'required|string|max:255',
            'mutasi_tanggal_mutasi' => 'required|date',
            'mutasi_sekolah_tujuan_no_surat' => 'required|string|max:255',
            'mutasi_tanggal_surat_diterima' => 'required|date',
            'jenjang_id' => 'required|exists:jenjang,jenjang_id',
        ]);

        $mutasi = Mutasi::findOrFail($id);

        // Get sekolah tujuan data
        $sekolah = Sekolah::with(['kecamatan'])
            ->findOrFail($validated['sekolah_id']);

        $sekolahTujuanNama = "{$sekolah->sekolah_nama} {$sekolah->kecamatan->kecamatan_nama} Kabupaten Trenggalek";

        // Get pejabat data
        $pejabat = $this->getPejabatByJenjang($sekolah->jenjang_id);

        // Update mutasi
        $mutasi->update([
            'mutasi_nama_siswa' => $validated['mutasi_nama_siswa'],
            'mutasi_sekolah_asal_nama' => $validated['mutasi_sekolah_asal_nama'],
            'mutasi_sekolah_asal_no_surat' => $validated['mutasi_sekolah_asal_no_surat'],
            'mutasi_tanggal_mutasi' => $validated['mutasi_tanggal_mutasi'],
            'mutasi_nisn' => $validated['mutasi_nisn'],
            'mutasi_noinduk' => $validated['mutasi_noinduk'],
            'mutasi_tempat_lahir' => $validated['mutasi_tempat_lahir'],
            'mutasi_tanggal_lahir' => $validated['mutasi_tanggal_lahir'],
            'mutasi_tingkat_kelas' => $validated['mutasi_tingkat_kelas'],
            'mutasi_nama_wali' => $validated['mutasi_nama_wali'],
            'mutasi_alamat' => $validated['mutasi_alamat'],
            'mutasi_sekolah_tujuan_id' => $sekolah->sekolah_id,
            'mutasi_sekolah_tujuan_nama' => $sekolahTujuanNama,
            'mutasi_sekolah_tujuan_alamat' => $sekolah->sekolah_alamat,
            'mutasi_sekolah_tujuan_no_surat' => $validated['mutasi_sekolah_tujuan_no_surat'],
            'mutasi_tanggal_surat_diterima' => $validated['mutasi_tanggal_surat_diterima'],
            'jenjang_id' => $validated['jenjang_id'],
            'mutasi_pejabat_nip' => $pejabat['nip'],
            'mutasi_pejabat_nama' => $pejabat['nama'],
            'mutasi_pejabat_pangkat' => $pejabat['pangkat'],
            'mutasi_pejabat_jabatan' => $pejabat['jabatan'],
        ]);

        return redirect()
            ->route('mutasi_masuk.index')
            ->with('success', 'Data mutasi masuk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        NomorSuratMutasi::where('mutasi_id', $id)->delete();
        Mutasi::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data mutasi berhasil dihapus'
        ]);
    }

    public function listData()
    {
        $mutasi = Mutasi::query()
            ->where('mutasi.mutasi_jenis', '1')
            ->orderBy('mutasi.mutasi_id', 'DESC');

        return DataTables::eloquent($mutasi)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '
                    <div class="btn-group-modern" role="group">
                        <a href="' . route('mutasi_masuk.show', $row->mutasi_id) . '" 
                            class="btn-modern btn-secondary-modern" 
                            data-toggle="tooltip" 
                            title="Cetak Surat">
                            <i class="fa fa-print"></i>
                        </a>
                        <a href="' . route('mutasi_masuk.edit', $row->mutasi_id) . '" 
                            class="btn-modern btn-warning-modern" 
                            data-toggle="tooltip" 
                            title="Edit Data">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button onclick="deleteData(' . $row->mutasi_id . ')" 
                            class="btn-modern btn-danger-modern" 
                            data-toggle="tooltip" 
                            title="Hapus Data">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function listDataJenjang(int $id)
    {
        $mutasi = Mutasi::query()
            ->where('mutasi_jenis', '1')
            ->where('jenjang_id', $id)
            ->orderBy('mutasi_id', 'DESC');

        return DataTables::eloquent($mutasi)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '
                    <div class="btn-group-modern" role="group">
                        <a href="' . route('mutasi_masuk.show', $row->mutasi_id) . '" 
                           class="btn-modern btn-secondary-modern">
                            <i class="fa fa-print"></i>
                        </a>
                        <a href="' . route('mutasi_masuk.edit', $row->mutasi_id) . '" 
                           class="btn-modern btn-warning-modern">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button onclick="deleteData(' . $row->mutasi_id . ')" 
                                class="btn-modern btn-danger-modern">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function search_sekolah(Request $request): JsonResponse
    {
        $search = $request->input('select', '');
        $kecamatan_id = $request->input('kecamatan_id');
        $jenjang_id = $request->input('jenjang_id');

        $sekolah = Sekolah::where([
            ['kecamatan_id', '=', $kecamatan_id],
            ['jenjang_id', '=', $jenjang_id],
            ['sekolah_nama', 'like', '%' . $search . '%'],
        ])
        ->orderBy('sekolah_nama')
        ->get(['sekolah_id', 'sekolah_nama', 'sekolah_npsn', 'sekolah_alamat']);

        return response()->json($sekolah);
    }
  
    /**
     * Get pejabat by jenjang
     */
    private function getPejabatByJenjang(int $jenjang_id): array
    {
        $pejabatId = Jenjang::where('jenjang_id', $jenjang_id)
            ->value('pejabat_id');

        $pejabat = Pejabat::find($pejabatId);

        if (!$pejabat) {
            return [
                'nip' => null,
                'nama' => null,
                'pangkat' => null,
                'jabatan' => null
            ];
        }

        return [
            'nip' => $pejabat->pejabat_nip,
            'nama' => $pejabat->pejabat_nama,
            'pangkat' => $pejabat->pejabat_pangkat,
            'jabatan' => $pejabat->pejabat_jabatan
        ];
    }

    /**
     * Generate nomor surat
     */
    private function generateNomorSurat(int $mutasi_id, string $kode_surat): void
    {
        $exists = NomorSuratMutasi::where('mutasi_id', $mutasi_id)->exists();
        
        if (!$exists) {
            $tahun = now()->year;
            $tanggal_ini = now()->format('Y-m-d');
            
            $no_surat = NomorSuratMutasi::whereYear('tanggal', $tahun)->max('nomor');
            $nomor = ($no_surat ?? 0) + 1;
            
            NomorSuratMutasi::create([
                'mutasi_id' => $mutasi_id,
                'nomor' => $nomor,
                'tanggal' => $tanggal_ini,
                'nomor_surat' => "{$kode_surat}/      /408.22/{$tahun}"
            ]);
        }
    }

    // Surat keterangan mutasi
    public function suket_mutasi_masuk_pdf(int $mutasi_id)
    {
        try {
            // Set timeout dan memory
            set_time_limit(300);
            ini_set('memory_limit', '512M');

            // Generate nomor surat
            $this->generateNomorSurat($mutasi_id, '421.2');

            // Get data
            $mutasi = Mutasi::findOrFail($mutasi_id);
            $nomorSurat = NomorSuratMutasi::where('mutasi_id', $mutasi_id)->firstOrFail();

            // Generate QR Code
            $qrCodeUrl = url('qr_read/' . $mutasi->mutasi_kode_scan);
            $qrCode = QrCode::style('round')->size(75)->generate($qrCodeUrl);
            $qrCode = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $qrCode);

            // Load PDF dengan options
            $pdf = Pdf::loadView(
                'admin.mutasi_masuk.suket_mutasi_masuk_pdf',
                compact('mutasi', 'nomorSurat', 'qrCode')
            )->setPaper('A4', 'portrait');

            // Return PDF stream
            return $pdf->stream('Surat_Keterangan_Mutasi_' . $mutasi->mutasi_nama_siswa . '.pdf');

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

    // Method untuk download PDF
    public function download_suket_mutasi_masuk_pdf(int $mutasi_id)
    {
        try {
            set_time_limit(300);
            ini_set('memory_limit', '512M');

            $this->generateNomorSurat($mutasi_id, '421.2');

            $mutasi = Mutasi::findOrFail($mutasi_id);
            $nomorSurat = NomorSuratMutasi::where('mutasi_id', $mutasi_id)->firstOrFail();

            $qrCodeUrl = url('qr_read/' . $mutasi->mutasi_kode_scan);
            $qrCode = QrCode::style('round')->size(75)->generate($qrCodeUrl);
            $qrCode = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $qrCode);

            $pdf = Pdf::loadView(
                'admin.mutasi_masuk.suket_mutasi_masuk_pdf',
                compact('mutasi', 'nomorSurat', 'qrCode')
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
}