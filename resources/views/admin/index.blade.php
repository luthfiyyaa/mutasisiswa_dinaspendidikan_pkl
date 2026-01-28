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

<!-- Statistik per Bidang -->
<div style="margin-bottom: 2rem;">
    <h2 class="page-title-modern" style="margin-bottom: 1rem">
        <i class="fas fa-chart-pie"></i> Statistik Data Mutasi per Bidang
    </h2>
    
    <div class="stats-grid">
        @foreach($statistik_bidang as $key => $bidang)
        <div class="stat-card {{ $key == 'paud' ? 'blue' : ($key == 'sd' ? 'green' : 'blue') }}" 
             style="--card-color: {{ $key == 'paud' ? '#3b82f6' : ($key == 'sd' ? '#10b981' : '#06b6d4') }}; 
                    --card-color-light: {{ $key == 'paud' ? '#60a5fa' : ($key == 'sd' ? '#34d399' : '#22d3ee') }};">
            <div class="stat-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="stat-value">{{ $bidang['total'] }}</div>
            <div class="stat-label">Bidang {{ $bidang['nama'] }}</div>
            
            <div style="margin: 1rem 0; padding: 0.75rem; background: #f8fafc; border-radius: 10px;">
                <div style="font-size: 0.8rem; color: #64748b; margin-bottom: 0.5rem;">
                    <i class="fas fa-school"></i> {{ $bidang['jenjang'] }}
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-top: 0.75rem;">
                    <div>
                        <div style="font-size: 0.75rem; color: #64748b; margin-bottom: 0.25rem;">Masuk</div>
                        <div style="font-size: 1.25rem; font-weight: 700; color: #10b981;">
                            <i class="fas fa-arrow-down" style="font-size: 0.9rem;"></i> {{ $bidang['mutasi_masuk'] }}
                        </div>
                    </div>
                    <div>
                        <div style="font-size: 0.75rem; color: #64748b; margin-bottom: 0.25rem;">Keluar</div>
                        <div style="font-size: 1.25rem; font-weight: 700; color: #f59e0b;">
                            <i class="fas fa-arrow-up" style="font-size: 0.9rem;"></i> {{ $bidang['mutasi_keluar'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Card untuk Grafik Mutasi per Kecamatan -->
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <h2 class="page-title-modern" style="margin-bottom: 1rem"><i class="fa-solid fa-chart-column"></i> Statistik Data Mutasi per Kecamatan</h2>
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
                        backgroundColor: 'rgba(59, 130, 246, 0.8)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1,
                        barPercentage: 0.8,
                        categoryPercentage: 0.9
                    },
                    {
                        label: 'jumlah mutasi keluar',
                        data: @json($kecamatan_data['keluar']),
                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                        borderColor: 'rgba(16, 185, 129, 1)',
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

