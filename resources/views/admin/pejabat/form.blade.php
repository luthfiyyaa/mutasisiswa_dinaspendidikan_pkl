<div class="modal fade app-modal" id="modal-form" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog app-modal-dialog">
    <div class="modal-content app-modal-content">
      <div class="app-modal-header">
        <h4 class="app-modal-title">
          <i class="fas fa-user-tie"></i>
          Pejabat
        </h4>
        <button type="button" class="app-modal-close" data-dismiss="modal" aria-label="Close">×</button>
      </div>
      
      <form class="form-horizontal"  method="post">
        {{ csrf_field() }} {{ method_field('POST') }}
        
        <div class="app-modal-body">
          <input type="hidden" id="id" name="id">

          <div class="app-form-group">
            <label class="app-form-label">
              <i class="fas fa-id-card"></i>
              NIP
            </label>
            <input 
              type="text" 
              class="app-form-control" 
              required 
              name="pejabat_nip" 
              id="pejabat_nip" 
              placeholder="Masukkan NIP pejabat"
            >
            <span class="app-form-error help-block with-errors"></span>
          </div>

          <div class="app-form-group">
            <label class="app-form-label">
              <i class="fas fa-user"></i>
              Nama
            </label>
            <input 
              type="text" 
              class="app-form-control" 
              required 
              name="pejabat_nama" 
              id="pejabat_nama" 
              placeholder="Masukkan nama lengkap pejabat"
            >
            <span class="app-form-error help-block with-errors"></span>
          </div>

          <div class="app-form-group">
            <label class="app-form-label">
              <i class="fas fa-medal"></i>
              Pangkat
            </label>
            <input 
              type="text" 
              class="app-form-control" 
              required 
              name="pejabat_pangkat" 
              id="pejabat_pangkat" 
              placeholder="Masukkan pangkat pejabat"
            >
            <span class="app-form-error help-block with-errors"></span>
          </div>

          <div class="app-form-group">
            <label class="app-form-label">
              <i class="fas fa-briefcase"></i>
              Jabatan
            </label>
            <input 
              type="text" 
              class="app-form-control" 
              required 
              name="pejabat_jabatan" 
              id="pejabat_jabatan" 
              placeholder="Masukkan jabatan pejabat"
            >
            <span class="app-form-error help-block with-errors"></span>
          </div>

        </div>
        
        <div class="app-modal-footer">
          <button type="button" class="btn-modern btn-danger-modern" data-dismiss="modal">
            <i class="fa fa-times"></i>
            Batal
          </button>
          <button type="submit" class="btn-modern btn-secondary-modern">
            <i class="fa fa-save"></i>
            Simpan Data
          </button>
        </div>
      </form>

    </div>
  </div>
</div>