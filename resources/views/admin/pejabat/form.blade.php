<style>
/* Override modal default to prevent conflicts */
#modal-form.modal {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(4px);
}

#modal-form.modal.in {
  display: block !important;
}

#modal-form .modal-dialog {
  position: relative;
  width: auto;
  max-width: 550px;
  margin: 30px auto;
  animation: slideDown 0.3s ease;
}

@keyframes slideDown {
  from {
    transform: translateY(-50px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

#modal-form .modal-content {
  position: relative;
  background-color: #fff;
  border-radius: 16px;
  border: none;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
  outline: 0;
}

#modal-form .modal-header {
  background: linear-gradient(135deg, #66aaea 0%, #4ba2a0 100%);
  color: white;
  border-radius: 16px 16px 0 0;
  padding: 1rem 1.25rem;
  border: none;
  border-bottom: none;
}

#modal-form .modal-header .close {
  color: white;
  opacity: 0.8;
  text-shadow: none;
  font-size: 1.75rem;
  font-weight: 300;
  float: right;
  line-height: 1;
  margin-top: -2px;
}

#modal-form .modal-header .close:hover {
  opacity: 1;
  color: white;
}

#modal-form .modal-title {
  font-weight: 700;
  font-size: 1.1rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin: 0;
  line-height: 1.5;
}

#modal-form .modal-body {
  padding: 1.25rem;
  position: relative;
}

#modal-form .modal-footer {
  border-top: 2px solid #f3f4f6;
  padding: 1rem 1.25rem;
  background: #f8fafc;
  border-radius: 0 0 16px 16px;
}

/* Form styling */
#modal-form .form-group-modal {
  margin-bottom: 1.25rem;
}

#modal-form .form-label-modal {
  font-weight: 600;
  color: #4a5568;
  margin-bottom: 0.5rem;
  display: block;
  font-size: 0.875rem;
}

#modal-form .form-label-modal i {
  color: #66aaea;
  margin-right: 0.35rem;
  font-size: 0.85rem;
}

#modal-form .form-control-modal {
  width: 100%;
  padding: 0.65rem 1rem;
  border: 2px solid #e5e7eb;
  border-radius: 8px;
  font-size: 0.875rem;
  transition: all 0.3s ease;
  background: white;
  display: block;
  height: auto;
}

#modal-form .form-control-modal:focus {
  border-color: #66aaea;
  outline: none;
  box-shadow: 0 0 0 3px rgba(102, 170, 234, 0.1);
}

#modal-form .form-control-modal::placeholder {
  color: #a0aec0;
  font-size: 0.85rem;
}

/* Button modal styling */
#modal-form .btn-modal {
  padding: 0.6rem 1.25rem;
  border-radius: 8px;
  font-weight: 600;
  font-size: 0.875rem;
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
}

#modal-form .btn-modal i {
  font-size: 0.8rem;
}

#modal-form .btn-cancel-modal {
  background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
  color: white;
  box-shadow: 0 2px 8px rgba(107, 114, 128, 0.3);
}

#modal-form .btn-cancel-modal:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(107, 114, 128, 0.4);
  color: white;
}

#modal-form .btn-save-modal {
  background: linear-gradient(135deg, #66aaea 0%, #4ba2a0 100%);
  color: white;
  box-shadow: 0 2px 8px rgba(102, 170, 234, 0.3);
}

#modal-form .btn-save-modal:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(102, 170, 234, 0.4);
  color: white;
}

/* Help text */
#modal-form .help-block {
  font-size: 0.8rem;
  color: #ef4444;
  margin-top: 0.35rem;
  display: block;
}

/* Input group spacing */
#modal-form .input-group-modal {
  display: flex;
  flex-direction: column;
}

/* Responsive */
@media (max-width: 768px) {
  #modal-form .modal-dialog {
    margin: 10px;
  }
  
  #modal-form .modal-body {
    padding: 1rem;
  }
  
  #modal-form .form-control-modal {
    font-size: 0.85rem;
    padding: 0.6rem 0.875rem;
  }
}
</style>

<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">
          <i class="fas fa-user-tie"></i>
          Default Modal
        </h4>
      </div>
      
      <form class="form-horizontal" data-toggle="validator" method="post">
        {{ csrf_field() }} {{ method_field('POST') }}
        
        <div class="modal-body">
          <input type="hidden" id="id" name="id">

          <div class="form-group-modal">
            <label class="form-label-modal">
              <i class="fas fa-id-card"></i>
              NIP
            </label>
            <div class="input-group-modal">
              <input 
                type="text" 
                class="form-control-modal" 
                required 
                name="pejabat_nip" 
                id="pejabat_nip" 
                placeholder="Masukkan NIP pejabat"
              >
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group-modal">
            <label class="form-label-modal">
              <i class="fas fa-user"></i>
              Nama
            </label>
            <div class="input-group-modal">
              <input 
                type="text" 
                class="form-control-modal" 
                required 
                name="pejabat_nama" 
                id="pejabat_nama" 
                placeholder="Masukkan nama lengkap pejabat"
              >
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group-modal">
            <label class="form-label-modal">
              <i class="fas fa-medal"></i>
              Pangkat
            </label>
            <div class="input-group-modal">
              <input 
                type="text" 
                class="form-control-modal" 
                required 
                name="pejabat_pangkat" 
                id="pejabat_pangkat" 
                placeholder="Masukkan pangkat pejabat"
              >
              <span class="help-block with-errors"></span>
            </div>
          </div>

          <div class="form-group-modal">
            <label class="form-label-modal">
              <i class="fas fa-briefcase"></i>
              Jabatan
            </label>
            <div class="input-group-modal">
              <input 
                type="text" 
                class="form-control-modal" 
                required 
                name="pejabat_jabatan" 
                id="pejabat_jabatan" 
                placeholder="Masukkan jabatan pejabat"
              >
              <span class="help-block with-errors"></span>
            </div>
          </div>

        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn-modal btn-cancel-modal" data-dismiss="modal">
            <i class="fa fa-times"></i>
            Batal
          </button>
          <button type="submit" class="btn-modal btn-save-modal">
            <i class="fa fa-save"></i>
            Simpan Data
          </button>
        </div>
      </form>

    </div>
  </div>
</div>