<div class="modal fade app-modal modal-slide-from-bottom" id="modal-form" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog app-modal-dialog">
    <div class="modal-content app-modal-content">
      
      <div class="app-modal-header">
        <h4 class="app-modal-title">
          <i class="fas fa-folder-plus"></i> Default Modal
        </h4>
        <button type="button" class="app-modal-close" data-dismiss="modal" aria-label="Close">×</button>
      </div>

      <form class="form-horizontal" data-toggle="validator" method="post">
        {{ csrf_field() }} {{ method_field('POST') }}
        
        <div class="app-modal-body">
          <input type="hidden" id="id" name="id">

          <div class="app-form-group">
            <label for="menu_id_parent" class="app-form-label">
              <i class="fas fa-sitemap"></i> Parent
            </label>
            <select id="menu_id_parent" name="menu_id_parent" class="app-form-control js-example-basic-single" style="width: 100%;">
              <option value="0">--</option>
              @foreach($menu as $list)
                <option value="{{ $list->menu_id }}">{{ $list->menu_nama }}</option>
              @endforeach
            </select>
          </div>

          <div class="app-form-group">
            <label for="menu_nama" class="app-form-label">
              <i class="fas fa-bars"></i> Nama Menu
            </label>
            <input type="text" class="app-form-control" required name="menu_nama" id="menu_nama" placeholder="Nama Menu">
            <span class="app-form-error help-block with-errors"></span>
          </div>

          <div class="app-form-group">
            <label for="menu_link" class="app-form-label">
              <i class="fas fa-link"></i> Link
            </label>
            <input type="text" class="app-form-control" required name="menu_link" id="menu_link" placeholder="Nama Link">
            <span class="app-form-error help-block with-errors"></span>
          </div>

        </div>

        <div class="app-modal-footer">
          <button type="button" class="btn-modern btn-danger-modern" data-dismiss="modal">
            <i class="fa fa-arrow-circle-left"></i> Batal
          </button>
          <button type="submit" class="btn-modern btn-secondary-modern btn-save">
            <i class="fa fa-floppy-o"></i> Simpan
          </button>
        </div>

      </form>

    </div>
  </div>
</div>