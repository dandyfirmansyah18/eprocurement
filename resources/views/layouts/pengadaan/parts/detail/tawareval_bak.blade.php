<div class="tab-pane" id="tawareval">
<h3>
    Pemasukan Penawaran, Pembukaan, dan Evaluasi
    <span class="pcr-date">{{ explode(' - ', $schedule->a_submission)[0] }} - {{ explode(' - ', $schedule->a_evaluation)[0] }}</span>
</h3>
<div class="judulformtop">Daftar penawaran masuk
</div>

<div class="table-responsive">
  <table id="tabel_evaluation" class="table table-bordered order-column hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Perusahaan</th>
            <th>File penawaran</th>
            <th>Evaluasi Teknis</th>
            <th>Evaluasi Biaya (Peringkat paling mendekati HPS)</th>
            <th>Nilai Akhir</th>
        </tr>
    </thead>
    <tbody>
      @for ($ii = 0; $ii < count($enrollments); $ii++)
        @php
          $vendor     = $enrollments[$ii]->vendor;
          $evaluation = $enrollments[$ii]->evaluation;
          $offering   = $enrollments[$ii]->offering();
        @endphp
        <tr>
          <td>{{ $ii + 1 }}</td>
          <td><a href="<?php echo url('vendor/detail/' . $vendor->id); ?>">{{ $vendor->name }}</a></td>
          <td>
            @if($offering != null)
              @if($now < \App\Helpers\AuxHelper::parse_date_adding_days($schedule->a_start, ($schedule->announcement + $schedule->download + $schedule->aanwizing + 1)))
                <a href="#" class=""  data-toggle="modal" data-target="#penawaran"><i class="fa fa-unlock-alt"></i>&nbsp;File penawaran </a>
              @else
                <a href="/uploads/{{ $offering->filepath }}" target="_blank">File penawaran </a>
              @endif
            @else
              Belum ada penawaran
            @endif
          </td>
          <td>
              @if($enrollments[$ii]->evaluation != null)
                  <a href="#" class="btn btn-primary trg_modal_techev"  data-toggle="modal" data-target="#evaluasi" data-enrollment="{{ $enrollments[$ii]->id }}" data-technicals="{{ $enrollments[$ii]->evaluation->techevs }}" data-notes="{{ $enrollments[$ii]->evaluation->notes }}"><i class="fa fa-pencil"></i> Evaluasi </a>
              @else
                  <a href="#" class="btn btn-primary trg_modal_techev"  data-toggle="modal" data-target="#evaluasi" data-enrollment="{{ $enrollments[$ii]->id }}"><i class="fa fa-pencil"></i> Evaluasi </a>
              @endif
          </td>
          <td>
          <a href="#" class="btn btn-primary trg_modal_monev"  data-toggle="modal" data-target="#evaluasi_money" data-enrollment="{{ $enrollments[$ii]->id }}"><i class="fa fa-pencil"></i> Evaluasi </a>
          </td>
          <td>
            @if($evaluation != null)
              <div class="score {{ $evaluation->score }}">
                  &nbsp;{{ $evaluation->score }}%
              </div>
            @endif
          </td>
        </tr>
      @endfor
    </tbody>
  </table>
  <em><i class="fa fa-check text-success"></i> : nilai tertinggi</em>
</div><!--end .table-responsive -->

<br>

<div class="judulform">Upload BA Pembukaan Penawaran</div>
<form id="form_st04" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/jadwal/pengadaan/tender" method="POST">
  <input type="hidden" name="procurement_id" id="procurement_id" value="{{ $procurement->id }}" />
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-6">
      @if($file_tender != null)
        <p>BA Pembukaan Penawaran saat ini: </p>
        <a href="/uploads/{{ $file_tender->filepath }}" target="_blank">{{ $file_tender->filename }}</a>
      @endif
    </div>
    <div class="col-md-6">
      <div class="pull-right">
        <div id="st04_file" class="dropzone st-dropzone" url="/upload/procurement">
          <div class="dz-message btn btn-default">
            <h3>
              Pilih file
            </h3>
          </div>
        </div>
        <p class="help-block st-help-block">Unggah BA Pembukaan Penawaran baru</p>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <input type="text" class="form-control" id="st04_title" name="item[title]" value="{{ $tender->title }}">
        <label for="namalengkap">Judul File BA Pembukaan Penawaran</label>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group floating-label">
        <textarea type="text" class="form-control" id="st04_description" name="item[description]">{!! $tender->description !!}</textarea>
        <label for="regular2">Catatan Pembukaan Penawaran</label>
      </div>
    </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <a id="trg_st04" href="#" class="btn btn-default-bright">Upload</a>
    </div>
  </div>
