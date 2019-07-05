@php
    use \App\Helpers\FormHelper;
@endphp

<div class="tab-pane" id="sanggah">
    <h3>
        Sanggahan
        <span class="pcr-date">{{ $schedule->a_consultation }}</span>
    </h3>

    <div class="judulformtop">BA Sanggahan</div>
    <p>
        @if($file_refutal != null)
            {!! FormHelper::file_tag($file_refutal->filepath, $file_refutal->filename) !!}
        @else
            Belum ada BA Sanggahan.
        @endif
    </p>
    <hr>

    @if($enrolled == 1)
    <div class="judulformtop">Jaminan Sanggahan</div>
    <form id="form_jsanggahan" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/enrollment/jaminan/sanggah" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="procurement_id" id="j_procurement_id" value="{{ $procurement->id }}" />
        <input type="hidden" name="assurance[id]" id="j_sanggahan_id" value="{{ $sanggahan->id }}" />
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-12">
                <div class="form-group floating-label">
                    <input type="text" class="form-control" name="assurance[amount]" value="{{ $sanggahan->amount }}" />
                    <label for="regular2">Nilai Jaminan</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="file" class="form-control" name="assurance_doc" />
                    <p class="help-block">Upload Dokumen yang Diperlukan</p>
                </div>
            </div>
            <div class="col-md-6">
                @if($file_sanggahan != null)
                    <p>Jaminan saat ini: </p>
                    <a href="/uploads/{{ $file_sanggahan->filepath }}" target="_blank">{{ $file_sanggahan->filename }}</a>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group floating-label">
                    <textarea type="text" class="form-control" name="assurance[notes]">{{ $sanggahan->notes }}</textarea>
                    <label for="regular2">Catatan </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group date" id="tanggal_sanggahanstart">
                        <div class="input-group-content">
                            <input type="text" class="form-control" name="assurance[start_date]" value="{{ \App\Helpers\AuxHelper::render_date($sanggahan->start_date) }}" />
                            <label>Tanggal Mulai Jaminan</label>
                            <p class="help-block">tanggal/bulan/tahun</p>
                        </div>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group date" id="tanggal_sanggahanend">
                        <div class="input-group-content">
                            <input type="text" class="form-control" name="assurance[end_date]" value="{{ \App\Helpers\AuxHelper::render_date($sanggahan->end_date) }}" />
                            <label>Tanggal Selesai Jaminan</label>
                            <p class="help-block">tanggal/bulan/tahun</p>
                        </div>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="pull-right">
        <a id="trg_jsanggahan" href="#" class="btn btn-primary mt25" ><i class="fa fa-save"></i> Simpan Jaminan</a>
    </div>
    <div class="clear"></div>
    <hr>
    @endif
</div>

@push('jspage')
<script type="text/javascript">
$(document).ready(function() {
    if($('#tanggal_sanggahanstart').length > 0) {
        $('#tanggal_sanggahanstart').datepicker({
            autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
        });

        $('#tanggal_sanggahanend').datepicker({
            autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
        });

        $('#trg_jsanggahan').on('click', function(event){
            $('form#form_jsanggahan').submit();
            event.preventDefault();
        });
    }
});
</script>
@endpush
