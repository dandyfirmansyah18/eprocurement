@php
  use \App\Helpers\DateHelper;
  use \App\Helpers\FormHelper;
  use \App\Helper\AttachmentHelper;
@endphp

<div class="mt25">

  <!-- <label class="radio-inline checkbox-styled">
    <input type="checkbox" name="trg_assessment[certificates]" class="target-checker trg-assessment" {{ \App\Helpers\AuxHelper::render_boolean_checked($assessment->certificates) }} {{ $disabled }}><span>Verifikasi Tabel daftar Surat/Sertifikat Pendukung</span>
  </label> -->
  <dt>
    <label class="custom-control custom-checkbox m-b-0">
      <input type="checkbox" class="custom-control-input trg-assessment" name="trg_assessment[certificates]" {{ \App\Helpers\AuxHelper::render_boolean_checked($assessment->certificates) }} {{ $disabled }}>
      <span class="custom-control-label"><strong>Verifikasi Tabel daftar Surat/Sertifikat Pendukung</strong></span>
    </label>
  </dt>
  <hr>
  <table class="table no-margin">
    <thead>
      <tr>
        <th>#</th>
        <th>Jenis Surat</th>
        <th>No Surat/Sertifikat</th>
        <th>Nama Surat/Sertifikat</th>
        <th>Tanggal Diterbitkan</th>
        <th>Tanggal Habis Berlaku</th>
        <th>Institusi</th>
        <th>File</th>
      </tr>
    </thead>
    <tbody>
      @for($im = 0; $im < count($cert); $im++)
        <tr>
          @php
            $doc = $cert[$im]->doc()
          @endphp
          <td>{{ $im + 1 }}</td>
          <td>{{ $cert[$im]->type }}</td>
          <td>{{ $cert[$im]->number }}</td>
          <td>{{ $cert[$im]->title }}</td>
          <td>{{ DateHelper::datepicker($cert[$im]->release_date) }}</td>
          <td>{{ DateHelper::datepicker($cert[$im]->expired_date) }}</td>
          <td>{{ $cert[$im]->author }}</td>
          <td>
              @if($doc != null)
                  {!! FormHelper::file_tag($doc->filepath, $doc->filename) !!}
              @endif
          </td>
        </tr>
      @endfor
    </tbody>
  </table>
  <hr>
  <!-- <label class="radio-inline checkbox-styled">
    <input type="checkbox" name="trg_assessment[experiences]" class="target-checker trg-assessment" {{ \App\Helpers\AuxHelper::render_boolean_checked($assessment->experiences) }} {{ $disabled }}><span>Verifikasi Tabel daftar pengalaman</span>
  </label> -->
  <dt>
    <label class="custom-control custom-checkbox m-b-0">
      <input type="checkbox" class="custom-control-input trg-assessment" name="trg_assessment[experiences]" {{ \App\Helpers\AuxHelper::render_boolean_checked($assessment->experiences) }} {{ $disabled }}>
      <span class="custom-control-label"><strong>Verifikasi Tabel daftar pengalaman</strong></span>
    </label>
  </dt>
  <hr>
  <table class="table no-margin">
    <thead>
      <tr>
        <th>#</th>
        <th>Nama Paket Pekerjaan</th>
        <th>Bidang/Sub Bidang</th>
        <th>Lokasi</th>
        <th>Pemberi Tugas/Pengguna Jasa <br>(Nama/No Telp)</th>
        <th>Kontrak <br>Nomor/Tanggal / Nilai</th>
        <th>Tanggal Selesai <br>Kontrak / BA Serah Terima</th>
      </tr>
    </thead>
    <tbody>
      @for($im = 0; $im < count($exps); $im++)
        <tr>
          <td>{{ $im + 1 }}</td>
          <td>{{ $exps[$im]->name }}</td>
          <td>{{ $exps[$im]->field }}</td>
          <td>{{ $exps[$im]->location }}</td>
          <td>{{ $exps[$im]->client_name }} / {{ $exps[$im]->client_phone }}</td>
          <td>{{ $exps[$im]->contract_number }} / Rp {{ $exps[$im]->contract_value }}</td>
          <td>{{ $exps[$im]->contract_due }} / {{ $exps[$im]->hand_over }}</td>
        </tr>
      @endfor
    </tbody>
  </table>
</div>