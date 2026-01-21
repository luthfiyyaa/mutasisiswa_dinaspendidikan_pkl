<?php $hal = "mutasi_keluar"; ?>
@extends('layouts.admin.master')
@section('title', 'DINDIK | Mutasi Keluar')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
/* =====================
   GLOBAL & BACKGROUND
===================== */
.content-wrapper {
  background: transparent !important;
}

/* =====================
   PAGE HEADER
===================== */
.content-header {
  margin-bottom: 1.2rem;
}

.page-title {
  font-size: 1.65rem;
  font-weight: 700;
  color: white;
  margin-bottom: 0.5rem;
  text-shadow: 0 2px 4px rgba(0,0,0,.2);
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.page-title i {
  font-size: 1.5rem;
}

/* =====================
   CONTENT CARD (BOX)
===================== */
.box {
  background: rgba(255,255,255,.98);
  backdrop-filter: blur(10px);
  border-radius: 16px;
  border: none !important;
  box-shadow: 0 8px 30px rgba(0,0,0,.12);
  overflow: hidden;
  margin-bottom: 1.5rem;
}

.box-header {
  background: rgba(255,255,255,.98);
  padding: 1rem 1.5rem;
  border: none !important;
  position: relative;
  overflow: hidden;
}

.box-header::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" fill="white" opacity="0.05"/></svg>');
  opacity: 0.3;
}

.box-title {
  color: black !important;
  font-size: 1.1rem;
  font-weight: 600;
  position: relative;
  z-index: 1;
  display: flex;
  align-items: center;
  gap: 0.6rem;
  margin: 0;
}

.box-title i {
  font-size: 1.1rem;
  color: #66aaea;
}

.box-body {
  padding: 1.5rem;
}

/* =====================
   ACTION HEADER SECTION
===================== */
.action-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
  flex-wrap: wrap;
  gap: 0.75rem;
}

.action-left {
  flex: 1;
}

/* =====================
   BUTTON MODERN
===================== */
.btn {
  border-radius: 8px !important;
  font-weight: 600;
  transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
  display: inline-flex;
  align-items: center;
  gap: .5rem;
  padding: 0.5rem 1rem;
  border: none;
  position: relative;
  overflow: hidden;
  font-size: 0.875rem;
}

.btn::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  border-radius: 50%;
  background: rgba(255,255,255,.2);
  transform: translate(-50%, -50%);
  transition: width .6s, height .6s;
}

.btn:hover::before {
  width: 300px;
  height: 300px;
}

.btn i {
  font-size: 0.95rem;
  transition: transform .3s ease;
}

.btn:hover i {
  transform: scale(1.1);
}

.btn-primary {
  background: linear-gradient(135deg, #66aaea 0%, #4ba2a0 100%) !important;
  box-shadow: 0 3px 10px rgba(102,170,234,.3);
  color: white !important;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(102,170,234,.4);
  color: white !important;
}

.btn-warning {
  background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
  color: white !important;
  box-shadow: 0 3px 10px rgba(245,158,11,.25);
}

.btn-warning:hover {
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(245,158,11,.35);
  color: white !important;
}

.btn-danger {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
  color: white !important;
  box-shadow: 0 3px 10px rgba(239,68,68,.25);
}

.btn-danger:hover {
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(239,68,68,.35);
  color: white !important;
}

.btn-sm {
  padding: 0.35rem 0.75rem;
  font-size: 0.8rem;
}

.btn-xs {
  padding: 0.25rem 0.6rem;
  font-size: 0.75rem;
  gap: 0.35rem;
}

.btn-xs i {
  font-size: 0.85rem;
}

/* =====================
   FILTER SECTION
===================== */
.filter-section {
  background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
  padding: 1.25rem;
  border-radius: 12px;
  margin-bottom: 1.25rem;
  border: 2px solid rgba(102,170,234,.1);
  box-shadow: 0 3px 8px rgba(0,0,0,.04);
}

.filter-header {
  display: flex;
  align-items: center;
  gap: 0.6rem;
  margin-bottom: 1rem;
  padding-bottom: 0.75rem;
  border-bottom: 2px solid rgba(102,170,234,.2);
}

.filter-header i {
  font-size: 1.1rem;
  color: #66aaea;
}

.filter-header-title {
  font-size: 0.95rem;
  font-weight: 700;
  color: #2d3748;
  margin: 0;
}

.filter-label {
  font-weight: 600;
  color: #4a5568;
  margin-bottom: .6rem;
  display: flex;
  align-items: center;
  gap: 0.4rem;
  font-size: 0.85rem;
}

.filter-label i {
  color: #66aaea;
  font-size: 0.8rem;
}

/* =====================
   FORM MODERN
===================== */
.form-control {
  border: 2px solid #e5e7eb;
  border-radius: 8px;
  padding: .6rem 1rem;
  transition: all .3s ease;
  background: white;
  font-size: 0.85rem;
}

.form-control:focus {
  border-color: #66aaea;
  outline: none;
  box-shadow: 0 0 0 3px rgba(102,170,234,.12);
  background: #fafbfc;
}

.form-control option {
  padding: 0.5rem;
}

/* =====================
   DATATABLES CUSTOMIZATION
===================== */
.dataTables_wrapper {
  padding-top: 1rem;
}

/* Wrapper untuk Tampilkan dan Cari - Sejajar */
.dataTables_wrapper .row:first-child {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.dataTables_length {
  margin-bottom: 0 !important;
  float: left;
}

.dataTables_length label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-weight: 500;
  color: #64748b;
  font-size: 0.875rem;
  margin: 0;
}

.dataTables_length select {
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  padding: 0.4rem 1.5rem 0.4rem 0.75rem;
  min-width: 70px;
  background: white;
  font-size: 0.875rem;
}

.dataTables_filter {
  margin-bottom: 0 !important;
  float: right;
}

.dataTables_filter label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-weight: 500;
  color: #64748b;
  font-size: 0.875rem;
  margin: 0;
}

