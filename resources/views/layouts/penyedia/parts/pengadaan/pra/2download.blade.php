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
            @php
                $date_diff  = DateHelper::end_date_diff($schedule->a_p_download)
            @endphp
            <dt>File Prakualifikasi</dt>
            <dd class="stg-p-download">
                @if($date_diff < 0)
                    {{ $file_p_download->filename }}
                @else
                    {!! FormHelper::file_tag($file_p_download->filepath, $file_p_download->filename) !!}
                @endif
            </dd>
            <hr>
            <dt>Penjelasan</dt>
            <dd>
              {!! $procurement->pre_notes !!}
            </dd>
          </dl>
        <hr>
      </div>
    </div>
</div><!--end .panel -->
