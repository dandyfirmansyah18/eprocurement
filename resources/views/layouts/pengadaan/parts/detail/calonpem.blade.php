<div class="tab-pane p-20" id="calonpem" role="tabpanel">
    <div class="pull-left">
        <h4>
            <a href="#">Pengusulan Calon Pemenang</a>
        </h4>
        <span class="pcr-date">{{ $schedule->a_candidate }}</span>
    </div>
    <hr>
    <div class="abs-right">
        <a id="trg_sch_candidate" href="#" class="btn btn-info mt20" data-actual="{{ $schedule->a_candidate }}" data-back="{{ $schedule->b_candidate }}">Atur Jadwal</a>
    </div>
    <div class="clear"></div>

    <p>
        Upload BA Pengusulan Pemenang
    </p>
    <form id="form_st06" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/jadwal/pengadaan/kandidat" method="POST">
        <input type="hidden" name="procurement_id" id="procurement_id" value="{{ $procurement->id }}" />
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">
                @if($file_candidate != null)
                <p>BA Pengusulan Pemenang saat ini: </p>
                <a href="/uploads/{{ $file_candidate->filepath }}" target="_blank">{{ $file_candidate->filename }}</a>
                @endif
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <p class="help-block st-help-block">Unggah BA Pengusulan Pemenang baru</p>
                    <input type="file" id="st06_file" name="st06_file">
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="namalengkap">Judul File Pengusulan Pemenang</label>
                    <input type="text" class="form-control" id="st06_title" name="item[title]" value="{{ $candidate->title }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group floating-label">
                    <label for="regular2">Catatan Pengusulan Pemenang</label>
                    <textarea type="text" class="form-control" id="st06_description" name="item[description]">{!! $candidate->description !!}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <input type="submit" id="submit" class="btn btn-primary mt25" value="Upload"> 
        </div>
    </form>
    <hr>
    Log Perubahan dokumen ini:
    @for ($ii = 0; $ii < count($log_candidates); $ii++)
        @if($log_candidates[$ii]->old_name == 'none')
            <br>Upload file awal &ldquo;{{ $log_candidates[$ii]->new_name }}&rdquo;  ( {{ \App\Helpers\AuxHelper::render_date_long($log_candidates[$ii]->created_at) }} )
        @else
            <br>Perubahan file &ldquo;{{ $log_candidates[$ii]->new_name }}&rdquo; ( {{ \App\Helpers\AuxHelper::render_date_long($log_candidates[$ii]->created_at) }} )
        @endif
    @endfor
    <hr>
</div>

@push('jspage')
    <script>
        $(document).ready(function(){
            $('#trg_st06').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_st06').submit();
                }
                event.preventDefault();
            });

            $('#trg_sch_candidate').on('click', function(event){
                var $el     = $(this);
                $('#sch_tab').val('calonpem');
                $('#sch_part').val('candidate');

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
