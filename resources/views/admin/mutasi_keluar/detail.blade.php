<?php $hal = "mutasi_keluar"; ?>
@extends('layouts.admin.master')
@section('title', 'DINDIK | Mutasi Keluar')

@section('css')
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="page-header-modern">
  <h1 class="page-title-modern">
    <a href="{{route('mutasi_keluar.index')}}" class="btn-modern btn-warning-modern">
      <i class="fa fa-arrow-circle-left"></i> Kembali
    </a> |
    <i class="fas fa-file-alt"></i> Detail Mutasi Keluar
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="detail-card">

        <a href="{{url('/mutasi-keluar/pdf')}}/{{$mutasi_id}}" target="_blank" class="btn-modern btn-secondary-modern" style="margin-bottom: 20px;">
          <i class="fa fa-print"></i> Cetak Surat Rekomendasi
        </a>

        @foreach($mutasi as $data)
        <div class="detail-section">
          <div class="section-header">
            <i class="fas fa-user-graduate"></i>
            IDENTITAS SISWA
          </div>

          <table class="detail-table">
            <tr>
              <td style="width:150px;">Nama</td>
              <td style="width:10px;">:</td>
              <td><strong>{{$data->mutasi_nama_siswa}}</strong></td>
            </tr>
            <tr>
              <td>No. Induk</td>
              <td>:</td>
              <td>{{$data->mutasi_noinduk}}</td>
            </tr>
            <tr>
              <td>NISN</td>
              <td>:</td>
              <td>{{$data->mutasi_nisn}}</td>
            </tr>
            <tr>
              <td>Tingkat Kelas</td>
              <td>:</td>
              <td>{{$data->mutasi_tingkat_kelas}}</td>
            </tr>
            <tr>
              <td>Tempat/Tgl Lahir</td>
              <td>:</td>
              <td>{{$data->mutasi_tempat_lahir}} / {{App\Helpers\TanggalIndonesia::format($data->mutasi_tanggal_lahir,false)}}</td>
            </tr>
            <tr>
              <td>Nama Wali</td>
              <td>:</td>
              <td>{{$data->mutasi_nama_wali}}</td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td>
              <td>{{$data->mutasi_alamat}}</td>
            </tr>
          </table>
        </div>

        <div class="detail-section">
          <div class="section-header">
            <i class="fas fa-school"></i>
            SEKOLAH ASAL SISWA
          </div>

          <table class="detail-table">
            <tr>
              <td style="width:150px;">Nama Sekolah</td>
              <td style="width:10px;">:</td>
              <td><strong>{{$data->mutasi_sekolah_asal_nama}}</strong></td>
            </tr>
            <tr>
              <td>Nomor Surat</td>
              <td>:</td>
              <td>{{$data->mutasi_sekolah_asal_no_surat}}</td>
            </tr>
            <tr>
              <td>Tanggal Surat</td>
              <td>:</td>
              <td>{{ App\Helpers\TanggalIndonesia::format($data->mutasi_tanggal_mutasi, false) }}</td>
            </tr>
          </table>
        </div>

        <div class="detail-section">
          <div class="section-header">
            <i class="fas fa-building"></i>
            SEKOLAH TUJUAN SISWA
          </div>

          <table class="detail-table">
            <tr>
              <td style="width:150px;">Nama Sekolah</td>
              <td style="width:10px;">:</td>
              <td><strong>{{$data->mutasi_sekolah_tujuan_nama}}</strong></td>
            </tr>
            <tr>
              <td>Nomor Surat</td>
              <td>:</td>
              <td>{{$data->mutasi_sekolah_tujuan_no_surat}}</td>
            </tr>
            <tr>
              <td>Tanggal Surat</td>
              <td>:</td>
              <td>{{App\Helpers\TanggalIndonesia::format($data->mutasi_tanggal_surat_diterima,false)}}</td>
            </tr>
          </table>
        </div>
        @endforeach

      </div>

    </div>
  </div>
</section>

@endsection

@section('js')
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function() {

});
</script>

@endsection