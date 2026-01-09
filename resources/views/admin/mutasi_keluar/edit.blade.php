<?php $hal = "mutasi_keluar"; $hari_ini = date("Y-m-d");?>
@extends('layouts.admin.master')
@section('title', 'DISDIKPORA | Mutasi Keluar')

@section('css')
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
    <a href="{{route('mutasi_keluar.index')}}" class="btn btn-warning"> <i class="fa fa-arrow-circle-left"></i>  Kembali</a> |
    Edit Mutasi Keluar
    <!-- <small>Data barang</small> -->
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-8">


      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Form Edit Mutasi Masuk</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" role="form" action="{{route('mutasi_keluar.update',$mutasi->mutasi_id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
					{{method_field('PUT')}}
          <div class="box-body" style="margin-left:20px;">


            <div class="form-group">
              <label for="jenjang_id" class="col-sm-2 control-label">Jenjang</label>

              <div class="col-sm-10">
                <select required name="jenjang_id" id="jenjang_id" class="form-control">
                  <?php
                  foreach ($jenjang as $value) {
                    ?>
                    <option value="{{ $value->jenjang_id }}" {{ $mutasi->jenjang_id==$value->jenjang_id ? 'selected' : '' }}> {{$value->jenjang_nama}} </option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <hr>
            <p><b>IDENTITAS SISWA :</b></p>

            <div class="form-group">
              <label for="mutasi_noinduk" class="col-sm-2 control-label">No. Induk</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" required name="mutasi_noinduk" id="mutasi_noinduk" placeholder="Nomor Induk" value="{{$mutasi->mutasi_noinduk}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_nisn" class="col-sm-2 control-label">NISN</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" required name="mutasi_nisn" id="mutasi_nisn" placeholder="NISN" value="{{$mutasi->mutasi_nisn}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_tingkat_kelas" class="col-sm-2 control-label">Tingkat Kelas</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" required name="mutasi_tingkat_kelas" id="mutasi_tingkat_kelas" placeholder="Tingkat Kelas" value="{{$mutasi->mutasi_tingkat_kelas}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_nama_siswa" class="col-sm-2 control-label">Nama Siswa</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" required name="mutasi_nama_siswa" id="mutasi_nama_siswa" placeholder="Nama Siswa" value="{{$mutasi->mutasi_nama_siswa}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_tempat_lahir" class="col-sm-2 control-label">Tempat/Tgl Lahir</label>

              <div class="col-sm-5">
                <input type="text" class="form-control" required name="mutasi_tempat_lahir" id="mutasi_tempat_lahir" placeholder="Tempat Lahir" value="{{$mutasi->mutasi_tempat_lahir}}">
              </div>
              <div class="col-sm-1">
                /
              </div>
              <div class="col-sm-4">
                <input type="date" max="{{$hari_ini}}" class="form-control" required name="mutasi_tanggal_lahir" id="mutasi_tanggal_lahir" placeholder="Tanggal Lahir" value="{{$mutasi->mutasi_tanggal_lahir}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_nama_wali" class="col-sm-2 control-label">Nama Wali</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" required name="mutasi_nama_wali" id="mutasi_nama_wali" placeholder="Nama Wali" value="{{$mutasi->mutasi_nama_wali}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_alamat" class="col-sm-2 control-label">Alamat</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" required name="mutasi_alamat" id="mutasi_alamat" placeholder="Alamat" value="{{$mutasi->mutasi_alamat}}">
              </div>
            </div>

            <hr>
            <p><b>SEKOLAH ASAL SISWA :</b></p>

            <div class="form-group">
              <label for="kecamatan_id" class="col-sm-2 control-label">Kecamatan</label>

              <div class="col-sm-10">
                <select required name="kecamatan_id" id="kecamatan_id" class="form-control js-example-basic-single" style="width: 100%;">
                  <?php
                  foreach ($kecamatan as $value) {
                    ?>
                    <option value="{{ $value->kecamatan_id }}" {{ $kecamatan_id==$value->kecamatan_id ? 'selected' : '' }}> {{$value->kecamatan_nama}} </option>
                  <?php } ?>
                </select>
                </div>
            </div>

            <div class="form-group">
              <label for="mutasi_sekolah_asal_nama" class="col-sm-2 control-label">Nama Sekolah</label>

              <div class="col-sm-10">

              <!-- <input type="text" hidden class="form-control empty" id="jenishukuman" name="jenishukuman" placeholder="Wajib Diisi"> -->
              <input type="text" hidden  name="kecamatan_search_id" id="kecamatan_search_id">
              <input type="text" hidden  name="jenjang_search_id" id="jenjang_search_id">
              <select id="sekolah_id" required name="sekolah_id" class="form-control">
                <option value="" disabled selected>- Pilih Sekolahan -</option>
              </select>
              <small style="color:orange">Pilih jenjang dan kecamatan terlebih dahulu</small>

                <!-- <input type="text" class="form-control" name="mutasi_sekolah_asal_nama" id="mutasi_sekolah_asal_nama" placeholder=""> -->
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_sekolah_asal_no_surat" class="col-sm-2 control-label">Nomor Surat</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" required name="mutasi_sekolah_asal_no_surat" id="mutasi_sekolah_asal_no_surat" placeholder="Nomor Surat" value="{{$mutasi->mutasi_sekolah_asal_no_surat}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_tanggal_mutasi	" class="col-sm-2 control-label">Tanggal Surat</label>

              <div class="col-sm-10">
                <input type="date" max="{{$hari_ini}}" class="form-control" required name="mutasi_tanggal_mutasi" id="mutasi_tanggal_mutasi" placeholder="" value="{{$mutasi->mutasi_tanggal_mutasi}}">
              </div>
            </div>

            <hr>
            <p><b>SEKOLAH TUJUAN SISWA :</b></p>



            <div class="form-group">
              <label for="mutasi_sekolah_tujuan_nama" class="col-sm-2 control-label">Nama Sekolah</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" required name="mutasi_sekolah_tujuan_nama" id="mutasi_sekolah_tujuan_nama" placeholder="Nama Sekolah Tujuan" value="{{$mutasi->mutasi_sekolah_tujuan_nama}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_sekolah_tujuan_no_surat" class="col-sm-2 control-label">Nomor Surat</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" required name="mutasi_sekolah_tujuan_no_surat" id="mutasi_sekolah_tujuan_no_surat" placeholder="Nomor Surat" value="{{$mutasi->mutasi_sekolah_tujuan_no_surat}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_tanggal_surat_diterima" class="col-sm-2 control-label">Tanggal Surat</label>

              <div class="col-sm-10">
                <input type="date" max="{{$hari_ini}}" class="form-control" required name="mutasi_tanggal_surat_diterima" id="mutasi_tanggal_surat_diterima" placeholder="" value="{{$mutasi->mutasi_tanggal_surat_diterima}}">
              </div>
            </div>


          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <!-- <a href="{{route('mutasi_masuk.index')}}" class="btn btn-warning">Kembali</a> -->
            <button type="submit" class="btn btn-primary pull-right"> <i class="fa fa-floppy-o"></i> Simpan</button>
          </div>
          <!-- /.box-footer -->
        </form>
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
<script src="{{asset('public/admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('public/admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function() {

  $('#kecamatan_search_id').val("{{$kecamatan_id}}");
  $('#jenjang_search_id').val("{{$mutasi->jenjang_id}}");

  var sekolah_selected = "<option value="+"{{$mutasi_sekolah_asal_id}}"+">"+"{{$sekolah_nama}}"+"</option>"
  $('#sekolah_id').html(sekolah_selected);

  $(document).on('change','#kecamatan_id',function(a) {
    var id = $(this).val();
    console.log(id);
    $('#kecamatan_search_id').val(id);
  });

  $(document).on('change','#jenjang_id',function(a) {
    var id = $(this).val();
    console.log(id);
    $('#jenjang_search_id').val(id);
  });



  $("#sekolah_id").select2({
    // minimumInputLength: 0,
    // minimumResultsForSearch: -1,
    minimumInputLength: 0,
    ajax: {
      placeholder: 'Cari Sekolah',
      cache: false,
      url: '{{  url('search_sekolah') }}',
      dataType: 'json',
      type: "GET",
      quietMillis: 50,
      data: function (params) {
        return {
          select: $.trim(params.term),
          kecamatan_id: $('#kecamatan_search_id').val(),
          jenjang_id: $('#jenjang_search_id').val()
        };
      },
      processResults: function (data) {
        return {
          results: $.map(data, function (item) {
            return {
              text:item.sekolah_nama,
              id: item.sekolah_id
            }
          })
        };
      }
    }
  });



});
</script>

<script>

  $(document).ready(function() {
  $('.js-example-basic-single').select2({
    // dropdownParent: $(".modal")
  });
});
</script>

@endsection
