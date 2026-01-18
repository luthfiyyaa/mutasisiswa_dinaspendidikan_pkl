<?php $hal = "mutasi_keluar"; $hari_ini = date("Y-m-d"); ?>
@extends('layouts.admin.master')
@section('title', 'DINDIK | Mutasi Keluar')

@section('css')
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">


<style>
/* =====================
   GLOBAL & BACKGROUND
===================== */
.content-wrapper {
    background: transparent !important;
    max-width: 1200px;
    margin: 0 auto;
}

/* =====================
   PAGE HEADER
===================== */
.content-header {
    margin-bottom: 1.5rem;
    color : white;
}

.page-title {
    font-size: 1.65rem;
    font-weight: 700;
    color: white;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(253, 252, 252, 0.2);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.page-title i {
    font-size: 1.5rem;
}

/* =====================
   CONTENT CARD (BOX)
===================== */
.box {
    background: rgba(255,255,255,.98);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    border: none !important;
    box-shadow: 0 8px 30px rgba(0,0,0,.12);
    overflow: hidden;
    margin-bottom: 1.5rem;
}

.box-header {
    background: rgba(255,255,255,.98);
    /* padding: 1.25rem 1.5rem; */
    border: none !important;
    position: relative;
    overflow: hidden;
}

.box-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" fill="white" opacity="0.05"/></svg>');
    opacity: 0.3;
}

.box-title {
    color: black !important;
    font-size: 1.2rem;
    font-weight: 600;
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    gap: 0.6rem;
    margin: 0;
}

.box-title i {
    font-size: 1.2rem;
    color: white;
}

.box-body {
    padding: 2rem;
}

.section-header {
  background: linear-gradient(135deg, #66aaea 0%, #4ba2a0 100%);
  color: white;
  padding: 1rem 1.5rem;
  border-radius: 12px;
  font-weight: 700;
  font-size: 1.1rem;
  margin-bottom: 1.5rem;
  display: flex;
  align-items: center;
  gap: 0.75rem;
  box-shadow: 0 4px 12px rgba(102, 170, 234, 0.3);
}

.section-header i {
  font-size: 1.3rem;
}

/* =====================
   BUTTON MODERN
===================== */
.btn {
    border-radius: 8px !important;
    font-weight: 600;
    transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: 0.6rem 1.25rem;
    border: none;
    position: relative;
    overflow: hidden;
    font-size: 0.9rem;
    cursor: pointer;
    text-decoration: none;
}

.btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255,255,255,.2);
    transform: translate(-50%, -50%);
    transition: width .6s, height .6s;
}

.btn:hover::before {
    width: 300px;
    height: 300px;
}

.btn i {
    font-size: 1rem;
    transition: transform .3s ease;
}

.btn:hover i {
    transform: scale(1.1);
}

.btn-primary {
    background: linear-gradient(135deg, #66aaea 0%, #4ba2a0 100%) !important;
    box-shadow: 0 3px 10px rgba(102,170,234,.3);
    color: white !important;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102,170,234,.4);
    color: white !important;
}

.btn-warning {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
    color: white !important;
    box-shadow: 0 3px 10px rgba(245,158,11,.25);
}

.btn-warning:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(245,158,11,.35);
    color: white !important;
}

/* =====================
   FORM MODERN
===================== */
.form-horizontal {
    width: 100%;
}

.form-group {
    margin-bottom: 1.5rem;
    display: flex;
    align-items: flex-start;
}

.control-label {
    font-weight: 600;
    color: #4a5568;
    padding-top: 0.6rem;
    text-align: right;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 0.4rem;
}

.form-control {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    padding: .7rem 1rem;
    transition: all .3s ease;
    background: white;
    font-size: 0.9rem;
    width: 100%;
    display: block;
}

.form-control:focus {
    border-color: #66aaea;
    outline: none;
    box-shadow: 0 0 0 3px rgba(102,170,234,.12);
    background: #fafbfc;
}

select.form-control {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%234a5568' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    padding-right: 2.5rem;
}

/* =====================
   SECTION DIVIDERS
===================== */
hr {
    border: none;
    border-top: 2px solid #e2e8f0;
    margin: 2rem 0 1.5rem 0;
}

