@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="card panel expanded">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#prakualifikasi" data-target="#pra1">
      <header class="teksutama">
        1. Mulai Prakualifikasi
        <br>
        @if($schedule->a_p_announcement != null)
            <span class="pcr-date">
                {{ $schedule->a_p_announcement }}
            </span>
        @endif
      </header>
      <div class="tools">
        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
      </div>
    </div>
    <div id="pra1" class="collapse in">
        <div class="card-body acccardbody">
            <hr>
            <p>
                Lokasi:&nbsp;{{ $inv_p_announcement->location }}
                <br>
                Tanggal Kegiatan:&nbsp;{{ DateHelper::long_format($inv_p_announcement->activity_date) }}
            </p>
            <p>
                {{ $inv_p_announcement->foreword }}
            </p>
            <p>
                @if($file_p_announcement != null)
                Undangan:&nbsp;{!! FormHelper::file_tag($file_p_announcement->filepath, $file_p_announcement->filename) !!}
                @endif
            </p>
            <hr>
        </div>
    </div>
</div><!--end .panel -->