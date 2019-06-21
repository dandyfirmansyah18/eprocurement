@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="tab-pane" id="aanwizing">
    <h3>
        Aanwizing
        <span class="pcr-date">{{ $schedule->a_aanwizing }}</span>
    </h3>
    <div class="judulformtop">Upload BA Aanwizing
    </div>
    <form id="form_st03" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/jadwal/pengadaan/aanwizing" method="POST">
        <input type="hidden" name="procurement_id" id="procurement_id" value="{{ $procurement->id }}" />
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">
                @if($inv_aanwizing != null)
                <p>BA Aanwizing saat ini: </p>
                    {!! FormHelper::file_tag($inv_aanwizing->filepath, $inv_aanwizing->filename) !!}
                @endif
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <div id="st03_file" class="dropzone st-dropzone" url="/upload/procurement">
                        <div class="dz-message btn btn-default">
                            <h3>
                                Pilih file
                            </h3>
                        </div>
                    </div>
                    <p class="help-block st-help-block">Unggah BA Aanwizing baru</p>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="st03_title" name="item[title]" value="{{ $aanwizing->title }}">
                    <label for="namalengkap">Judul File Aanwizing</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group floating-label">
                    <textarea type="text" class="form-control" id="st03_description" name="item[description]">{!! $aanwizing->description !!}</textarea>
                    <label for="regular2">Catatan Aanwizing</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a id="trg_st03" href="#" class="btn btn-default-bright">Upload</a>
            </div>
        </div>
    </form>
    <hr>
    Log Perubahan dokumen ini:
    @for ($ii = 0; $ii < count($log_aanwizings); $ii++)
        @if($log_aanwizings[$ii]->old_name == 'none')
            <br>Upload file awal &ldquo;{{ $log_aanwizings[$ii]->new_name }}&rdquo;  ( {{ DateHelper::long_format($log_aanwizings[$ii]->created_at) }} )
        @else
            <br>Perubahan file &ldquo;{{ $log_aanwizings[$ii]->new_name }}&rdquo; ( {{ DateHelper::long_format($log_aanwizings[$ii]->created_at) }} )
        @endif
    @endfor
    <hr>
</div>
