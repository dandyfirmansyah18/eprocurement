<!--Modal verifikasi pihak pengadaan-->
<div class="modal fade" id="verifikasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="formModalLabel">Verifikasi Pengadaan Terhadap Kelengkapan Pengajuan Pengadaan</h4>
        </div>
        <div class="modal-body">
          <form class="form" role="form" action="/perencanaan/verify/{{ $data['id']}}" method="POST">
            <div class="form-group floating-label">
              <input type="text" class="form-control" id="regular2" value="{{ $user['name']}}" readonly="readonly">
              <label for="regular2">Nama verifikator</label>
            </div>

            <div class="form-group">
              <div class="input-group date" id="tanggalverifikasi">
                <div class="input-group-content">
                  <input type="text" class="form-control" name="verification_date" readonly="readonly">
                  <label>Tanggal verifikasi</label>
                </div>
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </div>
            <div class="form-group floating-label">
              <textarea type="text" class="form-control" id="regular2" name="verification_note"></textarea>
              <label for="regular2">(opsional) Catatan </label>
            </div>
            <div class="form-group">
              
              <div id="verification_file_block" class="form-group dropzone-block tight">
                <input type="hidden" name="token_verification_file" id="token_verification_file" value="{{ csrf_token() }}">
                <input type="hidden" id="user_id" name="user_id" value="{{ $user['id'] }}">
                <input type="hidden" id="preprocurement_id" name="preid" value="{{ $data['id'] }}">
                <div class="upload-block">
                  <div id="verification_file" class="dropzone tight" url="/upload/memo">
                    <div class="dz-message btn btn-default">
                      <h5>
                        Pilih file
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="clear"></div>
                <p class="help-block">Unggah RKS Administrasi</p>
                <div class="clear"></div>
              </div>
              
            </div>

            <div class="modal-footer">
              {{ csrf_field() }}
              <input type="hidden" name="id" value="{{ $data['id'] }}">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Verifikasi</button>
            </div>
          </form>
        </div>
    </div><!-- /.modal-content -->
  </div>
</div>

<!--Modal persetujuan pengajuan-->
<div class="modal fade" id="approval" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="formModalLabel">Memberi Persetujuan Pada Pengajuan Pengadaan Ini</h4>
        </div>
        <div class="modal-body">
          <form class="form" role="form" action="/perencanaan/approval/{{ $data['id'] }}" method="POST" >
            <div class="form-group floating-label">
              <input type="text" class="form-control" id="regular2" value="{{ $user['name']}}" readonly="readonly">
              <input type="hidden" name="user_id" value="2" />
              <label for="regular2">Nama yang Menyetujui</label>
            </div>

            <div class="form-group">
              <div class="input-group date" id="tanggalpersetujuan">
                <div class="input-group-content">
                  <input type="text" class="form-control" name="approval_date" readonly="readonly" disabled="disabled">
                  <label>Tanggal Disetujui</label>
                </div>
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </div>
            <div class="form-group floating-label">
              <textarea type="text" name="notes" class="form-control" id="notes-approval"></textarea>
              <label for="regular2">(opsional) Catatan lain </label>
            </div>
            <div class="modal-footer">
              {{ csrf_field() }}
              <input type="hidden" name="id" value="{{ $data['id'] }}">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Setujui</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
    </div>
  </div>
</div>

<!--Modal penolakan pengajuan-->
<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="formModalLabel">Penolakan Pada Pengajuan Pengadaan Ini</h4>
        </div>
        <div class="modal-body">
          <form class="form" role="form" action="/perencanaan/reject" method="POST" >
            <div class="form-group floating-label">
              <input type="text" class="form-control" id="regular2" value="{{ $user['name']}}" readonly="readonly">
              <input type="hidden" name="user_id" value="{{ $user['id'] }}" />
              <label for="regular2">Nama yang Menolak</label>
            </div>

            <div class="form-group">
              <div class="input-group date" id="tanggalpenolakan">
                <div class="input-group-content">
                  <input type="text" class="form-control" name="reject_date" readonly="readonly" disabled="disabled">
                  <label>Tanggal Penolakan</label>
                </div>
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
            </div>
            <div class="form-group floating-label">
              <textarea type="text" name="notes" class="form-control" id="notes-reject"></textarea>
              <label for="regular2">(opsional) Catatan lain </label>
            </div>
            <div class="modal-footer">
              {{ csrf_field() }}
              <input type="hidden" name="id" value="{{ $data['id'] }}">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Tolak</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
    </div>
  </div>
</div>


