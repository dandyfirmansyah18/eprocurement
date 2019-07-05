@php
    use \App\Helpers\FormHelper;
@endphp

<div class="card panel">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#prakualifikasi" data-target="#pra5">
      <header class="teksutama">
          5. Pembuktian Prakualifikasi
          <br>
          @if($schedule->a_p_evaluation != null)
              <span class="pcr-date">
                  {{ $schedule->a_p_evaluation }}
              </span>
          @endif
      </header>
      <div class="tools">
        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
      </div>
    </div>
    <div id="pra5" class="collapse">
      <div class="card-body acccardbody">
        <hr>
        <p>
            @if($file_p_evaluation != null)
                {!! FormHelper::file_tag($file_p_evaluation->filepath, $file_p_evaluation->filename) !!}
            @else
                Belum ada BA Pembuktian Prakualifikasi.
            @endif
        </p>
        @if($ba_p_evaluation->notes != null)
            <p>
                Catatan:
                <br />
                {{ $ba_p_evaluation->notes }}
            </p>
        @endif
        <hr>
      </div>
    </div>
</div><!--end .panel -->
