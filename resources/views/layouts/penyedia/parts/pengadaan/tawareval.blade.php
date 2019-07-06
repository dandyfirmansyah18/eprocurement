<div class="tab-pane" id="tawareval" role="tabpanel">
  &nbsp;
      @include('layouts.penyedia.parts.pengadaan.submission.main')

      @if($procurement->delivery_method > 1)
          @include('layouts.penyedia.parts.pengadaan.submission.addition')
      @endif
</div>