<div class="tab-pane" id="second5">
  <h3>
    @if (array_key_exists(0, $approval))

    <i class="fa fa-lg fa-check text-success"></i>
    Sudah disetujui pada tanggal: {{ date('d F Y', strtotime($approval[0]['approval_time'])) }} oleh manajer: {{ $approval[0]['user']['name']}}

    @elseif ($data['verified'] && $user['role_level'] == 4)

    <a href="#" class="mt25 btn btn-primary" data-toggle="modal" data-user="manager" data-target="#approval"><i class="fa fa-check"></i> Persetujuan </a>

    @else
      Menunggu Verifikasi
    @endif
  </h3>
  <hr>
  Log Percakapan dan persetujuan Manajer :

  @foreach ($data['chat'] as $chat)
    <br />
    @if ($chat['recipient_id'] == $user['id'] || $chat['sender_id'] == $user['id'])
    {{ date('d F Y H.i', strtotime($chat['created_at'])) }} - {{ $chat['sender']['name'] }} : {!! html_entity_decode($chat['message']) !!}
    @endif
  @endforeach

  <hr>

  Komunikasi proses persetujuan
  <form class="form" role="form" action="/perencanaan/chats" method="POST" >
    <textarea id="summernote2" name="message">

    </textarea>
    <input type="hidden" name="id" value="{{ $data['id'] }}">
    {{ csrf_field() }}
    <button type="submit" class="btn btn-default-bright">Kirim </button>
  </form>
  <hr>
</div>

<div class="tab-pane" id="third5">
  <h3>
    @if (array_key_exists(1, $approval))
      <i class="fa fa-lg fa-check text-success"></i>
      Sudah disetujui pada tanggal: {{ date('d F Y', strtotime($approval[1]['approval_time'])) }} oleh kepala divisi: {{ $approval[1]['user']['name']}}
    @elseif (array_key_exists(0, $approval) && $approval[0]['user_level'] == 1 && $user['role_level'] == 5)
    <a href="#" class="mt25 btn btn-primary" data-toggle="modal" data-user="kadiv" data-target="#approval"><i class="fa fa-check"></i> Persetujuan </a>
    @else
      Menunggu Persetujuan Manajer
    @endif
  </h3>
  <hr>
  Log Percakapan dan persetujuan kepala divisi :

  @foreach ($data['chat'] as $chat)
    <br />
    @if ($chat['recipient_id'] == $user['id'] || $chat['sender_id'] == $user['id'])
    {{ date('d F Y H.i', strtotime($chat['created_at'])) }} - {{ $chat['sender']['name'] }} : {!! html_entity_decode($chat['message']) !!}
    @endif
  @endforeach

  <hr>

  Komunikasi proses persetujuan
  <form class="form" role="form" action="/perencanaan/chats" method="POST" >
    <textarea id="summernote3" name="message">

    </textarea>
    <input type="hidden" name="id" value="{{ $data['id'] }}">
    {{ csrf_field() }}
    <button type="submit" class="btn btn-default-bright">Kirim </button>
  </form>
  <hr>
</div>

<div class="tab-pane" id="fourth">
  <h3>
    @if (array_key_exists(2, $approval))
      <i class="fa fa-lg fa-check text-success"></i>
      Sudah disetujui pada tanggal: {{ date('d F Y', strtotime($approval[2]['approval_time'])) }} oleh direksi: {{ $approval[2]['user']['name']}}
    @elseif (array_key_exists(1, $approval) && $approval[1]['user_level'] == 2 && $user['role_level'] == 6)
    <a href="#" class="mt25 btn btn-primary" data-toggle="modal" data-user="direksi" data-target="#approval"><i class="fa fa-check"></i> Persetujuan </a>
    @else
      Menunggu Persetujuan Kepala Divisi
    @endif
  </h3>
  <hr>
  Log Percakapan dan persetujuan Direksi :

  @foreach ($data['chat'] as $chat)
    <br />
    @if ($chat['recipient_id'] == $user['id'] || $chat['sender_id'] == $user['id'])
    {{ date('d F Y H.i', strtotime($chat['created_at'])) }} - {{ $chat['sender']['name'] }} : {!! html_entity_decode($chat['message']) !!}
    @endif
  @endforeach

  <hr>
  Komunikasi proses persetujuan
  <form class="form" role="form" action="/perencanaan/chats" method="POST" >
    <textarea id="summernote0" name="message">
    </textarea>
    <input type="hidden" name="id" value="{{ $data['id'] }}">
    {{ csrf_field() }}
    <button type="submit" class="btn btn-default-bright">Kirim </button>
  </form>
  <hr>
</div>
