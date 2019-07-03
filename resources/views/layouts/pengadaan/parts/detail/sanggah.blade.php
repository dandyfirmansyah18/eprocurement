@php
    use \App\Helpers\FormHelper;
    use \App\Helpers\DateHelper;
@endphp
<div class="tab-pane p-20" id="sanggah" role="tabpanel">
    <div class="pull-left">
        <h4>
            <a href="#">Sanggahan</a>
        </h4>
        <span class="pcr-date">{{ $schedule->a_consultation }}</span>
    </div>
    <div class="abs-right">
        <a id="trg_sch_refutal" href="#" class="btn btn-info mt20" data-actual="{{ $schedule->a_consultation }}" data-back="{{ $schedule->b_consultation }}">Atur Jadwal</a>
    </div>
    <div class="clear"></div>

    <p>
        Jaminan Sanggahan Penyedia
    </p>

    <div class="table-responsive">
        <table id="table_assurances" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Penyedia</th>
                    <th>Nilai Jaminan</th>
                    <th>Dokumen yang diperlukan</th>
                    <th>Catatan</th>
                    <th>Tanggal Mulai Jaminan</th>
                    <th>Tanggal Selesai Jaminan</th>
                </tr>
            </thead>
            <tbody>
                @for ($ii = 0; $ii < count($assurances); $ii++)
                    @php
                        $vendor = $assurances[$ii]->user->company;
                    @endphp
                    <tr>
                        <td>{{ $ii + 1 }}</td>
                        <td>
                            <a href="<?php echo url('vendor/detail/' . $vendor->id); ?>">{{ $vendor->name }}</a>
                        </td>
                        <td>
                            {{ $assurances[$ii]['amount'] }}
                        </td>
                        <td>
                            {!! \App\Helpers\AttachmentHelper::render_assurance_file($assurances[$ii]['id']) !!}
                        </td>
                        <td>
                            {{ $assurances[$ii]['notes'] }}
                        </td>
                        <td>
                            {{ DateHelper::long_format($assurances[$ii]['start_date']) }}
                        </td>
                        <td>
                            {{ DateHelper::long_format($assurances[$ii]['end_date']) }}
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div><!--end .table-responsive -->
    
    <p>
        Upload BA Sanggahan
    </p>

    <div class="row">
        <div class="col-md-6">
            @if($file_refutal != null)
                <p>BA Sanggahan saat ini: </p>
                <a href="/uploads/{{ $file_refutal->filepath }}" target="_blank">{{ $file_refutal->filename }}</a>
            @endif
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                <p class="help-block st-help-block">Unggah BA Sanggahan</p>
                <input type="file" class="form-control" id="st08_file" name="st08_file">
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <p>
        Evaluasi Sanggahan
    </p>
    <form id="form_refutal" class="form floating-label form-validation" role="form" action="/pengadaan/atur/sanggahan" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="procurement_id" value="{{ $procurement->id }}">
        <input type="hidden" name="item[old_winner]" value="{{ $current_winner }}">
        <input type="hidden" id="ss_evaluation" value="{{ $refutal->type_id }}">
        <div class="row">
            <div class="form-group ">
                <div class="col-sm-12">
                    <label class="radio-inline radio-styled">
                        <input class="ss_evaluation" type="radio" name="item[type_id]" value="0" />
                        <span>Tidak ada sanggahan</span>
                    </label>
                    <label class="radio-inline radio-styled">
                        <input class="ss_evaluation"  type="radio" name="item[type_id]" value="1" />
                        <span>Sanggahan diterima</span>
                    </label>
                    <label class="radio-inline radio-styled">
                        <input class="ss_evaluation"  type="radio" name="item[type_id]" value="2" />
                        <span>Sanggahan tidak diterima</span>
                    </label>
                </div>
                <div class="clear"></div>
            </div>
            <div id="ss_change_winner" class="row hidden-block">
                <div class="col-sm-6">
                    <div class="form-group floating-label">
                        <input type="hidden" name="new_winner" id="ss_new_winner" value="{{ $refutal->new_winner }}" disabled="disabled">
                        <label>Pilih Pemenang Baru</label>
                        <select id="ss_new_vendor_picker" class="form-control select2-list" name="item[new_winner]">
                            <option value=""></option>
                            @for ($ii = 0; $ii < count($enrollments); $ii++)
                                @php
                                    $vendor = $enrollments[$ii]->vendor;
                                @endphp
                                @if($current_winner != $vendor->id)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group floating-label">
                        <label>Penjelasan Hasil Sanggah</label>
                        <textarea name="item[evaluation]" class="form-control" rows="2">{{ $refutal->evaluation }}</textarea>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12">
           <input type="submit" id="submit" class="btn btn-primary mt25" value="Simpan Evaluasi">
        </div>
    </div>
    <hr>
</div>

@push('jspage')
    <script>
        $(document).ready(function(){
            $('.ss_evaluation').on('change', function(){
                var value   = $(this).val();
                if(value == 1) {
                    $('#ss_change_winner').show();
                } else {
                    $('#ss_change_winner').hide();
                }
            })

            var ss_evaluation   = $('#ss_evaluation').val();
            if(ss_evaluation == '') {
                ss_evaluation   = 0;
            }
            $('.ss_evaluation').each(function(){
                if($(this).val() == ss_evaluation) {
                    $(this).trigger('click');
                }
            });

            var ss_new_winner   = $('#ss_new_winner').val();
            $('#ss_new_vendor_picker').val(ss_new_winner);
            $('#ss_new_vendor_picker').change();

            $('#trg_refutal').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_refutal').submit();
                }
                event.preventDefault();
            });

            $('#trg_sch_refutal').on('click', function(event){
                var $el     = $(this);
                $('#sch_tab').val('sanggah');
                $('#sch_part').val('consultation');

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
