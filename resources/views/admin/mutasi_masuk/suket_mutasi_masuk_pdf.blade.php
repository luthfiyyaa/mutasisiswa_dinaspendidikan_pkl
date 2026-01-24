<?php $hari_ini = date("Y-m-d"); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Surat Keterangan Mutasi - {{ $mutasi->mutasi_nama_siswa }}</title>
	<style type="text/css">
        @page {
        size: A4;
        margin-left: 2.5cm;
        margin-right: 2.5cm;
        margin-top: 2.5cm;
        margin-bottom: 2.5cm;
    	}

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
        }

        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }

        hr {
            margin-top: 3px;
            margin-bottom: 2px;
            border: 0;
            border-top: 3px solid #000;
        }

        .hr-tipis {
            border-top: 1px solid #000;
            margin-top: 0;
        }

        p {
            margin: 0;
        }

        ol {
            margin: 5px 0 0 18px;
            padding: 0;
        }

        /* ===== TABEL BAWAH (KUNCI UTAMA) ===== */
        .bottom-table {
            width: 100%;
            margin-top: 25px;
            border-collapse: collapse;
            page-break-inside: avoid;
        }

        .bottom-left {
            width: 50%;
            vertical-align: bottom;
            line-height: 1.6;
        }

        .bottom-right {
            width: 50%;
            text-align: center;
            vertical-align: top;
            line-height: 1.6;
        }

        .nama-ttd {
            font-weight: bold;
            text-decoration: underline;
        }
	</style>
</head>

<body>

<!-- ================= HEADER ================= -->
<header>
	<table class="text-center" border="0" style="width: 100%;">
		<tr>
			<td style="width: 90px;">
				<img src="{{ public_path('admin/images/logo_trenggalek_hitam_putih.jpg') }}" style="width:90px;">
			</td>
			<td>
				<p style="font-size:12pt;"><b>PEMERINTAH KABUPATEN TRENGGALEK</b></p>
				<p style="font-size:16pt;"><b>DINAS PENDIDIKAN</b></p>
				<p style="font-size:12pt;">
					Jl. RA. Kartini No. 76 Telp. (0355) 791344 Fax. (0355) 791129
				</p>
				<p style="font-size:14pt;"><b>TRENGGALEK (66315)</b></p>
			</td>
		</tr>
	</table>

	<hr>
	<hr class="hr-tipis">
</header>

<br>

<!-- ================= JUDUL ================= -->
<div class="text-center">
	<u><b>SURAT KETERANGAN MUTASI SISWA</b></u><br>
	Nomor : {{ $nomorSurat->nomor_surat ?? '-' }}
</div>

<br><br>

<!-- ================= ISI ================= -->
<p style="text-indent:40px; text-align:justify;">
	Yang bertanda tangan dibawah ini Kepala Dinas Pendidikan, Kabupaten Trenggalek
	menerangkan bahwa :
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

</body>
</html>
