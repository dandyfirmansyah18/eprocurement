@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="card panel">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#prakualifikasi" data-target="#pra5">
      <header class="teksutama">
          5. Pembuktian Prakualifikasi
          <br>
          @if($schedule->a_p_evaluation != null)
              <span class="pcr-date">
                  {{ $schedule->a_p_evaluation }}
              </span>
          @endif
      </header>
      <div class="tools">
        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
      </div>
    </div>
    <div id="pra5" class="collapse">
      <div class="card-body acccardbody">
        <hr>
        <div class="abs-right">
            <a id="trg_sch_p_evaluation" href="#" class="btn btn-info mt30" data-actual="{{ $schedule->a_p_evaluation }}" data-back="{{ $schedule->b_p_evaluation }}">Atur Jadwal</a>
        </div>
          <h4>Daftar Dokumen yang Diupload peserta</h4>
          <table class="table table-bordered order-column hover">
            <thead>
              <td>Nama Perusahaan</td>
              <td>waktu upload</td>
              <td>file</td>
              <td>didownload panitia</td>
            </thead>
            <tbody>
                @for ($ii = 0; $ii < count($pre_offereds); $ii++)
                    @php
                        $st_offering   = $pre_offereds[$ii]->pre_offering();
                        $st_tender  = $pre_offereds[$ii]->pre_tender;
                    @endphp
                    <tr>
                        <td>{{ $pre_offereds[$ii]->vendor->name }}</td>
                        <td>{{ DateHelper::time_format($st_offering->created_at) }}</td>
                        <td class="trg_open_pre_tender" data-id="{{ $pre_offereds[$ii]->id }}">
                            {!! FormHelper::file_tag($st_offering->filepath, $st_offering->filename) !!}
                        </td>
                        @if($st_tender != null)
                            <td>{{ DateHelper::time_format($st_tender->download) }}</td>
                        @else
                            <td>Belum didownload</td>
                        @endif
                    </tr>
                @endfor
            </tbody>
          </table>

          <h4>BA Pembuktian Prakualifikasi</h4>
          <form id="form_peva_memorandum" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/pengadaan/atur/memoranda" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
              <input type="hidden" name="tab_path" value="pra" />
              <input type="hidden" name="item[purpose]" value="p_evaluation" />
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <input type="file" class="form-control" name="memorandum_doc">
                          <p class="help-block">Upload BA Pembuktian Prakualifikasi</p>
                      </div>
                  </div>
                  <div class="col-md-6">
                      @if($file_p_evaluation != null)
                          <p>BA Pembuktian Prakualifikasi saat ini: </p>
                          <a href="/uploads/{{ $file_p_evaluation->filepath }}" target="_blank">{{ $file_p_evaluation->filename }}</a>
                      @endif
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group floating-label">
                          <textarea type="text" class="form-control" name="item[notes]">{{ $ba_p_evaluation->notes }}</textarea>
                          <label for="regular2">Catatan Pembuktian Prakualifikasi</label>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <a id="trg_peva_memorandum" href="#" class="btn btn-default-bright"><i class="fa fa-save"></i> Simpan</a>
                  </div>
              </div>
          </form>
          <hr>
          Log Perubahan dokumen ini:
          @for ($ii = 0; $ii < count($log_p_evaluation); $ii++)
              @if($log_p_evaluation[$ii]->old_name == 'none')
                  <br>Upload file awal &ldquo;{{ $log_p_evaluation[$ii]->new_name }}&rdquo;  ( {{ DateHelper::long_format($log_p_evaluation[$ii]->created_at) }} )
              @else
                  <br>Perubahan file &ldquo;{{ $log_p_evaluation[$ii]->new_name }}&rdquo; ( {{ DateHelper::long_format($log_p_evaluation[$ii]->created_at) }} )
              @endif
          @endfor
          <hr>
        
        <div class="hidden-block">
            <form id="form_stg_pre_tender_open" action="/pengadaan/atur/pra_pembukaan" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                <input id="stp_enrollment_id" type="hidden" name="item[enrollment_id]" value="" />
                <input id="stp_type" type="hidden" name="item[type]" value="3" />
            </form>
        </div>
      </div>
    </div>
</div><!--end .panel -->

@push('jspage')
    <script>
        $(document).ready(function(){
            $('#trg_peva_memorandum').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_peva_memorandum').submit();
                }
                event.preventDefault();
            });

            $('.trg_open_pre_tender a').each(function(){
                var $el     = $(this);
                var en_id   = $el.parent().data('id');
                $('#stp_enrollment_id').val(en_id);
                $el.on('click', function(){
                    var form = $('form#form_stg_pre_tender_open');
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

            $('#trg_sch_p_evaluation').on('click', function(event){
                var $el     = $(this);
                $('#sch_tab').val('pra');
                $('#sch_part').val('p_evaluation');

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
