<div class="tab-pane p-20" id="kontrak" role="tabpanel">
    <div class="pull-left">
        <h4>
            <a href="#">Kontrak</a>
        </h4>
        <span class="pcr-date">{{ $schedule->a_contract }}</span>
    </div>
    <hr>
    <div class="abs-right">
        <a id="trg_sch_contract" href="#" class="btn btn-info mt20" data-actual="{{ $schedule->a_contract }}" data-back="{{ $schedule->b_contract }}">Atur Jadwal</a>
        @if($procurement->stage == 9)
            <a id="trg_work" href="#" class="btn btn-primary mt20">Pengadaan Selesai</a>
        @else
            <a href="#" class="btn btn-primary mt20" disabled>Pengadaan Selesai</a>
        @endif
    </div>
    <div class="clear"></div>
    <p>Upload Surat keputusan Penetapan Pemenang</p>
    <div class="clear"></div>
    <form id="form_contract" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/jadwal/pengadaan/kontrak" method="POST">
        <input type="hidden" name="procurement_id" id="procurement_id" value="{{ $procurement->id }}" />
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">
                @if($file_contract != null)
                <p>Kontrak saat ini: </p>
                <a href="/uploads/{{ $file_contract->filepath }}" target="_blank">{{ $file_contract->filename }}</a>
                @endif
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <p class="help-block st-help-block">Unggah Kontrak baru</p>
                    <input type="file" class="form-control" id="st09_file" name="st09_file">
                    
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="namalengkap">Judul File</label>
                    <input type="text" class="form-control" id="st09_title" name="item[title]" value="{{ $contract->title }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group floating-label">
                    
                    <label for="regular2">Catatan</label>
                    <textarea type="text" class="form-control" id="st09_description" name="item[description]">{!! $contract->description !!}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
           <input type="submit" id="submit" class="btn btn-primary mt25" value="Upload">
            </div>
        </div>
    </form>
    <hr>

    Log Perubahan dokumen ini:
    @for ($ii = 0; $ii < count($log_contracts); $ii++)
        @if($log_contracts[$ii]->old_name == 'none')
            <br>Upload file awal &ldquo;{{ $log_contracts[$ii]->new_name }}&rdquo;  ( {{ \App\Helpers\AuxHelper::render_date_long($log_contracts[$ii]->created_at) }} )
        @else
            <br>Perubahan file &ldquo;{{ $log_contracts[$ii]->new_name }}&rdquo; ( {{ \App\Helpers\AuxHelper::render_date_long($log_contracts[$ii]->created_at) }} )
        @endif
    @endfor
    <hr>
</div>

@push('jspage')
    <script>
        $(document).ready(function(){
            $('#trg_contract').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_contract').submit();
                }
                event.preventDefault();
            });

            $('#trg_sch_contract').on('click', function(event){
                var $el     = $(this);
                $('#sch_tab').val('kontrak');
                $('#sch_part').val('contract');

                if($el.data('actual') != '') {
                    $('#sch_date').val($el.data('actual'));
                }

                if($('#sch_backdate').length > 0 && $el.data('back') != '') {
                    $('#sch_backdate').val($el.data('back'));
                }

                $('.daterange').daterangepicker({
                    daysOfWeekDisabled: [0,6],
                    timePicker: true,
                    timePicker24Hour: true,
                    timePickerIncrement: 10,
                    locale: {
                        format: 'LLLL'
                    }
                });

                $('#schedule_modal').modal();
                event.preventDefault();
            });
        });
    </script>
@endpush
