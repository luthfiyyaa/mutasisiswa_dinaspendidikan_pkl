<style>

</style>

<div class="modal fade app-modal" id="modal-form" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog app-modal-dialog">
    <div class="modal-content app-modal-content">

      <div class="app-modal-header">
        <h4 class="app-modal-title">
          <i class="fas fa-folder-plus"></i>
          Kecamatan
        </h4>
        <button class="app-modal-close" data-dismiss="modal">×</button>
      </div>

      <form method="post">
        <div class="app-modal-body">

          <div class="app-form-group">
            <label class="app-form-label">
              <i class="fas fa-code"></i>
              Kode Wilayah
            </label>
            <input
              type="text"
              class="app-form-control"
              placeholder="Masukkan kode wilayah kecamatan"
              required
            >
            <span class="app-form-error"></span>
          </div>

          <div class="app-form-group">
            <label class="app-form-label">
              <i class="fas fa-map-marker-alt"></i>
              Nama Kecamatan
            </label>
            <input
              type="text"
              class="app-form-control"
              placeholder="Masukkan nama kecamatan"
              required
            >
            <span class="app-form-error"></span>
          </div>

        </div>

        <div class="app-modal-footer">
          <button type="button" class="app-btn app-btn-secondary" data-dismiss="modal">
            <i class="fa fa-times"></i> Batal
          </button>
          <button type="submit" class="app-btn app-btn-primary">
            <i class="fa fa-save"></i> Simpan Data
          </button>
        </div>
      </form>

    </div>
  </div>
</div>
