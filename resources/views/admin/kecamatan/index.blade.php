<?php $hal = "kecamatan"; ?>
@extends('layouts.admin.master')
@section('title', 'DINDIK | Kecamatan')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
/* DataTables custom styling */
.dataTables_wrapper {
  padding: 1rem;
}

.dataTables_filter input {
  border-radius: 6px;
  border: 2px solid #e5e7eb;
  padding: 0.4rem 0.8rem;
  transition: all 0.3s ease;
  font-size: 0.875rem;
}

.dataTables_filter input:focus {
  border-color: #66aaea;
  outline: none;
  box-shadow: 0 0 0 3px rgba(102, 170, 234, 0.1);
}

.dataTables_length select {
  border-radius: 6px;
  border: 2px solid #e5e7eb;
  padding: 0.4rem 0.8rem;
  font-size: 0.875rem;
}

.dataTables_info {
  padding: 0.75rem 0;
  font-weight: 500;
  color: #64748b;
  font-size: 0.875rem;
}

.dataTables_wrapper .row:first-child {
  display: flex;
  align-items: center;
}

/* kolom kiri */
.dataTables_wrapper .row:first-child > div:first-child {
  flex: 1;
}

/* kolom kanan */
.dataTables_wrapper .row:first-child > div:last-child {
  flex: 1;
  display: flex;
  justify-content: flex-end;
}

.pagination {
  margin: 0;
  display: flex;
  gap: 0.25rem;
  list-style: none !important;
  justify-content: flex-end;
}

