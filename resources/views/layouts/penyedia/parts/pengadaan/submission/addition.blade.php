@php
    use \App\Helpers\DateHelper;
@endphp

<div class="card panel collapsed">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#tab_submission" data-target="#subm_addition">
      <header class="teksutama">
          Pemasukan Penawaran 2
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
            @if($enrolled == 1)
              <div class="judulformtop">Unggah Penawaran 2</div>
              <form id="form_upload2" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/enrollment/upload2" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="procurement_id" id="j_procurement_id" value="{{ $procurement->id }}" />
                {{ csrf_field() }}
          
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="file" class="form-control" name="assurance_doc" />
                      <p class="help-block">Upload Dokumen yang Diperlukan</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    @if($file_upload2 != null)
                      <p>Penawaran saat ini: </p>
                      <a href="/uploads/{{ $file_upload2->filepath }}" target="_blank">{{ $file_upload2->filename }}</a>
                    @endif
                  </div>
                </div>
              </form>
              <div class="pull-right">
                <a id="trg_upload2" href="#" class="btn btn-primary mt25" ><i class="fa fa-save"></i> Simpan Penawaran</a>
              </div>
              <div class="clear"></div>
              <hr>
          
              <div class="judulformtop">Jaminan Penawaran 2</div>
              <form id="form_jaminan2" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/enrollment/jaminan/upload" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="procurement_id" id="j_procurement_id2" value="{{ $procurement->id }}" />
                <input type="hidden" name="assurance[id]" id="j_sanggahan_id2" value="{{ $jaminan2->id }}" />
                <input type="hidden" name="assurance[phase]" value="2" />
                {{ csrf_field() }}
          
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group floating-label">
                      <input type="text" class="form-control" name="assurance[amount]" value="{{ $jaminan2->amount }}" />
                      <label for="regular2">Nilai Jaminan</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="file" class="form-control" name="assurance_doc" />
                      <p class="help-block">Upload Dokumen yang Diperlukan</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    @if($file_jaminan2 != null)
                      <p>Jaminan saat ini: </p>
                      <a href="/uploads/{{ $file_jaminan2->filepath }}" target="_blank">{{ $file_jaminan2->filename }}</a>
                    @endif
                  </div>
                </div>
          
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group floating-label">
                      <textarea type="text" class="form-control" name="assurance[notes]">{{ $jaminan2->notes }}</textarea>
                      <label for="regular2">Catatan </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <div class="input-group date" id="tanggal_jaminanstart2">
                        <div class="input-group-content">
                          <input type="text" class="form-control" name="assurance[start_date]" value="{{ DateHelper::datepicker($jaminan2->start_date) }}" />
                          <label>Tanggal Mulai Jaminan</label>
                          <p class="help-block">tanggal/bulan/tahun</p>
                        </div>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      </div>
                    </div>
                  </div>
          
                  <div class="col-sm-6">
                    <div class="form-group">
                      <div class="input-group date" id="tanggal_jaminanend2">
                        <div class="input-group-content">
                          <input type="text" class="form-control" name="assurance[end_date]" value="{{ DateHelper::datepicker($jaminan2->end_date) }}" />
                          <label>Tanggal Selesai Jaminan</label>
                          <p class="help-block">tanggal/bulan/tahun</p>
                        </div>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <div class="pull-right">
                <a id="trg_jaminan2" href="#" class="btn btn-primary mt25" ><i class="fa fa-save"></i> Simpan Jaminan</a>
              </div>
              <div class="clear"></div>
              <hr>
            @endif
        </div>
    </div>
</div><!--end .panel -->

@push('jspage')
    <script>
        $(document).ready(function() {
            if($('#tanggal_jaminanstart2').length > 0) {
                $('#tanggal_jaminanstart2').datepicker({
                    autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
                });
        
                $('#tanggal_jaminanend2').datepicker({
                    autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
                });
        
                $('#trg_jaminan2').on('click', function(event){
                    $('form#form_jaminan2').submit();
                    event.preventDefault();
                });
        
                $('#trg_upload2').on('click', function(event){
                    $('form#form_upload2').submit();
                    event.preventDefault();
                });
            }
          });
    </script>
@endpush
