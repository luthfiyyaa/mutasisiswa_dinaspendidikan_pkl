<?php $hal = "profil"; ?>
@extends('layouts.admin.master')
@section('title', 'Admin-Profil')

@section('css')
@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Edit Profil
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{route('admin_user.store')}}" method="POST">
          {{ csrf_field() }}

          @if ($errors->any())
          <div class="alert alert-danger"><ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul></div>
          @endif

          <div class="box-body">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>

              <div class="input-group col-sm-9">
                <span class="input-group-addon"><i class="fa  fa-smile-o"></i></span>
                <input type="text" class="form-control" name="name" placeholder="Nama" value="{{$name}}">
              </div>
            </div>

            <div class="form-group">
              <label for="users_email" class="col-sm-2 control-label">Email</label>

              <div class="input-group col-sm-9">
                <span class="input-group-addon">@</span>
                <input type="email" class="form-control" name="users_email" placeholder="users_email" value="{{$users_email}}">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

              <div class="input-group col-sm-9">
                <span class="input-group-addon"><i class="fa  fa-user"></i></span>
                <input type="text" class="form-control" name="email" placeholder="Email" value="{{$email}}">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

              <div class="input-group col-sm-9">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="password" placeholder="**********">
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right">SIMPAN</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.box -->


    </div>
    <!--/.col (left) -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@endsection


@section('js')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> -->
<script src="{{ asset('public/js/sweetalert.min.js') }}"></script>
@include('sweet::alert')
@endsection
