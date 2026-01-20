<?php $hal = "laporan_mutasi_keluar"; ?>
@extends('layouts.admin.master')
@section('title', 'DINDIK | Laporan Mutasi Keluar')

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
    <i class="fas fa-file-alt"></i>Laporan Mutasi Keluar
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
            Filter Laporan
          </h3>
        </div>
        
        <div class="filter-section">
          <form id="filterForm">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group-modern">
                  <label class="form-label-modern">
                    <i class="far fa-calendar-alt"></i>Tanggal Awal
                  </label>
                  <input type="date" class="form-control-modern" name="tanggal_awal" id="tanggal_awal">
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="form-group-modern">
                  <label class="form-label-modern">
                    <i class="far fa-calendar-check"></i>Tanggal Akhir
                  </label>
                  <input type="date" class="form-control-modern" name="tanggal_akhir" id="tanggal_akhir">
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="form-group-modern">
                  <label class="form-label-modern">
                    <i class="fas fa-graduation-cap"></i>Jenjang
                  </label>
                  <select name="jenjang" id="jenjang" class="form-control-modern">
                    <option selected value="all">- Semua Jenjang -</option>
                    <?php
                    foreach ($jenjang as $key => $value) {
                      $attr = " jenjang_id='$value->jenjang_id' jenjang_nama='$value->jenjang_nama' nama='";
                      ?>
                      <option {{$attr}} value="{{$value->jenjang_id}}" >{{$value->jenjang_nama}}</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="btn-group-modern">
              <button type="submit" id="btnTampilkan" class="btn-modern btn-primary-modern">
                <i class="fa fa-search"></i>
                Tampilkan Data
              </button>
              <button type="button" id="btnCetak" class="btn-modern btn-secondary-modern" disabled>
                <i class="fa fa-print"></i>
                Cetak Laporan
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Data Table Card -->
      <div class="content-card">
        <div class="content-card-header">
          <h3 class="content-card-title">
            <i class="fas fa-table"></i>
            Data Mutasi Keluar
          </h3>
        </div>

        <div class="table-wrapper">
          <table id="datatable1" class="table table-bordered table-striped" style="width:100%">
            <thead>
              <tr>
                <th style="text-align:center;width:5%">No</th>
                <th style="width:22%">Nama</th>
                <th style="width:10%">No. Induk</th>
                <th style="width:10%">NISN</th>
                <th style="width:20%">Sekolah Asal</th>
                <th style="width:20%">Sekolah Tujuan</th>
                <th style="text-align:center;width:8%">Action</th>
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
<script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script type="text/javascript">
var table, save_method, tanggal_awal, tanggal_akhir, jenjang, query;
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
      url: '{{ route('data_laporan_mutasi_keluar') }}',
      type: 'GET',
      data: function(d){
      }
    },
    columns: [
      {data: null, render: (d,t,r,m) => m.row + 1, className: 'text-center' },
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

  document.getElementById("btnCetak").disabled = true;

  $(document).on('submit','#filterForm',function (event) {
    event.preventDefault();

    tanggal_awal = $('#tanggal_awal').val();
    tanggal_akhir = $('#tanggal_akhir').val();
    jenjang = $('#jenjang').val();

    query = "";

    if (jenjang=="all"&&tanggal_awal==""&&tanggal_akhir=="") {
      query = "q1"; //tampilkan semua data
      table.ajax.url("{{ url('/data_laporan_mutasi_keluar_filter') }}/"+0+"/"+0+"/"+jenjang+"/"+query).load();
    }else if (tanggal_awal==""&&tanggal_akhir=="") {
      query = "q2"; //tampilkan berdasarkan jenjang
      table.ajax.url("{{ url('/data_laporan_mutasi_keluar_filter') }}/"+0+"/"+0+"/"+jenjang+"/"+query).load();
    }else if (jenjang=="all") {
      query = "q3"; //tampilkan berdasarkan tanggal awal dan tanggal akhir
      table.ajax.url("{{ url('/data_laporan_mutasi_keluar_filter') }}/"+tanggal_awal+"/"+tanggal_akhir+"/"+jenjang+"/"+query).load();
    }else {
      query = "q4"; //tampilkan berdasarkan semua filter
      table.ajax.url("{{ url('/data_laporan_mutasi_keluar_filter') }}/"+tanggal_awal+"/"+tanggal_akhir+"/"+jenjang+"/"+query).load();
    }

    document.getElementById("btnCetak").disabled = false;
  });

  $('#btnCetak').click(function (e) {
    e.preventDefault();

    tanggal_awal = $('#tanggal_awal').val();
    tanggal_akhir = $('#tanggal_akhir').val();
    jenjang = $('#jenjang').val();

    query = "";

    if (jenjang=="all"&&tanggal_awal==""&&tanggal_akhir=="") {
      query = "q1";
      window.open("{{url('laporan_mutasi_keluar_excel_file')}}/"+0+"/"+0+"/"+jenjang+"/"+query);
    }else if (tanggal_awal==""&&tanggal_akhir=="") {
      query = "q2";
      window.open("{{url('laporan_mutasi_keluar_excel_file')}}/"+0+"/"+0+"/"+jenjang+"/"+query);
    }else if (jenjang=="all") {
      query = "q3";
      window.open("{{url('laporan_mutasi_keluar_excel_file')}}/"+tanggal_awal+"/"+tanggal_akhir+"/"+jenjang+"/"+query);
    }else {
      query = "q4";
      window.open("{{url('laporan_mutasi_keluar_excel_file')}}/"+tanggal_awal+"/"+tanggal_akhir+"/"+jenjang+"/"+query);
    }
  });

});

</script>

@endsection