@php
  use \App\Helpers\DateHelper;
@endphp

<dl class="uhui dl-horizontal mt25">
    <dt>
        <label class="radio-inline checkbox-styled">
            <span>Pajak </span>
        </label>
    </dt>

    <dd>
        NPWP : {{ $tax->taxpayer_number }}, tanggal dikeluarkan: {{ \App\Helpers\AuxHelper::render_date_long($tax->release_date) }}
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
    <br>
    <dd>
        <b>Bukti pelunasan 2 tahun terakhir (nomor pelunasan)</b> : {{ $tax->last_satisfactionnumber_kedua }}
    </dd>
    <dd>
        @if($company_taxpayment_kedua != null)
          <a href="{{ URL::asset('uploads/' . $company_taxpayment_kedua->filepath) }}" target="_blank">File Bukti Lunas</a>
        @endif
        &nbsp;
    </dd>

    <br>
    @if($company->type_id != '4')
        <dd>
            <b>SKT (Surat Keterangan Terdaftar) Perusahaan</b> : {{ $tax->sktnumber }}
        </dd>
        <dd>
        @if($company_skt != null)
          <a href="{{ URL::asset('uploads/' . $company_skt->filepath) }}" target="_blank">File SKT</a>
        @endif
        &nbsp;
        </dd>
        <br>
        <dd>
            <b>SPPKP Perusahaan</b> : {{ $tax->sppkpnumber }}
        </dd>
        <dd>
            @if($company_sppkp != null)
              <a href="{{ URL::asset('uploads/' . $company_sppkp->filepath) }}" target="_blank">File SPPKP</a>
            @endif
            &nbsp;
        </dd>
        <br />
    @endif
    <br />

    @if($company->type_id != '4')
        <dt>
        <label class="radio-inline checkbox-styled">
            <span>Izin Usaha</span>
        </label>
        </dt>

        @if($siup != null && $siup->document_number != null)
          <dd>
              <b>Jenis Izin: SIUP</b>
              @if($company_siup != null)
                (<a href="{{ URL::asset('uploads/' . $company_siup->filepath) }}" target="_blank">File SIUP</a>)
              @endif
              <br />
              Kualifikasi: {{ $siup->qualification }} <br />
              Nomor Izin: <strong>{{ $siup->document_number }}</strong> <br />
              Tanggal Keluar: {{ DateHelper::long_format($siup->release_date) }} <br />
              Tanggal habis: {{ DateHelper::long_format($siup->expired_date) }} <br />
              Instansi yang mengeluarkan: {{ $siup->licensor }} <br />
              Bidang Usaha: 
              @if($siup->sub_business_siup_other == '')
              {{ $siup->sub_business }}
              @else
              {{ $siup->sub_business_siup_other }}
              @endif
              <br />
          </dd>
        @endif
        <br>
        @if($iujk != null && $iujk->document_number != null)
          <dd>
              <b>Jenis Izin: IUT</b> 
              @if($company_iujk != null)
                (<a href="{{ URL::asset('uploads/' . $company_iujk->filepath) }}" target="_blank">File IUT</a>)
              @endif
              <br />
              Kualifikasi: {{ $iujk->qualification }} <br />
              Nomor Izin: <strong>{{ $iujk->document_number }}</strong> <br />
              Tanggal Keluar: {{ DateHelper::long_format($iujk->release_date) }} <br />
              Tanggal habis: {{ DateHelper::long_format($iujk->expired_date) }} <br />
              Instansi yang mengeluarkan: {{ $iujk->licensor }} <br />
              Bidang Usaha: 
              @if($iujk->sub_business_iujk_other == '')
              {{ $iujk->sub_business }}
              @else
              {{ $iujk->sub_business_iujk_other }}
              @endif
              <br />
          </dd>
        @endif
        <br>
        @if($sk_kemenkumham != null && $sk_kemenkumham->document_number != null)
          <dd>
              <b>Jenis Izin: SK Kemenkumham</b> 
              @if($company_sk_kemenkumham != null)
                (<a href="{{ URL::asset('uploads/' . $company_sk_kemenkumham->filepath) }}" target="_blank">File SK Kemenkumham</a>)
              @endif
              <br />
              Nomor Izin: <strong>{{ $sk_kemenkumham->document_number }}</strong> <br />
              Tanggal Pengesahan: {{ DateHelper::long_format($deed->confirmed) }}
              <br />
          </dd>
        @endif
        <br>
        @if($sk_kemenkumham != null && $sk_kemenkumham->document_number_perubahan != null)
          <dd>
              <b>Jenis Izin: SK Kemenkumham Perubahan</b> 
              @if($company_sk_kemenkumham_perubahan != null)
                (<a href="{{ URL::asset('uploads/' . $company_sk_kemenkumham_perubahan->filepath) }}" target="_blank">File SK Kemenkumham Perubahan</a>)
              @endif
              <br />
              Nomor Izin: <strong>{{ $sk_kemenkumham->document_number_perubahan }}</strong> <br />
              Tanggal Pengesahan: {{ DateHelper::long_format($deed->renewal_confirmed) }}
              <br />
          </dd>
        @endif

        <br />
    @endif

    <br />

    @if($company->type_id != '4')
    <dt>
        <label class="radio-inline checkbox-styled">
            <span>TDP</span>
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
            <a href="{{ URL::asset('uploads/' . $company_registration->filepath) }}" target="_blank">File TDP</a>
        @endif
        &nbsp;
    </dd>
    <br />
    @endif

    @if($company->type_id != '4')
        <dt>
            <label class="radio-inline checkbox-styled">
                <span>Akta Pendirian </span>
            </label>
        </dt>

        <dd>
            Nomor: <strong>{{ $deed->number }}</strong> <br />
            Notaris: {{ $deed->notary }} <br />
            Tanggal Keluar: {{ DateHelper::long_format($deed->released) }}
        </dd>
        <dd>
            @if($deed_release != null)
                <a href="{{ URL::asset('uploads/' . $deed_release->filepath) }}" target="_blank">File Akta Pendirian</a>
            @endif
            &nbsp;
        </dd>
        <br />
        @if($deed_renewal != null && $deed->renewal_number)
        <dt>
            <label class="radio-inline checkbox-styled">
                <span>Akta Perubahan</span>
            </label>
        </dt>
        <dd>
            Nomor: <strong>{{ $deed->renewal_number }}</strong> <br />
            Notaris: {{ $deed->renewal_notary }} <br />
            Tanggal Keluar: {{ DateHelper::long_format($deed->renewaled) }}
        </dd>
        <dd>
            @if($deed_renewal != null)
                <a href="{{ URL::asset('uploads/' . $deed_renewal->filepath) }}" target="_blank">File Akta Terakhir</a>
            @endif
            &nbsp;
        </dd>
        <br />
        @endif
    @endif

    @if($company->type_id != '4')
        <dt>
            <label class="radio-inline checkbox-styled">
                <span>Neraca Keuangan</span>
            </label>
        </dt>
        <dd>
            Kualifikasi perusahaan: {{ $company->qualification }} (neraca 2 tahun terakhir)
        </dd>
        <dd>
            @if($company_balance != null)
                <a href="{{ URL::asset('uploads/' . $company_balance->filepath) }}" target="_blank">File Neraca Keuangan</a>
            @endif
            &nbsp;
        </dd>
        <br>
    @endif

    <dt>
        <label class="radio-inline checkbox-styled">
            <span>Surat Pernyataan</span>
        </label>
    </dt>
    <dd>
        Surat Pernyataan Kesanggupan Memenuhi Pengadaan
    </dd>
    <dd>
        @if($company_spkmp != null)
            <a href="{{ URL::asset('uploads/' . $company_spkmp->filepath) }}" target="_blank">File Surat Pernyataan Kesanggupan Memenuhi Pengadaan</a>
        @endif
        &nbsp;
    </dd>
</dl>
