<?php $hal = "profil"; ?>
@extends('layouts.admin.master')
@section('title', 'Admin-Profil')

@section('css')
<style>
.alert-simple {
  padding: 12px 20px;
  margin-bottom: 20px;
  border-radius: 6px;
  display: flex;
  align-items: center;
  gap: 10px;
  position: relative;
  animation: slideDown 0.3s ease;
}

.alert-danger-simple {
  background-color: #fee;
  border-left: 4px solid #dc3545;
  color: #721c24;
}

.alert-success-simple {
  background-color: #d4edda;
  border-left: 4px solid #28a745;
  color: #155724;
}

.alert-simple i {
  font-size: 18px;
}

.alert-simple span {
  flex: 1;
  font-size: 14px;
}

.close-simple {
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
  opacity: 0.6;
  transition: opacity 0.2s;
  padding: 0;
  line-height: 1;
}

.close-simple:hover {
  opacity: 1;
}

@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
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

      @if (session('error'))
      <div class="alert-simple alert-danger-simple">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ session('error') }}</span>
        <button type="button" class="close-simple" onclick="this.parentElement.remove()">×</button>
      </div>
      @endif

      @if (session('success'))
      <div class="alert-simple alert-success-simple">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
        <button type="button" class="close-simple" onclick="this.parentElement.remove()">×</button>
      </div>
      @endif

          <div class="section-header">
            <i class="fas fa-user-circle"></i>
            INFORMASI AKUN
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name" placeholder="Nama" value="{{$name}}">
            </div>
          </div>

          <div class="form-group">
            <label for="users_email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="users_email" id="users_email" placeholder="Email" value="{{$users_email}}">
            </div>
          </div>

          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" id="email" placeholder="Username" value="{{$email}}">
            </div>
          </div>

          <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password" id="password" placeholder="**********">
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