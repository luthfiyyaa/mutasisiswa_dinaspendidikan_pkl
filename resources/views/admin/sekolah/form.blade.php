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
                <label for="inputEmail3" class="col-sm-2 control-label">Nama Sekolah</label>

                <div class="input-group col-sm-8">
                  <!-- <span class="input-group-addon"><i class="fa  fa-user"></i></span> -->
                  <input type="text" class="form-control" required name="sekolah_nama" id="sekolah_nama" placeholder="Nama Sekolah" >
                  <span class="help-block with-errors"></span>
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">NPSN</label>

                <div class="input-group col-sm-8">
                  <!-- <span class="input-group-addon"><i class="fa  fa-user"></i></span> -->
                  <input type="text" class="form-control" required name="sekolah_npsn" id="sekolah_npsn" placeholder="NPSN" >
                  <span class="help-block with-errors"></span>
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group">
                <label class="col-sm-2 control-label">Jenjang</label>
                <div class="input-group col-sm-8">
                  <!-- <span class="input-group-addon"><i class="fa  fa-user"></i></span> -->
                  <select required id="jenjang_id" name="jenjang_id" class="form-control" style="width: 100%;">
                    <option value="" >--Pilih--</option>
                    @foreach($jenjang as $list)
                      <option  value="{{ $list->jenjang_id }}"> {{ $list->jenjang_nama }}</option>
                    @endforeach
                  </select>
                  <span class="help-block with-errors"></span>
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group">
                <label class="col-sm-2 control-label">Kecamatan</label>



                <div class="input-group col-sm-8">
                  <!-- <span class="input-group-addon"><i class="fa  fa-user"></i></span> -->
                  <select required id="kecamatan_id" name="kecamatan_id" class="form-control js-example-basic-single" style="width: 100%;">
                    <option value="" >--Pilih--</option>
                    @foreach($kecamatan as $list2)
                      <option  value="{{ $list2->kecamatan_id }}">{{ $list2->kecamatan_nama }}</option>
                    @endforeach
                  </select>
                  <span class="help-block with-errors"></span>
                </div>
              </div>
              <!-- /.form-group -->

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>

                <div class="input-group col-sm-8">
                  <!-- <span class="input-group-addon"><i class="fa  fa-user"></i></span> -->
                  <input type="text" class="form-control" required name="sekolah_alamat" id="sekolah_alamat" placeholder="Alamat" >
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
