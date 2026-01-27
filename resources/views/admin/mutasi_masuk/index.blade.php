<?php $hal = "mutasi_masuk"; ?>
@extends('layouts.admin.master')
@section('title', 'DINDIK | Mutasi Masuk')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection


@section('content')
<!-- Page Header -->
<div class="page-header-modern">
  <h1 class="page-title-modern">
    <i class="fa fa-exchange-alt"></i>
    Mutasi Masuk
  </h1>
</div>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <!-- Filter Card -->
      <div class="content-card">
        <div class="content-card-header">
          <h3 class="content-card-title">
            <i class="fas fa-filter"></i>
            Filter Data
          </h3>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group-modern">
              <label class="form-label-modern">
                <i class="fas fa-graduation-cap"></i>
                Jenjang Pendidikan
              </label>
              <select name="jenjang" id="jenjang" class="form-control">
                <option disabled selected value="">-- Pilih Jenjang --</option>
                @foreach ($jenjang as $key => $value)
                  <option value="{{$value->jenjang_id}}" jenjang_id="{{$value->jenjang_id}}" jenjang_nama="{{$value->jenjang_nama}}">
                    {{$value->jenjang_nama}}
                  </option>
                @endforeach
              </select>
              <small style="color:#f59e0b; display:block; margin-top:5px;">
                  <i class="fas fa-info-circle"></i> Pilih jenjang dan sistem akan otomatis menampilkan data
              </small>
            </div>
          </div>
        </div>
      </div>

      <!-- Table Card -->
      <div class="content-card">
        <div class="content-card-header">
          <h3 class="content-card-title">
            <i class="fas fa-table"></i>
            Data Mutasi Masuk
          </h3>
          <a href="{{route('mutasi_masuk.create')}}" class="btn-modern btn-primary-modern">
            <i class="fa fa-plus"></i>
            Tambah Data
          </a>
        </div>

        <div class="table-responsive">
          <table id="datatable1" class="table table-bordered table-striped" style="width:100%">
            <thead>
              <tr>
                <th class="text-center" style="width:5%">No</th>
                <th style="width:20%">Nama Siswa</th>
                <th style="width:10%">No. Induk</th>
                <th style="width:12%">NISN</th>
                <th style="width:20%">Sekolah Asal</th>
                <th style="width:20%">Sekolah Tujuan</th>
                <th class="text-center" style="width:13%">Aksi</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection


@section('js')
<!-- DataTables -->
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script type="text/javascript">
var table, save_method;

$(function(){
  table = $('#datatable1').DataTable({
    searching: true,
    processing: true,
    language: {
      processing: '<i class="fa fa-spinner fa-spin"></i> Sedang memproses...',
      search: "Cari:",
      lengthMenu: "Tampilkan _MENU_",
      info: "Menampilkan _START_-_END_ dari _TOTAL_ data",
      infoFiltered: "(disaring dari _MAX_)",
      zeroRecords: "Tidak ada data yang ditemukan",
      emptyTable: "Tidak ada data tersedia",
      paginate: {
        first: '«',
        last: '»',
        next: '›',
        previous: '‹'
      }
    },
    ajax: {
      url: '{{ route('data_mutasi_masuk') }}',
      type: 'GET',
      data: function(d){
        // Additional parameters can be added here
      }
    },
    columns: [
      {data: null, render: (d,t,r,m) => m.row + 1, className: 'text-center'},
      {data: 'mutasi_nama_siswa', name: 'mutasi_nama_siswa', className: 'text-left'},
      {data: 'mutasi_noinduk', name: 'mutasi_noinduk', className: 'text-left'},
      {data: 'mutasi_nisn', name: 'mutasi_nisn', className: 'text-left'},
      {data: 'mutasi_sekolah_asal_nama', name: 'mutasi_sekolah_asal_nama', className: 'text-left'},
      {data: 'mutasi_sekolah_tujuan_nama', name: 'mutasi_sekolah_tujuan_nama', className: 'text-left'},
      {data: 'aksi', name: 'aksi', className: 'text-center', orderable: false, searchable: false},
    ]
  });
});

$(document).ready(function() {
  $('#jenjang').change(function () {
    var optionSelected = $(this).find("option:selected");
    var jenjang_id = optionSelected.val();
    var jenjang_nama = optionSelected.text();

    console.log('jenjang_id = ' + jenjang_id);
    console.log('jenjang_nama = ' + jenjang_nama);

    table.ajax.url("{{ url('/data_mutasi_masuk_jenjang') }}/" + jenjang_id).load();
  });
});

function deleteData(id){
  if(confirm("Apakah Anda yakin ingin menghapus data ini?")){
    $.ajax({
      url : "mutasi_masuk/" + id,
      type : "POST",
      data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
      success : function(data){
        table.ajax.reload();
        alert("Data berhasil dihapus!");
      },
      error : function(){
        alert("Tidak dapat menghapus data!");
      }
    });
  }
}
</script>

@endsection