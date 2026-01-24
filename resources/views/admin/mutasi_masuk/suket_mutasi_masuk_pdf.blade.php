<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Surat Keterangan Mutasi - {{ $mutasi->mutasi_nama_siswa }}</title>
    <style>
        @page {
            margin: 15mm 15mm 15mm 15mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
        }

        .text-center { 
            text-align: center; 
        }

        .header-wrapper {
            width: 100%;
            margin-bottom: 10px;
        }

        .header-table {
            width: 100%;
            border: none;
        }

        .header-table td {
            vertical-align: middle;
            border: none;
        }

        .logo-cell {
            width: 100px;
            text-align: left;
        }

        .header-logo {
            width: 80px;
            height: auto;
        }

        .header-text {
            text-align: center;
        }

        .header-text p {
            margin: 2px 0;
            line-height: 1.3;
        }

        .header-title {
            font-size: 12pt;
            font-weight: bold;
        }

        .header-main {
            font-size: 16pt;
            font-weight: bold;
        }

        .header-address {
            font-size: 11pt;
        }

        .header-city {
            font-size: 13pt;
            font-weight: bold;
        }

        .header-line {
            border: none;
            border-top: 3px solid #000;
            margin: 2px 0;
        }

        .header-line-thin {
            border: none;
            border-top: 1px solid #000;
            margin: 2px 0 15px 0;
        }

        .document-title {
            font-weight: bold;
            text-decoration: underline;
            margin: 15px 0 5px 0;
            font-size: 13pt;
        }

        .document-number {
            margin-bottom: 15px;
            font-size: 12pt;
        }

        .content-text {
            text-align: justify;
            text-indent: 40px;
            margin: 10px 0;
        }

        .data-section {
            margin: 15px 0 15px 40px;
        }

        .data-table {
            width: 100%;
            border: none;
        }

        .data-table td {
            padding: 3px 0;
            vertical-align: top;
            border: none;
        }

        .data-label {
            width: 180px;
        }

        .data-colon {
            width: 15px;
        }

        .signature-wrapper {
            margin-top: 25px;
        }

        .signature-table {
            width: 100%;
            border: none;
        }

        .signature-table td {
            border: none;
            vertical-align: top;
        }

        .signature-left {
            width: 35%;
        }

        .signature-right {
            width: 65%;
            text-align: center;
        }

        .signature-space {
            height: 70px;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
            margin: 5px 0;
        }

        .footer-wrapper {
            margin-top: 20px;
        }

        .footer-table {
            width: 100%;
            border: none;
        }

        .footer-table td {
            border: none;
            vertical-align: top;
        }

        .footer-left {
            width: 50%;
        }

        .footer-right {
            width: 50%;
            text-align: center;
        }

        .tembusan-indent {
            margin-left: 14px;
        }

        .qr-code {
            display: inline-block;
            margin: 10px 0;
        }

        .qr-text {
            font-size: 8pt;
            line-height: 1.3;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    {{-- Header --}}
    <div class="header-wrapper">
        <table class="header-table">
            <tr>
                <img src="{{ public_path('admin/images/logo_trenggalek_hitam_putih.jpg') }}" style="width:90px;">

                <td class="header-text">
                    <p class="header-title">PEMERINTAH KABUPATEN TRENGGALEK</p>
                    <p class="header-main">DINAS PENDIDIKAN, PEMUDA DAN OLAHRAGA</p>
                    <p class="header-address">Jalan RA. Kartini Nomor 76 Telp. (0355) 791344 Fax. (0355) 791129</p>
                    <p class="header-city">TRENGGALEK (66315)</p>
                </td>
            </tr>
        </table>
        <hr class="header-line">
        <hr class="header-line-thin">
    </div>

    {{-- Document Title --}}
    <div class="text-center">
        <p class="document-title">SURAT KETERANGAN MUTASI SISWA</p>
        <p class="document-number">Nomor : {{ $nomorSurat->nomor_surat }}</p>
    </div>

    {{-- Content --}}
    <p class="content-text">
        Yang bertanda tangan dibawah ini Kepala Dinas Pendidikan, Pemuda dan Olahraga 
        Kabupaten Trenggalek menerangkan bahwa :
    </p>

    <div class="data-section">
        <table class="data-table">
            <tr>
                <td class="data-label">Nama</td>
                <td class="data-colon">:</td>
                <td>{{ $mutasi->mutasi_nama_siswa }}</td>
            </tr>
            <tr>
                <td class="data-label">No. Induk / NISN</td>
                <td class="data-colon">:</td>
                <td>{{ $mutasi->mutasi_noinduk }} / {{ $mutasi->mutasi_nisn }}</td>
            </tr>
            <tr>
                <td class="data-label">Tempat Tanggal Lahir</td>
                <td class="data-colon">:</td>
                <td>{{ $mutasi->mutasi_tempat_lahir }}, {{ App\Helpers\TanggalIndonesia::format($mutasi->mutasi_tanggal_lahir, false) }}</td>
            </tr>
            <tr>
                <td class="data-label">Asal Sekolah</td>
                <td class="data-colon">:</td>
                <td>{{ $mutasi->mutasi_sekolah_asal_nama }}</td>
            </tr>
            <tr>
                <td class="data-label">Tingkat / Kelas</td>
                <td class="data-colon">:</td>
                <td>{{ $mutasi->mutasi_tingkat_kelas }}</td>
            </tr>
            <tr>
                <td class="data-label">Nama Orang Tua / Wali</td>
                <td class="data-colon">:</td>
                <td>{{ $mutasi->mutasi_nama_wali }}</td>
            </tr>
            <tr>
                <td class="data-label">Alamat</td>
                <td class="data-colon">:</td>
                <td>{{ $mutasi->mutasi_alamat }}</td>
            </tr>
        </table>
    </div>

    <p class="content-text">
        Berdasarkan Surat Keterangan Pindah / Mutasi dari {{ $mutasi->mutasi_sekolah_asal_nama }} 
        Nomor : {{ $mutasi->mutasi_sekolah_asal_no_surat }} 
        Tanggal {{ App\Helpers\TanggalIndonesia::format($mutasi->mutasi_tanggal_mutasi, false) }} 
        serta Surat Keterangan Kesediaan Menerima dari {{ $mutasi->mutasi_sekolah_tujuan_nama }} 
        Nomor : {{ $mutasi->mutasi_sekolah_tujuan_no_surat }} 
        Tanggal {{ App\Helpers\TanggalIndonesia::format($mutasi->mutasi_tanggal_surat_diterima, false) }} 
        pada prinsipnya kami menyetujui mutasi siswa tersebut.
    </p>

    <p class="content-text">
        Demikian Surat keterangan ini diberikan untuk dapat digunakan sebagaimana mestinya.
    </p>
<br>

<table border="0" style="width:100%; margin-left:40px;">
	<tr>
		<td style="width:170px;">Nama</td><td>:</td>
		<td>{{ $mutasi->mutasi_nama_siswa }}</td>
	</tr>
	<tr>
		<td>No. Induk / NISN</td><td>:</td>
		<td>{{ $mutasi->mutasi_noinduk }} / {{ $mutasi->mutasi_nisn }}</td>
	</tr>
	<tr>
		<td>Tempat Tanggal Lahir</td><td>:</td>
		<td>{{ $mutasi->mutasi_tempat_lahir }},
			{{ App\Helpers\TanggalIndonesia::format($mutasi->mutasi_tanggal_lahir, false) }}
		</td>
	</tr>
	<tr>
		<td>Asal Sekolah</td><td>:</td>
		<td>{{ $mutasi->mutasi_sekolah_asal_nama }}</td>
	</tr>
	<tr>
		<td>Tingkat / Kelas</td><td>:</td>
		<td>{{ $mutasi->mutasi_tingkat_kelas }}</td>
	</tr>
	<tr>
		<td>Nama Orang Tua / Wali</td><td>:</td>
		<td>{{ $mutasi->mutasi_nama_wali }}</td>
	</tr>
	<tr>
		<td>Alamat</td><td>:</td>
		<td>{{ $mutasi->mutasi_alamat }}</td>
	</tr>
</table>

<br>

<p style="text-align:justify;">
	Berdasarkan Surat Keterangan Pindah / Mutasi dari
	{{ $mutasi->mutasi_sekolah_asal_nama }} Nomor :
	{{ $mutasi->mutasi_sekolah_asal_no_surat }} Tanggal
	{{ App\Helpers\TanggalIndonesia::format($mutasi->mutasi_tanggal_mutasi, false) }}
	serta Surat Keterangan Kesediaan Menerima dari
	{{ $mutasi->mutasi_sekolah_tujuan_nama }} Nomor :
	{{ $mutasi->mutasi_sekolah_tujuan_no_surat }} Tanggal
	{{ App\Helpers\TanggalIndonesia::format($mutasi->mutasi_tanggal_surat_diterima, false) }},
	pada prinsipnya kami menyetujui mutasi siswa tersebut.
</p>

<br>

<p>
	Demikian Surat keterangan ini diberikan untuk dapat digunakan sebagaimana mestinya.
</p>

<!-- ================= BAGIAN BAWAH (SEJAJAR) ================= -->
<table class="bottom-table">
	<tr>
		<td class="bottom-left">
			<b>Tembusan disampaikan kepada Yth :</b>
			<ol>
				<li>Kepala DINDIK Kab. Trenggalek 
                    (sebagai Laporan)</li>
			</ol>
		</td>

		<td class="bottom-right">
			Trenggalek, {{ App\Helpers\TanggalIndonesia::format($mutasi->tanggal, false) }}<br><br>

			a.n. Kepala Dinas Pendidikan<br>
			Kabupaten Trenggalek<br>
			{!! $mutasi->mutasi_pejabat_jabatan !!}<br><br>

			{!! $qrCode !!}<br><br>

			<div class="nama-ttd">
				{{ $mutasi->mutasi_pejabat_nama }}
			</div>
			{{ $mutasi->mutasi_pejabat_pangkat }}<br>
			NIP. {{ $mutasi->mutasi_pejabat_nip }}
		</td>
	</tr>
</table>

    {{-- Signature --}}
    <div class="signature-wrapper">
        <table class="signature-table">
            <tr>
                <td class="signature-left">&nbsp;</td>
                <td class="signature-right">
                    <p>Trenggalek, {{ App\Helpers\TanggalIndonesia::format($mutasi->tanggal, false) }}</p>
                    <p>a.n. Kepala Dinas Pendidikan</p>
                    <p>Kabupaten Trenggalek</p>
                    <p>{!! $mutasi->mutasi_pejabat_jabatan !!}</p>
                    <div class="signature-space"></div>
                    <p class="signature-name">{{ $mutasi->mutasi_pejabat_nama }}</p>
                    <p>{{ $mutasi->mutasi_pejabat_pangkat }}</p>
                    <p>NIP. {{ $mutasi->mutasi_pejabat_nip }}</p>
                </td>
            </tr>
        </table>
    </div>


    {{-- Footer --}}
    <div class="footer-wrapper">
        <table class="footer-table">
            <tr>
                <td class="footer-left">
                    <p><strong>Tembusan disampaikan kepada Yth :</strong></p>
                    <p>1. Kepala DINDIK Kab. Trenggalek</p>
                    <p class="tembusan-indent">(sebagai Laporan)</p>
                </td>
                <td class="footer-right">
                    <div class="qr-code">{!! $qrCode !!}</div>
                    <p class="qr-text">
                        Scan QRcode untuk<br>
                        menampilkan dokumen secara online.
                    </p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>