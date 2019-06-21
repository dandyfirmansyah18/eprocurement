<div class="tab-pane" id="tawareval">
    &nbsp;
    <div class="panel-group" id="tab_submission">
        @include('pengadaan.parts.detail.submission.main')

        @if($procurement->delivery_method > 1)
            @include('pengadaan.parts.detail.submission.addition')
        @endif
    </div><!--end .panel-group -->
</div>
