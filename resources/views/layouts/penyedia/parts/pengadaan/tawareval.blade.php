<div class="tab-pane" id="tawareval">
  &nbsp;
  <div class="panel-group" id="tab_submission">
      @include('layouts.penyedia.parts.pengadaan.submission.main')

      @if($procurement->delivery_method > 1)
          @include('layouts.penyedia.parts.pengadaan.submission.addition')
      @endif
  </div><!--end .panel-group -->
</div>