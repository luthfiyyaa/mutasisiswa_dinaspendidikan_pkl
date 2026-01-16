<table border="1" width="100%">
  <thead>
    <tr>
      <th colspan="13" align="center" style="font-size: 14pt"><b>Data Laporan Mutasi Masuk</b></th>
    </tr>
    <tr>
      <td colspan="13" align="left" style="font-size: 12pt">{{$begin_date}} s/d {{$end_date}}</td>
    </tr>
    <tr>
      <td colspan="13" align="left" style="font-size: 12pt">Jenjang : {{$jenjang_nama}}</td>
    </tr>
    <tr>
      <th align="center" style="width: 8px;border: 7px solid black"><b>NO.</b></th>
      <th align="center" style="width: 45px;border: 7px solid black"><b>NAMA</b></th>
      <th align="center" style="width: 45px;border: 7px solid black"><b>SEKOLAH ASAL</b></th>
      <th align="center" style="width: 30px;border: 7px solid black"><b>NO. SURAT SEKOLAH ASAL</b></th>
      <th align="center" style="width: 30px;border: 7px solid black"><b>TGL SURAT MUTASI</b></th>
      <th align="center" style="width: 20px;border: 7px solid black"><b>NO INDUK / NISN</b></th>
      <th align="center" style="width: 30px;border: 7px solid black"><b>TEMPAT TANGGAL LAHIR</b></th>
      <th align="center" style="width: 20px;border: 7px solid black"><b>TINGKAT KELAS</b></th>
      <th align="center" style="width: 45px;border: 7px solid black"><b>NAMA WALI</b></th>
      <th align="center" style="width: 45px;border: 7px solid black"><b>ALAMAT</b></th>
      <th align="center" style="width: 45px;border: 7px solid black"><b>PINDAH KE SEKOLAH</b></th>
      <th align="center" style="width: 30px;border: 7px solid black"><b>NO. SURAT SEKOLAH PENERIMA</b></th>
      <th align="center" style="width: 30px;border: 7px solid black"><b>TANGGAL SURAT DITERIMA</b></th>
    </tr>
  </thead>
  <tbody>
    @php $no = 1; @endphp
    @foreach($mutasi_masuk as $data)

    <tr>
      <td align="center" style="border: 7px solid black;">{{ $no++ }}.</td>
      <td style="border: 7px solid black;">{{ $data->mutasi_nama_siswa }}</td>
      <td style="border: 7px solid black;">{{ $data->mutasi_sekolah_asal_nama }}</td>
      <td style="border: 7px solid black;">{{ $data->mutasi_sekolah_asal_no_surat }}</td>
      <td style="border: 7px solid black;">{{ App\Helpers\TanggalIndonesia::format($data->mutasi_tanggal_mutasi, false) }}</td>
      <td style="border: 7px solid black;">{{ $data->mutasi_noinduk }} / {{ $data->mutasi_nisn }}</td>
      <td style="border: 7px solid black;">{{ $data->mutasi_tempat_lahir }}, {{ tanggal_indonesia($data->mutasi_tanggal_lahir, false) }}</td>
      <td style="border: 7px solid black;">{{ $data->mutasi_tingkat_kelas }}</td>
      <td style="border: 7px solid black;">{{ $data->mutasi_nama_wali }}</td>
      <td style="border: 7px solid black;">{{ $data->mutasi_alamat }}</td>
      <td style="border: 7px solid black;">{{ $data->mutasi_sekolah_tujuan_nama }}</td>
      <td style="border: 7px solid black;">{{ $data->mutasi_sekolah_tujuan_no_surat }}</td>
      <td style="border: 7px solid black;">{{ App\Helpers\TanggalIndonesia::format($data->mutasi_tanggal_surat_diterima, false) }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
