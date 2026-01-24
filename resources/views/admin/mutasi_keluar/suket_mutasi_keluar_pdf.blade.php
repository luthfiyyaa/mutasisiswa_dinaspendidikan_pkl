<?php $hari_ini = date("Y-m-d"); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Surat Keterangan Mutasi</title>
	<style type="text/css">
	@page {
		margin: 1.5cm 2.5cm 2.5cm 2.5cm;
	}
	
	body {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 11pt;
		margin: 0;
		padding: 0;
	}
	
	.text-center {
		text-align: center;
	}

	.text-left {
		text-align: left;
	}

	.text-right {
		text-align: right;
	}

	.text-justify {
		text-align: justify;
	}

	.text-uppercase {
		text-transform: uppercase;
	}

	.text-lowercase {
		text-transform: lowercase;
	}

	.text-capital {
		text-transform: capitalize;
	}

	.text-underline {
		text-decoration: underline;
		text-decoration-color: #000;
	}

	.font-sm {
		font-size: 12px;
	}

	.bg-red {
		background-color: red;
	}

	.bg-grey {
		background-color: rgb(220, 220, 220);
	}

	.table {
		border-collapse: collapse;
		border-spacing: 0;
		width: 100%;
		border: solid 1px black;
	}

	.table th, .table td{
		border: 1px solid black;
		font-size: 12px;
	}

	.mb-0 {
		margin-bottom: 0px;
	}

	.mt-0 {
		margin-top: 0px;
	}

	.my-0 {
		margin-bottom: 0px;
		margin-top: 0px;
	}
	
	.mb-1 {
		margin-bottom: 1.5px;
	}

	.mar {
		margin-top: 10px;
		margin-bottom: 10px
	}

	hr {
		display: block;
		margin-top: 0.3em;
		margin-bottom: -0.2em;
		margin-left: auto;
		margin-right: auto;
		border-style: inset;
		border-width: 3px;
		color: black;
	}
	
	ol {
		display: block;
		margin-top: 0em;
		margin-bottom: 1em;
		margin-left: 0;
		margin-right: 0;
		padding-left: 17px;
		padding-top: -15px;
	}
	
	p {
		margin: 0;
		padding: 0;
	}

	</style>
