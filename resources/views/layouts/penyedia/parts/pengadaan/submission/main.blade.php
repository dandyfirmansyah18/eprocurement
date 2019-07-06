@php
    use \App\Helpers\DateHelper;
@endphp

      <header class="teksutama">
          Pemasukan Penawaran
          @if($schedule->a_submission != null)
            <span class="pcr-date">
                {{ $schedule->a_submission }}
            </span>
          @endif
      </header>
      
      <hr>
        <div class="card-body acccardbody">
            <br />
            @if($enrolled == 1)
              <div class="judulformtop">Unggah Penawaran</div>
              <form id="form_upload" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/enrollment/upload" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="procurement_id" id="j_procurement_id" value="{{ $procurement->id }}" />
                {{ csrf_field() }}
          
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <p class="help-block">Upload Dokumen yang Diperlukan</p>
                      <input type="file" class="form-control" name="assurance_doc" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    @if($file_upload != null)
                      <p>Penawaran saat ini: </p>
                      <a href="/uploads/{{ $file_upload->filepath }}" target="_blank">{{ $file_upload->filename }}</a>
                    @endif
                  </div>
                </div>
              </form>
              <div class="pull-right">
                <a id="trg_upload" href="#" class="btn btn-primary mt25" ><i class="fa fa-save"></i> Simpan Penawaran</a>
              </div>
              <div class="clear"></div>
              <hr>
          
              <p>Jaminan Penawaran</p>
              <hr>
              <form id="form_jaminan" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/enrollment/jaminan/upload" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="procurement_id" id="j_procurement_id" value="{{ $procurement->id }}" />
                <input type="hidden" name="assurance[id]" id="j_sanggahan_id" value="{{ $jaminan->id }}" />
                {{ csrf_field() }}
          
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group floating-label">
                        
                      <label for="regular2">Nilai Jaminan</label>
                      <input type="text" class="form-control" name="assurance[amount]" value="{{ $jaminan->amount }}" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        
                      <p class="help-block">Upload Dokumen yang Diperlukan</p>
                      <input type="file" class="form-control" name="assurance_doc" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    @if($file_jaminan != null)
                      <p>Jaminan saat ini: </p>
                      <a href="/uploads/{{ $file_jaminan->filepath }}" target="_blank">{{ $file_jaminan->filename }}</a>
                    @endif
                  </div>
                </div>
          
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group floating-label">
                        
                      <label for="regular2">Catatan </label>
                      <textarea type="text" class="form-control" name="assurance[notes]">{{ $jaminan->notes }}</textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <div class="input-group date" id="tanggal_jaminanstart">
                        <div class="input-group-content">
                            
                          <label>Tanggal Mulai Jaminan</label>
                          <input type="text" class="form-control" name="assurance[start_date]" value="{{ DateHelper::datepicker($jaminan->start_date) }}" />
                            <p class="help-block">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> &nbsp;tanggal/bulan/tahun</p>
                        </div>
                      </div>
                    </div>
                  </div>
          
                  <div class="col-sm-6">
                    <div class="form-group">
                      <div class="input-group date" id="tanggal_jaminanend">
                        <div class="input-group-content">
                          <label>Tanggal Selesai Jaminan</label>
                          <input type="text" class="form-control" name="assurance[end_date]" value="{{ DateHelper::datepicker($jaminan->end_date) }}" />
                          <p class="help-block"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>&nbsp;tanggal/bulan/tahun</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <div class="pull-right">
                <a id="trg_jaminan" href="#" class="btn btn-primary mt25" ><i class="fa fa-save"></i> Simpan Jaminan</a>
              </div>
              <div class="clear"></div>
              <hr>
            @endif
        </div>
    

    <script>
        $(document).ready(function() {
            if($('#tanggal_jaminanstart').length > 0) {
                $('#tanggal_jaminanstart').datepicker({
                    autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
                });
        
                $('#tanggal_jaminanend').datepicker({
                    autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
                });
        
                $('#trg_jaminan').on('click', function(event){
                    $('form#form_jaminan').submit();
                    event.preventDefault();
                });
        
                $('#trg_upload').on('click', function(event){
                    $('form#form_upload').submit();
                    event.preventDefault();
                });
            }
          });
    </script>