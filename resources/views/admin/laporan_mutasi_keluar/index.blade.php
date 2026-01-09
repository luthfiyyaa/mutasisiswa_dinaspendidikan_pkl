<?php $hal = "laporan_mutasi_keluar"; ?>
@extends('layouts.admin.master')
@section('title', 'DISDIKPORA | Laporan Mutasi Keluar')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('public/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

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
    Laporan Mutasi Keluar
    <!-- <small>Data barang</small> -->
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Mutasi Keluar</h3>
        </div>
        <div class="box-body">

          <div class="form-group row">
            <div class="col-md-6">

              <form class="form-horizontal">
                <div class="box-body">
                  <div class="form-group">
                    <label for="tanggal_awal" class="col-sm-3 control-label">Tanggal awal</label>

                    <div class="col-sm-9">
                      <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal" placeholder="Tanggal awal">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="tanggal_akhir" class="col-sm-3 control-label">Tanggal akhir</label>

                    <div class="col-sm-9">
                      <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" placeholder="Tanggal akhir">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="tanggal_akhir" class="col-sm-3 control-label">Jenjang</label>

                    <div class="col-sm-9">
                      <select name="jenjang" id="jenjang" class="form-control">
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
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" id="btnTampilkan" class="btn btn-primary"><i class="fa fa-fw fa-search"></i>Tampilkan</button>
                  <button type="submit" id="btnCetak" class="btn btn-success pull-right"> <i class="fa fa-print"></i> Cetak Laporan</button>
                </div>
                <!-- /.box-footer -->
              </form>
            </div>
          </div>
        </div>


        <!-- /.box-header -->
        <div class="box-body">
          <table id="datatable1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="text-align: center;width:5%">No #</th>
                <th style="width:25%">Nama</th>
                <th style="width:10%">No. Induk</th>
                <th style="width:10%">NISN</th>
                <th style="width:20%">Sekolah Asal</th>
                <th style="width:20%">Sekolah Tujuan</th>
                <th style="text-align: center;width:5%">Action</th>
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
var table, save_method, tanggal_awal, tanggal_akhir, jenjang, query;
$(function(){

  table = $('.table').DataTable({
    searching: true,
    processing: true,
    serverSide: true,
    oLanguage: {
        "sEmptyTable": "Tidak ada data"
      },
    language: {
      processing: "Sedang diproses..."
    },
    ajax: {
      url: '{{ route('data_laporan_mutasi_keluar') }}',
      type: 'GET',
      data: function(d){

      }
    },
    columns: [
      {data: 'no', name: 'no', className: 'text-center'},
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

  $(document).on('click','#btnTampilkan',function (event) {
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

    tanggal_awal = $('#tanggal_awal').val();
    tanggal_akhir = $('#tanggal_akhir').val();
    jenjang = $('#jenjang').val();

    query = "";

    if (jenjang=="all"&&tanggal_awal==""&&tanggal_akhir=="") {
      query = "q1"; //tampilkan semua data
      window.open("{{url('laporan_mutasi_keluar_excel_file')}}/"+0+"/"+0+"/"+jenjang+"/"+query);
    }else if (tanggal_awal==""&&tanggal_akhir=="") {
      query = "q2"; //tampilkan berdasarkan jenjang
      window.open("{{url('laporan_mutasi_keluar_excel_file')}}/"+0+"/"+0+"/"+jenjang+"/"+query);
    }else if (jenjang=="all") {
      query = "q3"; //tampilkan berdasarkan tanggal awal dan tanggal akhir
      window.open("{{url('laporan_mutasi_keluar_excel_file')}}/"+tanggal_awal+"/"+tanggal_akhir+"/"+jenjang+"/"+query);
    }else {
      query = "q4"; //tampilkan berdasarkan semua filter
      window.open("{{url('laporan_mutasi_keluar_excel_file')}}/"+tanggal_awal+"/"+tanggal_akhir+"/"+jenjang+"/"+query);
    }



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
