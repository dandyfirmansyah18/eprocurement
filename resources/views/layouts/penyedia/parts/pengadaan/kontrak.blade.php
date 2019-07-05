<div class="tab-pane" id="kontrak">
    <h3>
        Surat keputusan Penetapan Pemenang
        <span class="pcr-date">{{ $schedule->a_contract }}</span>
    </h3>
    <p>
        @if($file_contract != null)
            {!! \App\Helpers\AuxHelper::render_file_url($file_contract->filepath, $file_contract->filename) !!}
        @else
            Belum ada SK.
        @endif
    </p>
    @if($contract->description != null)
        <p>
            Catatan:
            <br />
            {{ $contract->description }}
        </p>
    @endif
    <hr>
</div>
