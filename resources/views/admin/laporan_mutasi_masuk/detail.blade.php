<?php $hal = "laporan_mutasi_masuk"; ?>
@extends('layouts.admin.master')
@section('title', 'DISDIKPORA | Laporan Mutasi Masuk')

@section('css')
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">


<style>
.example-modal .modal {
  position: relative;
  top: auto;
  bottom: auto;
  right: auto;
  left: auto;
  display: block;
  z-index: 1;
}

.example-modal .modal {
  background: transparent !important;
}
</style>
@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <a href="{{route('laporan_mutasi_masuk.index')}}" class="btn btn-warning"> <i class="fa fa-arrow-circle-left"></i>  Kembali</a> |
    Detail Laporan Mutasi Masuk
    <!-- <small>Data barang</small> -->
  </h1>
</section>



<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">


      <div class="box box-danger">
        <!-- <div class="box-header with-border">
          <h3 class="box-title">Form Mutasi Masuk</h3>
        </div> -->
        <!-- /.box-header -->

        <div class="box-body">


          <table class="table table-bordered table-striped" >
            @foreach($mutasi as $data)
            <tr>
              <td colspan="3"> <b>IDENTITAS SISWA</b>  </td>
            </tr>
            <tr>
              <td style="width:150px;">Nama</td>
              <td style="width:10px;">:</td>
              <td>{{$data->mutasi_nama_siswa}}</td>
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
              <td style="width:150px;">Tempat/Tgl Lahir</td>
              <td style="width:10px;">:</td>
              <td>{{$data->mutasi_tempat_lahir}} / {{ App\Helpers\tanggal_indonesia::format($data->mutasi_tanggal_lahir, false) }}</td>
            </tr>
            <tr>
              <td style="width:150px;">Nama Wali</td>
              <td style="width:10px;">:</td>
              <td>{{$data->mutasi_nama_wali}}</td>
            </tr>
            <tr>
              <td style="width:150px;">Alamat</td>
              <td style="width:10px;">:</td>
              <td>{{$data->mutasi_alamat}}</td>
            </tr>
            <tr>
              <td colspan="3"> <b>SEKOLAH ASAL SISWA</b>  </td>
            </tr>
            <tr>
              <td>Nama Sekolah</td>
              <td>:</td>
              <td>{{$data->mutasi_sekolah_asal_nama}}</td>
            </tr>
            <tr>
              <td>Nomor Surat</td>
              <td>:</td>
              <td>{{$data->mutasi_sekolah_asal_no_surat}}</td>
            </tr>
            <tr>
              <td>Tanggal Surat</td>
              <td>:</td>
              <td>{{tanggal_indonesia($data->mutasi_tanggal_mutasi, false)}}</td>
            </tr>
            <tr>
              <td colspan="3"> <b>SEKOLAH TUJUAN SISWA</b>  </td>
            </tr>
            <tr>
              <td>Nama Sekolah</td>
              <td>:</td>
              <td>{{$data->mutasi_sekolah_tujuan_nama}}</td>
            </tr>
            <tr>
              <td>Nomor Surat</td>
              <td>:</td>
              <td>{{$data->mutasi_sekolah_tujuan_no_surat}}</td>
            </tr>
            <tr>
              <td>Tanggal Surat</td>
              <td>:</td>
              <td>{{tanggal_indonesia($data->mutasi_tanggal_surat_diterima,false)}}</td>
            </tr>
            @endforeach
          </table>

        </div>

      </div>

      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

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
