<div class="modal fade app-modal modal-slide-from-bottom" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog app-modal-dialog">
    <div class="modal-content app-modal-content">
      
      <div class="app-modal-header">
        <h4 class="app-modal-title">
          <i class="fas fa-folder-plus"></i> Default Modal
        </h4>
        <button type="button" class="app-modal-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <form class="form-horizontal" data-toggle="validator" method="post">
        {{ csrf_field() }} {{ method_field('POST') }}
        
        <div class="modal-body">
          <input type="hidden" id="id" name="id">

          <div class="app-form-group">
            <label for="group_nama" class="app-form-label">
              <i class="fas fa-users"></i> Nama Group
            </label>
            <input type="text" class="app-form-control" required name="group_nama" id="group_nama" placeholder="Example: Administrator">
            <span class="app-form-error help-block with-errors"></span>
          </div>

        </div>

        <div class="app-modal-footer">
          <button type="button" class="btn-modern btn-danger-modern" data-dismiss="modal">
            <i class="fa fa-arrow-circle-left"></i> Batal
          </button>
          <button type="submit" class="btn-modern btn-primary-modern btn-save">
            <i class="fa fa-floppy-o"></i> Simpan
          </button>
        </div>

      </form>

    </div>
  </div>
</div>