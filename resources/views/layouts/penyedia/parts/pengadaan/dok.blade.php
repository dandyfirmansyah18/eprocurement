@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="tab-pane " id="dok">
    <h3>
        Download Dokumen Lelang
        <span class="pcr-date">{{ $schedule->a_download }}</span>
    </h3>
    <hr>
    <dl class="">
        @php
            $date_diff  = DateHelper::end_date_diff($schedule->a_download)
        @endphp
        <dt>File RKS Teknis</dt>
        <dd class="stg-download-technical">
            @if($date_diff < 0)
                @if($file_rks != null)
                    {{ $file_rks->filename }}
                @else
                    -
                @endif
            @else
                @if($file_rks != null)
                    {!! FormHelper::file_tag($file_rks->filepath, $file_rks->filename) !!}
                @else
                    -
                @endif
            @endif
        </dd>
        <hr>
        <dt>File RKS Administrasi</dt>
        <dd class="stg-download-administration">
            @if($date_diff < 0)
                @if($doc_adm != null)
                    {{ $doc_adm->filename }}
                @else
                    -
                @endif
            @else
                @if($doc_adm != null)
                    {!! FormHelper::file_tag($doc_adm->filepath, $doc_adm->filename) !!}
                @else
                    -
                @endif
            @endif
        </dd>
    </dl>
    <hr>

    <div class="hidden-block">
        <form id="form_stg_download" action="/pengadaan/atur/dokumen" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
            @if($enrollment != null)
                <input id="sd_enrollment_id" type="hidden" name="item[enrollment_id]" value="{{ $enrollment->id }}" />
                <input id="sd_type" type="hidden" name="item[type]" value="" />
            @endif
        </form>
    </div>
</div>

@push('jspage')
    <script>
        $(document).ready(function(){
            if($('#sd_enrollment_id').length > 0) {
                $('.stg-download-technical a').on('click', function(){
                    $('#sd_type').val('technical');
                    var form = $('form#form_stg_download');
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

                $('.stg-download-administration a').on('click', function(){
                    $('#sd_type').val('administration');
                    var form = $('form#form_stg_download');
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
            }
        });
    </script>
@endpush