.pagination > li > a,
.pagination > li > span {
  border: 1px solid #e2e8f0;
  border-radius: 6px;
  padding: 0.4rem 0.75rem;
  color: #64748b;
  font-weight: 500;
  transition: all .2s ease;
  margin: 0;
  background: white;
  font-size: 0.875rem;
  min-width: 36px;
  text-align: center;
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

table.dataTable thead th {
  background: linear-gradient(135deg, #66aaea 0%, #4ba2a0 100%);
  color: white;
  font-weight: 600;
  border: none;
  padding: 0.65rem 0.75rem;
  font-size: 0.875rem;
}

table.dataTable tbody td {
  padding: 0.6rem 0.75rem;
  font-size: 0.85rem;
  vertical-align: middle;
}

table.dataTable tbody tr {
  transition: all 0.2s ease;
}

table.dataTable tbody tr:hover {
  background: rgba(102, 170, 234, 0.05);
}

/* Card styling */
.content-card {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  border-radius: 16px;
  padding: 1.25rem;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
  margin-bottom: 1.25rem;
}

.content-card-header {
  border-bottom: 2px solid #f3f4f6;
  padding-bottom: 0.75rem;
  margin-bottom: 1rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.content-card-title {
  font-size: 1.15rem;
  font-weight: 700;
  color: #1a202c;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.content-card-title i {
  color: #66aaea;
  font-size: 1.1rem;
}

.text-center {
  text-align: center;
}

/* Button styling */
.btn-modern {
  padding: 0.6rem 1.25rem;
  border-radius: 8px;
  font-weight: 600;
  font-size: 0.85rem;
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  text-decoration: none;
}

.btn-modern i {
  font-size: 0.8rem;
}

.btn-primary-modern {
  background: linear-gradient(135deg, #66aaea 0%, #4ba2a0 100%);
  color: white;
  box-shadow: 0 3px 10px rgba(102, 170, 234, 0.3);
}

.btn-primary-modern:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 14px rgba(102, 170, 234, 0.4);
}

/* Action buttons in table */
.btn-action {
  padding: 0.4rem 0.8rem;
  font-size: 0.75rem;
  border-radius: 6px;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 0.35rem;
  text-decoration: none;
  font-weight: 600;
  margin: 0 0.15rem;
}

.btn-action i {
  font-size: 0.7rem;
}

.btn-warning-action {
  background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
  color: white;
  box-shadow: 0 2px 6px rgba(245, 158, 11, 0.25);
}

.btn-warning-action:hover {
  transform: translateY(-1px);
  box-shadow: 0 3px 8px rgba(245, 158, 11, 0.35);
  color: white;
}

.btn-danger-action {
  background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
  color: white;
  box-shadow: 0 2px 6px rgba(239, 68, 68, 0.25);
}

.btn-danger-action:hover {
  transform: translateY(-1px);
  box-shadow: 0 3px 8px rgba(239, 68, 68, 0.35);
  color: white;
}

/* Page header */
.page-header-modern {
  margin-bottom: 1.25rem;
}

.page-title-modern {
  font-size: 1.65rem;
  font-weight: 700;
  color: white;
  margin-bottom: 0.35rem;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.page-title-modern i {
  font-size: 1.5rem;
}

/* Table wrapper */
.table-wrapper {
  background: white;
  border-radius: 10px;
  overflow: hidden;
}

/* Responsive */
@media (max-width: 768px) {
  .content-card {
    padding: 0.875rem;
  }
  
  .content-card-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.75rem;
  }
  
  table.dataTable tbody td {
    font-size: 0.8rem;
    padding: 0.5rem 0.6rem;
  }
  
  table.dataTable thead th {
    font-size: 0.8rem;
    padding: 0.55rem 0.6rem;
  }
}
</style>

@endsection


@section('content')
<!-- Page Header -->
<div class="page-header-modern">
  <h1 class="page-title-modern">
    <i class="fas fa-map-marked-alt"></i>Data Kecamatan
  </h1>
</div>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="content-card">
        <div class="content-card-header">
          <h3 class="content-card-title">
            <i class="fas fa-database"></i>
            Data Master Kecamatan
          </h3>
          <button onclick="addForm()" class="btn-modern btn-primary-modern">
            <i class="fa fa-plus"></i>
            Tambah Data
          </button>
        </div>

        <div class="table-wrapper">
          <table id="datatable1" class="table table-bordered table-striped" style="width:100%">
            <thead>
              <tr>
                <th style="text-align:center;width:10%">No</th>
                <th style="width:30%">Kode Wilayah</th>
                <th style="width:40%">Nama Kecamatan</th>
                <th style="text-align:center;width:20%">Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</section>

@include('admin.kecamatan.form')
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
      processing: "Sedang diproses..."
    },
    ajax: {
      url: '{{ route('data_kecamatan') }}',
      type: 'GET',
      data: function(d){

      }
    },
    columns: [
      {data: null, render: (d,t,r,m) => m.row + 1, className: 'text-center'},
      {data: 'kecamatan_kode_wilayah', name: 'kecamatan_kode_wilayah', className: 'text-left'},
      {data: 'kecamatan_nama', name: 'kecamatan_nama', className: 'text-left'},
      {data: 'aksi', name: 'aksi', className: 'text-center', orderable: false, searchable: false},
    ]
  });

  $('#modal-form form').validator().on('submit', function(e){
    if(!e.isDefaultPrevented()){
      var id = $('#id').val();
      if(save_method == "add") url = "{{ route('kecamatan.store') }}";
      else url = "kecamatan/"+id;
      $.ajax({
        url : url,
        type : "POST",
        data : $('#modal-form form').serialize(),
        success : function(data){
          $('#modal-form').modal('hide');
          table.ajax.reload();
        },
        error : function(){
          alert("Tidak dapat menyimpan data!");
        }
      });
      return false;
    }
  });
});

function addForm(){
  save_method = "add";
  $('input[name=_method]').val('POST');
  $('#modal-form').modal('show');
  $('#modal-form form')[0].reset();
  $('.modal-title').text('Tambah Data Kecamatan');
}

function editForm(id){
  save_method = "edit";
  $('input[name=_method]').val('PATCH');
  $('#modal-form form')[0].reset();
  $.ajax({
    url : "kecamatan/"+id+"/edit",
    type : "GET",
    dataType : "JSON",
    success : function(data){
      $('#modal-form').modal('show');
      $('.modal-title').text('Edit Data Kecamatan');
      $('#id').val(data.kecamatan_id);
      $('#kecamatan_kode_wilayah').val(data.kecamatan_kode_wilayah);
      $('#kecamatan_nama').val(data.kecamatan_nama);
    },
    error : function(){
      alert("Tidak dapat menampilkan data !!!");
    }
  });
}

function deleteData(id){
  if(confirm("Apakah yakin data akan dihapus?")){
    $.ajax({
      url : "kecamatan/"+id,
      type : "POST",
      data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
      success : function(data){
        table.ajax.reload();
      },
      error : function(){
        alert("Tidak dapat menghapus data!");
      }
    });
  }
}
</script>

@endsection