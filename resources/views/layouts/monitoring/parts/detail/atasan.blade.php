<!--Modal verifikasi pihak pengadaan-->
<div class="modal fade" id="verifikasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="formModalLabel">Verifikasi Pengadaan Terhadap Kelengkapan Pengajuan Pengadaan</h4>
        </div>
        <div class="modal-body">
          <form class="form" role="form">
            <div class="form-group floating-label">
              <input type="text" class="form-control" id="regular2" value="Panji Daud S">
              <label for="regular2">Nama verifikator</label>
            </div>

            <div class="form-group">
              <div class="input-group date" id="tanggalverifikasi">
                <div class="input-group-content">
                  <input type="text" class="form-control" name="aktaubah_date">
                  <label>Tanggal verifikasi</label>
                </div>
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </div>
                <div class="form-group floating-label">
                  <textarea type="text" class="form-control" id="regular2"></textarea>
                  <label for="regular2">(opsional) Catatan </label>
                </div>
          </form>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-primary"><i class="fa fa-check"></i> Verifikasi</button>
            </div>
    </div><!-- /.modal-content -->
  </div>
</div>

<!--Modal persetujuan pengajuan-->
<div class="modal fade" id="approval" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="formModalLabel">Memberi Persetujuan Pada Pengajuan Pengadaan Ini</h4>
        </div>
        <div class="modal-body">
          <form class="form" role="form">
            <div class="form-group floating-label">
              <input type="text" class="form-control" id="regular2" value="Panji Daud S">
              <label for="regular2">Nama yang Menyetujui</label>
            </div>

            <div class="form-group">
              <div class="input-group date" id="tanggalpersetujuan">
                <div class="input-group-content">
                  <input type="text" class="form-control" name="aktaubah_date">
                  <label>Tanggal Disetujui</label>
                </div>
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </div>
                <div class="form-group floating-label">
                  <textarea type="text" class="form-control" id="regular2"></textarea>
                  <label for="regular2">(opsional) Catatan lain </label>
                </div>
          </form>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-primary"><i class="fa fa-check"></i> Setujui</button>
            </div>
    </div><!-- /.modal-content -->
  </div>
</div>


<div class="tab-pane " id="second5">
  <h3><i class="fa fa-lg fa-check text-success"></i> Sudah disetujui pada tanggal: 20 Juli 2017 oleh manajer: Panji Daud</h3>
  <hr>
  Log Percakapan dan persetujuan Manajer :
  <br>
  17 April 2017 09.50 - Pengaju (Panji Daud S) : Mohon persetujuannya
  <br>
  18 April 2017 14:05 - Manajer : Ok sudah baik

  <hr>

  komunikasi proses persetujuan
  <div id="summernote">

  </div>
  <a class="btn btn-default-bright" href="#">Kirim </a>
  <hr>


</div>
<div class="tab-pane " id="third5">
  <a href="#" class="mt25 btn btn-primary"  data-toggle="modal" data-target="#approval"><i class="fa fa-check"></i> Persetujuan </a>
  <hr>
  Log Percakapan dan persetujuan kepala divisi :
  <br>
  17 April 2017 09.50 - Pengaju (Panji Daud S) : Mohon persetujuannya
  <br>
  18 April 2017 14:05 - kepala divisi : Ok sudah baik

  <hr>

  komunikasi proses persetujuan
  <div id="summernote2">

  </div>
  <a class="btn btn-default-bright" href="#">Kirim </a>
  <hr>


</div>

<div class="tab-pane" id="fourth">

  <a href="#" class="mt25 btn btn-primary"  data-toggle="modal" data-target="#approval"><i class="fa fa-check"></i> Persetujuan </a>
  <hr>
  Log Percakapan dan persetujuan Direksi :
  <br>
  17 April 2017 09.50 - Pengaju (Panji Daud S) : Mohon persetujuannya
  <br>
  18 April 2017 14:05 - Direksi : Ok sudah baik

  <hr>

  komunikasi proses persetujuan
  <div id="summernote3">

  </div>
  <a class="btn btn-default-bright" href="#">Kirim </a>
  <hr>