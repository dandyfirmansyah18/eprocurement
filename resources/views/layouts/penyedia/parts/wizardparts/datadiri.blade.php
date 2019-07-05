<!--nama -->
<div class="row">
  <div class="col-sm-3">
    <div class="form-group">
      <input type="text" class="form-control" id="gelardepan">
      <p class="help-block">pisahkan dengan koma</p>
      <label for="gelardepan">Gelar di depan</label>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <input type="text" class="form-control" id="namalengkap">
      <label for="namalengkap">Nama lengkap</label>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <input type="text" class="form-control" id="gelarbelakang">
      <p class="help-block">pisahkan dengan koma</p>
      <label for="gelarbelakang">Gelar di belakang</label>
    </div>
  </div>
</div>

<!--jenis kelamin, tempat tanggal lahir -->
<div class="row">
  <div class="col-sm-3">
    <div class="pt25">
    <label class="radio-inline radio-styled">
      <input type="radio" name="gendre"><span>Laki - laki</span>
    </label>
    <label class="radio-inline radio-styled">
      <input type="radio" name="gendre"><span>Perempuan</span>
    </label>
  </div>
  <p class="help-block">Jenis kelamin</p>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <select class="form-control select2-list">
        <optgroup label="">
          <option value=""></option>
        </optgroup>
        <optgroup label="DKI Jakarta">
          <option value="AK">Jakarta Timur</option>
          <option value="HI">Jakarta Selatan</option>
        </optgroup>
        <optgroup label="Jawa Barat">
          <option value="CA">Depok</option>
          <option value="NV">Bogor</option>
          <option value="OR">Bandung</option>
          <option value="WA">Cirebon</option>
        </optgroup>
        <optgroup label="Jawa TImur">
          <option value="AZ">Malang</option>
          <option value="CO">Sidoarjo</option>
          <option value="ID">Surabaya</option>
        </optgroup>
      </select>
      <label>Tempat Lahir</label>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
    <div class="input-group date" id="tanggallahir">
      <div class="input-group-content">
        <input type="text" class="form-control">
        <label>Tanggal lahir</label>
        <p class="help-block">tanggal/bulan/tahun</p>
      </div>
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    </div>
  </div>
  </div>
</div>

<!--domisili -->
<div class="row">
  <div class="col-sm-3">
    <div class="pt25">
    <label class="radio-inline radio-styled">
      <input type="radio" name="domisili"><span>Luar Negeri</span>
    </label>
    <label class="radio-inline radio-styled">
      <input type="radio" name="domisili"><span>Dalam Negeri</span>
    </label>
  </div>
  <p class="help-block">Domisili</p>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <select class="form-control select2-list">
        <optgroup label="">
          <option value=""></option>
        </optgroup>
        <optgroup label="DKI Jakarta">
          <option value="AK">Jakarta Timur</option>
          <option value="HI">Jakarta Selatan</option>
        </optgroup>
        <optgroup label="Jawa Barat">
          <option value="CA">Depok</option>
          <option value="NV">Bogor</option>
          <option value="OR">Bandung</option>
          <option value="WA">Cirebon</option>
        </optgroup>
        <optgroup label="Jawa TImur">
          <option value="AZ">Malang</option>
          <option value="CO">Sidoarjo</option>
          <option value="ID">Surabaya</option>
        </optgroup>
      </select>
      <label>Kota domisili</label>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
			<textarea name="textarea1" id="textarea1" class="form-control" rows="2"></textarea>
      <label>Alamat domisili</label>
    </div>
  </div>
</div>

<!--kontak -->
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <input type="text" class="form-control" id="telp">
      <label for="telp">Nomor Telp</label>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <input type="text" class="form-control" id="email">
      <label for="email">Email</label>
    </div>
  </div>
</div>
