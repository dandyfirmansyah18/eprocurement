<div class="row">
    <div class="col-md-3">
        Upload Dokumen Pra-kualifikasi
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[a_p_upload]" value="{{ $schedule->a_p_upload }}" />
            <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
        </div>
    </div>

    @if($item->with_back_date)
    <div class="col-md-8 col-md-offset-3">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[b_p_upload]" value="{{ $schedule->b_p_upload }}" />
            <label class="tiny-label">Tanggal Backdate</label>
        </div>
    </div>
    @endif
    <div class="clear"></div>
</div>

<br>

<div class="row">
    <div class="col-md-3">
        Evaluasi Dokumen Pra-kualifikasi
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[a_p_evaluation]" value="{{ $schedule->a_p_evaluation }}" />
            <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
        </div>
    </div>

    @if($item->with_back_date)
    <div class="col-md-8 col-md-offset-3">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[b_p_evaluation]" value="{{ $schedule->b_p_evaluation }}" />
            <label class="tiny-label">Tanggal Backdate</label>
        </div>
    </div>
    @endif
    <div class="clear"></div>
</div>

<br>

<div class="row">
    <div class="col-md-3">
        Pembuktian Pra-kualifikasi
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[a_p_verification]" value="{{ $schedule->a_p_verification }}" />
            <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
        </div>
    </div>

    @if($item->with_back_date)
    <div class="col-md-8 col-md-offset-3">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[b_p_verification]" value="{{ $schedule->b_p_verification }}" />
            <label class="tiny-label">Tanggal Backdate</label>
        </div>
    </div>
    @endif
    <div class="clear"></div>
</div>

<br>

<div class="row">
    <div class="col-md-3">
        Penetapan Hasil Pra-kualifikasi
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[a_p_selection]" value="{{ $schedule->a_p_selection }}" />
            <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
        </div>
    </div>

    @if($item->with_back_date)
    <div class="col-md-8 col-md-offset-3">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[b_p_selection]" value="{{ $schedule->b_p_selection }}" />
            <label class="tiny-label">Tanggal Backdate</label>
        </div>
    </div>
    @endif
    <div class="clear"></div>
</div>

<br>

<div class="row">
    <div class="col-md-3">
        Pengumuman Pra-kualifikasi
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[a_p_result]" value="{{ $schedule->a_p_result }}" />
            <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
        </div>
    </div>

    @if($item->with_back_date)
    <div class="col-md-8 col-md-offset-3">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[b_p_result]" value="{{ $schedule->b_p_result }}" />
            <label class="tiny-label">Tanggal Backdate</label>
        </div>
    </div>
    @endif
    <div class="clear"></div>
</div>

<br>

<div class="row">
    <div class="col-md-3">
        Pemasukan Penawaran
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[a_submission]" value="{{ $schedule->a_submission }}" />
            <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
        </div>
    </div>

    @if($item->with_back_date)
    <div class="col-md-8 col-md-offset-3">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[b_submission]" value="{{ $schedule->b_submission }}" />
            <label class="tiny-label">Tanggal Backdate</label>
        </div>
    </div>
    @endif
    <div class="clear"></div>
</div>
<br>

@if($item->delivery_method == 3)
<div class="row">
    <div class="col-md-3">
        Pengumuman lolos tahap 1
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[a_phase1]" value="{{ $schedule->a_phase1 }}" />
            <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
        </div>
    </div>

    @if($item->with_back_date)
    <div class="col-md-8 col-md-offset-3">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[b_phase1]" value="{{ $schedule->b_phase1 }}" />
            <label class="tiny-label">Tanggal Backdate</label>
        </div>
    </div>
    @endif
    <div class="clear"></div>
</div>

<br>

<div class="row">
    <div class="col-md-3">
        Pemasukan penawaran tahap 2
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[a_submission2]" value="{{ $schedule->a_submission2 }}" />
            <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
        </div>
    </div>

    @if($item->with_back_date)
    <div class="col-md-8 col-md-offset-3">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[b_submission2]" value="{{ $schedule->b_submission2 }}" />
            <label class="tiny-label">Tanggal Backdate</label>
        </div>
    </div>
    @endif
    <div class="clear"></div>
