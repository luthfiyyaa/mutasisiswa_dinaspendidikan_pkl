<div class="modal fade app-modal modal-slide-from-bottom" id="modal-form" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog app-modal-dialog">
    <div class="modal-content app-modal-content">
      
      <div class="app-modal-header">
        <h4 class="app-modal-title">
          <i class="fas fa-folder-plus"></i> Default Modal
        </h4>
        <button type="button" class="app-modal-close" data-dismiss="modal" aria-label="Close">×</button>
      </div>

      <form class="form-horizontal" data-toggle="validator" method="post" onsubmit="return validateForm()">
        {{ csrf_field() }} {{ method_field('POST') }}
        
        <div class="app-modal-body">
          <input type="hidden" id="id" name="id">

          <div class="app-form-group">
            <label for="name" class="app-form-label">
              <i class="fas fa-user"></i> Nama
            </label>
            <input type="text" class="app-form-control" required name="name" id="name" placeholder="Nama Users">
            <span class="app-form-error help-block with-errors"></span>
          </div>

          <div class="app-form-group">
            <label for="group_id" class="app-form-label">
              <i class="fas fa-users"></i> Group
            </label>
            <select id="group_id" required name="group_id" class="app-form-control js-example-basic-single" style="width: 100%;">
              @foreach($group as $list)
              <option value="{{ $list->group_id }}">{{ $list->group_nama }}</option>
              @endforeach
            </select>
            <span class="app-form-error help-block with-errors"></span>
          </div>

          <div class="app-form-group">
            <label for="users_email" class="app-form-label">
              <i class="fas fa-envelope"></i> Email
            </label>
            <input type="email" class="app-form-control" required name="users_email" id="users_email" placeholder="Email">
            <span class="app-form-error help-block with-errors"></span>
          </div>

          <div class="app-form-group">
            <label for="email" class="app-form-label">
              <i class="fas fa-user-circle"></i> Username
            </label>
            <input type="text" class="app-form-control" required name="email" id="email" placeholder="Username">
            <span class="app-form-error help-block with-errors"></span>
          </div>

          <div class="app-form-group">
            <label for="password" class="app-form-label">
              <i class="fas fa-lock"></i> Password
            </label>
            <input type="password" onchange="check_pass();" required class="app-form-control" name="password" id="password" placeholder="Isikan Password">
            <span class="app-form-error help-block with-errors"></span>
          </div>

          <div class="app-form-group">
            <label for="confirm_password" class="app-form-label">
              <i class="fas fa-lock"></i> Confirm Password
            </label>
            <input type="password" onchange="check_pass();" class="app-form-control" name="confirm_password" id="confirm_password" placeholder="Ulangi Password">
            <span id='message'></span>
          </div>

        </div>

        <div class="app-modal-footer">
          <button type="button" class="btn-modern btn-danger-modern" data-dismiss="modal">
            <i class="fa fa-arrow-circle-left"></i> Batal
          </button>
          <button type="submit" id="submit" class="btn-modern btn-secondary-modern btn-save">
            <i class="fa fa-floppy-o"></i> Simpan
          </button>
        </div>

      </form>

    </div>
  </div>
</div>