/* =====================
   FORM FOOTER
===================== */
.box-footer {
    background: #f8fafc;
    padding: 1.5rem 2rem;
    border-top: 2px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* =====================
   COLUMN LAYOUT
===================== */
.col-sm-2 {
    width: 16.666667%;
    padding-right: 15px;
}

.col-sm-4 {
    width: 33.333333%;
    padding-right: 15px;
}

.col-sm-5 {
    width: 41.666667%;
    padding-right: 15px;
}

.col-sm-10 {
    width: 83.333333%;
    padding-left: 15px;
}

.col-sm-1 {
    width: 8.333333%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-top: 0.6rem;
    color: #64748b;
    font-weight: 600;
}

/* =====================
   HELPER TEXT
===================== */
small {
    display: block;
    margin-top: 0.5rem;
    font-size: 0.8rem;
    font-style: italic;
}

.pull-right {
    float: right;
}

/* =====================
   ANIMATIONS
===================== */
@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.box {
    animation: slideInDown 0.5s ease-out;
}

/* =====================
   RESPONSIVE
===================== */
@media (max-width: 768px) {
    body {
        padding: 10px;
    }

    .form-group {
        flex-direction: column;
    }

    .col-sm-1,
    .col-sm-2,
    .col-sm-4,
    .col-sm-5,
    .col-sm-10 {
        width: 100%;
        padding: 0;
    }

    .control-label {
        text-align: left;
        justify-content: flex-start;
        margin-bottom: 0.5rem;
    }

    .box-body {
        padding: 1.5rem;
    }

    .box-footer {
        flex-direction: column;
        gap: 1rem;
    }

    .btn {
        width: 100%;
        justify-content: center;
    }
}

</style>
@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <a href="{{route('mutasi_keluar.index')}}" class="btn btn-warning"> <i class="fa fa-arrow-circle-left"></i>  Kembali</a> |
    Mutasi Keluar
    <!-- <small>Data barang</small> -->
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-8">


      <div class="box box-success">
        <form class="form-horizontal" role="form" action="{{route('mutasi_keluar.store')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          {{method_field('post')}}
          <div class="box-body" style="margin-left:20px;">


            <div class="form-group">
              <label for="jenjang_id" class="col-sm-2 control-label">Jenjang</label>

              <div class="col-sm-10">
                <select required name="jenjang_id" id="jenjang_id" class="form-control">
                  <option disabled selected value="">-- Pilih --</option>
                  <?php
                  foreach ($jenjang as $value) {
                    ?>
                    <option value="{{$value->jenjang_id}}" >{{$value->jenjang_nama}}</option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="section-header">
                <i class="fas fa-user-graduate"></i>
                IDENTITAS SISWA
            </div>

            <div class="form-group">
              <label for="mutasi_noinduk" class="col-sm-2 control-label">No. Induk</label>

              <div class="col-sm-10">
                <input type="text" required class="form-control" name="mutasi_noinduk" id="mutasi_noinduk" required placeholder="Nomor Induk">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_nisn" class="col-sm-2 control-label">NISN</label>

              <div class="col-sm-10">
                <input type="text" required class="form-control" name="mutasi_nisn" id="mutasi_nisn" placeholder="NISN">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_tingkat_kelas" class="col-sm-2 control-label">Tingkat Kelas</label>

              <div class="col-sm-10">
                <input type="text" required class="form-control" name="mutasi_tingkat_kelas" id="mutasi_tingkat_kelas" placeholder="Tingkat Kelas">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_nama_siswa" class="col-sm-2 control-label">Nama Siswa</label>

              <div class="col-sm-10">
                <input type="text" required class="form-control" name="mutasi_nama_siswa" id="mutasi_nama_siswa" placeholder="Nama Siswa">
              </div>
            </div>

            <div class="form-group">
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

            <div class="form-group">
              <label for="mutasi_nama_wali" class="col-sm-2 control-label">Nama Wali</label>

              <div class="col-sm-10">
                <input type="text" required class="form-control" name="mutasi_nama_wali" id="mutasi_nama_wali" placeholder="Nama Wali">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_alamat" class="col-sm-2 control-label">Alamat</label>

              <div class="col-sm-10">
                <input type="text" required class="form-control" name="mutasi_alamat" id="mutasi_alamat" placeholder="Alamat">
              </div>
            </div>

            <div class="section-header">
            <i class="fas fa-user-graduate"></i>
            SEKOLAH ASAL SISWA
            </div>

            <div class="form-group">
              <label for="kecamatan_id" class="col-sm-2 control-label">Kecamatan</label>

              <div class="col-sm-10">
                <select required name="kecamatan_id" id="kecamatan_id" class="form-control js-example-basic-single" style="width: 100%;">
                  <option disabled selected value="">-- Pilih --</option>
                  <?php
                  foreach ($kecamatan as $value) {
                    ?>
                    <option value="{{$value->kecamatan_id}}" >{{$value->kecamatan_nama}}</option>
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
              <select required id="sekolah_id" name="sekolah_id" class="form-control">
                <option value="" disabled selected>- Pilih Sekolahan -</option>
              </select>
              <small style="color:orange">Pilih jenjang dan kecamatan terlebih dahulu</small>

                <!-- <input type="text" class="form-control" name="mutasi_sekolah_tujuan_nama" id="mutasi_sekolah_tujuan_nama" placeholder=""> -->
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_sekolah_asal_no_surat" class="col-sm-2 control-label">Nomor Surat</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" required name="mutasi_sekolah_asal_no_surat" id="mutasi_sekolah_asal_no_surat" placeholder="Nomor Surat">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_tanggal_mutasi" class="col-sm-2 control-label">Tanggal Surat</label>

              <div class="col-sm-10">
                <input type="date" max="{{$hari_ini}}" class="form-control" required name="mutasi_tanggal_mutasi" id="mutasi_tanggal_mutasi" placeholder="">
              </div>
            </div>

            <div class="section-header">
            <i class="fas fa-user-graduate"></i>
            SEKOLAH TUJUAN SISWA
            </div>

            <div class="form-group">
              <label for="mutasi_sekolah_tujuan_nama" class="col-sm-2 control-label">Nama Sekolah</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" required name="mutasi_sekolah_tujuan_nama" id="mutasi_sekolah_tujuan_nama" placeholder="Nama Sekolah Tujuan">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_sekolah_tujuan_no_surat" class="col-sm-2 control-label">Nomor Surat</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" required name="mutasi_sekolah_tujuan_no_surat" id="mutasi_sekolah_tujuan_no_surat" placeholder="Nomor Surat">
              </div>
            </div>

            <div class="form-group">
              <label for="mutasi_tanggal_surat_diterima" class="col-sm-2 control-label">Tanggal Surat</label>

              <div class="col-sm-10">
                <input type="date" max="{{$hari_ini}}" class="form-control" required name="mutasi_tanggal_surat_diterima" id="mutasi_tanggal_surat_diterima" placeholder="">
              </div>
            </div>





          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <!-- <a href="{{route('mutasi_keluar.index')}}" class="btn btn-warning">Kembali</a> -->
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
