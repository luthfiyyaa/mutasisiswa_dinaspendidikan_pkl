<?php $hal = "laporan_mutasi_masuk"; ?>
@extends('layouts.admin.master')
@section('title', 'DISDIKPORA | Detail Laporan Mutasi Masuk')

@section('css')
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
/* Detail Card Styling */
.detail-card {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  border-radius: 20px;
  padding: 2rem;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  margin-bottom: 2rem;
}

.detail-section {
  margin-bottom: 2rem;
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

.detail-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
}

.detail-table tr {
  transition: all 0.2s ease;
}

.detail-table tr:hover {
  background: rgba(102, 170, 234, 0.05);
}

.detail-table td {
  padding: 1rem;
  border-bottom: 1px solid #f3f4f6;
}

.detail-table td:first-child {
  font-weight: 600;
  color: #4a5568;
  width: 200px;
  vertical-align: top;
}

.detail-table td:nth-child(2) {
  width: 20px;
  color: #a0aec0;
  vertical-align: top;
}

.detail-table td:last-child {
  color: #2d3748;
}

/* Page Header */
.page-header-modern {
  margin-bottom: 2rem;
  display: flex;
  align-items: center;
  gap: 1rem;
}

.page-title-modern {
  font-size: 2rem;
  font-weight: 700;
  color: white;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  display: flex;
  align-items: center;
  gap: 1rem;
}

/* Back Button */
.btn-back-modern {
  padding: 0.75rem 1.5rem;
  border-radius: 10px;
  font-weight: 600;
  font-size: 0.95rem;
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  text-decoration: none;
  background: rgba(255, 255, 255, 0.95);
  color: #4ba2a0;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.btn-back-modern:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
  color: #66aaea;
  text-decoration: none;
}

.btn-back-modern i {
  font-size: 1.1rem;
}

/* Badge untuk highlight info penting */
.info-badge {
  display: inline-block;
  padding: 0.5rem 1rem;
  background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
  color: white;
  border-radius: 8px;
  font-weight: 600;
  font-size: 0.9rem;
  margin-top: 0.5rem;
  box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
}

/* Print Button */
.btn-print-modern {
  padding: 0.75rem 1.5rem;
  border-radius: 10px;
  font-weight: 600;
  font-size: 0.95rem;
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
  color: white;
  box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
  margin-left: auto;
}

.btn-print-modern:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(139, 92, 246, 0.4);
}

.action-buttons {
  display: flex;
  gap: 1rem;
  margin-bottom: 2rem;
}

/* Responsive */
@media (max-width: 768px) {
  .detail-table td:first-child {
    width: 120px;
    font-size: 0.9rem;
  }
  
  .detail-card {
    padding: 1rem;
  }
  
  .section-header {
    font-size: 1rem;
    padding: 0.875rem 1rem;
  }
  
  .page-title-modern {
    font-size: 1.5rem;
    flex-direction: column;
    align-items: flex-start;
  }

  .action-buttons {
    flex-direction: column;
  }
}

/* Animation untuk section */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.detail-section {
  animation: fadeInUp 0.5s ease;
}

.detail-section:nth-child(1) { animation-delay: 0.1s; }
.detail-section:nth-child(2) { animation-delay: 0.2s; }
.detail-section:nth-child(3) { animation-delay: 0.3s; }
</style>
@endsection


@section('content')
<!-- Page Header -->
<div class="page-header-modern">
  <h1 class="page-title-modern">
    <i class="fas fa-file-alt"></i>
    Detail Laporan Mutasi Masuk
  </h1>
</div>

<!-- Action Buttons -->
<div class="action-buttons">
  <a href="{{route('laporan_mutasi_masuk.index')}}" class="btn-back-modern">
    <i class="fas fa-arrow-left"></i>
    Kembali
  </a>
  <button class="btn-print-modern" onclick="window.print()">
    <i class="fas fa-print"></i>
    Cetak Detail
  </button>
</div>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">

      <div class="detail-card">
        @foreach($mutasi as $data)
        
        <!-- Identitas Siswa Section -->
        <div class="detail-section">
          <div class="section-header">
            <i class="fas fa-user-graduate"></i>
            IDENTITAS SISWA
          </div>
          <table class="detail-table">
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td><strong>{{$data->mutasi_nama_siswa}}</strong></td>
            </tr>
            <tr>
              <td>No. Induk</td>
              <td>:</td>
              <td>{{$data->mutasi_noinduk}}</td>
            </tr>
            <tr>
              <td>NISN</td>
              <td>:</td>
              <td>{{$data->mutasi_nisn}}</td>
            </tr>
            <tr>
              <td>Tingkat Kelas</td>
              <td>:</td>
              <td><span class="info-badge">{{$data->mutasi_tingkat_kelas}}</span></td>
            </tr>
            <tr>
              <td>Tempat/Tgl Lahir</td>
              <td>:</td>
              <td>{{$data->mutasi_tempat_lahir}} / {{ App\Helpers\TanggalIndonesia::format($data->mutasi_tanggal_lahir, false) }}</td>
            </tr>
            <tr>
              <td>Nama Wali</td>
              <td>:</td>
              <td>{{$data->mutasi_nama_wali}}</td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td>
              <td>{{$data->mutasi_alamat}}</td>
            </tr>
          </table>
        </div>

        <!-- Sekolah Asal Section -->
        <div class="detail-section">
          <div class="section-header">
            <i class="fas fa-school"></i>
            SEKOLAH ASAL SISWA
          </div>
          <table class="detail-table">
            <tr>
              <td>Nama Sekolah</td>
              <td>:</td>
              <td><strong>{{$data->mutasi_sekolah_asal_nama}}</strong></td>
            </tr>
            <tr>
              <td>Nomor Surat</td>
              <td>:</td>
              <td>{{$data->mutasi_sekolah_asal_no_surat}}</td>
            </tr>
            <tr>
              <td>Tanggal Surat</td>
              <td>:</td>
              <td>{{App\Helpers\TanggalIndonesia::format($data->mutasi_tanggal_mutasi, false)}}</td>
            </tr>
          </table>
        </div>

        <!-- Sekolah Tujuan Section -->
        <div class="detail-section">
          <div class="section-header">
            <i class="fas fa-building"></i>
            SEKOLAH TUJUAN SISWA
          </div>
          <table class="detail-table">
            <tr>
              <td>Nama Sekolah</td>
              <td>:</td>
              <td><strong>{{$data->mutasi_sekolah_tujuan_nama}}</strong></td>
            </tr>
            <tr>
              <td>Nomor Surat</td>
              <td>:</td>
              <td>{{$data->mutasi_sekolah_tujuan_no_surat}}</td>
            </tr>
            <tr>
              <td>Tanggal Surat</td>
              <td>:</td>
              <td>{{App\Helpers\TanggalIndonesia::format($data->mutasi_tanggal_surat_diterima,false)}}</td>
            </tr>
          </table>
        </div>

        @endforeach
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
  // Smooth scroll animation
  $('html, body').animate({
    scrollTop: 0
  }, 300);
});
</script>

@endsection