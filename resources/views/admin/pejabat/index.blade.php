<?php $hal = "pejabat"; ?>
@extends('layouts.admin.master')
@section('title', 'DISDIKPORA | Pejabat')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

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
    Data Pejabat
    <!-- <small>Data barang</small> -->
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Master Pejabat</h3>
        </div>
        <a onclick="addForm()"  style="margin-bottom:20px;margin-left:10px;" class="card-body-title"><button class="btn btn-primary"><i class="fa  fa-plus-square-o"></i> Tambah</button></a>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="datatable1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="text-align: center;width:10%">No #</th>
                <th style="width:15%">NIP</th>
                <th style="width:25%">Nama</th>
                <th style="width:15%">Pangkat</th>
                <th style="width:25%">Jabatan</th>
                <th style="text-align: center;width:10%">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@include('admin.pejabat.form')
@endsection


@section('js')
<!-- DataTables -->
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script type="text/javascript">
var table, save_method;
$(function(){

  // table = $('.table').DataTable({
  //   "processing" : true,
  //   "ajax" : {
  //     "url" : "{{ route('data_group') }}",
  //     "type" : "GET"
  //   }
  // });

  table = $('.table').DataTable({
    searching: true,
    processing: true,
    language: {
      processing: "Sedang diproses..."
    },
    ajax: {
      url: '{{ route('data_pejabat') }}',
      type: 'GET',
      data: function(d){

      }
    },
    columns: [
      { data: null, render: (d,t,r,m) => m.row + 1 },
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
  $('.modal-title').text('Tambah Data Pejabat');
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
      $('.modal-title').text('Edit Data Pejabat');
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




@endsection
