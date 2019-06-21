@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="card panel">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#prakualifikasi" data-target="#pra2">
      <header class="teksutama">
        2. Download Dokumen Prakualifikasi
        <br>
        @if($schedule->a_p_download != null)
            <span class="pcr-date">
                {{ $schedule->a_p_download }}
            </span>
        @endif
      </header>
      <div class="tools">
        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
      </div>
    </div>
    <div id="pra2" class="collapse">
      <div class="card-body acccardbody">
        <hr>
          <h4>Penjelasan dan File Kegiatan Prakualifikasi </h4>
          <dl class="">
            <dt>Penjelasan</dt>
            <dd>{!! $procurement->pre_notes !!}</dd>
            <dt>File Prakualifikasi</dt>
            <dd>
              @if($file_p_download != null)
                {!! FormHelper::file_tag($file_p_download->filepath, $file_p_download->filename) !!}
              @endif
              &nbsp;
            </dd>
          </dl>
        <hr>
        <h4>Daftar peserta yang <strong>belum</strong> mendownload seluruh file</h4>
        <ol>
            @for ($ii = 0; $ii < count($pre_undownloadeds); $ii++)
                <li>{{ $pre_undownloadeds[$ii]->vendor->name }}</li>
            @endfor
        </ol>
        <br>
        <h4>Daftar peserta yang <strong>sudah</strong> mendownload seluruh file</h4>
        <ol>
            @for ($ii = 0; $ii < count($pre_downloadeds); $ii++)
                <li>{{ $pre_downloadeds[$ii]->vendor->name }}&nbsp;({{ DateHelper::time_format($pre_downloadeds[$ii]->updated_at) }})</li>
            @endfor
        </ol>
      </div>
    </div>
</div><!--end .panel -->
