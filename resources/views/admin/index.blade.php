<?php $hal = "index"; ?>
@extends('layouts.admin.master')

@section('title','DINDIK - Dashboard')

@section('content')
<div class="page-header">
    <h1 class="page-title">Dashboard Beranda</h1>
    <p class="page-subtitle">Selamat datang di sistem informasi DISDIKPORA</p>
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
@endsection