.dataTables_filter input {
  border-radius: 8px;
  border: 1px solid #e2e8f0;
  padding: .5rem 1rem;
  min-width: 200px;
  background: white;
  transition: all .3s ease;
  font-size: 0.875rem;
}

.dataTables_filter input:focus {
  border-color: #66aaea;
  box-shadow: 0 0 0 3px rgba(102,170,234,.1);
  outline: none;
}

/* =====================
   TABLE STYLING
===================== */
.table-wrapper {
  background: white;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0,0,0,.05);
}

table.dataTable {
  border-collapse: separate !important;
  border-spacing: 0;
  width: 100% !important;
}

table.dataTable thead th {
  background: linear-gradient(135deg, #66aaea 0%, #4ba2a0 100%);
  color: white;
  font-weight: 600;
  border: none;
  padding: 1.25rem 1rem;
  text-transform: uppercase;
  font-size: 0.85rem;
  letter-spacing: 0.5px;
}

table.dataTable tbody td {
  padding: 1rem;
  vertical-align: middle;
  border-bottom: 1px solid #f1f5f9;
}

table.dataTable tbody tr {
  transition: all .2s ease;
}

table.dataTable tbody tr:hover {
  background: linear-gradient(90deg, rgba(102,170,234,.08) 0%, rgba(75,162,160,.08) 100%);
  transform: scale(1.01);
}

/* =====================
   PAGINATION - KECIL DI KANAN BAWAH
===================== */
.dataTables_wrapper .row:last-child {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 1rem;
}

.dataTables_info {
  padding: 0.5rem 0;
  font-weight: 500;
  color: #64748b;
  font-size: 0.75rem;
  float: left;
}

.dataTables_paginate {
  padding: 0.5rem 0;
  float: right;
  text-align: right;
}

.pagination {
  margin: 0 !important;
  display: inline-flex !important;
  gap: 0.15rem;
}

.pagination > li > a,
.pagination > li > span {
  border: 1px solid #e2e8f0;
  border-radius: 4px;
  padding: 0.25rem 0.5rem !important;
  color: #64748b;
  font-weight: 500;
  transition: all .2s ease;
  margin: 0;
  background: white;
  font-size: 0.7rem !important;
  min-width: 28px;
  text-align: center;
  line-height: 1.2;
}

.pagination > li > a:hover {
  background: #66aaea;
  color: white;
  border-color: #66aaea;
}

.pagination > .active > a,
.pagination > .active > span {
  background: #66aaea;
  color: white;
  border-color: #66aaea;
}

.pagination > .disabled > a,
.pagination > .disabled > span {
  background: #f8fafc;
  color: #cbd5e1;
  border-color: #e2e8f0;
  cursor: not-allowed;
}

/* =====================
   ACTION BUTTON
===================== */
.action-buttons {
  display: flex;
  gap: .3rem;
  justify-content: center;
}

.action-buttons .btn {
  padding: 0.2rem 0.4rem;
  font-size: 0.65rem;
}

.action-buttons .btn i {
  font-size: 0.75rem;
}

.text-center {
  text-align: center;
}

.text-left {
  text-align: left;
}

/* =====================
   LOADING STATE
===================== */
.dataTables_processing {
  background: linear-gradient(135deg, #66aaea 0%, #4ba2a0 100%);
  color: white;
  border-radius: 12px;
  padding: 1.5rem 2rem;
  font-weight: 600;
  box-shadow: 0 8px 25px rgba(102,170,234,.4);
}

/* =====================
   RESPONSIVE
===================== */
@media (max-width: 768px) {
  .box-body {
    padding: 1.25rem;
  }

  .page-title {
    font-size: 1.5rem;
  }

  .action-header {
    flex-direction: column;
    align-items: stretch;
  }

  .filter-section {
    padding: 1.25rem;
  }

  .dataTables_wrapper .row:first-child {
    flex-direction: column;
    align-items: stretch;
    gap: 1rem;
  }

  .dataTables_length,
  .dataTables_filter {
    float: none !important;
    width: 100%;
  }

  .dataTables_filter input {
    min-width: 100%;
  }

  .action-buttons {
    flex-direction: column;
  }

  .dataTables_wrapper .row:last-child {
    flex-direction: column;
    gap: 0.5rem;
  }

  .dataTables_info,
  .dataTables_paginate {
    float: none !important;
    text-align: center !important;
  }

  .pagination {
    justify-content: center;
  }
}

/* =====================
   ANIMATIONS
===================== */
@keyframes slideInDown {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.box {
  animation: slideInDown 0.5s ease-out;
}
</style>

@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 class="page-title">
    <i class="fa fa-exchange-alt"></i>
    Mutasi Keluar
  </h1>
</section>

<!-- Filter Section - Outside box -->
<div class="filter-section">
  <div class="filter-header">
    <i class="fa fa-filter"></i>
    <h4 class="filter-header-title">Filter Data</h4>
  </div>
  <div class="form-group row">
    <div class="col-md-6">
      <label class="filter-label">
        <i class="fa fa-school"></i>
        Filter Berdasarkan Jenjang Pendidikan
      </label>
      <select name="jenjang" id="jenjang" class="form-control">
        <option disabled selected value="">-- Pilih Jenjang Pendidikan --</option>
        <?php
        foreach ($jenjang as $key => $value) {
          $attr = " jenjang_id='$value->jenjang_id' jenjang_nama='$value->jenjang_nama'";
          ?>
          <option {{$attr}} value="{{$value->jenjang_id}}">{{$value->jenjang_nama}}</option>
        <?php } ?>
      </select>
    </div>
  </div>
</div>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">
            <i class="fa fa-database"></i>
            Data Mutasi Keluar
          </h3>
        </div>

        <div class="box-body">
          <!-- Action Header -->
          <div class="action-header">
            <div class="action-left">
              <a href="{{route('mutasi_keluar.create')}}" class="btn btn-primary">
                <i class="fa fa-plus-circle"></i> Tambah Data Mutasi
              </a>
            </div>
          </div>

          <!-- Table -->
          <div class="table-responsive table-wrapper">
            <table id="datatable1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="text-align: center; width: 5%">No</th>
                  <th style="text-align: center; width: 20%">Nama Siswa</th>
                  <th style="text-align: center; width: 7%">No. Induk</th>
                  <th style="text-align: center; width: 10%">NISN</th>
                  <th style="text-align: center;width: 20%">Sekolah Asal</th>
                  <th style="text-align: center; width: 20%">Sekolah Tujuan</th>
                  <th style="text-align: center; width: 18%">Aksi</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
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
      infoEmpty: "Tidak ada data",
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
      url: '{{ route('data_mutasi_keluar') }}',
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
      var jenjang_id  = optionSelected.val();
      var jenjang_nama   = optionSelected.text();

    console.log('jenjang_id = '+jenjang_id);
    console.log('jenjang_nama = '+jenjang_nama);

    table.ajax.url("{{ url('/data_mutasi_keluar_jenjang') }}/"+jenjang_id).load();
    });
});

function deleteData(id){
  if(confirm("Apakah Anda yakin ingin menghapus data ini?")){
    $.ajax({
      url : "mutasi_keluar/"+id,
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