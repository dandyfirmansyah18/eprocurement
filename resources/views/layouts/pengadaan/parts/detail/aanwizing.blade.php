@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="tab-pane p-20" id="aanwizing" role="tabpanel">
    <h4>
        Aanwizing
    </h4>
    <h8>{{ $schedule->a_aanwizing }}</h8>
    <hr>
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
                    <p class="help-block st-help-block">Unggah BA Aanwizing baru</p>
                    <input type="file" class="form-control" name="st03_file">
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="namalengkap">Judul File Aanwizing</label>
                    <input type="text" class="form-control" id="st03_title" name="item[title]" value="{{ $aanwizing->title }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group floating-label">
                    <label for="regular2">Catatan Aanwizing</label>
                    <textarea type="text" class="form-control" id="st03_description" name="item[description]">{!! $aanwizing->description !!}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <input type="submit" id="submit" class="btn btn-primary mt25" value="Upload"> 
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
