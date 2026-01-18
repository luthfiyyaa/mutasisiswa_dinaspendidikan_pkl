<?php $hal = "laporan_mutasi_masuk"; ?>
@extends('layouts.admin.master')
@section('title', 'DINDIK | Laporan Mutasi Masuk')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
/* DataTables custom styling */
.dataTables_wrapper {
  padding: 1rem;
}

.dataTables_filter input {
  border-radius: 6px;
  border: 2px solid #e5e7eb;
  padding: 0.4rem 0.8rem;
  transition: all 0.3s ease;
  font-size: 0.875rem;
}

.dataTables_filter input:focus {
  border-color: #66aaea;
  outline: none;
  box-shadow: 0 0 0 3px rgba(102, 170, 234, 0.1);
}

.dataTables_length select {
  border-radius: 6px;
  border: 2px solid #e5e7eb;
  padding: 0.4rem 0.8rem;
  font-size: 0.875rem;
}

table.dataTable thead th {
  background: linear-gradient(135deg, #66aaea 0%, #4ba2a0 100%);
  color: white;
  font-weight: 600;
  border: none;
  padding: 0.65rem 0.75rem;
  font-size: 0.875rem;
}

table.dataTable tbody td {
  padding: 0.6rem 0.75rem;
  font-size: 0.85rem;
  vertical-align: middle;
}

table.dataTable tbody tr {
  transition: all 0.2s ease;
}

table.dataTable tbody tr:hover {
  background: rgba(102, 170, 234, 0.05);
}

.text-center {
  text-align: center;
}


/* Card styling sesuai dengan CSS */
.content-card {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  border-radius: 16px;
  padding: 1.25rem;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
  margin-bottom: 1.25rem;
}

.content-card-header {
  border-bottom: 2px solid #f3f4f6;
  padding-bottom: 0.75rem;
  margin-bottom: 1rem;
}

.content-card-title {
  font-size: 1.15rem;
  font-weight: 700;
  color: #1a202c;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.content-card-title i {
  color: #66aaea;
  font-size: 1.1rem;
}

/* Form styling */
.form-group-modern {
  margin-bottom: 0;
}

.form-label-modern {
  font-weight: 600;
  color: #4a5568;
  margin-bottom: 0.4rem;
  display: block;
  font-size: 0.825rem;
}

.form-label-modern i {
  font-size: 0.75rem;
  margin-right: 0.25rem;
}

.form-control-modern {
  width: 100%;
  padding: 0.55rem 0.85rem;
  border: 2px solid #e5e7eb;
  border-radius: 8px;
  font-size: 0.85rem;
  transition: all 0.3s ease;
  background: white;
}

.form-control-modern:focus {
  border-color: #66aaea;
  outline: none;
  box-shadow: 0 0 0 3px rgba(102, 170, 234, 0.1);
}

/* Button styling */
.btn-modern {
  padding: 0.6rem 1.25rem;
  border-radius: 8px;
  font-weight: 600;
  font-size: 0.85rem;
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  text-decoration: none;
}

.btn-modern i {
  font-size: 0.8rem;
}

.btn-primary-modern {
  background: linear-gradient(135deg, #66aaea 0%, #4ba2a0 100%);
  color: white;
  box-shadow: 0 3px 10px rgba(102, 170, 234, 0.3);
}

.btn-primary-modern:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 14px rgba(102, 170, 234, 0.4);
}

.btn-success-modern {
  background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
  color: white;
  box-shadow: 0 3px 10px rgba(16, 185, 129, 0.3);
}

.btn-success-modern:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 14px rgba(16, 185, 129, 0.4);
}

.btn-modern:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none;
}

.btn-group-modern {
  display: flex;
  gap: 0.75rem;
  margin-top: 1rem;
}

/* Action button in table */
.btn-action {
  padding: 0.4rem 0.8rem;
  font-size: 0.75rem;
  border-radius: 6px;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 0.35rem;
  text-decoration: none;
  font-weight: 600;
}

.btn-action i {
  font-size: 0.7rem;
}

.btn-info-action {
  background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
  color: white;
  box-shadow: 0 2px 6px rgba(59, 130, 246, 0.25);
}

.btn-info-action:hover {
  transform: translateY(-1px);
  box-shadow: 0 3px 8px rgba(59, 130, 246, 0.35);
}

/* Page header styling */
.page-header-modern {
  margin-bottom: 1.25rem;
}

