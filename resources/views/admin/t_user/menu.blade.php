<?php $hal = "group";
use App\TUserModel;?>
@extends('layouts.admin.master')
@section('title', 'DINDIK | Manajemen Role')

@section('css')
<style>
.example-modal .modal {
  position: relative;
  top: auto;
  bottom: auto;
  right: auto;
  left: auto;
  display: block;
  z-index: 1;
  background: transparent !important;
}

/* Menu Permission List Styling */
.menu-permission-list {
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
}

.menu-item {
  border-bottom: 1px solid #f0f0f0;
  transition: all 0.2s ease;
}

.menu-item:last-child {
  border-bottom: none;
}

.menu-item:hover {
  background: rgba(102, 170, 234, 0.05);
}

.menu-item-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem 1.25rem;
  gap: 1rem;
}

/* Parent menu (level 1) */
.menu-item.level-1 .menu-item-content {
  background: linear-gradient(90deg, rgba(102, 170, 234, 0.08) 0%, transparent 100%);
  font-weight: 600;
  color: #2d3748;
  font-size: 1rem;
}

/* Child menu (level 2) */
.menu-item.level-2 .menu-item-content {
  padding-left: 2.5rem;
  color: #4a5568;
  font-size: 0.95rem;
}

/* Menu label */
.menu-label {
  flex: 1;
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.menu-number {
  font-weight: 700;
  color: #66aaea;
  min-width: 35px;
  font-size: 0.9rem;
}

.menu-name {
  flex: 1;
}

/* Checkbox wrapper */
.menu-checkbox-wrapper {
  display: flex;
  align-items: center;
}

/* Custom Checkbox */
.custom-checkbox {
  position: relative;
  display: inline-block;
  width: 22px;
  height: 22px;
  cursor: pointer;
}

.custom-checkbox input[type="checkbox"] {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  width: 100%;
  height: 100%;
  z-index: 2;
}

.checkbox-visual {
  position: absolute;
  top: 0;
  left: 0;
  width: 22px;
  height: 22px;
  background: #fff;
  border: 2px solid #cbd5e1;
  border-radius: 6px;
  transition: all 0.3s ease;
}

.custom-checkbox:hover .checkbox-visual {
  border-color: #66aaea;
  box-shadow: 0 0 0 3px rgba(102, 170, 234, 0.1);
}

.custom-checkbox input[type="checkbox"]:checked ~ .checkbox-visual {
  background: linear-gradient(135deg, #66aaea 0%, #4ba2a0 100%);
  border-color: #66aaea;
}

.checkbox-visual::after {
  content: "";
  position: absolute;
  display: none;
  left: 6px;
  top: 2px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
}

.custom-checkbox input[type="checkbox"]:checked ~ .checkbox-visual::after {
  display: block;
}

/* Responsive */
@media (max-width: 768px) {
  .menu-item-content {
    padding: 0.875rem 1rem;
  }
  
  .menu-item.level-2 .menu-item-content {
    padding-left: 2rem;
  }
  
  .menu-number {
    min-width: 30px;
    font-size: 0.85rem;
  }
  
  .menu-name {
    font-size: 0.9rem;
  }
}

@media (max-width: 480px) {
  .menu-item-content {
    padding: 0.75rem 0.875rem;
  }
  
  .menu-item.level-2 .menu-item-content {
    padding-left: 1.5rem;
  }
  
  .menu-label {
    gap: 0.5rem;
  }
  
  .menu-number {
    min-width: 25px;
    font-size: 0.8rem;
  }
  
  .menu-name {
    font-size: 0.85rem;
  }
}
</style>
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header-modern">
  <a href="{{route('group.index')}}" class="btn-modern btn-warning-modern">
    <i class="fa fa-arrow-circle-left"></i> Kembali
  </a>
  <h1 class="page-title-modern">Menu Group</h1>
</section>

<!-- Main Content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="detail-card">
        <h3 class="section-header">
          <i class="fa fa-cog"></i> {{$nama_group}}
        </h3>
      
        <div class="detail-table">
          <!-- Alert Success -->
          <?php if (session('error') == 1) { ?>
            <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              Success : <strong class="d-block d-sm-inline-block-force">Data berhasil dirubah!</strong>
            </div>
          <?php } ?>

          <div class="row">
            <div class="col-md-12">
              <!-- Form Start -->
              <form class="form-horizontal" action="{{ route('t_user.store') }}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="group_id" value="{{$id}}">
                
                <div class="box-body">
                  <div class="menu-permission-list">
                    <?php $count = 1; ?>
                    @foreach($menu2 as $data)
                      <?php $no=1; ?>

                      <!-- Menu Parent -->
                      <div class="menu-item level-1">
                        <div class="menu-item-content">
                          <div class="menu-label">
                            <span class="menu-number">{{$count}}.</span>
                            <span class="menu-name">{{$data->menu_nama}}</span>
                          </div>
                          <div class="menu-checkbox-wrapper">
                            <label class="custom-checkbox">
                              <?php
                                $t_user_id = App\Models\TUserModel::where([
                                  ['menu_id', '=', $data->menu_id],
                                  ['group_id', '=', $id],
                                ])->value('t_user_id');
                                $menu_id = App\Models\TUserModel::where('t_user_id','=',$t_user_id)->value('menu_id');
                              ?>
                              <input type="checkbox" name='menu_id[]' value="{{$data->menu_id}}" 
                                <?php if(($data->menu_id==$menu_id)) { ?> checked="checked" <?php } ?>>
                              <span class="checkbox-visual"></span>
                            </label>
                          </div>
                        </div>
                      </div>

                      <!-- Menu Children -->
                      @foreach(App\Models\MenuModel::where('menu_id_parent', '=', $data->menu_id)->get() as $menuItem)
                        <div class="menu-item level-2">
                          <div class="menu-item-content">
                            <div class="menu-label">
                              <span class="menu-number">{{$count}}.{{$no}}.</span>
                              <span class="menu-name">{{$menuItem->menu_nama}}</span>
                            </div>
                            <div class="menu-checkbox-wrapper">
                              <label class="custom-checkbox">
                                <?php
                                  $t_user_id = App\Models\TUserModel::where([
                                    ['menu_id', '=', $menuItem->menu_id],
                                    ['group_id', '=', $id],
                                  ])->value('t_user_id');
                                  $menu_id = App\Models\TUserModel::where('t_user_id','=',$t_user_id)->value('menu_id');
                                ?>
                                <input type="checkbox" name='menu_id[]' value="{{$menuItem->menu_id}}" 
                                  <?php if(($menuItem->menu_id==$menu_id)) { ?> checked="checked" <?php } ?>>
                                <span class="checkbox-visual"></span>
                              </label>
                            </div>
                          </div>
                        </div>
                        <?php $no++ ?>
                      @endforeach
                      
                      <?php $count++ ?>
                    @endforeach
                  </div>
                </div>
                <!-- /.box-body -->
                
                <div class="form-footer">
                  <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="fa fa-floppy-o"></i> Simpan
                  </button>
                </div>
              </form>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.detail-table -->
      </div>
      <!-- /.detail-card -->
    </div>
  </div>
</section>
<!-- /.content -->
@endsection

@section('js')
<!-- DataTables -->
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('admin/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

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
  });
});

$(".alert").delay(4000).slideUp(200, function() {
  $(this).alert('close');
});
</script>
@endsection