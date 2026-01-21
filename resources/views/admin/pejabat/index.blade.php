<?php $hal = "pejabat"; ?>
@extends('layouts.admin.master')
@section('title', 'DINDIK | Pejabat')

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
    <i class="fas fa-user-tie"></i>
    Data Pejabat
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
            Data Master Pejabat
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
                <th class="text-center" style="width:8%">No</th>
                <th style="width:15%">NIP</th>
                <th style="width:25%">Nama</th>
                <th style="width:17%">Pangkat</th>
                <th style="width:23%">Jabatan</th>
                <th class="text-center" style="width:12%">Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</section>

@include('admin.pejabat.form')
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
      url: '{{ route('data_pejabat') }}',
      type: 'GET',
      data: function(d){

      }
    },
    columns: [
      {data: null, render: (d,t,r,m) => m.row + 1, className: 'text-center'},
      {data: 'pejabat_nip', name: 'pejabat_nip', className: 'text-left'},
      {data: 'pejabat_nama', name: 'pejabat_nama', className: 'text-left'},
      {data: 'pejabat_pangkat', name: 'pejabat_pangkat', className: 'text-left'},
      {data: 'pejabat_jabatan', name: 'pejabat_jabatan', className: 'text-left'},
      {data: 'aksi', name: 'aksi', className: 'text-center', orderable: false, searchable: false},
    ]
  });

  $('#modal-form form').validator().on('submit', function(e){
    if(!e.isDefaultPrevented()){
      var id = $('#id').val();
      if(save_method == "add") url = "{{ route('pejabat.store') }}";
      else url = "pejabat/"+id;
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
  $('.app-modal-title').text('Tambah Data Pejabat');
}

function editForm(id){
  save_method = "edit";
  $('input[name=_method]').val('PATCH');
  $('#modal-form form')[0].reset();
  $.ajax({
    url : "pejabat/"+id+"/edit",
    type : "GET",
    dataType : "JSON",
    success : function(data){
      $('#modal-form').modal('show');
      $('.app-modal-title').text('Edit Data Pejabat');
      $('#id').val(data.pejabat_id);
      $('#pejabat_nip').val(data.pejabat_nip);
      $('#pejabat_nama').val(data.pejabat_nama);
      $('#pejabat_pangkat').val(data.pejabat_pangkat);
      $('#pejabat_jabatan').val(data.pejabat_jabatan);
    },
    error : function(){
      alert("Tidak dapat menampilkan data !!!");
    }
  });
}

function deleteData(id){
  if(confirm("Apakah yakin data akan dihapus?")){
    $.ajax({
      url : "pejabat/"+id,
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