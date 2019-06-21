@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="tab-pane " id="eval">
  <div class="pull-left">
      <h3>
          Evaluasi Pengadaan
          <span class="pcr-date">{{ $schedule->a_evaluation }}</span>
      </h3>
  </div>
  <div class="pull-right">
      <a id="trg_sch_evaluation" href="#" class="btn btn-info mt20" data-actual="{{ $schedule->a_evaluation }}" data-back="{{ $schedule->b_evaluation }}">Atur Jadwal</a>
  </div>
  <div class="clear"></div>

  <div class="judulformtop">
    Daftar Peserta untuk Dievaluasi
  </div>

  <table class="table table-bordered order-column hover mt10">
    <thead>
      <td>Nama Perusahaan</td>
      <td>waktu upload</td>
      <td>file</td>
      <td>didownload panitia</td>
      <td>nilai penawaran</td>
      <td>evaluasi</td>
    </thead>
    <tbody>
    @for ($ii = 0; $ii < count($offereds); $ii++)
      @php
        $vendor     = $offereds[$ii]->vendor;
        $evaluation = $offereds[$ii]->evaluation;
        $offering   = $offereds[$ii]->offering();
        $se_tender  = $offereds[$ii]->tender;
      @endphp
      <tr>
        <td><a href="<?php echo url('vendor/detail/' . $vendor->id); ?>">{{ $vendor->name }}</a></td>
        <td>{{ DateHelper::time_format($offering->created_at) }}</td>
        <td>
            {!! FormHelper::file_tag($offering->filepath, $offering->filename) !!}
        </td>
        @if($se_tender != null)
            <td>{{ DateHelper::time_format($se_tender->download) }}</td>
            <td>{!! $se_tender->amount !!}</td>
        @else
            <td>Belum didownload</td>
            <td></td>
        @endif
        <td>
          @if($measurement->scoring)
            @if($evaluation != null)
              <a href="#" class="btn btn-default-bright trg_modal_se_scoring"  data-enrollment="{{ $offereds[$ii]->id }}" data-money="{{ $evaluation->monev_score }}" data-technicals="{{ $evaluation->techevs }}" data-toggle="modal" data-target="#evaluasi"><i class="fa fa-pencil"></i> Evaluasi </a>
            @else
              <a href="#" class="btn btn-default-bright trg_modal_se_scoring"  data-enrollment="{{ $offereds[$ii]->id }}" data-toggle="modal" data-target="#evaluasi"><i class="fa fa-pencil"></i> Evaluasi </a>
            @endif
          @else
            @if($evaluation != null)
            <a href="#" class="btn btn-default-bright trg_modal_se_nonscoring"  data-enrollment="{{ $offereds[$ii]->id }}" data-toggle="modal" data-target="#non_scoring" data-doc="{{ $evaluation->pass_doc }}" data-adm="{{ $evaluation->pass_adm }}" data-second="{{ $evaluation->pass_second }}" data-notes="{{ $evaluation->notes }}">
              <i class="fa fa-pencil"></i> Evaluasi 
            </a>
            @else
              <a href="#" class="btn btn-default-bright trg_modal_se_scoring"  data-enrollment="{{ $offereds[$ii]->id }}" data-toggle="modal" data-target="#evaluasi"><i class="fa fa-pencil"></i> Evaluasi </a>
            @endif
          @endif
        </td>          
      </tr>
    @endfor
    </tbody>
  </table>

  <div class="judulform">Undangan Negosiasi
  </div>
  <form id="form_sev_invitation" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/pengadaan/atur/undangan" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
  <input type="hidden" name="tab_path" value="eval" />
  <input type="hidden" name="item[purpose]" value="evaluation" />
  <input type="hidden" name="item[enrollment_id]" value="{{ $candidate_highest }}" />
  <div class="row">
      <div class="col-md-6">
          @if($file_evaluation != null)
              <p>Undangan saat ini: </p>
              <a href="/uploads/{{ $file_evaluation->filepath }}" target="_blank">{{ $file_evaluation->filename }}</a>
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
              <div class="input-group date" id="inv_evaluation_block">
                  <div class="input-group-content">
                      <input type="text" class="form-control" id="inv_evaluation" name="item[activity_date]" value="{{ DateHelper::datepicker($inv_evaluation->activity_date) }}">
                      <label>Tanggal kegiatan</label>
                      <p class="help-block">tanggal/bulan/tahun</p>
                  </div>
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
          </div>
      </div>
      <div class="col-md-6">
          <div class="form-group">
              <input type="text" class="form-control" name="item[location]" value="{{ $inv_evaluation->location }}">
              <label>Lokasi Kegiatan</label>
          </div>
      </div>
      <div class="col-md-12">
          <div class="form-group floating-label">
              <textarea type="text" class="form-control" name="item[foreword]">{{ $inv_evaluation->foreword }}</textarea>
              <label>Kata Pengantar Undangan</label>
          </div>
      </div>
      <div class="col-md-6">
        @if($candidate_highest > 0)
          <a id="trg_sev_invitation" href="#" class="btn btn-default-bright">
              <i class="fa fa-save"></i>&nbsp;Simpan Undangan
          </a>
        @else
          <a href="#" class="btn btn-default-bright" disabled>
              <i class="fa fa-save"></i>&nbsp;Simpan Undangan
          </a>
        @endif
      </div>
  </div>