</form>
<hr>
Log Perubahan tahapan ini:
@for ($ii = 0; $ii < count($log_tenders); $ii++)
  @if($log_tenders[$ii]->old_name == 'none')
    <br>Upload file awal &ldquo;{{ $log_tenders[$ii]->new_name }}&rdquo;  ( {{ \App\Helpers\AuxHelper::render_date_long($log_tenders[$ii]->created_at) }} )
  @else
    <br>Perubahan file &ldquo;{{ $log_tenders[$ii]->new_name }}&rdquo; ( {{ \App\Helpers\AuxHelper::render_date_long($log_tenders[$ii]->created_at) }} )
  @endif
@endfor
<hr>
</div>


<!--Modal evaluasi teknis-->
<div class="modal fade" id="evaluasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="formModalLabel">Evaluasi Teknis</h4>
        </div>
        <div class="modal-body">
          <p>Kriteria penilaian dibuat pada saat drafting pengadaan</p>
          <form id="form_techev" class="form-horizontal" role="form" novalidate="novalidate" action="/pengadaan/evaluasi_teknis" method="POST">
            <input type="hidden" name="enrollment_id" id="techev_enrollment" value="" />
            <input type="hidden" name="criterion" id="techev_criterion" value="{{ count($criterions) }}" />
            <input type="hidden" name="procurement_id" id="procurement_id" value="{{ $procurement->id }}" />
            {{ csrf_field() }}
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
            <div class="form-group floating-label mbt30">
              <textarea type="text" class="form-control" id="techev_notes" name="notes"></textarea>
              <label for="regular2">Catatan Penilaian</label>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button id="trg_techev" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Evaluasi</button>
        </div>
    </div><!-- /.modal-content -->
  </div>
</div>

<!--Modal evaluasi money-->
<div class="modal fade" id="evaluasi_money" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="formModalLabel">Evaluasi Biaya</h4>
        </div>
        <div class="modal-body">
          <form id="form_monev" class="form-horizontal" role="form" novalidate="novalidate" action="/pengadaan/evaluasi_biaya" method="POST">
            <input type="hidden" name="enrollment_id" id="monev_enrollment" value="" />
            <input type="hidden" name="criterion" id="monev_criterion" value="{{ count($criterions) }}" />
            <input type="hidden" name="procurement_id" id="procurement_id" value="{{ $procurement->id }}" />
            {{ csrf_field() }}
            <div class="form-group">
              <label class="col-sm-3 control-label">Penilaian</label>
              <div class="col-sm-9">
                <label class="radio-inline radio-styled">
                  <input type="radio" name="mark" value="1"><span>1</span>
                </label>
                <label class="radio-inline radio-styled">
                  <input type="radio" name="mark" value="2"><span>2</span>
                </label>
                <label class="radio-inline radio-styled">
                  <input type="radio" name="mark" value="3"><span>3</span>
                </label>
                <label class="radio-inline radio-styled">
                  <input type="radio" name="mark" value="4"><span>4</span>
                </label>
                <label class="radio-inline radio-styled">
                  <input type="radio" name="mark" value="5"><span>5</span>
                </label>
              </div><!--end .col -->
            </div><!--end .form-group -->
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button id="trg_monev" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Evaluasi</button>
        </div>
    </div><!-- /.modal-content -->
  </div>
</div>

@push('jspage')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.trg_modal_techev').each(function(){
              var $el = $(this);
              $el.on('click', function(){
                var enrollment        = $el.data('enrollment');
                var notes             = $el.data('notes');
                var technicals        = $el.data('technicals');
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

                $('#techev_enrollment').val(enrollment);

                $('#techev_notes').val(notes);
                if(notes != '') {
                    $('#techev_notes').addClass('dirty');
                } else {
                    $('#techev_notes').removeClass('dirty');
                }
              });
            });
        });
    </script>
@endpush
