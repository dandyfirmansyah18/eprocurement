@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="card panel">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#prakualifikasi" data-target="#pra3">
      <header class="teksutama">
          3. Aanwizing Prakualifikasi
          <br>
          @if($schedule->a_p_explanation != null)
              <span class="pcr-date">
                  {{ $schedule->a_p_explanation }}
              </span>
          @endif
      </header>
      <div class="tools">
        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
      </div>
    </div>
    <div id="pra3" class="collapse">
      <div class="card-body acccardbody">
        <hr>
          <h4>Penjelasan dan File untuk didownload</h4>
          <form id="form_pexp_memorandum" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/pengadaan/atur/memoranda" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
              <input type="hidden" name="tab_path" value="pra" />
              <input type="hidden" name="item[purpose]" value="p_explanation" />
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <input type="file" class="form-control" name="memorandum_doc">
                          <p class="help-block">Upload BA Aanwizing Prakualifikasi</p>
                      </div>
                  </div>
                  <div class="col-md-6">
                      @if($file_p_explanation != null)
                          <p>BA Aanwizing Prakualifikasi saat ini: </p>
                          <a href="/uploads/{{ $file_p_explanation->filepath }}" target="_blank">{{ $file_p_explanation->filename }}</a>
                      @endif
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group floating-label">
                          <textarea type="text" class="form-control" name="item[notes]">{{ $ba_p_explanation->notes }}</textarea>
                          <label for="regular2">Catatan Aanwizing Prakualifikasi</label>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <a id="trg_pexp_memorandum" href="#" class="btn btn-default-bright"><i class="fa fa-save"></i> Simpan</a>
                  </div>
              </div>
          </form>
          <hr>
          Log Perubahan dokumen ini:
          @for ($ii = 0; $ii < count($log_p_explanation); $ii++)
              @if($log_p_explanation[$ii]->old_name == 'none')
                  <br>Upload file awal &ldquo;{{ $log_p_explanation[$ii]->new_name }}&rdquo;  ( {{ DateHelper::long_format($log_p_explanation[$ii]->created_at) }} )
              @else
                  <br>Perubahan file &ldquo;{{ $log_p_explanation[$ii]->new_name }}&rdquo; ( {{ DateHelper::long_format($log_p_explanation[$ii]->created_at) }} )
              @endif
          @endfor
          <hr>
      </div>
    </div>
</div><!--end .panel -->

@push('jspage')
    <script>
        $(document).ready(function(){
            $('#trg_pexp_memorandum').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_pexp_memorandum').submit();
                }
                event.preventDefault();
            });
        });
    </script>
@endpush
