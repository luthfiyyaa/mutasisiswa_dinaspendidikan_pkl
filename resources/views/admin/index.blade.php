<?php $hal = "index"; ?>
@extends('layouts.admin.master')
@section('title', 'DISDIKPORA - Beranda')

@section('css')
@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Beranda
    <!-- <small>it all starts here</small> -->
  </h1>
</section>
<!-- Main content -->
<section class="content">


  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$mutasi_masuk}}</h3>

          <p>Total Mutasi Masuk</p>
        </div>
        <div class="icon">
          <i class="fa fa-indent"></i>
        </div>
        <!--<a href="{{route('laporan_mutasi_masuk.index')}}" class="small-box-footer">Info selengkapnya <i class="fa fa-arrow-circle-right"></i></a>-->
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$mutasi_keluar}}</h3>

          <p>Total Mutasi Keluar</p>
        </div>
        <div class="icon">
          <i class="fa fa-outdent"></i>
        </div>
        <!--<a href="{{route('laporan_mutasi_keluar.index')}}" class="small-box-footer">Info selengkapnya <i class="fa fa-arrow-circle-right"></i></a>-->
      </div>
    </div>
    <!-- ./col -->

  </div>

  <!-- /.content -->
  @endsection


  @section('js')
  @endsection