</form>
  <hr>
  Status Undangan:
  <br>
  @if($schedule->a_evaluation != null)
      @php
          $date_diff  = DateHelper::end_date_diff($schedule->a_evaluation)
      @endphp
      @if($date_diff < 0)
          <i class="fa fa-circle"></i> Belum dikirim. Akan dikirimkan pada {{ explode(' - ', $schedule->a_evaluation)[1] }}
      @else
          <i class="fa fa-check-circle"></i> Sudah dikirimkan pada {{ explode(' - ', $schedule->a_evaluation)[1] }}
      @endif
  @else
      <i class="fa fa-circle"></i> Belum dikirim. Harap mengatur jadwal kegiatan terlebih dahulu.
  @endif

</div>

@push('modal')
<!--Modal evaluasi teknis-->
<div class="modal fade" id="evaluasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="formModalLabel">Evaluasi Penawaran Metode Scoring (Biaya dan Teknis)</h4>
        </div>
        <div class="modal-body">
          <form id="form_se_scoring" class="form-horizontal" role="form" novalidate="novalidate" action="/pengadaan/evaluasi_scoring" method="POST">
            <input type="hidden" name="enrollment_id" id="se_m_enrollment" value="" />
            <input type="hidden" name="criterion" id="se_m_criterion" value="{{ count($criterions) }}" />
            <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
            {{ csrf_field() }}
            <p>Penilaian Biaya</p>
            <div class="form-group" id="se_monev">
            <label class="col-sm-3 control-label">Penilaian</label>
            <div class="col-sm-9">
              <label class="radio-inline radio-styled">
                <input type="radio" class="money-radio" name="money_mark" value="1"><span>1</span>
              </label>
              <label class="radio-inline radio-styled">
                <input type="radio" class="money-radio" name="money_mark" value="2"><span>2</span>
              </label>
              <label class="radio-inline radio-styled">
                <input type="radio" class="money-radio" name="money_mark" value="3"><span>3</span>
              </label>
              <label class="radio-inline radio-styled">
                <input type="radio" class="money-radio" name="money_mark" value="4"><span>4</span>
              </label>
              <label class="radio-inline radio-styled">
                <input type="radio" class="money-radio" name="money_mark" value="5"><span>5</span>
              </label>
            </div><!--end .col -->
          </div><!--end .form-group -->
            <hr>
            <p>Penilaian Teknis</p>
            @for ($ii = 0; $ii < count($criterions); $ii++)
              <div class="form-group" id="criterion_{{ $criterions[$ii]->id }}">
                <input type="hidden" name="counter_id[{{ $criterions[$ii]->id }}]" value="{{ $criterions[$ii]->id }}" />
                <label class="col-sm-3 control-label">{{ $criterions[$ii]->title }}</label>
                <div class="col-sm-9">
                  <label class="radio-inline radio-styled">
                    <input type="radio" class="tech-radio" name="mark[{{ $criterions[$ii]->id }}]" value="1"><span>1</span>
                  </label>
                  <label class="radio-inline radio-styled">
                    <input type="radio" class="tech-radio" name="mark[{{ $criterions[$ii]->id }}]" value="2"><span>2</span>
                  </label>
                  <label class="radio-inline radio-styled">
                    <input type="radio" class="tech-radio" name="mark[{{ $criterions[$ii]->id }}]" value="3"><span>3</span>
                  </label>
                  <label class="radio-inline radio-styled">
                    <input type="radio" class="tech-radio" name="mark[{{ $criterions[$ii]->id }}]" value="4"><span>4</span>
                  </label>
                  <label class="radio-inline radio-styled">
                    <input type="radio" class="tech-radio" name="mark[{{ $criterions[$ii]->id }}]" value="5"><span>5</span>
                  </label>
                </div><!--end .col -->
              </div><!--end .form-group -->
            @endfor
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button id="trg_se_scoring" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Evaluasi</button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>

