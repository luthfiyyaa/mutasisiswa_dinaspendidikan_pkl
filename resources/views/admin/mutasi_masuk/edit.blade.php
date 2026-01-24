<?php $hal = "mutasi_masuk"; $hari_ini = date("Y-m-d"); ?>
@extends('layouts.admin.master')
@section('title', 'DINDIK | Mutasi Masuk')

@section('css')
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection


@section('content')
<!-- Page Header -->
<div class="page-header-modern">
  <h1 class="page-title-modern">
    <a href="{{route('mutasi_masuk.index')}}" class="btn-modern btn-warning-modern"><i class="fa fa-arrow-circle-left"></i>Kembali</a>
    <i class="fas fa-file-alt"></i>
    Edit Mutasi Masuk
  </h1>
</div>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="detail-card">
        <form class="form-horizontal" role="form" action="{{route('mutasi_masuk.update',$mutasi->mutasi_id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          {{method_field('PUT')}}

          <!-- Section: Jenjang -->
          <div class="detail-section">
            <div class="section-header">
              <i class="fas fa-graduation-cap"></i>
              <h3>Jenjang Pendidikan</h3>
            </div>

            <div class="form-group">
              <label for="jenjang_id" class="col-sm-3 control-label">Jenjang</label>
              <div class="col-sm-9">
                <select name="jenjang_id" id="jenjang_id" class="form-control" required>
                  @foreach ($jenjang as $value)
                    <option value="{{$value->jenjang_id}}" {{$mutasi->jenjang_id==$value->jenjang_id ? 'selected' : ''}}>
                      {{$value->jenjang_nama}}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <!-- Section: Identitas Siswa -->
          <div class="detail-section">
            <div class="section-header">
              <i class="fas fa-user-graduate"></i>
              <h3>Identitas Siswa</h3>
            </div>

            <div class="form-group">
              <label for="mutasi_noinduk" class="col-sm-3 control-label">No. Induk</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" required name="mutasi_noinduk" id="mutasi_noinduk" placeholder="Masukkan nomor induk" value="{{$mutasi->mutasi_noinduk}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_nisn" class="col-sm-3 control-label">NISN</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" required name="mutasi_nisn" id="mutasi_nisn" placeholder="Masukkan NISN" value="{{$mutasi->mutasi_nisn}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_tingkat_kelas" class="col-sm-3 control-label">Tingkat Kelas</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" required name="mutasi_tingkat_kelas" id="mutasi_tingkat_kelas" placeholder="Contoh: X, XI, XII" value="{{$mutasi->mutasi_tingkat_kelas}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_nama_siswa" class="col-sm-3 control-label">Nama Siswa</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" required name="mutasi_nama_siswa" id="mutasi_nama_siswa" placeholder="Masukkan nama lengkap siswa" value="{{$mutasi->mutasi_nama_siswa}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_tempat_lahir" class="col-sm-3 control-label">Tempat/Tgl Lahir</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" required name="mutasi_tempat_lahir" id="mutasi_tempat_lahir" placeholder="Tempat lahir" value="{{$mutasi->mutasi_tempat_lahir}}">
              </div>
              <div class="col-sm-5">
                <input type="date" max="{{$hari_ini}}" class="form-control" required name="mutasi_tanggal_lahir" id="mutasi_tanggal_lahir" value="{{$mutasi->mutasi_tanggal_lahir}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_nama_wali" class="col-sm-3 control-label">Nama Wali</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" required name="mutasi_nama_wali" id="mutasi_nama_wali" placeholder="Masukkan nama wali/orang tua" value="{{$mutasi->mutasi_nama_wali}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_alamat" class="col-sm-3 control-label">Alamat</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" required name="mutasi_alamat" id="mutasi_alamat" placeholder="Masukkan alamat lengkap" value="{{$mutasi->mutasi_alamat}}">
              </div>
            </div>
          </div>

          <!-- Section: Sekolah Asal -->
          <div class="detail-section">
            <div class="section-header">
              <i class="fas fa-school"></i>
              <h3>Sekolah Asal Siswa</h3>
            </div>

            <div class="form-group">
              <label for="mutasi_sekolah_asal_nama" class="col-sm-3 control-label">Nama Sekolah</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" required name="mutasi_sekolah_asal_nama" id="mutasi_sekolah_asal_nama" placeholder="Masukkan nama sekolah asal" value="{{$mutasi->mutasi_sekolah_asal_nama}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_sekolah_asal_no_surat" class="col-sm-3 control-label">Nomor Surat</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" required name="mutasi_sekolah_asal_no_surat" id="mutasi_sekolah_asal_no_surat" placeholder="Masukkan nomor surat" value="{{$mutasi->mutasi_sekolah_asal_no_surat}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_tanggal_mutasi" class="col-sm-3 control-label">Tanggal Surat</label>
              <div class="col-sm-9">
                <input type="date" max="{{$hari_ini}}" class="form-control" required name="mutasi_tanggal_mutasi" id="mutasi_tanggal_mutasi" value="{{$mutasi->mutasi_tanggal_mutasi}}">
              </div>
            </div>
          </div>

          <!-- Section: Sekolah Tujuan -->
          <div class="detail-section">
            <div class="section-header">
              <i class="fas fa-building"></i>
              <h3>Sekolah Tujuan Siswa</h3>
            </div>

            <div class="form-group">
              <label for="kecamatan_id" class="col-sm-3 control-label">Kecamatan</label>
              <div class="col-sm-9">
                <select required name="kecamatan_id" id="kecamatan_id" class="form-control" style="width: 100%;">
                  @foreach ($kecamatan as $value)
                    <option value="{{$value->kecamatan_id}}" {{$kecamatan_id==$value->kecamatan_id ? 'selected' : ''}}>
                      {{$value->kecamatan_nama}}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="sekolah_id" class="col-sm-3 control-label">Nama Sekolah</label>
              <div class="col-sm-9">
                <input type="hidden" name="kecamatan_search_id" id="kecamatan_search_id">
                <input type="hidden" name="jenjang_search_id" id="jenjang_search_id">
                <select id="sekolah_id" name="sekolah_id" class="form-control" required>
                  <option value="" disabled selected>-- Pilih Sekolah --</option>
                </select>
                <small style="color:#f59e0b; display:block; margin-top:5px;">
                  <i class="fas fa-info-circle"></i> Pilih jenjang dan kecamatan terlebih dahulu
                </small>
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_sekolah_tujuan_no_surat" class="col-sm-3 control-label">Nomor Surat</label>
              <div class="col-sm-9">
                <input type="text" required class="form-control" name="mutasi_sekolah_tujuan_no_surat" id="mutasi_sekolah_tujuan_no_surat" placeholder="Masukkan nomor surat" value="{{$mutasi->mutasi_sekolah_tujuan_no_surat}}">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_tanggal_surat_diterima" class="col-sm-3 control-label">Tanggal Surat</label>
              <div class="col-sm-9">
                <input type="date" max="{{$hari_ini}}" class="form-control" required name="mutasi_tanggal_surat_diterima" id="mutasi_tanggal_surat_diterima" value="{{$mutasi->mutasi_tanggal_surat_diterima}}">
              </div>
            </div>
          </div>

          <!-- Footer -->
          <div class="form-footer">
            <button type="submit" class="btn-modern btn-primary-modern">
              <i class="fa fa-save"></i>
              Simpan Perubahan
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

  $('#kecamatan_search_id').val("{{$kecamatan_id}}");
  $('#jenjang_search_id').val("{{$mutasi->jenjang_id}}");

  var sekolah_selected = "<option value='{{$mutasi_sekolah_tujuan_id}}'>{{$sekolah_nama}}</option>";
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
              text: item.sekolah_nama,
              id: item.sekolah_id
            }
          })
        };
      }
    }
  });

  $('.js-example-basic-single').select2();

});
</script>

@endsection