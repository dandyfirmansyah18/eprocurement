@php
    use \App\Helpers\DateHelper;
@endphp

<div class="tab-pane p-20" id="tawareval" role="tabpanel">
    @include('layouts.pengadaan.parts.detail.submission.main')
    <br>
    <hr>
    
    @if($procurement->delivery_method > 1)
        @include('layouts.pengadaan.parts.detail.submission.addition')
    @endif
</div>

