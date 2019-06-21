@php
  use \App\Helpers\DateHelper;
@endphp

<dl class="uhui dl-horizontal mt25">
  <dt>
    <label class="radio-inline checkbox-styled">
      <input type="checkbox" name="trg_assessment[tax]" class="target-checker trg-assessment" {{ \App\Helpers\AuxHelper::render_boolean_checked($assessment->tax) }} {{ $disabled }}><span>Pajak </span>
    </label>
  </dt>

  <dd>
      NPWP : <strong>{{ $tax->taxpayer_number }}</strong> <br />
      Tanggal dikeluarkan: {{ DateHelper::long_format($tax->release_date) }}
  </dd>
  <dd>
    @if($company_taxpayer != null)
      <a href="{{ URL::asset('uploads/' . $company_taxpayer->filepath) }}" target="_blank">npwp.pdf</a>
    @endif
    &nbsp;
  </dd>

  <dd>
    Bukti pelunasan tahun terakhir (nomor pelunasan) : {{ $tax->last_satisfactionnumber }}
  </dd>
  <dd>
    @if($company_taxpayment != null)
      <a href="{{ URL::asset('uploads/' . $company_taxpayment->filepath) }}" target="_blank">bukti_lunas.pdf</a>
    @endif
    &nbsp;
  </dd>
  <dd>
    Bukti laporan bulanan PPH/PPN (nomor bukti) : {{ $tax->last_trimonthlynumber }}
  </dd>
  <dd>
    @if($company_taxreport != null)
      <a href="{{ URL::asset('uploads/' . $company_taxreport->filepath) }}" target="_blank">bukti_lapor.pdf</a>
    @endif
    &nbsp;
  </dd>

  <br />

  <dt>
    <label class="radio-inline checkbox-styled">
      <input type="checkbox" name="trg_assessment[permit]" class="target-checker trg-assessment" {{ \App\Helpers\AuxHelper::render_boolean_checked($assessment->permit) }} {{ $disabled }}><span>Izin Usaha</span>
    </label>
  </dt>

  @if($siup != null && $siup->document_number != null)
      <dd>
          Jenis Izin: SIUP
          @if($company_siup != null)
            (<a href="{{ URL::asset('uploads/' . $company_siup->filepath) }}" target="_blank">SIUP.pdf</a>)
          @endif
          <br />
          Kualifikasi: {{ $siup->qualification }} <br />
          Nomor Izin: <strong>{{ $siup->document_number }}</strong> <br />
          Tanggal Keluar: {{ DateHelper::long_format($siup->release_date) }} <br />
          Tanggal habis: {{ DateHelper::long_format($siup->expired_date) }} <br />
          Instansi yang mengeluarkan: {{ $siup->licensor }} <br />
          Bidang Usaha: {{ $siup->sub_business }}
          <br />
      </dd>
  @endif

  @if($iujk != null && $iujk->document_number != null)
      <dd>
          Jenis Izin: IUJK 
          @if($company_iujk != null)
            (<a href="{{ URL::asset('uploads/' . $company_iujk->filepath) }}" target="_blank">IUJK.pdf</a>)
          @endif
          <br />
          Kualifikasi: {{ $iujk->qualification }} <br />
          Nomor Izin: <strong>{{ $iujk->document_number }}</strong> <br />
          Tanggal Keluar: {{ DateHelper::long_format($iujk->release_date) }} <br />
          Tanggal habis: {{ DateHelper::long_format($iujk->expired_date) }} <br />
          Instansi yang mengeluarkan: {{ $iujk->licensor }} <br />
          Bidang Usaha: {{ $iujk->sub_business }}
          <br />
      </dd>
  @endif

  @if($siui != null && $siui->document_number != null)
      <dd>
          Jenis Izin: SIUI
          @if($company_siui != null)
            <a href="{{ URL::asset('uploads/' . $company_siui->filepath) }}" target="_blank">SIUI.pdf</a>
          @endif
          <br />
          Nomor Izin: <strong>{{ $siui->document_number }}</strong> <br />
          Tanggal Keluar: {{ DateHelper::long_format($siui->release_date) }} <br />
          Tanggal habis: {{ DateHelper::long_format($siui->expired_date) }} <br />
          Instansi yang mengeluarkan: {{ $siui->licensor }}
          <br />
      </dd>
  @endif

  <br />

  <dt>
    <label class="radio-inline checkbox-styled">
      <input type="checkbox" name="trg_assessment[registration]" class="target-checker trg-assessment" {{ \App\Helpers\AuxHelper::render_boolean_checked($assessment->registration) }} {{ $disabled }}><span>TDP</span>
    </label>
  </dt>

  <dd>
      Nomor TDP: <strong>{{ $registration->registration_number }}</strong> <br />
      Tanggal Keluar: {{ DateHelper::long_format($registration->release_date) }} <br />
      Tanggal habis: {{ DateHelper::long_format($registration->expired_date) }} <br />
      instansi yang mengeluarkan: {{ $registration->licensor }}
  </dd>
  <dd>
    @if($company_registration != null)
      <a href="{{ URL::asset('uploads/' . $company_registration->filepath) }}" target="_blank">TDP.pdf</a>
    @endif
    &nbsp;
  </dd>

  <br />

  <dt>
    <label class="radio-inline checkbox-styled">
      <input type="checkbox" name="trg_assessment[deed_establishment]" class="target-checker trg-assessment" {{ \App\Helpers\AuxHelper::render_boolean_checked($assessment->deed_establishment) }} {{ $disabled }}><span>  Akta Pendirian </span>
    </label>
  </dt>

  <dd>
      Nomor: <strong>{{ $deed->number }}</strong> <br />
      Notaris: {{ $deed->notary }} <br />
      Tanggal Keluar: {{ DateHelper::long_format($deed->released) }} <br />
      Tanggal Pengesahan: {{ DateHelper::long_format($deed->confirmed) }}
  </dd>
  <dd>
    @if($deed_release != null)
      <a href="{{ URL::asset('uploads/' . $deed_release->filepath) }}" target="_blank">akta-diri.pdf</a>
    @endif
    &nbsp;
  </dd>

  <br />

  <dt>
    <label class="radio-inline checkbox-styled">
      <input type="checkbox" name="trg_assessment[deed_renewal]" class="target-checker trg-assessment" {{ \App\Helpers\AuxHelper::render_boolean_checked($assessment->deed_renewal) }} {{ $disabled }}><span>  Akta Perubahan</span>
    </label>
  </dt>
  <dd>
      Nomor: <strong>{{ $deed->renewal_number }}</strong> <br />
      Notaris: {{ $deed->renewal_notary }} <br />
      Tanggal Keluar: {{ DateHelper::long_format($deed->renewaled) }} <br />
      Tanggal Pengesahan: {{ DateHelper::long_format($deed->renewal_confirmed) }}
  </dd>
  <dd>
    @if($deed_renewal != null)
      <a href="{{ URL::asset('uploads/' . $deed_renewal->filepath) }}" target="_blank">akta-terakhir.pdf</a>
    @endif
    &nbsp;
  </dd>

  <br />

  <dt>
    <label class="radio-inline checkbox-styled">
      <input type="checkbox" name="trg_assessment[balance]" class="target-checker trg-assessment" {{ \App\Helpers\AuxHelper::render_boolean_checked($assessment->balance) }} {{ $disabled }}><span>Neraca Keuangan</span>
    </label>
  </dt>
  <dd>
    Kualifikasi perusahaan: {{ $company->qualification }} (neraca 3 tahun terakhir)
  </dd>
  <dd>
    @if($company_balance != null)
      <a href="{{ URL::asset('uploads/' . $company_balance->filepath) }}" target="_blank">neraca.pdf</a>
    @endif
    &nbsp;
  </dd>
</dl>
