<!--pengaju -->
<form class="form floating-label form-validation" role="form" novalidate="novalidate">
<div class="card-body floating-label">
  <div class="judulformtop"><i class="fa fa-file-text"></i> Data Pengajuan
  </div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <input type="text" class="form-control" id="gelardepan" value="otomatis terisi">
      <p class="help-block"></p>
      <label for="gelardepan">Unit Kerja</label>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <input type="text" class="form-control" id="namalengkap" value="Panji Daud S">
      <label for="namalengkap">Nama Lengkap Pengaju</label>
    </div>
  </div>

</div>

<!--nama pekerjaan, hps -->
<div class="row">

  <div class="col-sm-4">
    <div class="form-group floating-label">
      <select id="jenispengadaan" class="form-control select2-list">
          <option value=""></option>
          <option value="1">Pelelangan/Seleksi Umum</option>
          <option value="2">Pelelangan Selektif/Seleksi Terbatas</option>
          <option value="3">Pemilihan Langsung/Seleksi Langsung</option>
          <option value="4">Penunjukan Langsung</option>
          <option value="5">Pengadaan Langsung</option>
      </select>
      <label>Metode Pengadaan</label>
    </div>

  </div>
  <div class="boks" style="display:none">
  <div class="col-sm-4">
    <div class="form-group floating-label">
      <select  class="form-control select2-list" multiple>
          <option value=""></option>
          <option value="AZ">Rekanan A</option>
          <option value="CO">Rekanan B</option>
          <option value="ID">Rekanan C</option>
      </select>
      <label>Pilih Rekanan</label>
    </div>
  </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <select id="jenispengadaan" class="form-control select2-list">
        <optgroup label="">
          <option value=""></option>
        </optgroup>
          <option value="1">Satu Sampul</option>
          <option value="2">Dua Sampul</option>
          <option value="3">Dua Tahap</option>
      </select>
      <label>Metode kualifikasi</label>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-4">
    <div class="form-group">
      <input type="text" class="form-control" id="namalengkap" >
      <label for="namalengkap">Nama Pekerjaan</label>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <input type="text" class="form-control hps-mask" id="namalengkap" >
      <label for="namalengkap">RAB/HPS/OE</label>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
    <div class="input-group date" id="tanggallahir">
      <div class="input-group-content">
        <input type="text" class="form-control">
        <label>Usulan tanggal mulai/pengumuman pengadaan</label>
        <p class="help-block">tanggal/bulan/tahun</p>
      </div>
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    </div>
  </div>
  </div>
</div>

<!--Nodin -->
<div class="row">
  <div class="col-sm-4">
    <div class="form-group">
      <input type="file" class="form-control" id="namalengkap" name="name">
      <p class="help-block">Upload Nota Dinas</p>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <input type="text" class="form-control" id="namalengkap" >
      <label for="namalengkap">Nomor Nota Dinas</label>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
    <div class="input-group date" id="tanggallahir">
      <div class="input-group-content">
        <input type="text" class="form-control">
        <label>Tanggal Nota Dinas</label>
        <p class="help-block">tanggal/bulan/tahun</p>
      </div>
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    </div>
  </div>
  </div>

</div>

<!--SPPP -->
<div class="row">
  <div class="col-sm-4">
    <div class="form-group">
      <input type="file" class="form-control" id="namalengkap" name="name">
      <p class="help-block">Upload SPPP/B</p>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group floating-label">
      <input type="text" class="form-control" id="namalengkap" >
      <label for="namalengkap">Nomor SPPP/B</label>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
    <div class="input-group date" id="tanggallahir">
      <div class="input-group-content">
        <input type="text" class="form-control">
        <label>Tanggal SPPP/B</label>
        <p class="help-block">tanggal/bulan/tahun</p>
      </div>
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    </div>
  </div>
  </div>

</div>

<!--RKS -->
<div class="row">
  <div class="col-sm-4">
    <div class="form-group">
      <input type="file" class="form-control" id="namalengkap" name="name">
      <p class="help-block">Upload RKS Teknis</p>
    </div>
  </div>
</div>

<div class="judulform"><i class="fa fa-file-text-o"></i> Catatan dan justifikasi
</div>
<div class="col-sm-6">
  <div class="form-group">
    <textarea name="textarea1" id="textarea1" class="form-control" rows="2"></textarea>
    <label>Catatan</label>
    <p class="help-block">Catatan terkait pengadaan ini</p>
  </div>
</div>

<div class="col-sm-6">
  <div class="form-group">
    <textarea name="textarea1" id="textarea1" class="form-control" rows="2"></textarea>
    <label>Justifikasi</label>
    <p class="help-block">Mengapa memilih metode pengadaan dan penyedia ini</p>
  </div>
</div>


</div>



<div class="card-actionbar">
  <div class="card-actionbar-row">
    <a href="<?php echo url('/perencanaan/daftar-calon'); ?>" type="submit" class="btn btn-primary ink-reaction"  ><i class="fa fa-save"></i>  Simpan Menjadi Draft Pengajuan Pengadaan</a>
  </div>
</div>

</form>


@push('jspage')
<script type="text/javascript">
  $(document).ready(function() {
    $('#jenispengadaan').on('change', function() {
      if (this.value == '0' || this.value == '1' || this.value == '2')
      {
        $(".boks").hide();
      }
      else
      {
        $(".boks").show();
      }


    });

		$(".form-control.hps-mask").inputmask('Rp 9.999.999.999.999', {numericInput: true, rightAlignNumerics: false});

  });
</script>

@endpush