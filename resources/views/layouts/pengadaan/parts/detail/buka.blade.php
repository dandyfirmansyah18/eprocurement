<div class="tab-pane" id="buka">
    &nbsp;
    <div class="panel-group" id="tab_tender">
        @include('pengadaan.parts.detail.tender.main')

        @if($procurement->delivery_method > 1)
            @include('pengadaan.parts.detail.tender.addition')
        @endif
    </div><!--end .panel-group -->
</div>
