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
    <i class="fas fa-users"></i> Data Users
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
          <button onclick="addForm()" class="btn-modern btn-primary-modern">
            <i class="fa fa-plus"></i> Tambah
          </button>
        </div>

        <div class="table-responsiver">
          <table id="datatable1" class="table table-bordered table-striped" style="width:100%">
            <thead>
              <tr>
                <th style="width:8%">No</th>
                <th style="width:16%">Nama</th>
                <th style="width:16%">Group</th>
                <th style="width:16%">Email</th>
                <th style="width:16%">Username</th>
                <th style="width:16%">Password</th>
                <th style="width:15%">Aksi</th>
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
    language: {
      processing: '<i class="fa fa-spinner fa-spin"></i> Sedang memproses...',
      search: "Cari:",
      lengthMenu: "Tampilkan _MENU_",
      info: "Menampilkan _START_-_END_ dari _TOTAL_ data",
      infoFiltered: "(disaring dari _MAX_)",
      zeroRecords: "Tidak ada data yang ditemukan",
      emptyTable: "Tidak ada data tersedia",
      paginate: {
        first: '«',
        last: '»',
        next: '›',
        previous: '‹'
      }
    },
    "ajax" : {
      "url" : "{{ route('data_master_user') }}",
      "type" : "GET"
    }
  });

  // HAPUS .validator() - INI YANG BERMASALAH!
  $('#modal-form form').on('submit', function(e){
    e.preventDefault(); // Prevent default submit
    
    var id = $('#id').val();
    var url;
    
    // Validasi manual
    var password = $('#password').val();
    var confirm = $('#confirm_password').val();
    
    // Jika password diisi, harus sama dengan konfirmasi
    if(password !== '' || confirm !== '') {
      if(password !== confirm) {
        alert('Password dan konfirmasi password tidak sama!');
        return false;
      }
      if(password.length < 6) {
        alert('Password minimal 6 karakter!');
        return false;
      }
    }
    
    if(save_method == "add") {
      url = "{{ route('master_user.store') }}";
    } else {
      url = "{{ url('master_user') }}/" + id;
    }
    
    var formData = $(this).serialize();
    
    console.log('=== SUBMIT DEBUG ===');
    console.log('Method:', save_method);
    console.log('URL:', url);
    console.log('Form Data:', formData);
    
    $.ajax({
      url : url,
      type : "POST",
      data : formData,
      dataType: 'json',
      success : function(response){
        console.log('Success:', response);
        $('#modal-form').modal('hide');
        table.ajax.reload();
        alert(response.message || 'Data berhasil disimpan!');
      },
      error : function(xhr, status, error){
        console.log('=== ERROR DEBUG ===');
        console.log('Status:', xhr.status);
        console.log('Response:', xhr.responseText);
        console.log('Error:', error);
        
        var errorMessage = 'Tidak dapat menyimpan data!';
        
        if(xhr.responseJSON && xhr.responseJSON.errors) {
          errorMessage = '';
          $.each(xhr.responseJSON.errors, function(key, value) {
            errorMessage += value[0] + '\n';
          });
        } else if(xhr.responseJSON && xhr.responseJSON.message) {
          errorMessage = xhr.responseJSON.message;
        }
        
        alert(errorMessage);
      }
    });
    
    return false;
  });
});
function addForm(){
  save_method = "add";
  $('input[name=_method]').val('POST');
  $('#modal-form').modal('show');
  $('#modal-form form')[0].reset();
  $('.app-modal-title').text('Tambah Data Users');
  
  $('#password').prop('required', true);
  $('#confirm_password').prop('required', true);
  $('#message').html('');
  $('#submit').prop('disabled', false);
}

function editForm(id){
  save_method = "edit";
  $('input[name=_method]').val('PATCH');
  $('#modal-form form')[0].reset();
  
  $('#password').prop('required', false);
  $('#confirm_password').prop('required', false);
  $('#message').html('');
  $('#submit').prop('disabled', false);
  
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
      // Password dikosongkan saat edit
      $('#password').val('');
      $('#confirm_password').val('');
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

  // Validasi password hanya jika diisi
  $('#confirm_password, #password').on('keyup', function () {
    var pass = $('#password').val();
    var cpass = $('#confirm_password').val();
    
    // Jika password diisi
    if(pass !== '' || cpass !== '') {
      if (pass === cpass) {
        $('#message').html('Password cocok ✓').css('color', 'green');
        $('#submit').prop('disabled', false);
      } else {
        $('#message').html('Password tidak cocok ✗').css('color', 'red');
        $('#submit').prop('disabled', true);
      }
    } else {
      // Jika password kosong (edit tanpa ubah password)
      $('#message').html('');
      $('#submit').prop('disabled', false);
    }
  });
</script>

@endsection