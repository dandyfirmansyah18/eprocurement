@php
    use \App\Helpers\DateHelper;
@endphp

<div class="card panel collapsed">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#tab_submission" data-target="#subm_addition">
        <header class="teksutama">
            Pemasukan Penawaran Tahap 2
            <br>
            @if($schedule->a_submission2 != null)
                <span class="pcr-date">
                    {{ $schedule->a_submission2 }}
                </span>
            @endif
        </header>
        <div class="tools">
          <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
        </div>
    </div>
    <div id="subm_addition" class="collapse">
        <div class="card-body acccardbody">
            <br />
            <div class="judulformtop">
                Daftar penawaran masuk
            </div>
            <div class="abs-right">
                <a id="trg_sch_submission2" href="#" class="btn btn-info mt20" data-actual="{{ $schedule->a_submission2 }}" data-back="{{ $schedule->b_submission2 }}">Atur Jadwal</a>
            </div>

            <h4>Daftar peserta yang <strong>belum</strong> mengupload dokumen penawaran tahap 2 </h4>
            <ol>
                @for ($ii = 0; $ii < count($unoffered_mores); $ii++)
                    <li>{{ $unoffered_mores[$ii]->vendor->name }}</li>
                @endfor
            </ol>
            <br />
            <h4>Daftar peserta yang <strong>sudah</strong> mengupload dokumen penawaran tahap 2 </h4>
            <ol>
                @for ($ii = 0; $ii < count($offered_mores); $ii++)
                    @php
                        $offering = $offered_mores[$ii]->offering2();
                    @endphp
                    <li>{{ $offered_mores[$ii]->vendor->name }}&nbsp;({{ DateHelper::time_format($offering->created_at) }})</li>
                @endfor
            </ol>
            <br />
            <hr>

            <div class="judulformtop">
                Undangan Pembuktian Dokumen Penawaran Tahap 2
            </div>
            <p>Undangan ini akan dikirimkan otomatis saat periode upload dokumen penawaran berakhir</p>
            <form id="form_ssub2_invitation" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/pengadaan/atur/undangan" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                <input type="hidden" name="tab_path" value="tawareval" />
                <input type="hidden" name="item[purpose]" value="submission2" />
                <div class="row">
                    <div class="col-md-6">
                        @if($file_submission2 != null)
                            <p>Undangan saat ini: </p>
                            <a href="/uploads/{{ $file_submission2->filepath }}" target="_blank">{{ $file_submission2->filename }}</a>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="file" class="form-control" name="invitation_doc">
                            <p class="help-block">Upload Undangan baru</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group date" id="inv_submission2_block">
                                <div class="input-group-content">
                                    <input type="text" class="form-control" id="inv_submission2" name="item[activity_date]" value="{{ DateHelper::datepicker($inv_submission2->activity_date) }}">
                                    <label>Tanggal kegiatan</label>
                                    <p class="help-block">tanggal/bulan/tahun</p>
                                </div>
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="item[location]" value="{{ $inv_submission2->location }}">
                            <label>Lokasi Kegiatan</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group floating-label">
                            <textarea type="text" class="form-control" name="item[foreword]">{{ $inv_submission2->foreword }}</textarea>
                            <label>Kata Pengantar Undangan</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <a id="trg_ssub2_invitation" href="#" class="btn btn-default-bright">
                            <i class="fa fa-save"></i>&nbsp;Simpan Undangan
                        </a>
                    </div>
                </div>
            </form>
            <hr>

            Status Undangan:
            <br>
            @if($schedule->a_submission2 != null)
                @php
                    $date_diff  = DateHelper::end_date_diff($schedule->a_submission2)
                @endphp
                @if($date_diff < 0)
                    <i class="fa fa-circle"></i> Belum dikirim. Akan dikirimkan pada {{ explode(' - ', $schedule->a_submission2)[1] }}
                @else
                    <i class="fa fa-check-circle"></i> Sudah dikirimkan pada {{ explode(' - ', $schedule->a_submission2)[1] }}
                @endif
            @else
                <i class="fa fa-circle"></i> Belum dikirim. Harap mengatur jadwal kegiatan terlebih dahulu.
            @endif
            <hr>
        </div>
    </div>
</div><!--end .panel -->

@push('jspage')
    <script>
        $(document).ready(function(){
            $('#inv_submission2_block').datepicker({
                autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
            });

            $('#trg_ssub2_invitation').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_ssub2_invitation').submit();
                }
                event.preventDefault();
            });

            $('#trg_sch_submission2').on('click', function(event){
                var $el     = $(this);
                $('#sch_tab').val('tawareval');
                $('#sch_part').val('submission2');

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
