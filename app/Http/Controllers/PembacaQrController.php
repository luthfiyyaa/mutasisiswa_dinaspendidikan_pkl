<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Mutasi;
use App\Helpers\TanggalIndonesia;

class PembacaQrController extends Controller
{
  public function index($mutasi_kode_scan): View
  {
    $mutasi = Mutasi::where('mutasi_kode_scan', $mutasiKodeScan)->first();
        
    if (!$mutasi) {
        abort(404, 'Data mutasi tidak ditemukan');
    }
    // return "oke".$mutasi_id;
    return view('admin.qr_read.index', [
            'mutasi_kode_scan' => $mutasiKodeScan,
            'mutasi' => $mutasi
        ]);
  }

  function getDataMutasi(): JsonResponse
  {
     $data = collect([]);
        
        return DataTables::of($data)
            ->rawColumns(['detail', 'isi'])
            ->make(true);

    // $arr = array();
    // $datas = new Collection($arr);
    // return Datatables::of($datas)->rawColumns(['detail','isi'])->make(true);

    // dd($datas);
  }

  function getDataMutasiCek($mutasi_kode_scan): JsonResponse
  {

    $mutasi = Mutasi::where('mutasi_kode_scan','=',$mutasi_kode_scan)->get();
    $mutasi = Mutasi::where('mutasi_kode_scan', $mutasiKodeScan)->first();

        if (!$mutasi) {
            return DataTables::of(collect([]))
                ->rawColumns(['detail', 'isi'])
                ->make(true);
        }

        // Build data array dengan struktur yang lebih clean
        $data = $this->buildMutasiDetailData($mutasi);

        return DataTables::of(collect($data))
            ->rawColumns(['detail', 'isi'])
            ->make(true);
    }

    // dd($mutasi_nama_siswa);

    // $detail  = array('Nama','No. Induk','NISN','Tingkat Kelas','Tempat/Tgl Lahir',
    // 'Nama Wali','Alamat','Nama Sekolah (Asal)','Nomor Surat (Sekolah Asal)','Tanggal Surat (Sekolah Asal)',
    // 'Nama Sekolah (Tujuan)','Nomor Surat (Sekolah Tujuan)', 'Tanggal Surat (Sekolah Tujuan)');
    // $isi  = array($mutasi_nama_siswa, $mutasi_noinduk, $mutasi_nisn, $mutasi_tingkat_kelas, $mutasi_ttl,
    // $mutasi_nama_wali, $mutasi_alamat,
    // $mutasi_sekolah_asal_nama, $mutasi_sekolah_asal_no_surat, $mutasi_tanggal_mutasi,
    // $mutasi_sekolah_tujuan_nama, $mutasi_sekolah_tujuan_no_surat, $mutasi_tanggal_surat_diterima);


    //   for ($i=0; $i < count($detail); $i++) {
    //     $arr[] = array(
    //       'detail'=> $detail[$i],
    //       'isi'=> $isi[$i]
    //     );
    //   }
    // }else {
    //   $arr = array();
    // }

    // // dd($arr);

    // $datas = new Collection($arr);
    // return Datatables::of($datas)->rawColumns(['detail','isi'])->make(true);

    
    /**
     * Build mutasi detail data array
     */
    private function buildMutasiDetailData(Mutasi $mutasi): array
    {
        return [
            [
                'detail' => 'Nama',
                'isi' => ": {$mutasi->mutasi_nama_siswa}"
            ],
            [
                'detail' => 'No. Induk',
                'isi' => ": {$mutasi->mutasi_noinduk}"
            ],
            [
                'detail' => 'NISN',
                'isi' => ": {$mutasi->mutasi_nisn}"
            ],
            [
                'detail' => 'Tingkat Kelas',
                'isi' => ": {$mutasi->mutasi_tingkat_kelas}"
            ],
            [
                'detail' => 'Tempat/Tgl Lahir',
                'isi' => ": {$mutasi->mutasi_tempat_lahir} / " . 
                         TanggalIndonesia::format($mutasi->mutasi_tanggal_lahir, false)
            ],
            [
                'detail' => 'Nama Wali',
                'isi' => ": {$mutasi->mutasi_nama_wali}"
            ],
            [
                'detail' => 'Alamat',
                'isi' => ": {$mutasi->mutasi_alamat}"
            ],
            [
                'detail' => 'Nama Sekolah (Asal)',
                'isi' => ": {$mutasi->mutasi_sekolah_asal_nama}"
            ],
            [
                'detail' => 'Nomor Surat (Sekolah Asal)',
                'isi' => ": {$mutasi->mutasi_sekolah_asal_no_surat}"
            ],
            [
                'detail' => 'Tanggal Surat (Sekolah Asal)',
                'isi' => ": " . TanggalIndonesia::format($mutasi->mutasi_tanggal_mutasi, false)
            ],
            [
                'detail' => 'Nama Sekolah (Tujuan)',
                'isi' => ": {$mutasi->mutasi_sekolah_tujuan_nama}"
            ],
            [
                'detail' => 'Nomor Surat (Sekolah Tujuan)',
                'isi' => ": {$mutasi->mutasi_sekolah_tujuan_no_surat}"
            ],
            [
                'detail' => 'Tanggal Surat (Sekolah Tujuan)',
                'isi' => ": " . TanggalIndonesia::format($mutasi->mutasi_tanggal_surat_diterima, false)
            ],
        ];
    }

