@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

      <header class="teksutama">
          <a href="#">Pembukaan dan Pembuktian Penawaran</a>
          <br>
          @if($schedule->a_tender != null)
            <span class="pcr-date">
                {{ $schedule->a_tender }}
            </span>
          @endif
      </header>
      <hr>
        <div class="card-body acccardbody">
            <br />
            <p>
                Daftar Dokumen yang sudah Diupload peserta
            </p>
            <div class="abs-right">
                <a id="trg_sch_tender" href="#" class="btn btn-info mt20" data-actual="{{ $schedule->a_tender }}" data-back="{{ $schedule->b_tender }}">Atur Jadwal</a>
            </div>
            <div class="table-responsive"> 
            <table class="table">
                <thead>
                    <td>Nama Perusahaan</td>
                    <td>Waktu upload</td>
                    <td>File</td>
                    <td>Nilai Penawaran</td>
                    <td>Didownload panitia</td>
                </thead>
                @for ($ii = 0; $ii < count($offereds); $ii++)
                    @php
                        $st_offering   = $offereds[$ii]->offering();
                        $st_tender  = $offereds[$ii]->tender;
                    @endphp
                    <tr>
                        <td>{{ $offereds[$ii]->vendor->name }}</td>
                        <td>{{ DateHelper::time_format($st_offering->created_at) }}</td>
                        <td class="trg_open_tender" data-id="{{ $offereds[$ii]->id }}">
                            {!! FormHelper::file_tag($st_offering->filepath, $st_offering->filename) !!}
                        </td>
                        @if($st_tender != null)
                            <td><textarea data-id="{{ $offereds[$ii]->id }}" class="trg_st_amount form-control">{!! $st_tender->amount !!}</textarea></td>
                            <td>{{ DateHelper::time_format($st_tender->download) }}</td>
                        @else
                            <td><textarea data-id="{{ $offereds[$ii]->id }}" class="trg_st_amount form-control"></textarea></td>
                            <td>Belum didownload</td>
                        @endif
                    </tr>
                @endfor
            </table>
            </div>
            <div class="clear"></div>
            <div class="pull-right">
                @if(count($offereds) > 0)
                    <a id="trg_sten_amount" href="#" class="btn btn-default-bright">
                        <i class="fa fa-save"></i> Simpan Nilai Penawaran
                    </a>
                @else
                    <a href="#" class="btn btn-default-bright" disabled>
                        <i class="fa fa-save"></i> Simpan Nilai Penawaran
                    </a>
                @endif
            </div>
            <div class="clear"></div>
            <hr>
                <br>
            <h5>BA Pembuktian Penawaran</h5>
            <hr>
            <form id="form_sten_memorandum" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/pengadaan/atur/memoranda" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                <input type="hidden" name="tab_path" value="buka" />
                <input type="hidden" name="item[purpose]" value="tender" />
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <p class="help-block">Upload BA Pembuktian Penawaran</p>
                            <input type="file" class="form-control" name="memorandum_doc">
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($file_tender != null)
                            <p>BA Pembuktian Penawaran saat ini: </p>
                            <a href="/uploads/{{ $file_tender->filepath }}" target="_blank">{{ $file_tender->filename }}</a>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group floating-label">
                            <label for="regular2">Catatan Pembuktian Penawaran</label>
                            <textarea type="text" class="form-control" name="item[notes]">{{ $ba_tender->notes }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a id="trg_sten_memorandum" href="#" class="btn btn-default-bright"><i class="fa fa-save"></i> Simpan</a>
                    </div>
                </div>
            </form>
            <hr>
            Log Perubahan dokumen ini:
            @for ($ii = 0; $ii < count($log_tenders); $ii++)
                @if($log_tenders[$ii]->old_name == 'none')
                    <br>Upload file awal &ldquo;{{ $log_tenders[$ii]->new_name }}&rdquo;  ( {{ DateHelper::long_format($log_tenders[$ii]->created_at) }} )
                @else
                    <br>Perubahan file &ldquo;{{ $log_tenders[$ii]->new_name }}&rdquo; ( {{ DateHelper::long_format($log_tenders[$ii]->created_at) }} )
                @endif
            @endfor
            <hr>
        
            <div class="hidden-block">
                <form id="form_stg_tender_open" action="/pengadaan/atur/pembukaan" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                    <input id="sta_enrollment_id" type="hidden" name="item[enrollment_id]" value="" />
                    <input id="sta_type" type="hidden" name="item[type]" value="0" />
                </form>
                <form id="form_stg_tender_save" action="/pengadaan/atur/tender" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                    <input type="hidden" name="tab_path" value="buka" />
                    <input id="stb_enrollment_id" type="hidden" name="item[enrollment_ids]" value="" />
                    <input id="stb_type" type="hidden" name="item[type]" value="0" />
                    <input id="stb_amount" type="hidden" name="item[amounts]" value="" />
                </form>
            </div>
        </div>

@push('jspage')
    <script>
        $(document).ready(function(){
            $('#trg_sten_memorandum').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_sten_memorandum').submit();
                }
                event.preventDefault();
            });

            $('#trg_sten_amount').on('click', function(event){
                var confirmation    = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    var ids         = '';
                    var amounts     = '';
                    $('.trg_st_amount').each(function(){
                        var $el     = $(this);
                        ids         += $el.data('id') + ','; 
                        amounts     += $el.val() + ',';
                    });
                    $('#stb_enrollment_id').val(ids);
                    $('#stb_amount').val(amounts);
                    $('form#form_stg_tender_save').submit();
                }
                event.preventDefault();
            });

            $('.trg_open_tender a').each(function(){
                var $el     = $(this);
                var en_id   = $el.parent().data('id');
                $('#sta_enrollment_id').val(en_id);
                $el.on('click', function(){
                    var form = $('form#form_stg_tender_open');
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

            $('#trg_sch_tender').on('click', function(event){
                var $el     = $(this);
                $('#sch_tab').val('buka');
                $('#sch_part').val('tender');

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
