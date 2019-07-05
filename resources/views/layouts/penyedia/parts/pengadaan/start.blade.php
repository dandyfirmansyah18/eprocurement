@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="tab-pane " id="start">
    <h3>
        Pengumuman dan Undangan Aanwizing
        <span class="pcr-date">{{ $schedule->a_announcement }}</span>
    </h3>
    <hr>

    <p>
        Lokasi:&nbsp;{{ $announcement->location }}
        <br>
        Tanggal Kegiatan:&nbsp;{{ DateHelper::long_format($announcement->activity_date) }}
    </p>
    <p>
        {{ $announcement->foreword }}
    </p>
    <p>
        @if($inv_announcement != null)
        Undangan:&nbsp;{!! FormHelper::file_tag($inv_announcement->filepath, $inv_announcement->filename) !!}
        @endif
    </p>
    <hr>
</div>
