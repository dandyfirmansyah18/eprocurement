@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="card panel">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#prakualifikasi" data-target="#pra4">
      <header class="teksutama">
          4. Upload Dokumen Prakualifikasi (peserta)
          <br>
          @if($schedule->a_p_upload != null)
              <span class="pcr-date">
                  {{ $schedule->a_p_upload }}
              </span>
          @endif
      </header>
      <div class="tools">
        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
      </div>
    </div>
    <div id="pra4" class="collapse">
      <div class="card-body acccardbody">
        <hr>
        <div class="abs-right">
            <a id="trg_sch_p_upload" href="#" class="btn btn-info mt30" data-actual="{{ $schedule->a_p_upload }}" data-back="{{ $schedule->b_p_upload }}">Atur Jadwal</a>
        </div>
        <h4>Daftar peserta yang <strong>belum</strong> mengupload dokumen prakualifikasi </h4>
        <ol>
            @for ($ii = 0; $ii < count($pre_unoffereds); $ii++)
                <li>{{ $pre_unoffereds[$ii]->vendor->name }}</li>
            @endfor
        </ol>
        <br />
        <h4>Daftar peserta yang <strong>sudah</strong> mengupload dokumen prakualifikasi </h4>
        <ol>
            @for ($ii = 0; $ii < count($pre_offereds); $ii++)
                @php
                    $pre_offering = $pre_offereds[$ii]->offering();
                @endphp
                <li>{{ $pre_offereds[$ii]->vendor->name }}&nbsp;({{ DateHelper::time_format($pre_offering->created_at) }})</li>
            @endfor
        </ol>

          <hr>
          <h4>Undangan Pembuktian Prakualifikasi</h4>
          <p>Undangan ini akan dikirimkan otomatis saat periode upload dokumen prakualifikasi berakhir</p>
          <form id="form_pupl_invitation" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/pengadaan/atur/undangan" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
              <input type="hidden" name="tab_path" value="pra" />
              <input type="hidden" name="item[purpose]" value="p_upload" />
              <div class="row">
                  <div class="col-md-6">
                      @if($file_p_upload != null)
                          <p>Undangan saat ini: </p>
                          <a href="/uploads/{{ $file_p_upload->filepath }}" target="_blank">{{ $file_p_upload->filename }}</a>
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
                          <div class="input-group date" id="inv_p_upload_block">
                              <div class="input-group-content">
                                  <input type="text" class="form-control" id="inv_p_upload" name="item[activity_date]" value="{{ DateHelper::datepicker($inv_p_upload->activity_date) }}">
                                  <label>Tanggal kegiatan</label>
                                  <p class="help-block">tanggal/bulan/tahun</p>
                              </div>
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <input type="text" class="form-control" name="item[location]" value="{{ $inv_p_upload->location }}">
                          <label>Lokasi Kegiatan</label>
                      </div>
                  </div>
                  <div class="col-md-12">
                      <div class="form-group floating-label">
                          <textarea type="text" class="form-control" name="item[foreword]">{{ $inv_p_upload->foreword }}</textarea>
                          <label>Kata Pengantar Undangan</label>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <a id="trg_pupl_invitation" href="#" class="btn btn-default-bright">
                          <i class="fa fa-save"></i>&nbsp;Simpan Undangan
                      </a>
                  </div>
              </div>
          </form>
          <hr>
          Status Undangan:
          <br />
          @if($schedule->a_p_upload != null)
              @php
                  $date_diff  = DateHelper::end_date_diff($schedule->a_p_upload)
              @endphp
              @if($date_diff < 0)
                  <i class="fa fa-circle"></i> Belum dikirim. Akan dikirimkan pada {{ explode(' - ', $schedule->a_p_upload)[1] }}
              @else
                  <i class="fa fa-check-circle"></i> Sudah dikirimkan pada {{ explode(' - ', $schedule->a_p_upload)[1] }}
              @endif
          @else
              <i class="fa fa-circle"></i> Belum dikirim. Harap mengatur jadwal kegiatan terlebih dahulu.
          @endif
        </div>
    </div>
</div><!--end .panel -->

@push('jspage')
    <script>
        $(document).ready(function(){
            $('#inv_p_upload_block').datepicker({
                autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
            });

            $('#trg_pupl_invitation').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_pupl_invitation').submit();
                }
                event.preventDefault();
            });

            $('#trg_sch_p_upload').on('click', function(event){
                var $el     = $(this);
                $('#sch_tab').val('pra');
                $('#sch_part').val('p_upload');

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