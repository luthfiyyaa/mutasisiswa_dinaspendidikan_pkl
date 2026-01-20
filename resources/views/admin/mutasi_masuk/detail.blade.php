<?php $hal = "mutasi_masuk"; ?>
@extends('layouts.admin.master')
@section('title', 'DISDIKPORA | Mutasi Masuk')

@section('css')
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection


@section('content')
<!-- Page Header -->
<div class="page-header-modern">
  <a href="{{route('mutasi_masuk.index')}}" class="btn-modern btn-warning-modern">
    <i class="fa fa-arrow-circle-left"></i>
    Kembali
  </a>
  <h1 class="page-title-modern">
    <i class="fas fa-file-alt"></i>
    Detail Mutasi Masuk
  </h1>
</div>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="detail-card">
        
        <!-- Button Cetak -->
        <div style="margin-bottom: 20px;">
          <a href="{{url('/mutasi-masuk/pdf')}}/{{$mutasi_id}}" target="_blank" class="btn-modern btn-success-modern">
            <i class="fa fa-print"></i>
            Cetak Surat Rekomendasi
          </a>
        </div>

        @foreach($mutasi as $data)
        <!-- Section: Identitas Siswa -->
        <div class="detail-section">
          <div class="section-header">
            <i class="fas fa-user-graduate"></i>
            <h3>Identitas Siswa</h3>
          </div>

          <table class="detail-table">
            <tr>
              <td class="label">Nama</td>
              <td class="colon">:</td>
              <td>{{$data->mutasi_nama_siswa}}</td>
            </tr>
            <tr>
              <td class="label">No. Induk</td>
              <td class="colon">:</td>
              <td>{{$data->mutasi_noinduk}}</td>
            </tr>
            <tr>
              <td class="label">NISN</td>
              <td class="colon">:</td>
              <td>{{$data->mutasi_nisn}}</td>
            </tr>
            <tr>
              <td class="label">Tingkat Kelas</td>
              <td class="colon">:</td>
              <td>{{$data->mutasi_tingkat_kelas}}</td>
            </tr>
            <tr>
              <td class="label">Tempat/Tgl Lahir</td>
              <td class="colon">:</td>
              <td>{{$data->mutasi_tempat_lahir}} / {{ App\Helpers\TanggalIndonesia::format($data->mutasi_tanggal_lahir, false) }}</td>
            </tr>
            <tr>
              <td class="label">Nama Wali</td>
              <td class="colon">:</td>
              <td>{{$data->mutasi_nama_wali}}</td>
            </tr>
            <tr>
              <td class="label">Alamat</td>
              <td class="colon">:</td>
              <td>{{$data->mutasi_alamat}}</td>
            </tr>
          </table>
        </div>

        <!-- Section: Sekolah Asal -->
        <div class="detail-section">
          <div class="section-header">
            <i class="fas fa-school"></i>
            <h3>Sekolah Asal Siswa</h3>
          </div>

          <table class="detail-table">
            <tr>
              <td class="label">Nama Sekolah</td>
              <td class="colon">:</td>
              <td>{{$data->mutasi_sekolah_asal_nama}}</td>
            </tr>
            <tr>
              <td class="label">Nomor Surat</td>
              <td class="colon">:</td>
              <td>{{$data->mutasi_sekolah_asal_no_surat}}</td>
            </tr>
            <tr>
              <td class="label">Tanggal Surat</td>
              <td class="colon">:</td>
              <td>{{ App\Helpers\TanggalIndonesia::format($data->mutasi_tanggal_mutasi, false) }}</td>
            </tr>
          </table>
        </div>

        <!-- Section: Sekolah Tujuan -->
        <div class="detail-section">
          <div class="section-header">
            <i class="fas fa-building"></i>
            <h3>Sekolah Tujuan Siswa</h3>
          </div>

          <table class="detail-table">
            <tr>
              <td class="label">Nama Sekolah</td>
              <td class="colon">:</td>
              <td>{{$data->mutasi_sekolah_tujuan_nama}}</td>
            </tr>
            <tr>
              <td class="label">Nomor Surat</td>
              <td class="colon">:</td>
              <td>{{$data->mutasi_sekolah_tujuan_no_surat}}</td>
            </tr>
            <tr>
              <td class="label">Tanggal Surat</td>
              <td class="colon">:</td>
              <td>{{ App\Helpers\TanggalIndonesia::format($data->mutasi_tanggal_surat_diterima, false) }}</td>
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
@endsection