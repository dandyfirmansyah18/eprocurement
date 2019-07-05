@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="card panel">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#prakualifikasi" data-target="#pra3">
      <header class="teksutama">
          3. Aanwizing Prakualifikasi
          <br>
          @if($schedule->a_p_explanation != null)
              <span class="pcr-date">
                  {{ $schedule->a_p_explanation }}
              </span>
          @endif
      </header>
      <div class="tools">
        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
      </div>
    </div>
    <div id="pra3" class="collapse">
      <div class="card-body acccardbody">
        <hr>
        <p>
            @if($file_p_explanation != null)
                {!! FormHelper::file_tag($file_p_explanation->filepath, $file_p_explanation->filename) !!}
            @else
                Belum ada BA Pembuktian Prakualifikasi.
            @endif
        </p>
        @if($ba_p_explanation->notes != null)
            <p>
                Catatan:
                <br />
                {{ $ba_p_explanation->notes }}
            </p>
        @endif
        <hr>
      </div>
    </div>
</div><!--end .panel -->
