<?php $hal = "profil"; ?>
@extends('layouts.admin.master')
@section('title', 'Admin-Profil')

@section('css')
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="page-header-modern">
  <h1 class="page-title-modern">
    <i class="fas fa-user-edit"></i> Edit Profil
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="detail-card">
        <form class="form-horizontal" action="{{route('admin_user.store')}}" method="POST">
          {{ csrf_field() }}

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <div class="section-header">
            <i class="fas fa-user-circle"></i>
            INFORMASI AKUN
          </div>

          <div class="form-group-modern">
            <label for="name" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-smile-o"></i></span>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nama" value="{{$name}}">
              </div>
            </div>
          </div>

          <div class="form-group-modern">
            <label for="users_email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <div class="input-group">
                <span class="input-group-addon">@</span>
                <input type="email" class="form-control" name="users_email" id="users_email" placeholder="Email" value="{{$users_email}}">
              </div>
            </div>
          </div>

          <div class="form-group-modern">
            <label for="email" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="email" id="email" placeholder="Username" value="{{$email}}">
              </div>
            </div>
          </div>

          <div class="form-group-modern">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="password" id="password" placeholder="**********">
              </div>
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
@endsection