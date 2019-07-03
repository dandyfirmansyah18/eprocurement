<div class="row mt25">
    @if($user->state > 0)
        <!-- <div class="col-md-4">
            <a class="btn btn-block btn-primary" href="/vendor/certificate/{{ $company->id }}" target="_blank">
                <i class="fa fa-download"></i>&nbsp; Surat Keterangan Penyedia
            </a>
        </div> -->
    @endif
    @if($user->state > 0)
        <div class="col-md-4">
            <a href="#" class="btn btn-primary btn-block"  data-toggle="modal" data-target="#ubahstatus">
                <i class="fa fa-edit"></i> Ubah Status Penyedia
            </a>
        </div>
        <div class="col-md-4">
            <a href="#" class="btn btn-primary btn-block"  data-toggle="modal" data-target="#ubahskrt">
                <i class="fa fa-edit"></i> Status SKRT
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
    <dd>{{ $user->notes }}&nbsp;</dd>
    <dd>
        <a href="#" class="btn btn-xs btn-default-bright" data-toggle="modal" data-target="#catatanpenyedia">
            <span class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Ubah Catatan</span>
        </a>
    </dd>

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

@if($user->state < 5)
<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#reset_password">
    <i class="fa fa-refresh"></i>&nbsp; Reset password
</a>
<!--
<a class="btn btn-primary" href="#"><i class="fa fa-print"></i>&nbsp; Print/Download Data Penyedia ini</a>
-->
<hr>
@endif

<span style="font-size:14px"><b>Kirim pesan ke Penyedia ini</b></span>
<form id="form_chat" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/vendor/chat" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="chat[entity_type]" value="vendor" />
    <input type="hidden" name="chat[entity_id]" value="{{ $company->id }}" />
    <input type="hidden" name="chat[sender_id]" value="{{ Auth::user()->id }}" />
    <input type="hidden" name="chat[recipient_id]" value="{{ $user->id }}" />
    <textarea id="summernote" name="chat[message]"></textarea>
</form>
<br>
<a id="trg_chat" class="btn btn-info"><span style="color:white">Kirim </span></a>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="reset_password_label" id="reset_password">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="reset_password_label">Apakah anda yakin?</h4>
            </div>
            <div class="modal-footer">
                <form id="form_reset_password" class="form floating-label" role="form" novalidate="novalidate" action="/vendor/reset_password" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $user->id }}" />
                    <input type="hidden" name="company_id" value="{{ $company->id }}" />
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <button id="trg_reset_password" type="button" class="btn btn-primary">Ya</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="statusskrt_label" id="ubahskrt">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form id="formModalAdministrasi" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="idCompany" value="{{ $company->id }}" /> 
                <div class="modal-header">
                    <h4 class="modal-title" id="statusskrt_label">Status SKRT</h4>
                </div>
                <div class="modal-footer">
                    <form id="form_ttd_skrt" class="form floating-label" role="form" novalidate="novalidate" action="/penyedia/skrtproccess" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="idCompany" value="{{ $company->id }}" />
                    </form>
                    <form id="form_done_skrt" class="form floating-label" role="form" novalidate="novalidate" action="/penyedia/skrtdone" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="idCompany" value="{{ $company->id }}" />
                    </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="trg_skrtproccess" type="button" class="btn btn-primary">TTD</button>
                    <button id="trg_skrtdone" type="button" class="btn btn-primary">Ambil</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#trg_reset_password').on('click', function(event){
            submit_form('form_reset_password');
            event.preventDefault();
        });
        $('#trg_skrtproccess').on('click', function(event){
            $("#formModalAdministrasi").attr("action", "{{ url('/penyedia/skrtproccess') }}");
            $("#formModalAdministrasi").submit();
            alert('Pemberitahuan Proses SKRT Sudah Dikirim ke Email Perusahaan.');
            event.preventDefault();
        });
        $('#trg_skrtdone').on('click', function(event){
            $("#formModalAdministrasi").attr("action", "{{ url('/penyedia/skrtdone') }}");
            $("#formModalAdministrasi").submit();
            alert('Pemberitahuan SKRT Selesai Sudah Dikirim ke Email Perusahaan.');
            event.preventDefault();
        });
    });
</script>