.page-title-modern {
  font-size: 1.65rem;
  font-weight: 700;
  color: white;
  margin-bottom: 0.35rem;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.page-title-modern i {
  font-size: 1.5rem;
}

.page-subtitle-modern {
  color: rgba(255, 255, 255, 0.9);
  font-size: 0.9rem;
}

/* Filter section */
.filter-section {
  background: #f8fafc;
  padding: 1rem;
  border-radius: 10px;
  margin-bottom: 0;
}

/* Table wrapper */
.table-wrapper {
  background: white;
  border-radius: 10px;
  overflow: hidden;
}

/* Row spacing */
.row {
  margin-left: -0.5rem;
  margin-right: -0.5rem;
}

.row > [class*="col-"] {
  padding-left: 0.5rem;
  padding-right: 0.5rem;
  margin-bottom: 0.75rem;
}

/* Responsive */
@media (max-width: 768px) {
  .btn-group-modern {
    flex-direction: column;
  }
  
  .content-card {
    padding: 0.875rem;
  }
  
  .page-title-modern {
    font-size: 1.35rem;
  }
  
  table.dataTable tbody td {
    font-size: 0.8rem;
    padding: 0.5rem 0.6rem;
  }
  
  table.dataTable thead th {
    font-size: 0.8rem;
    padding: 0.55rem 0.6rem;
  }
}
</style>

@endsection


@section('content')
<!-- Page Header -->
<div class="page-header-modern">
  <h1 class="page-title-modern">
    <i class="fas fa-file-alt"></i>Laporan Mutasi Masuk
  </h1>
</div>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <!-- Filter Card -->
      <div class="content-card">
        <div class="content-card-header">
          <h3 class="content-card-title">
            <i class="fas fa-filter"></i>
            Filter Laporan
          </h3>
        </div>
        
        <div class="filter-section">
          <form id="filterForm">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group-modern">
                  <label class="form-label-modern">
                    <i class="far fa-calendar-alt"></i>Tanggal Awal
                  </label>
                  <input type="date" class="form-control-modern" name="tanggal_awal" id="tanggal_awal">
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="form-group-modern">
                  <label class="form-label-modern">
                    <i class="far fa-calendar-check"></i>Tanggal Akhir
                  </label>
                  <input type="date" class="form-control-modern" name="tanggal_akhir" id="tanggal_akhir">
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="form-group-modern">
                  <label class="form-label-modern">
                    <i class="fas fa-graduation-cap"></i>Jenjang
                  </label>
                  <select name="jenjang" id="jenjang" class="form-control-modern">
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

            <div class="btn-group-modern">
              <button type="submit" id="btnTampilkan" class="btn-modern btn-primary-modern">
                <i class="fa fa-search"></i>
                Tampilkan Data
              </button>
              <button type="button" id="btnCetak" class="btn-modern btn-success-modern" disabled>
                <i class="fa fa-print"></i>
                Cetak Laporan
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Data Table Card -->
      <div class="content-card">
        <div class="content-card-header">
          <h3 class="content-card-title">
            <i class="fas fa-table"></i>
            Data Mutasi Masuk
          </h3>
        </div>

        <div class="table-wrapper">
          <table id="datatable1" class="table table-bordered table-striped" style="width:100%">
            <thead>
              <tr>
                <th style="text-align:center;width:5%">No</th>
                <th style="width:22%">Nama</th>
                <th style="width:10%">No. Induk</th>
                <th style="width:10%">NISN</th>
                <th style="width:20%">Sekolah Asal</th>
                <th style="width:20%">Sekolah Tujuan</th>
                <th style="text-align:center;width:8%">Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection


@section('js')
<!-- DataTables -->
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script type="text/javascript">
var table, save_method, tanggal_awal, tanggal_akhir, jenjang, query;
$(function(){

  table = $('#datatable1').DataTable({
    searching: true,
    processing: true,
    oLanguage: {
        "sEmptyTable": "Tidak ada data"
      },
    language: {
      processing: "Sedang diproses..."
    },
    ajax: {
      url: '{{ route('data_laporan_mutasi_masuk') }}',
      type: 'GET',
      data: function(d){
      }
    },
    columns: [
      {data: null, render: (d,t,r,m) => m.row + 1, className: 'text-center' },
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

  $(document).on('submit','#filterForm',function (event) {
    event.preventDefault();

    tanggal_awal = $('#tanggal_awal').val();
    tanggal_akhir = $('#tanggal_akhir').val();
    jenjang = $('#jenjang').val();

    query = "";

    if (jenjang=="all"&&tanggal_awal==""&&tanggal_akhir=="") {
      query = "q1"; //tampilkan semua data
      table.ajax.url("{{ url('/data_laporan_mutasi_masuk_filter') }}/"+0+"/"+0+"/"+jenjang+"/"+query).load();
    }else if (tanggal_awal==""&&tanggal_akhir=="") {
      query = "q2"; //tampilkan berdasarkan jenjang
      table.ajax.url("{{ url('/data_laporan_mutasi_masuk_filter') }}/"+0+"/"+0+"/"+jenjang+"/"+query).load();
    }else if (jenjang=="all") {
      query = "q3"; //tampilkan berdasarkan tanggal awal dan tanggal akhir
      table.ajax.url("{{ url('/data_laporan_mutasi_masuk_filter') }}/"+tanggal_awal+"/"+tanggal_akhir+"/"+jenjang+"/"+query).load();
    }else {
      query = "q4"; //tampilkan berdasarkan semua filter
      table.ajax.url("{{ url('/data_laporan_mutasi_masuk_filter') }}/"+tanggal_awal+"/"+tanggal_akhir+"/"+jenjang+"/"+query).load();
    }

    document.getElementById("btnCetak").disabled = false;
  });

  $('#btnCetak').click(function (e) {
    e.preventDefault();

    tanggal_awal = $('#tanggal_awal').val();
    tanggal_akhir = $('#tanggal_akhir').val();
    jenjang = $('#jenjang').val();

    query = "";

    if (jenjang=="all"&&tanggal_awal==""&&tanggal_akhir=="") {
      query = "q1";
      window.open("{{url('laporan_mutasi_masuk_excel_file')}}/"+0+"/"+0+"/"+jenjang+"/"+query);
    }else if (tanggal_awal==""&&tanggal_akhir=="") {
      query = "q2";
      window.open("{{url('laporan_mutasi_masuk_excel_file')}}/"+0+"/"+0+"/"+jenjang+"/"+query);
    }else if (jenjang=="all") {
      query = "q3";
      window.open("{{url('laporan_mutasi_masuk_excel_file')}}/"+tanggal_awal+"/"+tanggal_akhir+"/"+jenjang+"/"+query);
    }else {
      query = "q4";
      window.open("{{url('laporan_mutasi_masuk_excel_file')}}/"+tanggal_awal+"/"+tanggal_akhir+"/"+jenjang+"/"+query);
    }
  });

});

</script>

@endsection