<?php $hal = "master_user"; ?>
@extends('layouts.admin.master')
@section('title', 'Master User')

@section('css')
<link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="page-header-modern">
  <h1 class="page-title-modern">
    <i class="fas fa-users"></i> Master Users
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="content-card">
        <div class="content-card-header">
          <h3 class="content-card-title">
            <i class="fas fa-table"></i> Data Master Users
          </h3>
        </div>

        <div class="btn-group-modern" style="margin-bottom: 20px; margin-left: 15px;">
          <button onclick="addForm()" class="btn-modern btn-primary-modern">
            <i class="fa fa-plus-square-o"></i> Tambah
          </button>
        </div>

        <div class="table-wrapper">
          <table id="datatable1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width:5%">No #</th>
                <th style="width:16%">Nama</th>
                <th style="width:16%">Group</th>
                <th style="width:16%">Email</th>
                <th style="width:16%">Username</th>
                <th style="width:16%">Password</th>
                <th style="width:15%">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>

      </div>

    </div>
  </div>
</section>

@include('admin.master_user.form')
@endsection

@section('js')
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<script type="text/javascript">
var table, save_method;
$(function(){
  table = $('.table').DataTable({
    "processing" : true,
    "ajax" : {
      "url" : "{{ route('data_master_user') }}",
      "type" : "GET"
    }
  });
  $('#modal-form form').validator().on('submit', function(e){
    if(!e.isDefaultPrevented()){
      var id = $('#id').val();
      if(save_method == "add") url = "{{ route('master_user.store') }}";
      else url = "master_user/"+id;
      $.ajax({
        url : url,
        type : "POST",
        data : $('#modal-form form').serialize(),
        success : function(data){
          $('#modal-form').modal('hide');
          table.ajax.reload();
        },
        error : function(){
          alert("Tidak dapat menyimpan data!");
        }
      });
      return false;
    }
  });
});
function addForm(){
  save_method = "add";
  $('input[name=_method]').val('POST');
  $('#modal-form').modal('show');
  $('#modal-form form')[0].reset();
  $('.app-modal-title').text('Tambah Data Users');
}
function editForm(id){
  save_method = "edit";
  $('input[name=_method]').val('PATCH');
  $('#modal-form form')[0].reset();
  $.ajax({
    url : "master_user/"+id+"/edit",
    type : "GET",
    dataType : "JSON",
    success : function(data){
      $('#modal-form').modal('show');
      $('.app-modal-title').text('Edit Data Users');
      $('#id').val(data.id);
      $('#group_id').val(data.group_id).trigger('change');
      $('#name').val(data.name);
      $('#email').val(data.email);
      $('#users_email').val(data.users_email);
    },
    error : function(){
      alert("Tidak dapat menampilkan data !!!");
    }
  });
}
function deleteData(id){
  if(confirm("Apakah yakin data akan dihapus?")){
    $.ajax({
      url : "master_user/"+id,
      type : "POST",
      data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
      success : function(data){
        table.ajax.reload();
      },
      error : function(){
        alert("Tidak dapat menghapus data!");
      }
    });
  }
}
</script>

<script>
$(function () {
  $('#example1').DataTable()
  $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
  })
})
</script>

<script>
  $(document).ready(function() {
    $('.js-example-basic-single').select2({
      dropdownParent: $(".modal")
    });
  });

  $('#confirm_password').on('keyup', function () {
    if ($('#password').val() == $('#confirm_password').val()) {
      $('#message').html('').css('color', 'green');
    } else {
      $('#message').html('Password tidak cocok').css('color', 'red');
    }
  });

  $('#confirm_password').keyup(function(){
    var pass = $('#password').val();
    var cpass = $('#confirm_password').val();
    if(pass != cpass){
      $('#submit').attr({disabled:true});
    } else {
      $('#submit').attr({disabled:false});
    }
  });
</script>

@endsection