</div>

<br>
@endif

@if($item->delivery_method == 2 || $item->delivery_method == 3)
<div class="row">
    <div class="col-md-3">
        Pembukaan penawaran tahap 2
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[a_tender2]" value="{{ $schedule->a_tender2 }}" />
            <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
        </div>
    </div>

    @if($item->with_back_date)
    <div class="col-md-8 col-md-offset-3">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[b_tender2]" value="{{ $schedule->b_tender2 }}" />
            <label class="tiny-label">Tanggal Backdate</label>
        </div>
    </div>
    @endif
    <div class="clear"></div>
</div>

<br>
@endif

<div class="row">
    <div class="col-md-3">
        Buka Penawaran
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[a_tender]" value="{{ $schedule->a_tender }}" />
            <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
        </div>
    </div>

    @if($item->with_back_date)
    <div class="col-md-8 col-md-offset-3">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[b_tender]" value="{{ $schedule->b_tender }}" />
            <label class="tiny-label">Tanggal Backdate</label>
        </div>
    </div>
    @endif
    <div class="clear"></div>
</div>

<br>

<div class="row">
    <div class="col-md-3">
        Evaluasi Penawaran
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[a_evaluation]" value="{{ $schedule->a_evaluation }}" />
            <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
        </div>
    </div>

    @if($item->with_back_date)
    <div class="col-md-8 col-md-offset-3">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[b_evaluation]" value="{{ $schedule->b_evaluation }}" />
            <label class="tiny-label">Tanggal Backdate</label>
        </div>
    </div>
    @endif
    <div class="clear"></div>
</div>

<br>


<div class="row">
    <div class="col-md-3">
        Negosiasi
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[a_negotiation]" value="{{ $schedule->a_negotiation }}" />
            <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
        </div>
    </div>

    @if($item->with_back_date)
    <div class="col-md-8 col-md-offset-3">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[b_negotiation]" value="{{ $schedule->b_negotiation }}" />
            <label class="tiny-label">Tanggal Backdate</label>
        </div>
    </div>
    @endif
    <div class="clear"></div>
</div>

<br>

<div class="row">
    <div class="col-md-3">
        Evaluasi usulan Pemenang
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[a_candidate]" value="{{ $schedule->a_candidate }}" />
            <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
        </div>
    </div>

    @if($item->with_back_date)
    <div class="col-md-8 col-md-offset-3">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[b_candidate]" value="{{ $schedule->b_candidate }}" />
            <label class="tiny-label">Tanggal Backdate</label>
        </div>
    </div>
    @endif
    <div class="clear"></div>
</div>

<br>

<div class="row">
    <div class="col-md-3">
        Pengumuman Pemenang dan Masa Sanggah
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[a_winner]" value="{{ $schedule->a_winner }}" />
            <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
        </div>
    </div>

    @if($item->with_back_date)
    <div class="col-md-8 col-md-offset-3">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[b_winner]" value="{{ $schedule->b_winner }}" />
            <label class="tiny-label">Tanggal Backdate</label>
        </div>
    </div>
    @endif
    <div class="clear"></div>
</div>

<br>

<div class="row">
    <div class="col-md-3">
        Masa Jawab Sanggah
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[a_consultation]" value="{{ $schedule->a_consultation }}" />
            <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
        </div>
    </div>

    @if($item->with_back_date)
    <div class="col-md-8 col-md-offset-3">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[b_consultation]" value="{{ $schedule->b_consultation }}" />
            <label class="tiny-label">Tanggal Backdate</label>
        </div>
    </div>
    @endif
    <div class="clear"></div>
</div>

<br>

<div class="row">
    <div class="col-md-3">
        Kontrak
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[a_contract]" value="{{ $schedule->a_contract }}" />
            <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
        </div>
    </div>

    @if($item->with_back_date)
    <div class="col-md-8 col-md-offset-3">
        <div class="form-group">
            <input class="form-control daterange" type="text" name="schedule[b_contract]" value="{{ $schedule->b_contract }}" />
            <label class="tiny-label">Tanggal Backdate</label>
        </div>
    </div>
    @endif
    <div class="clear"></div>
</div>

<br>
