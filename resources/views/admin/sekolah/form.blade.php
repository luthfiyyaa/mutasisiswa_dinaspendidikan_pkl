<div class="modal fade app-modal" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog app-modal-dialog">
    <div class="modal-content app-modal-content">
      <div class="app-modal-header">
        <h4 class="app-modal-title">
          <i class="fas fa-school"></i>
          Sekolah
        </h4>
        <button type="button" class="app-modal-close" data-dismiss="modal" aria-label="Close">×</button>
      </div>
      
      <form class="form-horizontal" method="post">
      {{ csrf_field() }} {{ method_field('POST') }} 
        
        <div class="app-modal-body">
          <input type="hidden" id="id" name="id">

          <div class="app-form-group">
            <label class="app-form-label">
              <i class="fas fa-school"></i>
              Nama Sekolah
            </label>
            <input 
              type="text" 
              class="app-form-control" 
              required 
              name="sekolah_nama" 
              id="sekolah_nama" 
              placeholder="Masukkan nama sekolah"
            >
            <span class="app-form-error help-block with-errors"></span>
          </div>

          <div class="app-form-group">
            <label class="app-form-label">
              <i class="fas fa-id-card"></i>
              NPSN
            </label>
            <input 
              type="text" 
              class="app-form-control" 
              required 
              name="sekolah_npsn" 
              id="sekolah_npsn" 
              placeholder="Masukkan NPSN"
            >
            <span class="app-form-error help-block with-errors"></span>
          </div>

          <div class="app-form-group">
            <label class="app-form-label">
              <i class="fas fa-graduation-cap"></i>
              Jenjang
            </label>
            <select 
              required 
              id="jenjang_id" 
              name="jenjang_id" 
              class="app-form-control" 
              style="width: 100%;"
            >
              <option value="">-- Pilih Jenjang --</option>
              @foreach($jenjang as $list)
                <option value="{{ $list->jenjang_id }}">{{ $list->jenjang_nama }}</option>
              @endforeach
            </select>
            <span class="app-form-error help-block with-errors"></span>
          </div>

          <div class="app-form-group">
            <label class="app-form-label">
              <i class="fas fa-map-marker-alt"></i>
              Kecamatan
            </label>
            <select 
              required 
              id="kecamatan_id" 
              name="kecamatan_id" 
              class="app-form-control" 
              style="width: 100%;"
            >
              <option value="">-- Pilih Kecamatan --</option>
              @foreach($kecamatan as $list2)
                <option value="{{ $list2->kecamatan_id }}">{{ $list2->kecamatan_nama }}</option>
              @endforeach
            </select>
            <span class="app-form-error help-block with-errors"></span>
          </div>

          <div class="app-form-group">
            <label class="app-form-label">
              <i class="fas fa-home"></i>
              Alamat
            </label>
            <input 
              type="text" 
              class="app-form-control" 
              required 
              name="sekolah_alamat" 
              id="sekolah_alamat" 
              placeholder="Masukkan alamat lengkap"
            >
            <span class="app-form-error help-block with-errors"></span>
          </div>

        </div>
        
        <div class="app-modal-footer">
          <button type="button" class="btn-modern btn-danger-modern" data-dismiss="modal">
            <i class="fa fa-times"></i>
            Batal
          </button>
          <button type="submit" class="btn-modern btn-primary-modern">
            <i class="fa fa-save"></i>
            Simpan Data
          </button>
        </div>
      </form>

    </div>
  </div>
</div>