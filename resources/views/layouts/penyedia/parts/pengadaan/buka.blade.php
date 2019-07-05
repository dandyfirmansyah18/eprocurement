<div class="tab-pane" id="buka">
  &nbsp;
  <div class="panel-group" id="tab_tender">
      @include('layouts.penyedia.parts.pengadaan.tender.main')

      @if($procurement->delivery_method > 1)
          @include('layouts.penyedia.parts.pengadaan.tender.addition')
      @endif
  </div><!--end .panel-group -->
</div>