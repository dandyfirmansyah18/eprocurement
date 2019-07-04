@php
  use \App\Helpers\FormHelper;
@endphp

<h5 class="card-title"><i class="fa fa-user"></i> &nbsp;&nbsp;Data Penanggung Jawab Perusahaan</h5>
<br>
<!--nama -->
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="contact_name">Nama *</label>
      <input type="text" class="form-control is_req" id="contact_name" name="contact[name]" value="{{ $contact->name }}" required {{ $readonly }}>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="contact_jobtitle">Jabatan *</label>
      <input type="text" class="form-control is_req" id="contact_jobtitle" name="contact[job_title]" value="{{ $contact->job_title }}" {{ $readonly }}>
    </div>
  </div>
</div>

<!--kontak -->
<div class="row">
  <div class="col-sm-4">
    <div class="form-group">
      <label for="contact_phone">No. Telp *</label>
      <input type="text" class="form-control is_req" id="contact_phone" name="contact[phone]" value="{{ $contact->phone }}" required {{ $readonly }}>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="contact_handphone">No. HP *</label>
      <input type="text" class="form-control is_req" id="contact_handphone" name="contact[handphone]" value="{{ $contact->handphone }}" required {{ $readonly }}>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="contact_email">Email *</label>
      <input type="text" class="form-control is_req" id="contact_email" name="contact[email]" value="{{ $contact->email }}" required {{ $readonly }}>
    </div>
  </div>
</div>

<!--ktp -->
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="contact_nationalid">No. KTP *</label>
      <input type="number" class="form-control is_req" id="contact_nationalid" onkeydown="limit_ktp(this);" onkeyup="limit_ktp(this);" name="contact[national_id]" value="{{ $contact->national_id }}" required {{ $readonly }}>
    </div>
  </div>
  <div class="col-sm-6">
    <div id="company_contact_block" class="form-group dropzone-block">
      <label id="text_company_contact">Unggah KTP</label>
      <input type="hidden" name="token_contact_photo" id="token_contact_photo" value="{{ csrf_token() }}">
      <div class="upload-block">
        @if($contact_photo != null && $contact_photo->filename != null)
          <div class="image-block">
            File saat ini:<br>
            {!! FormHelper::file_tag($contact_photo->filepath, $contact_photo->filename) !!}
          </div>
        @endif
        <div id="contact_photo" class="dropzone" url="/upload/company">
          <div class="dz-message btn btn-default">
            <h3>
              Pilih file
            </h3>
          </div>
        </div>
      </div>
      <div class="clear"></div>
      <small id="emailHelp" class="form-text text-muted">* Maks. Upload File 4 MB</small>
      <div class="clear"></div>
    </div>
  </div>

</div>
<br><br>
<!-- pernyataan -->
<div class="row">
  <p class="warning-cabang">Dengan ini perusahaan pendaftar menyatakan:</p>
  <div class="col-md-12">
    <label class="checkbox checkbox-styled">
      <input type="checkbox" required name="contact[contract_signin]" id="contact_contractsignin" class="target-checker" {{ FormHelper::checked($contact->contract_signin) }}  {{ $readonly }}>&nbsp;&nbsp;&nbsp;<span>Penanggung jawab yang namanya tercantum di form ini secara hukum mempunyai kapasitas menandatangani kontrak berdasarkan surat yang terlampir dalam pendaftaran ini (akta pendirian/perubahannya/surat kuasa)</span>
    </label>
    <label class="checkbox checkbox-styled">
      <input type="checkbox" required name="contact[in_bankrupt]" id="contact_inbankrupt" class="target-checker" {{ FormHelper::checked($contact->in_bankrupt) }}  {{ $readonly }}>&nbsp;&nbsp;&nbsp;<span>Perusahaan tidak sedang dinyatakan pailit atau kegiatan usahanya tidak sedang dihentikan atau tidak sedang menjalani sanksi pidana atau sedang dalam pengawasan pihak berwajib/berwenang</span>
    </label>
    <label class="checkbox checkbox-styled">
      <input type="checkbox" required name="contact[real_data]" id="contact_realdata" class="target-checker" {{ FormHelper::checked($contact->real_data) }}  {{ $readonly }}>&nbsp;&nbsp;&nbsp;<span>Data-data perusahaan diisikan dan/atau dilampirkan di pendaftaran ini dengan sebenar - benarnya</span>
    </label>
  </div>
</div>
<hr>
