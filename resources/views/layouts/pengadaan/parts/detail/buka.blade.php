<div class="tab-pane p-20" id="buka" role="tabpanel">
    &nbsp;
        @include('layouts.pengadaan.parts.detail.tender.main')

        @if($procurement->delivery_method > 1)
            @include('layouts.pengadaan.parts.detail.tender.addition')
        @endif
</div>
