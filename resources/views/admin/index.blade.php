<?php $hal = "index"; ?>
@extends('layouts.admin.master')

@section('title','DINDIK - Dashboard')

@section('content')
<div class="page-header">
    <h1 class="page-title">Dashboard Beranda</h1>
    <p class="page-subtitle">Selamat datang di website mutasi Dinas Pendidikan Kabupaten Trenggalek</p>
</div>

<div class="stats-grid">
    <div class="stat-card blue">
        <div class="stat-icon">
            <i class="fas fa-sign-in-alt"></i>
        </div>
        <div class="stat-value">{{ $mutasi_masuk }}</div>
        <div class="stat-label">Total Mutasi Masuk</div>
        <div class="stat-footer">
            <a href="{{ route('laporan_mutasi_masuk.index') }}" class="stat-link">
                Info selengkapnya
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="stat-card green">
        <div class="stat-icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>
        <div class="stat-value">{{ $mutasi_keluar }}</div>
        <div class="stat-label">Total Mutasi Keluar</div>
        <div class="stat-footer">
            <a href="{{ route('laporan_mutasi_keluar.index') }}" class="stat-link">
                Info selengkapnya
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Card untuk Grafik Mutasi per Kecamatan -->
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="stat-card">
                <div class="card-body">
                    <div style="position: relative; height:500px; width: 100%;">
                        <canvas id="mutasiKecamatanChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Debug: cek data dari controller
    console.log('Data Kecamatan:', {
        labels: @json($kecamatan_data['labels']),
        masuk: @json($kecamatan_data['masuk']),
        keluar: @json($kecamatan_data['keluar'])
    });

    // Grafik Mutasi per Kecamatan
    const ctxKecamatan = document.getElementById('mutasiKecamatanChart');
    
    if (ctxKecamatan) {
        new Chart(ctxKecamatan, {
            type: 'bar',
            data: {
                labels: @json($kecamatan_data['labels']),
                datasets: [
                    {
                        label: 'jumlah mutasi masuk',
                        data: @json($kecamatan_data['masuk']),
                        backgroundColor: 'rgba(68, 114, 196, 0.8)',
                        borderColor: 'rgba(68, 114, 196, 1)',
                        borderWidth: 1,
                        barPercentage: 0.8,
                        categoryPercentage: 0.9
                    },
                    {
                        label: 'jumlah mutasi keluar',
                        data: @json($kecamatan_data['keluar']),
                        backgroundColor: 'rgba(237, 125, 49, 0.8)',
                        borderColor: 'rgba(237, 125, 49, 1)',
                        borderWidth: 1,
                        barPercentage: 0.8,
                        categoryPercentage: 0.9
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10,
                            precision: 0,
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            maxRotation: 45,
                            minRotation: 45,
                            font: {
                                size: 10
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Statistik Data Mutasi Berdasarkan Kecamatan',
                        font: {
                            size: 16,
                            weight: 'bold'
                        },
                        padding: {
                            top: 10,
                            bottom: 20
                        }
                    },
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            usePointStyle: false,
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: {
                            size: 13
                        },
                        bodyFont: {
                            size: 12
                        },
                        padding: 10,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' siswa';
                            }
                        }
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false
                }
            }
        });
        
        console.log('Chart berhasil dibuat!');
    } else {
        console.error('Element canvas tidak ditemukan!');
    }
});
</script>
@endsection

