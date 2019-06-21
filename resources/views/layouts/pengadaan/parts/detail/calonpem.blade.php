<div class="tab-pane" id="calonpem">
    <div class="pull-left">
        <h3>
            Pengusulan Calon Pemenang
            <span class="pcr-date">{{ $schedule->a_candidate }}</span>
        </h3>
    </div>
    <div class="pull-right">
        <a id="trg_sch_candidate" href="#" class="btn btn-info mt20" data-actual="{{ $schedule->a_candidate }}" data-back="{{ $schedule->b_candidate }}">Atur Jadwal</a>
    </div>
    <div class="clear"></div>

    <div class="judulformtop">
        Upload BA Pengusulan Pemenang
    </div>
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
                    <div id="st06_file" class="dropzone st-dropzone" url="/upload/procurement">
                        <div class="dz-message btn btn-default">
                            <h3>
                                Pilih file
                            </h3>
                        </div>
                    </div>
                    <p class="help-block st-help-block">Unggah BA Pengusulan Pemenang baru</p>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="st06_title" name="item[title]" value="{{ $candidate->title }}">
                    <label for="namalengkap">Judul File Pengusulan Pemenang</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group floating-label">
                    <textarea type="text" class="form-control" id="st06_description" name="item[description]">{!! $candidate->description !!}</textarea>
                    <label for="regular2">Catatan Pengusulan Pemenang</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a id="trg_st06" href="#" class="btn btn-default-bright">Upload</a>
            </div>
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
