<?php $hal = "menu"; ?>
@extends('layouts.admin.master')
@section('title', 'Master Menu')

@section('css')
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="page-header-modern">
  <h1 class="page-title-modern">
    <i class="fas fa-bars"></i> Master Menu
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="content-card">
        <div class="content-card-header">
          <h3 class="content-card-title">
            <i class="fas fa-table"></i> Data Master Menu
          </h3>
          <button onclick="addForm()" class="btn-modern btn-primary-modern">
            <i class="fa fa-plus"></i> Tambah
          </button>
        </div>

        <div class="table-wrapper">
          <table id="datatable1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width:10%">No #</th>
                <th style="width:16%">Nama Menu</th>
                <th style="width:16%">Link</th>
                <th style="width:16%">Parent</th>
                <th style="width:10%">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>

      </div>

    </div>
  </div>
</section>

@include('admin.menu.form')
@endsection

@section('js')
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script type="text/javascript">
var table, save_method;
$(function(){
  table = $('.table').DataTable({
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
    "ajax" : {
      "url" : "{{ route('data_menu') }}",
      "type" : "GET"
    }
  });
  $('#modal-form form').validator().on('submit', function(e){
    if(!e.isDefaultPrevented()){
      var id = $('#id').val();
      if(save_method == "add") url = "{{ route('menu.store') }}";
      else url = "menu/"+id;
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
  $('.app-modal-title').text('Tambah Data Menu');
}
function editForm(id){
  save_method = "edit";
  $('input[name=_method]').val('PATCH');
  $('#modal-form form')[0].reset();
  $.ajax({
    url : "menu/"+id+"/edit",
    type : "GET",
    dataType : "JSON",
    success : function(data){
      $('#modal-form').modal('show');
      $('.app-modal-title').text('Edit Data Menu');
      $('#id').val(data.menu_id);
      $('#menu_nama').val(data.menu_nama);
      $('#menu_link').val(data.menu_link);
      $('#menu_id_parent').val(data.menu_id_parent).trigger('change');
    },
    error : function(){
      alert("Tidak dapat menampilkan data !!!");
    }
  });
}
function deleteData(id){
  if(confirm("Apakah yakin data akan dihapus?")){
    $.ajax({
      url : "menu/"+id,
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
$(function () {
  $('#example1').DataTable()
  $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
  })
})
</script>

<script>
  $(document).ready(function() {
    $('.js-example-basic-single').select2({
      dropdownParent: $(".modal")
    });
  });
</script>

@endsection