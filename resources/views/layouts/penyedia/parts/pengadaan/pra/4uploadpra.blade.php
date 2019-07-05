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
        @if($enrolled == 1)
            <form id="form_p_upload" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/enrollment/pre_upload" method="POST" enctype="multipart/form-data">
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
                @if($file_p_upload != null)
                    <p>Penawaran saat ini: </p>
                    <a href="/uploads/{{ $file_p_upload->filepath }}" target="_blank">{{ $file_p_upload->filename }}</a>
                @endif
                </div>
            </div>
            </form>
            <div class="pull-right">
            <a id="trg_p_upload" href="#" class="btn btn-primary mt25" ><i class="fa fa-save"></i> Simpan Penawaran</a>
            </div>
            <div class="clear"></div>
            <hr>
        @endif
        </div>
    </div>
</div><!--end .panel -->

@push('jspage')
    <script>
        $(document).ready(function(){
            $('#trg_p_upload').on('click', function(event){
                $('form#form_p_upload').submit();
                event.preventDefault();
            });
        });
    </script>
@endpush