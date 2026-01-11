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
        // return "oke mutasi masuk";
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
        'mutasi_nisn' => 'required|string|max:20',
        'mutasi_noinduk' => 'required|string|max:50',
        'mutasi_tempat_lahir' => 'required|string|max:100',
        'mutasi_tanggal_lahir' => 'required|date',
        'mutasi_tingkat_kelas' => 'required|string|max:10',
        'mutasi_nama_wali' => 'required|string|max:255',
        'mutasi_alamat' => 'required|string',
        'mutasi_sekolah_asal_nama' => 'required|string|max:255',
        'mutasi_sekolah_asal_no_surat' => 'required|string|max:100',
        'mutasi_tanggal_mutasi' => 'required|date',
        'mutasi_sekolah_tujuan_no_surat' => 'required|string|max:100',
        'mutasi_tanggal_surat_diterima' => 'required|date',
        'jenjang_id' => 'required|exists:jenjang,jenjang_id',
        ]);

      // dd($mutasi_masuk->mutasi_id);

      $sekolah = Sekolah::with(['kecamatan'])
            ->findOrFail($validated['sekolah_id']);

      $sekolahTujuanNama = "{$sekolah->sekolah_nama} {$sekolah->kecamatan->kecamatan_nama} Kabupaten Trenggalek";

        // Get pejabat data
      $pejabat = $this->getPejabatByJenjang($sekolah->jenjang_id);

        // Generate QR code
      $kodeScan = Mutasi::generateQrCode();

        // Create mutasi
      $mutasi = Mutasi::create([
        'mutasi_jenis' => Mutasi::JENIS_MASUK,
        'mutasi_nama_siswa' => $validated['mutasi_nama_siswa'],
        'mutasi_sekolah_asal_id' => null,
        'mutasi_sekolah_asal_nama' => $validated['mutasi_sekolah_asal_nama'],
        'mutasi_sekolah_asal_alamat' => '',
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
        'mutasi_luar_kota' => false,
        'mutasi_kode_scan' => $kodeScan,
        'mutasi_pejabat_nip' => $pejabat['nip'],
        'mutasi_pejabat_nama' => $pejabat['nama'],
        'mutasi_pejabat_pangkat' => $pejabat['pangkat'],
        'mutasi_pejabat_jabatan' => $pejabat['jabatan'],
        ]);

        // Generate nomor surat
        $this->generateNomorSurat($mutasi->mutasi_id, '400.3.1');

        return redirect()
            ->route('mutasi_masuk.sukses_tambah', $mutasi->mutasi_id)
            ->with('success', 'Data mutasi masuk berhasil ditambahkan');
  }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
      // $mutasi_id = $id;
      $mutasi = Mutasi::with(['sekolahAsal', 'sekolahTujuan', 'jenjang'])
            ->findOrFail($id);
      // dd($mutasi);
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
        $mutasi = Mutasi::FindOrFail($id);
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
          'mutasi_nisn' => 'required|string|max:20',
          'mutasi_noinduk' => 'required|string|max:50',
          'mutasi_tempat_lahir' => 'required|string|max:100',
          'mutasi_tanggal_lahir' => 'required|date',
          'mutasi_tingkat_kelas' => 'required|string|max:10',
          'mutasi_nama_wali' => 'required|string|max:255',
          'mutasi_alamat' => 'required|string',
          'mutasi_sekolah_asal_nama' => 'required|string|max:255',
          'mutasi_sekolah_asal_no_surat' => 'required|string|max:100',
          'mutasi_tanggal_mutasi' => 'required|date',
          'mutasi_sekolah_tujuan_no_surat' => 'required|string|max:100',
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
      $mutasi = Mutasi::with(['jenjang'])
        ->where('mutasi_jenis', Mutasi::JENIS_MASUK)
        ->orderBy('mutasi_id', 'DESC');

      return DataTables::eloquent($mutasi)            ->addIndexColumn()
        ->addColumn('aksi', function ($row) {
            return '
              <div class="btn-group" role="group">
                  <a href="' . route('mutasi_masuk.show', $row->mutasi_id) . '" 
                    class="btn btn-sm btn-warning" 
                    data-toggle="tooltip" 
                    title="Cetak Surat">
                    <i class="fa fa-print"></i>
                  </a>
                  <a href="' . route('mutasi_masuk.edit', $row->mutasi_id) . '" 
                      class="btn btn-sm btn-primary" 
                      data-toggle="tooltip" 
                      title="Edit Data">
                      <i class="fa fa-edit"></i>
                  </a>
                  <button onclick="deleteData(' . $row->mutasi_id . ')" 
                      class="btn btn-sm btn-danger" 
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

        $mutasi = Mutasi::with(['jenjang'])
            ->where('mutasi_jenis', Mutasi::JENIS_MASUK)
            ->where('jenjang_id', $id)
            ->orderBy('mutasi_id', 'DESC');

        return DataTables::eloquent($mutasi)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '
                    <div class="btn-group" role="group">
                        <a href="' . route('mutasi_masuk.show', $row->mutasi_id) . '" 
                           class="btn btn-sm btn-warning">
                            <i class="fa fa-print"></i>
                        </a>
                        <a href="' . route('mutasi_masuk.edit', $row->mutasi_id) . '" 
                           class="btn btn-sm btn-primary">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button onclick="deleteData(' . $row->mutasi_id . ')" 
                                class="btn btn-sm btn-danger">
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
          $search         = $request->input('select', '');
          $kecamatan_id    = $request->input('kecamatan_id');
          $jenjang_id    = $request->input('jenjang_id');

          $sekolah = Sekolah::where([
            ['kecamatan_id', '=', $kecamatan_id],
            ['jenjang_id', '=', $jenjang_id],
            ['sekolah_nama', 'like', '%' . $search . '%'],
          ])
          ->orderBy('sekolah_nama')
          ->get(['sekolah_id', 'sekolah_nama', 'sekolah_npsn', 'sekolah_alamat']);

          return response()->json($sekolah);
        }

        public function sukses_tambah_mutasi_masuk($mutasi_id): View
        {
          $mutasi = Mutasi::with(['sekolahTujuan', 'jenjang'])
            ->findOrFail($mutasi_id);
          return view('admin.mutasi_masuk.sukses_tambah', [
            'mutasi_id' => $mutasi_id,
            'mutasi' => collect([$mutasi])
        ]);
        }

        public function suket_mutasi_masuk_pdf(int $mutasi_id)
        {

           // Generate nomor surat if not exists
        $this->generateNomorSurat($mutasi_id, '421.2');

        // Get mutasi data with nomor surat
        $mutasi = Mutasi::join('nomor_surat_mutasi', 'mutasi.mutasi_id', '=', 'nomor_surat_mutasi.mutasi_id')
            ->where('mutasi.mutasi_id', $mutasi_id)
            ->select('mutasi.*', 'nomor_surat_mutasi.*')
            ->get();

        $nomorSurat = NomorSuratMutasi::where('mutasi_id', $mutasi_id)->get();

        // Generate QR Code
        $mutasiKodeScan = Mutasi::where('mutasi_id', $mutasi_id)
            ->value('mutasi_kode_scan');

        $qrCode = QrCode::style('round')
            ->size(75)
            ->generate(url('qr_read') . '/' . $mutasiKodeScan);

        $qrCode = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $qrCode);

        $data = [
            'mutasi' => $mutasi,
            'no_usulan_tampil' => $nomorSurat,
            'qrCode' => $qrCode
        ];

        $pdf = Pdf::loadView('admin.mutasi_masuk.suket_mutasi_masuk_pdf', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->stream('surat-mutasi-masuk-' . $mutasi_id . '.pdf');
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
                'nip' => '',
                'nama' => '',
                'pangkat' => '',
                'jabatan' => ''
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
    private function generateNomorSurat(int $mutasi_id, string $prefix): void
    {
        $exists = NomorSuratMutasi::where('mutasi_id', $mutasi_id)->exists();

        if (!$exists) {
            $tahun = Carbon::now()->year;
            $maxNomor = NomorSuratMutasi::whereYear('tanggal', $tahun)->max('nomor');
            $nomor = ($maxNomor ?? 0) + 1;

            NomorSuratMutasi::create([
                'mutasi_id' => $mutasi_id,
                'nomor' => $nomor,
                'tanggal' => Carbon::today(),
                'nomor_surat' => "{$prefix}/{$nomor}/406.009/{$tahun}"
            ]);
        }
    }
}