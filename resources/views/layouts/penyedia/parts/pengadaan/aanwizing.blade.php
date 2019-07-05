<div class="tab-pane" id="aanwizing">
    <h3>
        Aanwizing
        <span class="pcr-date">{{ $schedule->a_aanwizing }}</span>
    </h3>
    <p>
        @if($inv_aanwizing != null)
            {!! \App\Helpers\AuxHelper::render_file_url($inv_aanwizing->filepath, $inv_aanwizing->filename) !!}
        @else
            Belum ada BA Aanwizing.
        @endif
    </p>
    @if($aanwizing->description != null)
        <p>
            Catatan:
            <br />
            {{ $aanwizing->description }}
        </p>
    @endif
    <hr>
</div>
