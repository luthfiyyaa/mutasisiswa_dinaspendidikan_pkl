<?php $hal = "qr_read"; ?>
@extends('layouts.admin.master_qr')
@section('title', 'Detail Mutasi')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('public/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('public/admin/bower_components/select2/dist/css/select2.min.css')}}">

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
    Data Mutasi
    <!-- <small>Data barang</small> -->
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box">
        <div class="box-header row">
          <!-- <h3 class="box-title">Data Master Menu</h3> -->
          <div class="col-md-6">
            <form class="" action="" method="post">
              <div class="input-group input-group-sm">
                  <input type="text" name="mutasi_kode_scan" id="mutasi_kode_scan" class="form-control" value="{{$mutasi_kode_scan}}">
                      <span class="input-group-btn">
                        <button type="button" id="btnTampilkan" class="btn btn-info btn-flat"><i class="fa fa-fw fa-search"></i> CEK</button>
                      </span>
                </div>
            </form>
          </div>



        </div>


        <!-- /.box-header -->
        <div class="box-body">

          <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <!-- <h4><i class="icon fa fa-check"></i> Sukses !!</h4> -->
            Tekan tombol CEK untuk menampilkan data !!
          </div>

          <table id="tb_mutasi" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width:5%">No</th>
                <th style="width:20%">Detail</th>
                <th style="width:75%">Isi</th>
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
<script src="{{asset('public/admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('public/admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script type="text/javascript">
var table, mutasi_kode_scan;

$(document).ready(function () {
  $(document).on('click','#btnTampilkan',function (event) {
    event.preventDefault();

    mutasi_kode_scan = $('#mutasi_kode_scan').val();

    table.ajax.url("{{ url('/getDataMutasiCek') }}/"+mutasi_kode_scan).load();

    console.log(mutasi_kode_scan);


  });

  table = $('#tb_mutasi').DataTable({
    searching: false,
    pageLength: 50,
    paging: false,
    processing: true,
    serverSide: true,
    oLanguage: {
        "sEmptyTable": "<b>Tidak ada data</b>"
      },
    language: {
      processing: "Sedang diproses..."
    },
    ajax: {
      url: '{{ url('getDataMutasi') }}',
      type: 'GET',
      data: function(d){

      }
    },
    columns: [
      {data: 'no', name: 'no', className: 'text-center', orderable: false, searchable: false, render : function(data, type, full, meta){
        return meta.row+1+'.';
      }},
      {data: 'detail', name: 'detail', className: 'text-left'},
      {data: 'isi', name: 'isi', className: 'text-left'},
    ]
  });

});


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
