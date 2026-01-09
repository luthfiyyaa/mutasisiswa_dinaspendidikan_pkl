<div class="modal fade modal-slide-from-bottom" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Default Modal</h4>
        </div>
        <form class="form-horizontal" data-toggle="validator" method="post">
          {{ csrf_field() }} {{ method_field('POST') }}
          <div class="modal-body">
            <input type="hidden" id="id" name="id">

            <div class="box-body" style="padding-left:30px !important;padding-right:30px !important;">

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Kode Kecamatan</label>

                <div class="input-group col-sm-8">
                  <!-- <span class="input-group-addon"><i class="fa  fa-user"></i></span> -->
                  <input type="text" class="form-control" required name="kecamatan_kode_wilayah" id="kecamatan_kode_wilayah" placeholder="Kode Kecamatan" >
                  <span class="help-block with-errors"></span>
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nama Kecamatan</label>

                <div class="input-group col-sm-8">
                  <!-- <span class="input-group-addon"><i class="fa  fa-user"></i></span> -->
                  <input type="text" class="form-control" required name="kecamatan_nama" id="kecamatan_nama" placeholder="Nama Kecamatan" >
                  <span class="help-block with-errors"></span>
                </div>
              </div>
              <!-- /.form-group -->

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning pull-left" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
            <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o"></i> Simpan </button>
          </div>
        </div>

      </form>

      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