<!--Modal evaluasi teknis-->
<div class="modal fade" id="non_scoring" tabindex="-1" role="dialog" aria-labelledby="non_scoring_label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="non_scoring_label">Evaluasi Penawaran Metode Non Scoring</h4>
        </div>
        <div class="modal-body">
          <form id="form_se_nonscoring" class="form-horizontal" role="form" novalidate="novalidate" action="/pengadaan/evaluasi_nonscoring" method="POST">
            <input type="hidden" name="enrollment_id" id="se_n_enrollment" value="" />
            <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
            {{ csrf_field() }}
            <label class="radio-inline checkbox-styled ml10">
              <input type="checkbox" name="item[adm]" id="se_pass_adm" class="se-nonscoring-checker" ><span>Memenuhi Syarat Dokumen Administrasi</span>
            </label>
            <br>
            <label class="radio-inline checkbox-styled ml10">
              <input type="checkbox" name="item[doc]" id="se_pass_doc" class="se-nonscoring-checker" ><span>Memenuhi Syarat Dokumen Penawaran</span>
            </label>
            <br>
            @if($procurement->delivery_method == 3)
              <label class="radio-inline checkbox-styled ml10">
                <input type="checkbox" name="item[second]" id="se_pass_second" class="se-nonscoring-checker" ><span>Memenuhi Syarat Tahap 2</span>
              </label>
            @endif
            <br>
            <textarea id="se_notes" class="form-control" name="item[notes]" rows="2" cols="80" placeholder="Catatan untuk peserta"></textarea>
            <br>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button id="trg_se_nonscoring" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Evaluasi</button>
      </div>
    </div><!-- /.modal-content -->
  </div>
</div>
@endpush

@push('jspage')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#inv_evaluation_block').datepicker({
                autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
            });

            $('#trg_sev_invitation').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_sev_invitation').submit();
                }
                event.preventDefault();
            });

            $('.trg_modal_se_nonscoring').each(function(){
              var $el = $(this);
              $el.on('click', function(){
                var enrollment  = $el.data('enrollment');
                var pass_adm    = $el.data('adm');
                var pass_doc    = $el.data('doc');
                var pass_second = $el.data('second');
                var notes       = $el.data('notes');

                $('#se_n_enrollment').val(enrollment);
                $('#se_pass_adm').prop('checked', pass_adm == 1);
                $('#se_pass_doc').prop('checked', pass_doc == 1);
                $('#se_notes').val(notes);

                if($('#se_pass_second').length > 0) {
                  $('#se_pass_second').prop('checked', pass_second == 1);
                }
              });
            });

            $('.trg_modal_se_scoring').each(function(){
              var $el = $(this);
              $el.on('click', function(){
                var enrollment  = $el.data('enrollment');
                var technicals  = $el.data('technicals');
                var money       = $el.data('money');

                if(technicals != null) {
                  for (var i = 0; i < technicals.length; i++) {
                      var group_el      = $('#criterion_' + technicals[i].criterion_id);
                      group_el.find('.tech-radio').each(function(){
                          var radio_el  = $(this);
                          if(radio_el.val() == technicals[i].score) {
                              radio_el.prop('checked', true);
                          } else {
                              radio_el.prop('checked', false);
                          }
                      });
                  }
                }

                if(money != null) {
                  var group_el      = $('#se_monev');
                  group_el.find('.money-radio').each(function(){
                      var radio_el  = $(this);
                      if(radio_el.val() == money) {
                          radio_el.prop('checked', true);
                      } else {
                          radio_el.prop('checked', false);
                      }
                  });
                }
                

                $('#se_m_enrollment').val(enrollment);
              });
            });

            $('#trg_se_scoring').on('click', function(event){
              $('form#form_se_scoring').submit();
              event.preventDefault();
            });

            $('#trg_se_nonscoring').on('click', function(event){
              $('form#form_se_nonscoring').submit();
              event.preventDefault();
            });

            $('#trg_sch_evaluation').on('click', function(event){
                var $el     = $(this);
                $('#sch_tab').val('eval');
                $('#sch_part').val('evaluation');

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
