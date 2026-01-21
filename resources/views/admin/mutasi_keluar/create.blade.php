<?php $hal = "mutasi_keluar"; $hari_ini = date("Y-m-d"); ?>
@extends('layouts.admin.master')
@section('title', 'DINDIK | Mutasi Keluar')

@section('css')
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="page-header-modern">
  <h1 class="page-title-modern">
    <a href="{{route('mutasi_keluar.index')}}" class="btn-modern btn-warning-modern">
      <i class="fa fa-arrow-circle-left"></i> Kembali
    </a> |
    Mutasi Keluar
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="detail-card">
        <form class="form-horizontal" role="form" action="{{route('mutasi_keluar.store')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          {{method_field('post')}}

          <div class="form-group-modern">
            <label for="jenjang_id" class="col-sm-2 control-label">Jenjang</label>
            <div class="col-sm-10">
              <select required name="jenjang_id" id="jenjang_id" class="form-control">
                <option disabled selected value="">-- Pilih --</option>
                <?php foreach ($jenjang as $value) { ?>
                  <option value="{{$value->jenjang_id}}">{{$value->jenjang_nama}}</option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="section-header">
            <i class="fas fa-user-graduate"></i>
            IDENTITAS SISWA
          </div>

          <div class="form-group-modern">
            <label for="mutasi_noinduk" class="col-sm-2 control-label">No. Induk</label>
            <div class="col-sm-10">
              <input type="text" required class="form-control" name="mutasi_noinduk" id="mutasi_noinduk" placeholder="Nomor Induk">
            </div>
          </div>

          <div class="form-group-modern">
            <label for="mutasi_nisn" class="col-sm-2 control-label">NISN</label>
            <div class="col-sm-10">
              <input type="text" required class="form-control" name="mutasi_nisn" id="mutasi_nisn" placeholder="NISN">
            </div>
          </div>

          <div class="form-group-modern">
            <label for="mutasi_tingkat_kelas" class="col-sm-2 control-label">Tingkat Kelas</label>
            <div class="col-sm-10">
              <input type="text" required class="form-control" name="mutasi_tingkat_kelas" id="mutasi_tingkat_kelas" placeholder="Tingkat Kelas">
            </div>
          </div>

          <div class="form-group-modern">
            <label for="mutasi_nama_siswa" class="col-sm-2 control-label">Nama Siswa</label>
            <div class="col-sm-10">
              <input type="text" required class="form-control" name="mutasi_nama_siswa" id="mutasi_nama_siswa" placeholder="Nama Siswa">
            </div>
          </div>

          <div class="form-group-modern">
            <label for="mutasi_tempat_lahir" class="col-sm-2 control-label">Tempat/Tgl Lahir</label>
            <div class="col-sm-5">
              <input type="text" required class="form-control" name="mutasi_tempat_lahir" id="mutasi_tempat_lahir" placeholder="Tempat Lahir">
            </div>
            <div class="col-sm-1">
              /
            </div>
            <div class="col-sm-4">
              <input type="date" max="{{$hari_ini}}" required class="form-control" name="mutasi_tanggal_lahir" id="mutasi_tanggal_lahir" placeholder="Tanggal Lahir">
            </div>
          </div>

          <div class="form-group-modern">
            <label for="mutasi_nama_wali" class="col-sm-2 control-label">Nama Wali</label>
            <div class="col-sm-10">
              <input type="text" required class="form-control" name="mutasi_nama_wali" id="mutasi_nama_wali" placeholder="Nama Wali">
            </div>
          </div>

          <div class="form-group-modern">
            <label for="mutasi_alamat" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-10">
              <input type="text" required class="form-control" name="mutasi_alamat" id="mutasi_alamat" placeholder="Alamat">
            </div>
          </div>

          <div class="section-header">
            <i class="fas fa-school"></i>
            SEKOLAH ASAL SISWA
          </div>

          <div class="form-group-modern">
            <label for="kecamatan_id" class="col-sm-2 control-label">Kecamatan</label>
            <div class="col-sm-10">
              <select required name="kecamatan_id" id="kecamatan_id" class="form-control js-example-basic-single" style="width: 100%;">
                <option disabled selected value="">-- Pilih --</option>
                <?php foreach ($kecamatan as $value) { ?>
                  <option value="{{$value->kecamatan_id}}">{{$value->kecamatan_nama}}</option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group-modern">
            <label for="mutasi_sekolah_asal_nama" class="col-sm-2 control-label">Nama Sekolah</label>
            <div class="col-sm-10">
              <input type="text" hidden name="kecamatan_search_id" id="kecamatan_search_id">
              <input type="text" hidden name="jenjang_search_id" id="jenjang_search_id">
              <select required id="sekolah_id" name="sekolah_id" class="form-control">
                <option value="" disabled selected>- Pilih Sekolahan -</option>
              </select>
              <small style="color:orange">Pilih jenjang dan kecamatan terlebih dahulu</small>
            </div>
          </div>

          <div class="form-group-modern">
            <label for="mutasi_sekolah_asal_no_surat" class="col-sm-2 control-label">Nomor Surat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" required name="mutasi_sekolah_asal_no_surat" id="mutasi_sekolah_asal_no_surat" placeholder="Nomor Surat">
            </div>
          </div>

          <div class="form-group-modern">
            <label for="mutasi_tanggal_mutasi" class="col-sm-2 control-label">Tanggal Surat</label>
            <div class="col-sm-10">
              <input type="date" max="{{$hari_ini}}" class="form-control" required name="mutasi_tanggal_mutasi" id="mutasi_tanggal_mutasi" placeholder="">
            </div>
          </div>

          <div class="section-header">
            <i class="fas fa-building"></i>
            SEKOLAH TUJUAN SISWA
          </div>

          <div class="form-group-modern">
            <label for="mutasi_sekolah_tujuan_nama" class="col-sm-2 control-label">Nama Sekolah</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" required name="mutasi_sekolah_tujuan_nama" id="mutasi_sekolah_tujuan_nama" placeholder="Nama Sekolah Tujuan">
            </div>
          </div>

          <div class="form-group-modern">
            <label for="mutasi_sekolah_tujuan_no_surat" class="col-sm-2 control-label">Nomor Surat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" required name="mutasi_sekolah_tujuan_no_surat" id="mutasi_sekolah_tujuan_no_surat" placeholder="Nomor Surat">
            </div>
          </div>

          <div class="form-group-modern">
            <label for="mutasi_tanggal_surat_diterima" class="col-sm-2 control-label">Tanggal Surat</label>
            <div class="col-sm-10">
              <input type="date" max="{{$hari_ini}}" class="form-control" required name="mutasi_tanggal_surat_diterima" id="mutasi_tanggal_surat_diterima" placeholder="">
            </div>
          </div>

          <div class="form-footer">
            <button type="submit" class="btn-modern btn-primary-modern">
              <i class="fa fa-floppy-o"></i> Simpan
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</section>

@endsection

@section('js')
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function() {

  $('#kecamatan_search_id').val("0");
  $('#jenjang_search_id').val("0");

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
    $('.js-example-basic-single').select2();
  });
</script>

@endsection