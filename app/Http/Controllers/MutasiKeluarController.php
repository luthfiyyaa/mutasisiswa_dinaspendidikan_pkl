<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Mutasi;
use App\Models\Jenjang;
use App\Models\Kecamatan;
use App\Models\Sekolah;
use App\Models\Pejabat;
use App\Models\NomorSuratMutasi;
use Carbon\Carbon;

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
        $validated = $request->validate([
            'sekolah_id' => 'required|exists:sekolah,sekolah_id',
            'mutasi_nama_siswa' => 'required|string|max:255',
            'mutasi_sekolah_asal_no_surat' => 'required|string|max:255',
            'mutasi_tanggal_mutasi' => 'required|date',
            'mutasi_nisn' => 'required|string|max:50',
            'mutasi_noinduk' => 'required|string|max:50',
            'mutasi_tempat_lahir' => 'required|string|max:255',
            'mutasi_tanggal_lahir' => 'required|date',
            'mutasi_tingkat_kelas' => 'required|string|max:50',
            'mutasi_nama_wali' => 'required|string|max:255',
            'mutasi_alamat' => 'required|string',
            'mutasi_sekolah_tujuan_nama' => 'required|string|max:255',
            'mutasi_sekolah_tujuan_no_surat' => 'nullable|string|max:255',
            'mutasi_tanggal_surat_diterima' => 'nullable|date',
            'jenjang_id' => 'required|exists:jenjang,jenjang_id',
        ]);

        // Get sekolah asal data
        $sekolah = Sekolah::with('kecamatan')->findOrFail($validated['sekolah_id']);
        $kecamatan_nama = $sekolah->kecamatan->kecamatan_nama ?? '';
        
        $sekolah_asal_nama = "{$sekolah->sekolah_nama} {$kecamatan_nama} Kabupaten Trenggalek";
        $sekolah_asal_alamat = $sekolah->sekolah_alamat;
        $jenjang_id = $sekolah->jenjang_id;

        // Generate unique scan code
        $kode_scan = md5(uniqid(now()->format('Y-m-d H:i:s'), true));

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
            'mutasi_sekolah_tujuan_id' => '',
            'mutasi_sekolah_tujuan_nama' => $validated['mutasi_sekolah_tujuan_nama'],
            'mutasi_sekolah_tujuan_alamat' => '',
            'mutasi_sekolah_tujuan_no_surat' => $validated['mutasi_sekolah_tujuan_no_surat'] ?? '',
            'mutasi_tanggal_surat_diterima' => $validated['mutasi_tanggal_surat_diterima'] ?? null,
            'jenjang_id' => $validated['jenjang_id'],
            'mutasi_luar_kota' => '',
            'mutasi_kode_scan' => $kode_scan,
            'mutasi_pejabat_nip' => $pejabat->pejabat_nip ?? '',
            'mutasi_pejabat_nama' => $pejabat->pejabat_nama ?? '',
            'mutasi_pejabat_pangkat' => $pejabat->pejabat_pangkat ?? '',
            'mutasi_pejabat_jabatan' => $pejabat->pejabat_jabatan ?? '',
        ]);

        // Create nomor surat
        $this->generateNomorSurat($mutasi_keluar->mutasi_id,'421.2');

        return redirect()->route('mutasi_keluar.index')->with('success', 'Data mutasi keluar berhasil ditambahkan!');
    
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
            'mutasi_nisn' => 'required|string|max:50',
            'mutasi_noinduk' => 'required|string|max:50',
            'mutasi_tempat_lahir' => 'required|string|max:255',
            'mutasi_tanggal_lahir' => 'required|date',
            'mutasi_tingkat_kelas' => 'required|string|max:50',
            'mutasi_nama_wali' => 'required|string|max:255',
            'mutasi_alamat' => 'required|string',
            'mutasi_sekolah_tujuan_nama' => 'required|string|max:255',
            'mutasi_sekolah_tujuan_no_surat' => 'nullable|string|max:255',
            'mutasi_tanggal_surat_diterima' => 'nullable|date',
            'jenjang_id' => 'required|exists:jenjang,jenjang_id',
        ]);

        // Get sekolah asal data
        $sekolah = Sekolah::findOrFail($validated['sekolah_id']);
        $sekolah_asal_nama = "{$sekolah->sekolah_nama} Kabupaten Trenggalek";
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
            'mutasi_sekolah_tujuan_id' => '',
            'mutasi_sekolah_tujuan_nama' => $validated['mutasi_sekolah_tujuan_nama'],
            'mutasi_sekolah_tujuan_alamat' => '',
            'mutasi_sekolah_tujuan_no_surat' => $validated['mutasi_sekolah_tujuan_no_surat'] ?? '',
            'mutasi_tanggal_surat_diterima' => $validated['mutasi_tanggal_surat_diterima'] ?? null,
            'jenjang_id' => $validated['jenjang_id'],
            'mutasi_luar_kota' => '',
            'mutasi_pejabat_nip' => $pejabat->pejabat_nip ?? '',
            'mutasi_pejabat_nama' => $pejabat->pejabat_nama ?? '',
            'mutasi_pejabat_pangkat' => $pejabat->pejabat_pangkat ?? '',
            'mutasi_pejabat_jabatan' => $pejabat->pejabat_jabatan ?? '',
        ]);

        return redirect()->route('mutasi_keluar.index');
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
            // ->select('mutasi.*', 'jenjang.jenjang_nama')
            ->orderBy('mutasi.mutasi_id', 'DESC');

        return DataTables::of($mutasi_keluar)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return sprintf(
                    '<a href="%s" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Cetak Surat Rekomendasi"><i class="fa fa-print"></i></a>
                    <a href="%s" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit Data" style="color:white;"><i class="fa fa-edit"></i></a>
                    <a onclick="deleteData(%d)" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus Data" style="color:white;"><i class="fa fa-trash"></i></a>',
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
                    '<a href="%s" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Cetak Surat Rekomendasi"><i class="fa fa-print"></i></a>
                    <a href="%s" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit Data" style="color:white;"><i class="fa fa-edit"></i></a>
                    <a onclick="deleteData(%d)" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus Data" style="color:white;"><i class="fa fa-trash"></i></a>',
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
        $this->generateNomorSurat($mutasi_id, '421.2');

        // Get nomor surat
        $mutasi = Mutasi::findOrFail($mutasi_id);
        $nomorSurat = NomorSuratMutasi::where('mutasi_id', $mutasi_id)->firstOrFail();

        // Get QR code
        $mutasi_kode_scan = Mutasi::where('mutasi_id', $mutasi_id)->value('mutasi_kode_scan');
        $qrCode = QrCode::style('round')->size(75)->generate(url('qr_read', $mutasi_kode_scan));
        $qrCode = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $qrCode);

        $pdf = Pdf::loadView(
            'admin.mutasi_keluar.suket_mutasi_keluar_pdf',
            compact('mutasi', 'nomorSurat', 'qrCode')
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

            $this->generateNomorSurat($mutasi_id, '421.2');

            $mutasi = Mutasi::findOrFail($mutasi_id);
            $nomorSurat = NomorSuratMutasi::where('mutasi_id', $mutasi_id)->firstOrFail();

            $qrCodeUrl = url('qr_read/' . $mutasi->mutasi_kode_scan);
            $qrCode = QrCode::style('round')->size(75)->generate($qrCodeUrl);
            $qrCode = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $qrCode);

            $pdf = Pdf::loadView(
                'admin.mutasi_masuk.suket_mutasi_keluar_pdf',
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

    /**
     * Create nomor surat mutasi
     *
     * @param  int  $mutasi_id
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
                'nomor_surat' => "421.2/ /406.009/{$tahun_ini}"
            ]);
        }
    }
}