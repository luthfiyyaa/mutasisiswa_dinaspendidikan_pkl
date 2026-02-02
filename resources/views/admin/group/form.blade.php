<div class="modal fade app-modal" id="modal-form" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog app-modal-dialog">
    <div class="modal-content app-modal-content">
      
      <div class="app-modal-header">
        <h4 class="app-modal-title">
          <i class="fas fa-folder-plus"></i>
          Group
        </h4>
        <button class="app-modal-close" data-dismiss="modal">×</button>
      </div>

      <form class="form-horizontal"  method="post">
        {{ csrf_field() }} {{ method_field('POST') }}

        <input type="hidden" name="group_id" id="id">
        
        <div class="app-modal-body">

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
          <button type="submit" class="btn-modern btn-secondary-modern">
            <i class="fa fa-save"></i> Simpan
          </button>
        </div>

      </form>

    </div>
  </div>
</div>