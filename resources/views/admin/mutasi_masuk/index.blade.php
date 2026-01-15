<?php $hal = "mutasi_masuk"; ?>
@extends('layouts.admin.master')
@section('title', 'DISDIKPORA | Mutasi Masuk')

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
    Mutasi Masuk
    <!-- <small>Data barang</small> -->
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Data Mutasi Masuk</h3>
        </div>
        <a href="{{route('mutasi_masuk.create')}}"  style="margin-bottom:20px;margin-left:10px;" class="card-body-title"><button class="btn btn-primary"><i class="fa  fa-plus-square-o"></i> Tambah</button></a>
        <div class="box-body">
        <div class="form-group row">
          <div class="col-md-3">
            <select name="jenjang" id="jenjang" class="form-control">
              <option disabled selected value="">-- Pilih --</option>
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


        <!-- /.box-header -->
        <div class="box-body">
          <table id="datatable1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="text-align: center;width:5%">No #</th>
                <th style="width:20%">Nama</th>
                <th style="width:10%">No. Induk</th>
                <th style="width:10%">NISN</th>
                <th style="width:20%">Sekolah Asal</th>
                <th style="width:20%">Sekolah Tujuan</th>
                <th style="text-align: center;width:15%">Action</th>
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

@endsection


@section('js')
<!-- DataTables -->
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script type="text/javascript">
var table, save_method;
$(function(){

  table = $('.table').DataTable({
    processing: true,
    searching: true,
    language: {
      processing: "Sedang diproses..."
    },
    ajax: {
      url: '{{ route('data_mutasi_masuk') }}',
      type: 'GET',
      data: function(d){
      }
    },
    columns: [
      {data: null, render: (d,t,r,m) => m.row + 1},
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

     table.ajax.url("{{ url('/data_mutasi_masuk_jenjang') }}/"+jenjang_id).load();

 });

});

function deleteData(id){
  if(confirm("Apakah yakin data akan dihapus?")){
    $.ajax({
      url : "mutasi_masuk/"+id,
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
