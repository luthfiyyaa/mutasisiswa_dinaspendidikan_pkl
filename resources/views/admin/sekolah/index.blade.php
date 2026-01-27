<?php $hal = "sekolah"; ?>
@extends('layouts.admin.master')
@section('title', 'DINDIK | Sekolah')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection


@section('content')
<!-- Page Header -->
<div class="page-header-modern">
  <h1 class="page-title-modern">
    <i class="fas fa-school"></i>
    Master Sekolah
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
            Data Master Sekolah
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
                <th class="text-center" style="width:5%">No</th>
                <th style="width:20%">Nama Sekolah</th>
                <th style="width:15%">NPSN</th>
                <th style="width:10%">Jenjang</th>
                <th style="width:15%">Kecamatan</th>
                <th style="width:20%">Alamat</th>
                <th class="text-center" style="width:15%">Aksi</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</section>

@include('admin.sekolah.form')
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
      url: '{{ route('data_sekolah') }}',
      type: 'GET',
      data: function(d){

      }
    },
    columns: [
      {data: null, render: (d,t,r,m) => m.row + 1, className: 'text-center'},
      {data: 'sekolah_nama', name: 'sekolah_nama', className: 'text-left'},
      {data: 'sekolah_npsn', name: 'sekolah_npsn', className: 'text-left'},
      {data: 'jenjang_nama', name: 'jenjang_nama', className: 'text-left'},
      {data: 'kecamatan_nama', name: 'kecamatan_nama', className: 'text-left'},
      {data: 'sekolah_alamat', name: 'sekolah_alamat', className: 'text-left'},
      {data: 'aksi', name: 'aksi', className: 'text-center', orderable: false, searchable: false},
    ]
  });

  $('#modal-form form').validator().on('submit', function(e){
    if(!e.isDefaultPrevented()){
      var id = $('#id').val();
      if(save_method == "add") url = "{{ route('sekolah.store') }}";
      else url = "sekolah/"+id;
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
  $('.app-modal-title').text('Tambah Data Sekolah');
  $('#jenjang_id').val('').trigger('change');
  $('#kecamatan_id').val('').trigger('change');
}

function editForm(id){
  save_method = "edit";
  $('input[name=_method]').val('PATCH');
  $('#modal-form form')[0].reset();
  $.ajax({
    url: "{{ url('sekolah') }}/" + id + "/edit",
    type : "GET",
    dataType : "JSON",
    success : function(data){
      $('#modal-form').modal('show');
      $('.app-modal-title').text('Edit Data Sekolah');
      $('#id').val(data.sekolah_id);
      $('#sekolah_nama').val(data.sekolah_nama);
      $('#sekolah_npsn').val(data.sekolah_npsn);
      $('#jenjang_id').val(data.jenjang_id).trigger('change');
      $('#kecamatan_id').val(data.kecamatan_id).trigger('change');
      $('#sekolah_alamat').val(data.sekolah_alamat);
    },
    error : function(){
      alert("Tidak dapat menampilkan data !!!");
    }
  });
}

function deleteData(id){
  if(confirm("Apakah yakin data akan dihapus?")){
    $.ajax({
      url: "{{ url('sekolah') }}/" + id,
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