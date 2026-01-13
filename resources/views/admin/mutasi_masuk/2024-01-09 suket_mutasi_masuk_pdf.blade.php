<?php $hari_ini = date("Y-m-d"); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Surat Keterangan Mutasi</title>
	<style type="text/css">
	body {
		font-family: "Times New Roman", Times, serif;
		font-size: 10pt;
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

	</style>
</head>
<body>
	<header>
		<table class="text-center" border="0" style="width: 100%;">
			<tr>
				<td  align="left"><img src="{{ asset("admin/images/logo_trenggalek_hitam_putih.jpg") }}" style="width: 90px;"></td>
				<td style="width: 100%">

          <p style="font-size:12pt;"> <b>PEMERINTAH KABUPATEN TRENGGALEK</b> </p>
					<p style="font-size:16pt;"> <b>DINAS PENDIDIKAN, PEMUDA DAN OLAHRAGA</b> </p>
          <p style="font-size:12pt;">Jalan RA. Kartini Nomor 76 Telp. (0355) 791344 Fax. (0355) 791129	</p>
					<p style="font-size:14pt;"><b>TRENGGALEK	(66315)</b></p>

				</td>
			</tr>
		</table>
		<hr style="height: 2px;">
		<hr >
	</header>

@foreach($mutasi as $data)


	<br>
  <!-- &nbsp;&nbsp;&nbsp;&nbsp; -->
  	<div style="text-align:justify" class="">

  		<div class="" style="text-align:center">
  			<u><b>SURAT KETERANGAN MUTASI SISWA</b></u>
        <br>
  			Nomor : {{$data->nomor_surat}}
  		</div>

  		<br>
  		<br>

  	 <p style="text-indent: 40px;">
       Yang bertanda tangan dibawah ini Kepala Dinas Pendidikan, Pemuda dan Olahraga Kabupaten Trenggalek
       menerangkan bahwa :
     </p>

     <div class="" style="margin-left:40px;">
       <table border="0" style="width: 100%;">
   			<tr>
   				<td style="width:170px;">Nama</td>
   				<td style="width:5px;">:</td>
   				<td style="">{{$data->mutasi_nama_siswa}}</td>
   				<!-- <td style="width:79%;">dr. Maya Syahria Saleh</td> -->
   			</tr>
   			<tr>
   				<td>No. Induk / NISN</td>
   				<td>:</td>
   				<td>{{$data->mutasi_noinduk}} / {{$data->mutasi_nisn}}</td>
   				<!-- <td>195904151986112001</td> -->
   			</tr>
   			<tr>
   				<td>Tempat Tanggal lahir</td>
   				<td>:</td>
   				<td>{{$data->mutasi_tempat_lahir}}, {{tanggal_indonesia($data->mutasi_tanggal_lahir, false)}}</td>
   				<!-- <td>Pembina Tingkat I / IV B</td> -->
   			</tr>
   			<tr>
   				<td>Asal Sekolah</td>
   				<td>:</td>
   				<td>{{$data->mutasi_sekolah_asal_nama}}</td>
   				<!-- <td>Direktur</td> -->
   			</tr>
   			<tr>
   				<td>Tingkat / Kelas</td>
   				<td>:</td>
   				<td>{{$data->mutasi_tingkat_kelas}}</td>
   				<!-- <td>RSUD Bhakti Dharma Husada Surabaya</td> -->
   			</tr>
        <tr>
   				<td>Nama Orang Tua / Wali</td>
   				<td>:</td>
   				<td>{{$data->mutasi_nama_wali}}</td>
   				<!-- <td>RSUD Bhakti Dharma Husada Surabaya</td> -->
   			</tr>
        <tr>
   				<td>Alamat</td>
   				<td>:</td>
   				<td>{{$data->mutasi_alamat}}</td>
   				<!-- <td>RSUD Bhakti Dharma Husada Surabaya</td> -->
   			</tr>
   		</table>
     </div>



  		<br>

      <p style="text-indent: 40px;">
        Berdasarkan Surat Keterangan Pindah / Mutasi dari {{$data->mutasi_sekolah_asal_nama}} Nomor :
        {{$data->mutasi_sekolah_asal_no_surat}} Tanggal {{tanggal_indonesia($data->mutasi_tanggal_mutasi, false)}}
				serta Surat	Keterangan Kesediaan Menerima dari {{$data->mutasi_sekolah_tujuan_nama}}
				 Nomor : {{$data->mutasi_sekolah_tujuan_no_surat}} Tanggal {{tanggal_indonesia($data->mutasi_tanggal_surat_diterima, false)}}
				 pada prinsipnya kami menyetujui
        mutasi siswa tersebut.
      </p>

      <p style="text-indent: 40px;">
        Demikian Surat keterangan ini diberikan untuk dapat digunakan sebagaimana mestinya.
      </p>

  	</div>

	<br>




	<table class="text-center" border="0" style="width: 100%;">

		<tr>
			<td style="width: 50%;"></td>
			<td style="width: 50%;">
        Trenggalek, {{tanggal_indonesia($data->tanggal,false)}}
        <br>
        <br>
        a.n. Kepala Dinas Pendidikan, Pemuda dan Olahraga
        <br>
        Kabupaten Trenggalek
        <br>
        {{$data->mutasi_pejabat_jabatan}}
				<br>
				<br>
				<br>
				<br>
				<br>
				<u>
					<b>
						{{$data->mutasi_pejabat_nama}}
					</b>
				</u>
				<br>
				{{$data->mutasi_pejabat_pangkat}}
				<br>
				NIP. {{$data->mutasi_pejabat_nip}}
			</td>
		</tr>

	</table>

	<br>

<table class="text-left" border="0" style="width: 100%;">
<tr>
	<td style="width: 50%;">
		Tembusan disampaikan kepada Yth :
		<br>
			1. Kepala Disdikpora Kab. Trenggalek
		<br>
	  <div style="margin-left:14px;">(sebagai Laporan)</div>
	</td>
	<td style="width: 50%;" class="text-center">
		<div class="visible-print text-center">
	    <!-- {!! QrCode::format('svg')->size(75)->generate('https://www.google.com/'); !!}
	    <p>Scan me to return to the original page.</p> -->
			{!! $qrCode !!}
			<br>
			<br>
			<p style="font-size:8pt;">
			    Scan QRcode untuk 
			    <br>
			    menampilkan dokumen secara online.
			</p>
			
	  </div>
	</td>
</tr>
</table>





@endforeach


</body>
</html>
