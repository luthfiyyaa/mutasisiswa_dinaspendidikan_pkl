<div class="modal fade app-modal" id="modal-form" tabindex="-1" data-backdrop="static">
  <div class="modal-dialog app-modal-dialog">
    <div class="modal-content app-modal-content">

      <div class="app-modal-header">
        <h4 class="app-modal-title">
          <i class="fas fa-folder-plus"></i>
          Jenjang
        </h4>
        <button type="button" class="app-modal-close" data-dismiss="modal">×</button>
      </div>
      
      <form class="form-horizontal" data-toggle="validator" method="post">
        {{ csrf_field() }} {{ method_field('POST') }}
        
        <div class="app-modal-body">
          <input type="hidden" id="id" name="id">

          <div class="app-form-group">
            <label class="app-form-label">
              <i class="fas fa-graduation-cap"></i>
              Nama Jenjang
            </label>
            <input 
              type="text" 
              class="app-form-control" 
              required 
              name="jenjang_nama" 
              id="jenjang_nama" 
              placeholder="Masukkan nama jenjang (SD, SMP, SMA, SMK)"
            >
            <span class="app-form-error help-block with-errors"></span>
          </div>

          <div class="app-form-group">
            <label class="app-form-label">
              <i class="fas fa-user-tie"></i>
              Pejabat
            </label>
            <select 
              required 
              id="pejabat_id" 
              name="pejabat_id" 
              class="app-form-control" 
              style="width: 100%;"
            >
              <option value="">-- Pilih Pejabat --</option>
              @foreach($pejabat as $list)
                <option value="{{ $list->pejabat_id }}">{{ $list->pejabat_nama }}</option>
              @endforeach
            </select>
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