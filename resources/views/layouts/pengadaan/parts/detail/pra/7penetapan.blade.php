@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="card panel">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#prakualifikasi" data-target="#pra7">
      <header class="teksutama">
          7. Penetapan dan Pengumuman Lolos Prakualifikasi
          <br>
          @if($schedule->a_p_result != null)
              <span class="pcr-date">
                  {{ $schedule->a_p_result }}
              </span>
          @endif
      </header>
      <div class="tools">
        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
      </div>
    </div>
    <div id="pra7" class="collapse">
      <div class="card-body acccardbody">
        <hr>
        <div class="abs-right">
            <a id="trg_sch_p_result" href="#" class="btn btn-info mt30" data-actual="{{ $schedule->a_p_result }}" data-back="{{ $schedule->b_p_result }}">Atur Jadwal</a>
        </div>
          <h4>Daftar Peserta yang Memenuhi Syarat Prakualifikasi</h4>
          <table class="table table-bordered order-column hover">
            <thead>
              <td>Nama Perusahaan</td>
              <td>waktu upload</td>
              <td>file</td>
              <td>didownload panitia</td>
              <td>evaluasi</td>
            </thead>
            <tbody>
              <form id="form_p_result" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/pengadaan/atur/pra_lolos" method="POST" enctype="multipart/form-data">
                @for ($ii = 0; $ii < count($pre_offereds); $ii++)
                    @php
                        $st_offering   = $pre_offereds[$ii]->pre_offering();
                        $st_tender  = $pre_offereds[$ii]->pre_tender;
                        $st_eval  = $pre_offereds[$ii]->pre_evaluation;
                    @endphp
                    <tr>
                        <td>
                          {{ csrf_field() }}
                          <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                          <input type="hidden" name="enrollment_id[]" value="{{ $pre_offereds[$ii]->id }}" />
                          {{ $pre_offereds[$ii]->vendor->name }}
                        </td>
                        <td>{{ DateHelper::time_format($st_offering->created_at) }}</td>
                        <td>
                            {!! FormHelper::file_tag($st_offering->filepath, $st_offering->filename) !!}
                        </td>
                        @if($st_tender != null)
                            <td>{{ DateHelper::time_format($st_tender->download) }}</td>
                        @else
                            <td>Belum didownload</td>
                        @endif
                        <td>
                          @if($st_eval != null)
                            <label class="radio-inline checkbox-styled">
                              <input type="checkbox" class="p-candidate-checker" {{ FormHelper::checked($st_eval->candidate) }} disabled><span>Memenuhi Syarat</span>
                            </label>
                            <br>
                            <textarea class="form-control" name="notes[]" rows="2" cols="80" placeholder="Catatan untuk peserta" disabled>{!! $st_eval->notes !!}</textarea>
                          @else
                            <label class="radio-inline checkbox-styled">
                              <input type="checkbox" class="p-candidate-checker" disabled><span>Memenuhi Syarat</span>
                            </label>
                            <br>
                            <textarea class="form-control" name="notes[]" rows="2" cols="80" placeholder="Catatan untuk peserta" disabled></textarea>
                          @endif
                        </td>
                    </tr>
                @endfor
              </form>
            </tbody>
          </table>
          <div class="clear"></div>
          <div class="pull-right">
            @if(count($pre_offereds) > 0)
              <a id="trg_p_result" href="#" class="btn btn-primary">
                <i class="fa fa-check"></i> Tetapkan Lolos Prakualifikasi
              </a>
            @else
              <a href="#" class="btn btn-primary" disabled>
                <i class="fa fa-check"></i> Tetapkan Lolos Prakualifikasi
              </a>
            @endif
          </div>
          <div class="clear"></div>
          <hr>
            <h4>BA Penetapan Lolos Prakualifikasi</h4>
            <form id="form_pres_memorandum" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/pengadaan/atur/memoranda" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                <input type="hidden" name="tab_path" value="pra" />
                <input type="hidden" name="item[purpose]" value="p_result" />
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="file" class="form-control" name="memorandum_doc">
                            <p class="help-block">Upload BA Penetapan Lolos Prakualifikasi</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($file_p_result != null)
                            <p>BA Penetapan Lolos Prakualifikasi saat ini: </p>
                            <a href="/uploads/{{ $file_p_result->filepath }}" target="_blank">{{ $file_p_result->filename }}</a>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group floating-label">
                            <textarea type="text" class="form-control" name="item[notes]">{{ $ba_p_result->notes }}</textarea>
                            <label for="regular2">Catatan Penetapan Lolos Prakualifikasi</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a id="trg_pres_memorandum" href="#" class="btn btn-default-bright"><i class="fa fa-save"></i> Simpan</a>
                    </div>
                </div>
            </form>
            <hr>
            Log Perubahan dokumen ini:
            @for ($ii = 0; $ii < count($log_p_result); $ii++)
                @if($log_p_result[$ii]->old_name == 'none')
                    <br>Upload file awal &ldquo;{{ $log_p_result[$ii]->new_name }}&rdquo;  ( {{ DateHelper::long_format($log_p_result[$ii]->created_at) }} )
                @else
                    <br>Perubahan file &ldquo;{{ $log_p_result[$ii]->new_name }}&rdquo; ( {{ DateHelper::long_format($log_p_result[$ii]->created_at) }} )
                @endif
            @endfor
            <hr>
      </div>
    </div>
</div><!--end .panel -->

@push('jspage')
    <script>
        $(document).ready(function(){
            $('#trg_pres_memorandum').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_pres_memorandum').submit();
                }
                event.preventDefault();
            });
            
            $('#trg_p_result').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_p_result').submit();
                }
                event.preventDefault();
            });

            $('#trg_sch_p_result').on('click', function(event){
                var $el     = $(this);
                $('#sch_tab').val('pra');
                $('#sch_part').val('p_result');

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