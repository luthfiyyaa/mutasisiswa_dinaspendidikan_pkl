<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Helpers\TanggalIndonesia;
use App\Models\Mutasi;
use App\Models\Jenjang;
use App\Models\Kecamatan;
use App\Models\Sekolah;
use App\Models\Pejabat;
use App\Models\NomorSuratMutasi;

class LaporanMutasiKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenjang = Jenjang::all();
        return view('admin.laporan_mutasi_keluar.index', compact('jenjang'));
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
        
        return view('admin.laporan_mutasi_keluar.detail', compact('mutasi_id', 'mutasi'));
    }


    /**
     * Get datatable listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listData()
    {
        $mutasi_masuk = Mutasi::query()
            ->join('jenjang', 'mutasi.jenjang_id', '=', 'jenjang.jenjang_id')
            ->join('nomor_surat_mutasi', 'mutasi.mutasi_id', '=', 'nomor_surat_mutasi.mutasi_id')
            ->where('mutasi.mutasi_jenis', '2')
            ->select('mutasi.*', 'jenjang.jenjang_nama')
            ->orderBy('mutasi.mutasi_id', 'DESC');

        return DataTables::of($mutasi_masuk)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return sprintf(
                    '<a href="%s" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Lihat Detail"><i class="fa fa-eye"></i></a>',
                    route('laporan_mutasi_keluar.show', $row->mutasi_id)
                );
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Get filtered datatable listing
     *
     * @param  string  $tanggal_awal
     * @param  string  $tanggal_akhir
     * @param  string  $jenjang_id
     * @param  string  $query
     * @return \Illuminate\Http\JsonResponse
     */
    public function listDataFilter(string $tanggal_awal, string $tanggal_akhir, string $jenjang_id, string $query)
    {
        $mutasi_jenis = "2";

        $mutasi_masuk = Mutasi::query()
            ->join('jenjang', 'mutasi.jenjang_id', '=', 'jenjang.jenjang_id')
            ->join('nomor_surat_mutasi', 'mutasi.mutasi_id', '=', 'nomor_surat_mutasi.mutasi_id')
            ->where('mutasi.mutasi_jenis', $mutasi_jenis);

        // Apply filters based on query type
        match ($query) {
            'q1' => null, // No additional filters
            'q2' => $mutasi_masuk->where('mutasi.jenjang_id', $jenjang_id),
            'q3' => $mutasi_masuk->whereBetween('nomor_surat_mutasi.tanggal', [$tanggal_awal, $tanggal_akhir]),
            default => $mutasi_masuk->whereBetween('nomor_surat_mutasi.tanggal', [$tanggal_awal, $tanggal_akhir])
                                   ->where('mutasi.jenjang_id', $jenjang_id),
        };

        $mutasi_masuk->select('mutasi.*', 'jenjang.jenjang_nama')
                     ->orderBy('mutasi.mutasi_id', 'DESC');

        return DataTables::of($mutasi_masuk)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return sprintf(
                    '<a href="%s" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Lihat Detail"><i class="fa fa-eye"></i></a>',
                    route('laporan_mutasi_keluar.show', $row->mutasi_id)
                );
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Export laporan mutasi keluar to Excel
     *
     * @param  string  $tanggal_awal
     * @param  string  $tanggal_akhir
     * @param  string  $jenjang_id
     * @param  string  $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function laporan_mutasi_keluar_excel_file(
        string $tanggal_awal,
        string $tanggal_akhir,
        string $jenjang_id,
        string $query
    ) {
        return Excel::download(
            new LaporanKeluarExport($tanggal_awal, $tanggal_akhir, $jenjang_id, $query),
            'laporan_mutasi_keluar.xlsx'
        );
    }
}

class LaporanKeluarExport implements FromView
{
    use Exportable;

    /**
     * Constructor
     *
     * @param  string  $tanggal_begin
     * @param  string  $tanggal_end
     * @param  string  $jenjang
     * @param  string  $qry
     */
    public function __construct(
        private readonly string $tanggal_begin,
        private readonly string $tanggal_end,
        private readonly string $jenjang,
        private readonly string $qry
    ) {}

    /**
     * Generate view for export
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        $tanggal_awal = $this->tanggal_begin;
        $tanggal_akhir = $this->tanggal_end;
        $jenjang_id = $this->jenjang;
        $query = $this->qry;
        $mutasi_jenis = "2";

        // Format dates for display
        $begin_date = $tanggal_awal == 0 
            ? "-" 
            : TanggalIndonesia::format($tanggal_awal, false);

        $end_date = $tanggal_akhir == 0 
            ? "-" 
            : TanggalIndonesia::format($tanggal_akhir, false);

        // Get jenjang name
        $jenjang_nama = $jenjang_id === "all"
            ? "Semua Jenjang"
            : Jenjang::where('jenjang_id', $jenjang_id)->value('jenjang_nama');

        // Build query based on filter type
        $data_xl = Mutasi::query()
            ->join('jenjang', 'mutasi.jenjang_id', '=', 'jenjang.jenjang_id')
            ->join('nomor_surat_mutasi', 'mutasi.mutasi_id', '=', 'nomor_surat_mutasi.mutasi_id')
            ->where('mutasi.mutasi_jenis', $mutasi_jenis);

        // Apply filters
        match ($query) {
            'q1' => null, // No additional filters
            'q2' => $data_xl->where('mutasi.jenjang_id', $jenjang_id),
            'q3' => $data_xl->whereBetween('nomor_surat_mutasi.tanggal', [$tanggal_awal, $tanggal_akhir]),
            default => $data_xl->whereBetween('nomor_surat_mutasi.tanggal', [$tanggal_awal, $tanggal_akhir])
                              ->where('mutasi.jenjang_id', $jenjang_id),
        };

        $data_xl = $data_xl->select(
            'mutasi.mutasi_nama_siswa',
            'mutasi.mutasi_sekolah_asal_nama',
            'mutasi.mutasi_sekolah_asal_no_surat',
            'mutasi.mutasi_tanggal_mutasi',
            'mutasi.mutasi_nisn',
            'mutasi.mutasi_noinduk',
            'mutasi.mutasi_tempat_lahir',
            'mutasi.mutasi_tanggal_lahir',
            'mutasi.mutasi_tingkat_kelas',
            'mutasi.mutasi_nama_wali',
            'mutasi.mutasi_alamat',
            'mutasi.mutasi_sekolah_tujuan_nama',
            'mutasi.mutasi_sekolah_tujuan_no_surat',
            'mutasi.mutasi_tanggal_surat_diterima'
        )->get();

        return view('admin.laporan_mutasi_keluar.laporan_mutasi_keluar_excel', [
            'mutasi_keluar' => $data_xl,
            'begin_date' => $begin_date,
            'end_date' => $end_date,
            'jenjang_nama' => $jenjang_nama,
        ]);
    }
}