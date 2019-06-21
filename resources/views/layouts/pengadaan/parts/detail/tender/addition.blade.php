@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="card panel collapsed">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#tab_tender" data-target="#stend_addition">
      <header class="teksutama">
          Pembukaan dan Pembuktian Penawaran 2
          <br>
          @if($schedule->a_tender2 != null)
            <span class="pcr-date">
                {{ $schedule->a_tender2 }}
            </span>
          @endif
      </header>
      <div class="tools">
        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
      </div>
    </div>
    <div id="stend_addition" class="collapse">
        <div class="card-body acccardbody">
            <br />
            <div class="judulformtop">
                Daftar Dokumen 2 yang sudah Diupload peserta
            </div>
            <div class="abs-right">
                <a id="trg_sch_tender2" href="#" class="btn btn-info mt20" data-actual="{{ $schedule->a_tender2 }}" data-back="{{ $schedule->b_tender2 }}">Atur Jadwal</a>
            </div>

            <table class="table table-bordered order-column hover">
                <thead>
                    <td>Nama Perusahaan</td>
                    <td>Waktu upload</td>
                    <td>File</td>
                    <td>Nilai Penawaran</td>
                    <td>Didownload panitia</td>
                </thead>
                @for ($ii = 0; $ii < count($offered_mores); $ii++)
                    @php
                        $st_offering    = $offered_mores[$ii]->offering2();
                        $st_tender      = $offered_mores[$ii]->tender2;
                    @endphp
                    <tr>
                        <td>{{ $offered_mores[$ii]->vendor->name }}</td>
                        <td>{{ DateHelper::time_format($st_offering->created_at) }}</td>
                        <td class="trg_open_tender2" data-id="{{ $offered_mores[$ii]->id }}">
                            {!! FormHelper::file_tag($st_offering->filepath, $st_offering->filename) !!}
                        </td>
                        @if($st_tender != null)
                            <td><textarea data-id="{{ $offered_mores[$ii]->id }}" class="trg_st_amount form-control">{!! $st_tender->amount !!}</textarea></td>
                            <td>{{ DateHelper::time_format($st_tender->download) }}</td>
                        @else
                            <td><textarea data-id="{{ $offered_mores[$ii]->id }}" class="trg_st_amount form-control"></textarea></td>
                            <td>Belum didownload</td>
                        @endif
                    </tr>
                @endfor
            </table>
            <div class="clear"></div>
            <div class="pull-right">
                @if(count($offered_mores) > 0)
                    <a id="trg_sten_amount2" href="#" class="btn btn-default-bright">
                        <i class="fa fa-save"></i> Simpan Nilai Penawaran
                    </a>
                @else
                    <a href="#" class="btn btn-default-bright" disabled>
                        <i class="fa fa-save"></i> Simpan Nilai Penawaran
                    </a>
                @endif
            </div>
            <div class="clear"></div>
        
            <h4>BA Pembuktian Penawaran 2</h4>
            <form id="form_sten_memorandum2" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/pengadaan/atur/memoranda" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                <input type="hidden" name="tab_path" value="buka" />
                <input type="hidden" name="item[purpose]" value="tender2" />
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="file" class="form-control" name="memorandum_doc">
                            <p class="help-block">Upload BA Pembuktian Penawaran</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($file_tender2 != null)
                            <p>BA Pembuktian Penawaran saat ini: </p>
                            <a href="/uploads/{{ $file_tender2->filepath }}" target="_blank">{{ $file_tender2->filename }}</a>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group floating-label">
                            <textarea type="text" class="form-control" name="item[notes]">{{ $ba_tender2->notes }}</textarea>
                            <label for="regular2">Catatan Pembuktian Penawaran</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a id="trg_sten_memorandum2" href="#" class="btn btn-default-bright"><i class="fa fa-save"></i> Simpan</a>
                    </div>
                </div>
            </form>
            <hr>
            Log Perubahan dokumen ini:
            @for ($ii = 0; $ii < count($log_tender_mores); $ii++)
                @if($log_tender_mores[$ii]->old_name == 'none')
                    <br>Upload file awal &ldquo;{{ $log_tender_mores[$ii]->new_name }}&rdquo;  ( {{ DateHelper::long_format($log_tender_mores[$ii]->created_at) }} )
                @else
                    <br>Perubahan file &ldquo;{{ $log_tender_mores[$ii]->new_name }}&rdquo; ( {{ DateHelper::long_format($log_tender_mores[$ii]->created_at) }} )
                @endif
            @endfor
            <hr>
        
            <div class="hidden-block">
                <form id="form_stg_tender_open2" action="/pengadaan/atur/pembukaan" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                    <input id="sta_enrollment_id2" type="hidden" name="item[enrollment_id]" value="" />
                    <input id="sta_type2" type="hidden" name="item[type]" value="1" />
                </form>
                <form id="form_stg_tender_save2" action="/pengadaan/atur/tender" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                    <input type="hidden" name="tab_path" value="buka" />
                    <input id="stb_enrollment_id2" type="hidden" name="item[enrollment_ids]" value="" />
                    <input id="stb_type2" type="hidden" name="item[type]" value="1" />
                    <input id="stb_amount2" type="hidden" name="item[amounts]" value="" />
                </form>
            </div>
        </div>
    </div>
</div><!--end .panel -->

@push('jspage')
    <script>
        $(document).ready(function(){
            $('#trg_sten_memorandum2').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_sten_memorandum2').submit();
                }
                event.preventDefault();
            });

            $('#trg_sten_amount2').on('click', function(event){
                var confirmation    = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    var ids         = '';
                    var amounts     = '';
                    $('.trg_st_amount2').each(function(){
                        var $el     = $(this);
                        ids         += $el.data('id') + ','; 
                        amounts     += $el.val() + ',';
                    });
                    $('#stb_enrollment_id2').val(ids);
                    $('#stb_amount2').val(amounts);
                    $('form#form_stg_tender_save2').submit();
                }
                event.preventDefault();
            });

            $('.trg_open_tender2 a').each(function(){
                var $el     = $(this);
                var en_id   = $el.parent().data('id');
                $('#sta_enrollment_id2').val(en_id);
                $el.on('click', function(){
                    var form = $('form#form_stg_tender_open2');
                    var form_data = new FormData(form[0]);
                    $.ajax({
                        type: form.attr("method"),
                        url: form.attr("action"),
                        data: form_data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(result){
                            console.log(result);
                        },
                        error: function(error){
                            console.log(error);
                        }
                    });
                });
            });

            $('#trg_sch_tender2').on('click', function(event){
                var $el     = $(this);
                $('#sch_tab').val('buka');
                $('#sch_part').val('tender2');

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
