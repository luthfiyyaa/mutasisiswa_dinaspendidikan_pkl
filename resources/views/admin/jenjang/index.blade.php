<?php $hal = "jenjang"; ?>
@extends('layouts.admin.master')
@section('title', 'DINDIK | Jenjang')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection


@section('content')
<!-- Page Header -->
<div class="page-header-modern">
  <h1 class="page-title-modern">
    <i class="fas fa-layer-group"></i>
    Master Jenjang
  </h1>
</div>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="content-card">
        <div class="content-card-header">
          <h3 class="content-card-title">
            <i class="fas fa-table"></i>
            Data Master Jenjang
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
                <th class="text-center" style="width:10%">No</th>
                <th style="width:35%">Nama Jenjang</th>
                <th style="width:45%">Pejabat</th>
                <th class="text-center" style="width:10%">Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</section>

@include('admin.jenjang.form')
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
      processing: "Sedang diproses...",
      paginate: {
        first: "Pertama",
        last: "Terakhir",
        next: "Selanjutnya",
        previous: "Sebelumnya"
      }
    },
    ajax: {
      url: '{{ route('data_jenjang') }}',
      type: 'GET',
      data: function(d){

      }
    },
    columns: [
      {data: null, render: (d,t,r,m) => m.row + 1, className: 'text-center'},
      {data: 'jenjang_nama', name: 'jenjang_nama', className: 'text-left'},
      {data: 'pejabat_nama', name: 'pejabat_nama', className: 'text-left'},
      {data: 'aksi', name: 'aksi', className: 'text-center', orderable: false, searchable: false},
    ]
  });

  $('#modal-form form').validator().on('submit', function(e){
    if(!e.isDefaultPrevented()){
      var id = $('#id').val();
      if(save_method == "add") url = "{{ route('jenjang.store') }}";
      else url = "jenjang/"+id;
      $.ajax({
        url : url,
        type : "POST",
        data : $('#modal-form form').serialize(),
        success : function(data){
          $('#modal-form').modal('hide');
          table.ajax.reload();
          location.reload();
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
  $('.app-modal-title').text('Tambah Data Jenjang');
  $('#pejabat_id').val('').trigger('change');
}

function editForm(id){
  save_method = "edit";
  $('input[name=_method]').val('PATCH');
  $('#modal-form form')[0].reset();
  $.ajax({
    url : "jenjang/"+id+"/edit",
    type : "GET",
    dataType : "JSON",
    success : function(data){
      $('#modal-form').modal('show');
      $('.app-modal-title').text('Edit Data Jenjang');
      $('#id').val(data.jenjang_id);
      $('#jenjang_nama').val(data.jenjang_nama);
      $('#pejabat_id').val(data.pejabat_id).trigger('change');
    },
    error : function(){
      alert("Tidak dapat menampilkan data !!!");
    }
  });
}

function deleteData(id){
  if(confirm("Apakah yakin data akan dihapus?")){
    $.ajax({
      url : "jenjang/"+id,
      type : "POST",
      data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
      success : function(data){
        table.ajax.reload();
        location.reload();
      },
      error : function(){
        alert("Tidak dapat menghapus data!");
      }
    });
  }
}
</script>

<script>
$(document).ready(function() {
  $('.js-example-basic-single').select2({
    dropdownParent: $("#modal-form")
  });
});
</script>

@endsection