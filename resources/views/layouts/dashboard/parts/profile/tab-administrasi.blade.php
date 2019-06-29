<div class="row mt25">
    @if($user->state == 1)
        <!-- <div class="col-md-4">
            <a class="btn btn-block btn-primary" href="/vendor/certificate/{{ $company->id }}" target="_blank">
                <i class="fa fa-download"></i>&nbsp; Surat Keterangan Penyedia
            </a>
        </div> -->
        <div class="col-md-4">
            <a href="#" class="btn btn-primary btn-block"  data-toggle="modal" data-target="#ubahdata">
                <i class="fa fa-edit"></i>&nbsp;Ubah Data
            </a>
        </div>
    @endif
</div>

<hr>
<dl class="uhui dl-horizontal">
    <dt>Rating Penyedia</dt>
    <dd>
        <input id="input-2-xs" name="input-2" class="rating rating-loading" data-min="0" data-max="4" data-step="0.1" data-stars="4" value="{{ $rating }}" readonly>
        @if($rating > 0.0 && $rating < 2.5)
            <div class="rating-info">Buruk dan diganti dengan vendor yang lain</div>
        @elseif($rating >= 2.5 && $rating <= 2.9)
            <div class="rating-info">Cukup baik dan tetap digunakan tapi perlu perbaikan kinerja</div>
        @elseif($rating >= 3.0 && $rating <= 3.4)
            <div class="rating-info">Baik dan tetap digunakan</div>
        @elseif($rating >= 3.5 && $rating <= 4)
            <div class="rating-info">Sangat Baik dan Tetap digunakan</div>
        @else
            <div class="rating-info">Belum ada rating</div>
        @endif
    </dd>
    <br>
    <dt>Catatan</dt>
    <dd>{{ $user->notes }} &nbsp;</dd>
    <hr>
    <dt>Daftar Lelang Aktif</dt>
        @for($im = 0; $im < count($active_enrollments); $im++)
            <dd>{{ $active_enrollments[$im]->title }}</dd>
        @endfor
    <br />
    <dt>Daftar Lelang selesai</dt>
        @for($im = 0; $im < count($finished_enrollments); $im++)
            <dd>{{ $finished_enrollments[$im]->title }}</dd>
        @endfor
    <br />
</dl>

<hr>
<h5>Log Percakapan</h5>

@for ($ii = 0; $ii < count($chats); $ii++)
    <div class="vnd-chat-item">
        <div class="col-sm-2">
            <div class="vnd-chat-author">
                @if($chats[$ii]->sender_id == $user->id)
                    Penyedia
                @else
                    {{ $chats[$ii]->sender->name }}
                @endif
            </div>
            <div class="vnd-chat-time">
                {{ \App\Helpers\AuxHelper::render_date_time($chats[$ii]->created_at) }}
            </div>
        </div>
        <div class="col-sm-9 vnd-chat-msg">
            {!! html_entity_decode($chats[$ii]->message) !!}
        </div>
        <div class="clear"></div>
    </div>
@endfor

<div class="clear"></div>
<hr>

@if($user->state == 1)
    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#change_password">
        <i class="fa fa-refresh"></i>&nbsp;Ubah password
    </a>
    <!--
    <a class="btn btn-primary" href="#"><i class="fa fa-print"></i>&nbsp; Print/Download Data Penyedia ini</a>
    -->
    <hr>
@endif

Kirim pesan ke Admin
<form id="form_chat" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/dashboard/chat" method="POST">
{{ csrf_field() }}
<input type="hidden" name="chat[entity_type]" value="vendor" />
<input type="hidden" name="chat[entity_id]" value="{{ $company->id }}" />
<input type="hidden" name="chat[sender_id]" value="{{ $user->id }}" />
<input type="hidden" name="chat[recipient_id]" value="0" />
<textarea id="summernote" name="chat[message]"></textarea>
</form>
<br>
<a id="trg_chat" class="btn  btn-default-bright" href="#">Kirim </a>
