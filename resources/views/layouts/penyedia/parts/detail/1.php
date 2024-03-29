@php
  use \App\Helpers\DateHelper;
@endphp
<div class="row mt25">
  <div class="col-md-12">
    <dl class="uhui dl-horizontal">
      <dt>Waktu Request Register</dt>
      <dd>{{ \App\Helpers\AuxHelper::render_date($user->pinrequest_time) }}</dd>
      <dt>Waktu Pengisian</dt>
      <dd>{{ \App\Helpers\AuxHelper::render_date($company->created_at) }}</dd>
      <dt>Waktu pengiriman data</dt>
      <dd>{{ \App\Helpers\AuxHelper::render_date($user->registration_time) }}</dd>
      <br />

      <h3>
        <label class="radio-inline checkbox-styled">
          <span>Data Perusahaan</span>
        </label>
      </h3>
      <hr>
      <dt>Jenis Perusahaan</dt>
      <dd>{{ $company->type }}</dd>
      <dt>Tempat / Tanggal Berdiri</dt>
      <dd>{{ \App\Helpers\AuxHelper::render_date($deed->released) }}</dd>
      <dt>Alamat Domisili</dt>
      <dd>
        @if($company->province_id != null)
          {{ $company->new_province->province_name }}
        @endif
         - 
        @if($company->city_id != null)
          {{ $company->city_id }}
        @endif
         - 
        @if($company->postal_code != '0')
          {{ $company->new_postal_code->sub_district.' - '.$company->new_postal_code->urban.' - '.$company->new_postal_code->postal_code }}
        @else
          {{ $company->postal_code_other }}
        @endif
        &nbsp;
      </dd>
      <dd>{{ $company->address }}&nbsp;</dd>
      @if($company->type_id != '4')
      <dd>
        <b>Surat Keterangan Domisili Perusahaan (SKDP)</b>
        <br>
        Nomor : 
        @if($skdp != null)
          {{ $skdp->document_number }} 
        @else
          -
        @endif
        <br>
        Tanggal : 
        @if($skdp != null)
          {{ DateHelper::long_format($skdp->document_date) }}
        @else
          -
        @endif
        <br>
        <label class="radio-inline checkbox-styled">
          @if($company_domicile != null)
            File Surat Keterangan Domisili Perusahaan : 
            {!! \App\Helpers\AuxHelper::render_file_url($company_domicile->filepath, $company_domicile->filename) !!}
          @endif
        </label>
      </dd>
      @endif
      <dt>Alamat Operasional</dt>
      <dd>
        @if($company->operational_province_id != null)
          {{ $company->new_operational_province->province_name }}
        @endif
         - 
        @if($company->operational_city_id != null)
          {{ $company->operational_city_id }}
        @endif
         - 
        @if($company->operational_postal_code != '0')
          {{ $company->new_operational_postal_code->sub_district.' - '.$company->new_operational_postal_code->urban.' - '.$company->new_operational_postal_code->postal_code }}
        @else
          {{ $company->operational_postal_code_other }}
        @endif
        &nbsp;
      </dd>
      <dd>{{ $company->operational_address }}&nbsp;</dd>
      <dt>Kontak</dt>
      <dd>Telp : {{ $company->phone }}</dd>
      <dd>Email : {{ $company->email }}</dd>
      <dt>Jenis</dt>
      <dd>{{ $company->branch }}</dd>
      <dt>Tipe Bidang Usaha</dt>
      <dd>{{ $company->type }}</dd>
      <dt>Kualifikasi</dt>
      <dd>{{ $company->qualification }}</dd>
      <dt>Bidang Usaha</dt>
      <dd>{{ $company->business_text }}</dd>
      <br />
      <dt>Company Profile</dt>
      <dd>
        <label class="radio-inline checkbox-styled">
          @if($company_profile != null)
            {!! \App\Helpers\AuxHelper::render_file_url($company_profile->filepath, $company_profile->filename) !!}
          @endif
        </label>
      </dd>
      @if($company->type_id != '4')
      <dt>Stuktur Organisasi</dt>
      <dd>
        <label class="radio-inline checkbox-styled">
          @if($company_struktur != null)
            {!! \App\Helpers\AuxHelper::render_file_url($company_struktur->filepath, $company_struktur->filename) !!}
          @endif
        </label>
      </dd>
      @endif
      <br />

      <h3>
        <label class="radio-inline checkbox-styled">
          <span>Data Penanggung Jawab</span>
        </label>
      </h3>
      <hr>
      <!-- Data Penanggung Jawab -->
      <dt>Penanggung Jawab</dt>
      <dd>{{ $contact->name }}</dd>
      <dt>No KTP</dt>
      <dd>{{ $contact->national_id }}</dd>
      <dd>
        <label class="radio-inline checkbox-styled">
          @if($contact_photo != null)
            {!! \App\Helpers\AuxHelper::render_file_url($contact_photo->filepath, $contact_photo->filename) !!}
          @endif
        </label>
      </dd>
      <dt>No. Telp</dt>
      <dd>{{ $contact->phone }}</dd>
      <dt>No. Handphone</dt>
      <dd>{{ $contact->handphone }}</dd>
      <dt>Jabatan</dt>
      <dd>{{ $contact->job_title }}</dd>
      <dt>email</dt>
      <dd>{{ $contact->email }}</dd>
      <dt>pernyataan</dt>
      <dd>
        {!! $contact->render_contractsignin_icon() !!}&nbsp;&nbsp;Penanggung jawab yang namanya tercantum di form ini secara hukum mempunyai kapasitas menandatangani kontrak berdasarkan surat yang terlampir dalam pendaftaran ini (akta pendirian/perubahannya/surat kuasa)
        <br />
        {!! $contact->render_inbankrupt_icon() !!}&nbsp;&nbsp;Perusahaan tidak sedang dinyatakan pailit atau kegiatan usahanya tidak sedang dihentikan atau tidak sedang menjalani sanksi pidana atau sedang dalam pengawasan pihak berwajib/berwenang
        <br />
        {!! $contact->render_realdata_icon() !!}&nbsp;&nbsp;Data-data perusahaan diisikan dan/atau dilampirkan di pendaftaran ini dengan sebenar - benarnya
      </dd>

    </dl>
  </div>

</div>
