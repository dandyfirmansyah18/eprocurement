@php
    use \App\Helpers\FormHelper;
@endphp

<div class="tab-pane" id="evalpengumuman">
    <h3>
        Evaluasi Pemenang dan Pengumuman
        <span class="pcr-date">{{ $schedule->a_winner }}</span>
    </h3>
    <p>Pemenang pengadaan ini berdasarkan hasil evaluasi dan negosiasi:</p>
    <table id="tabel_candidates" class="table table-bordered order-column hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Perusahaan</th>
                <th>Nilai Akhir</th>
                <th>Pemenang</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @for ($ii = 0; $ii < count($enrollments); $ii++)
            @php
            $vendor = $enrollments[$ii]->vendor;
            $evaluation = $enrollments[$ii]->evaluation;
            @endphp
            <tr class="win_tr">
                <td>
                    <input type="hidden" name="winner[counter_id][{{ $ii }}]" value="{{ $ii }}" />
                    <input type="hidden" name="winner[vendor_id][{{ $ii }}]" value="{{ $vendor->id }}" />
                    {{ $ii + 1 }}
                </td>
                <td><a href="<?php echo url('vendor/detail/' . $vendor->id); ?>">{{ $vendor->name }}</a></td>
                <td>
                    @if($evaluation != null)
                    <div class="score {{ $evaluation->score }}">
                        &nbsp;{{ $evaluation->score }}%
                    </div>
                    @endif
                </td>
                <td class="mid_td">
                    <label class="radio-inline radio-styled">
                        {!! FormHelper::checked_icon($enrollments[$ii]->winner) !!}
                    </label>
                </td>
                <td>
                    {!! $enrollments[$ii]->notes !!}
                </td>
            </tr>
            @endfor
        </tbody>
    </table>
    <hr>
</div>