    /**
     * Get mutasi data as JSON (alternative method untuk non-datatable)
     */
    public function getMutasiDetail(string $mutasiKodeScan): JsonResponse
    {
        $mutasi = Mutasi::where('mutasi_kode_scan', $mutasiKodeScan)->first();

        if (!$mutasi) {
            return response()->json([
                'success' => false,
                'message' => 'Data mutasi tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'siswa' => [
                    'nama' => $mutasi->mutasi_nama_siswa,
                    'no_induk' => $mutasi->mutasi_noinduk,
                    'nisn' => $mutasi->mutasi_nisn,
                    'tingkat_kelas' => $mutasi->mutasi_tingkat_kelas,
                    'tempat_lahir' => $mutasi->mutasi_tempat_lahir,
                    'tanggal_lahir' => $mutasi->mutasi_tanggal_lahir,
                    'tanggal_lahir_formatted' => TanggalIndonesia::format($mutasi->mutasi_tanggal_lahir, false),
                    'nama_wali' => $mutasi->mutasi_nama_wali,
                    'alamat' => $mutasi->mutasi_alamat,
                ],
                'sekolah_asal' => [
                    'nama' => $mutasi->mutasi_sekolah_asal_nama,
                    'no_surat' => $mutasi->mutasi_sekolah_asal_no_surat,
                    'tanggal_mutasi' => $mutasi->mutasi_tanggal_mutasi,
                    'tanggal_mutasi_formatted' => TanggalIndonesia::format($mutasi->mutasi_tanggal_mutasi, false),
                ],
                'sekolah_tujuan' => [
                    'nama' => $mutasi->mutasi_sekolah_tujuan_nama,
                    'no_surat' => $mutasi->mutasi_sekolah_tujuan_no_surat,
                    'tanggal_surat_diterima' => $mutasi->mutasi_tanggal_surat_diterima,
                    'tanggal_surat_diterima_formatted' => TanggalIndonesia::format($mutasi->mutasi_tanggal_surat_diterima, false),
                ],
            ]
        ]);
    }

    /**
     * Verify QR code and return status
     */
    public function verifyQrCode(string $mutasiKodeScan): JsonResponse
    {
        $exists = Mutasi::where('mutasi_kode_scan', $mutasiKodeScan)->exists();

        return response()->json([
            'success' => true,
            'valid' => $exists,
            'message' => $exists ? 'QR Code valid' : 'QR Code tidak ditemukan'
        ]);
    }

    /**
     * Scan QR code via camera/upload (untuk future feature)
     */
    public function scan(): View
    {
        return view('admin.qr_read.scan');
    }

    /**
     * Process scanned QR code
     */
    public function processScan(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'qr_code' => 'required|string'
        ]);

        $mutasi = Mutasi::where('mutasi_kode_scan', $validated['qr_code'])->first();

        if (!$mutasi) {
            return response()->json([
                'success' => false,
                'message' => 'QR Code tidak valid atau data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'QR Code berhasil di-scan',
            'redirect_url' => route('qr_read.index', $mutasi->mutasi_kode_scan)
        ]);
    }
}
