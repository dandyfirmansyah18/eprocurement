@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="card panel">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#prakualifikasi" data-target="#pra6">
      <header class="teksutama">
          6. Evaluasi Prakualifikasi
          <br>
          @if($schedule->a_p_selection != null)
              <span class="pcr-date">
                  {{ $schedule->a_p_selection }}
              </span>
          @endif
      </header>
      <div class="tools">
        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
      </div>
    </div>
    <div id="pra6" class="collapse">
      <div class="card-body acccardbody">
        <hr>
        <div class="abs-right">
            <a id="trg_sch_p_selection" href="#" class="btn btn-info mt30" data-actual="{{ $schedule->a_p_selection }}" data-back="{{ $schedule->b_p_selection }}">Atur Jadwal</a>
        </div>
          <h4>Daftar Peserta untuk Dievaluasi</h4>
          <table class="table table-bordered order-column hover">
            <thead>
              <td>Nama Perusahaan</td>
              <td>waktu upload</td>
              <td>file</td>
              <td>didownload panitia</td>
              <td>evaluasi</td>
            </thead>
            <tbody>
              <form id="form_pcan_eval" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/pengadaan/atur/pra_evaluasi" method="POST" enctype="multipart/form-data">
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
                              <input type="hidden" name="candidate[]" class="p_candidate_checked" value="{{ $st_eval->candidate }}" />
                              <label class="radio-inline checkbox-styled">
                                <input type="checkbox" class="p-candidate-checker" {{ FormHelper::checked($st_eval->candidate) }} ><span>Memenuhi Syarat</span>
                              </label>
                              <br>
                              <textarea class="form-control" name="notes[]" rows="2" cols="80" placeholder="Catatan untuk peserta">{!! $st_eval->notes !!}</textarea>
                          @else
                              <input type="hidden" name="candidate[]" class="p_candidate_checked" value="" />
                              <label class="radio-inline checkbox-styled">
                                <input type="checkbox" class="p-candidate-checker" ><span>Memenuhi Syarat</span>
                              </label>
                              <br>
                              <textarea class="form-control" name="notes[]" rows="2" cols="80" placeholder="Catatan untuk peserta"></textarea>
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
              <a id="trg_pcan_eval" href="#" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan Evaluasi
              </a>
            @else
              <a href="#" class="btn btn-primary" disabled>
                <i class="fa fa-save"></i> Simpan Evaluasi
              </a>
            @endif
          </div>
          <div class="clear"></div>

      </div>
    </div>
</div><!--end .panel -->

@push('jspage')
    <script>
        $(document).ready(function(){
            $('#trg_pcan_eval').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_pcan_eval').submit();
                }
                event.preventDefault();
            });

            $('.p-candidate-checker').each(function(){
              var $el = $(this);
              $el.on('click', function(){
                $el.parent().prev().val($el.prop('checked'));
              });
            });

            $('#trg_sch_p_selection').on('click', function(event){
                var $el     = $(this);
                $('#sch_tab').val('pra');
                $('#sch_part').val('p_selection');

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