</head>
<body>
	<header>
		<table class="text-center" border="0" style="width: 100%;">
			<tr>
				<td style="width: 100px; vertical-align: middle;">
					<img src="{{ public_path('admin/images/logo_trenggalek.png') }}" style="width:90px;">
				</td>
				<td style="vertical-align: middle;">
					<p style="font-size:13pt; font-weight: bold; margin: 2px 0;">PEMERINTAH KABUPATEN TRENGGALEK</p>
					<p style="font-size:16pt; font-weight: bold; margin: 2px 0;">DINAS PENDIDIKAN</p>
					<p style="font-size:9.5pt; margin: 2px 0;">Jl. RA. Kartini No.76 Trenggalek (0355) 791344 (0355) 791129, 791473</p>
					<p style="font-size:9.5pt; margin: 2px 0;">dinaspendidikan@trenggalekkab.go.id Laman : https://disdik.trenggalekkab.go.id</p>
				</td>
			</tr>
		</table>
		<hr style="height: 2px; margin-top: 5px;">
		<hr style="margin-top: 2px;">
	</header>

	<br>

        <div class="text-justify">

			<div class="text-center">
				<u><b>SURAT KETERANGAN MUTASI SISWA</b></u>
				<br>
				<span style="font-size: 11pt;">Nomor: {{ $nomorSurat->nomor_surat ?? '-' }}</span>
			</div>

  		  <br>

			<p style="text-indent: 40px; line-height: 1.5;">
				Yang bertanda tangan dibawah ini Kepala Dinas Pendidikan Kabupaten Trenggalek menerangkan bahwa:
			</p>

     	<div style="margin-left: 60px;">
       		<table border="0" style="width: 100%; line-height: 1.5;">
   				<tr>
   					<td style="width:210px; vertical-align: top;">Nama</td>
   					<td style="width:10px; vertical-align: top;">:</td>
   					<td style="vertical-align: top;">{{$mutasi->mutasi_nama_siswa}}</td>
   				</tr>
   				<tr>
   					<td style="vertical-align: top;">No. Induk / NISN</td>
   					<td style="vertical-align: top;">:</td>
   					<td style="vertical-align: top;">{{$mutasi->mutasi_noinduk}} / {{$mutasi->mutasi_nisn}}</td>
   				</tr>
   				<tr>
   					<td style="vertical-align: top;">Tempat/Tanggal Lahir</td>
   					<td style="vertical-align: top;">:</td>
   					<td style="vertical-align: top;">{{$mutasi->mutasi_tempat_lahir}}, {{App\Helpers\TanggalIndonesia::format($mutasi->mutasi_tanggal_lahir, false)}}</td>
   				</tr>
   				<tr>
   					<td style="vertical-align: top;">Asal Sekolah</td>
   					<td style="vertical-align: top;">:</td>
   					<td style="vertical-align: top;">{{$mutasi->mutasi_sekolah_asal_nama}}</td>
   				</tr>
   				<tr>
   					<td style="vertical-align: top;">Tingkat / Kelas</td>
   					<td style="vertical-align: top;">:</td>
   					<td style="vertical-align: top;">{{$mutasi->mutasi_tingkat_kelas}}</td>
   				</tr>
        		<tr>
   					<td style="vertical-align: top;">Nama Orang Tua / Wali</td>
   					<td style="vertical-align: top;">:</td>
   					<td style="vertical-align: top;">{{$mutasi->mutasi_nama_wali}}</td>
   				</tr>
        		<tr>
   					<td style="vertical-align: top;">Alamat</td>
   					<td style="vertical-align: top;">:</td>
   					<td style="vertical-align: top;">{{$mutasi->mutasi_alamat}}</td>
   				</tr>
   			</table>
     	</div>
		
  		<br>

      	<p style="margin-left: 60px; margin-right: 0; text-align: justify; line-height: 1.5;">
        	Berdasarkan Surat Keterangan Pindah / Mutasi dari {{$mutasi->mutasi_sekolah_asal_nama}} Nomor: {{$mutasi->mutasi_sekolah_asal_no_surat}} Tanggal {{App\Helpers\TanggalIndonesia::format($mutasi->mutasi_tanggal_mutasi, false)}} serta Surat Keterangan Kesediaan Menerima dari {{$mutasi->mutasi_sekolah_tujuan_nama}} Nomor: {{$mutasi->mutasi_sekolah_tujuan_no_surat}} Tanggal {{App\Helpers\TanggalIndonesia::format($mutasi->mutasi_tanggal_surat_diterima, false)}} pada prinsipnya kami menyetujui mutasi siswa tersebut.
      	</p>

      	<p style="margin-left: 60px; margin-right: 0; text-align: justify; line-height: 1.5;">
        	Demikian surat keterangan ini diberikan untuk dapat digunakan sebagaimana mestinya.
      	</p>

  	</div>

	<table border="0" style="width: 120%;">
		<tr>
			<td style="width: 20%;"></td>
			<td style="width: 90%; text-align: center; line-height: 1.3;">
        		<p>Trenggalek, {{App\Helpers\TanggalIndonesia::format($mutasi->tanggal,false)}}</p>
        		<p>a.n Kepala Dinas Pendidikan Kabupaten Trenggalek</p>
        		<p>{!! $mutasi->mutasi_pejabat_jabatan !!}</p>
				<br>
				<br>
				<br>
				<br>
				<p style="text-decoration: underline; font-weight: bold;">
					{{$mutasi->mutasi_pejabat_nama}}
				</p>
				<p>{{$mutasi->mutasi_pejabat_pangkat}}</p>
				<p>NIP.{{$mutasi->mutasi_pejabat_nip}}</p>
			</td>
		</tr>
	</table>

	<table border="0" style="width: 100%;">
		<tr>
			<td style="width: 50%; vertical-align: top; line-height: 1.3;">
				<p>Tembusan disampaikan kepada Yth:</p>
				<p>1. Kepala Dindik Kab. Trenggalek</p>
			</td>
		</tr>
	</table>

</body>
</html>