@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<!-- detail dan persetujuan pengadaan -->
<div class="tab-pane active" id="first5">

    <dl class="mt25 uhui dl-horizontal">
        <div class="pull-right adm-btn-top">
            <br />
            @if ($data['verified'] == 0 && $user['role_level'] == 3)
                <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#verifikasi"><i class="fa fa-check" ></i> Verifikasi pengadaan  </a>
            <!-- @elseif ($user['role_level'] == 2 && $data['verified'] == 0)
                <br />
                <form class="form" role="form" action="/perencanaan/verifikasi" method="POST" >
                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary confirm-modal"><i class="fa fa-check"></i> Ajukan verifikasi ke pengadaan</button>
                </form>
                <br /> -->
            @endif

            <!-- @if (!$data['start_approval'] && $data['verified'] > 0 && $user['role_level'] == 2 && count($data['log']) > 3)
                <form class="form" role="form" action="/perencanaan/mulai" method="POST" >
                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary confirm-modal"><i class="fa fa-check"></i> Ajukan kembali persetujuan berjenjang</button>
                </form>
            @elseif (!$data['start_approval'] && $data['verified'] > 0 && $user['role_level'] == 2)
                <form class="form" role="form" action="/perencanaan/mulai" method="POST" >
                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary confirm-modal"><i class="fa fa-check"></i> Ajukan persetujuan berjenjang</button>
                </form>
            @endif

            @if ($user['role_level'] == 4 && $data['start_approval'] == 1 && !array_key_exists(0, $approval)) -->
                <!--<hr>
                Approval Manajer
                <br />-->
                <!-- <a href="#" class="mt25 btn btn-primary" data-toggle="modal" data-user="manager" data-target="#approval">
                    <i class="fa fa-check"></i> Beri persetujuan
                </a>
                <a href="#" class="mt25 btn btn-primary" data-toggle="modal" data-user="manager" data-target="#reject">
                    <i class="fa fa-ban"></i> Tolak
                </a>
            @endif
 -->


            <!-- @if ($user['role_level'] == 5 && $data['start_approval'] && (!array_key_exists(1, $approval) && array_key_exists(0, $approval))) -->
                <!--Approval Kepala Divisi
                <br />-->
                <!-- <a href="#" class="mt25 btn btn-primary" data-toggle="modal" data-user="kadiv" data-target="#approval">
                    <i class="fa fa-check"></i> Beri persetujuan
                </a>

                <a href="#" class="mt25 btn btn-primary" data-toggle="modal" data-user="kadiv" data-target="#reject">
                    <i class="fa fa-ban"></i> Tolak
                </a>
            @endif

            @if ($user['role_level'] == 6 && $data['start_approval'] && (!array_key_exists(2, $approval) && array_key_exists(1, $approval))) -->
                <!--Approval Direksi
                <br />-->
                <!-- <a href="#" class="mt25 btn btn-primary" data-toggle="modal" data-user="direksi" data-target="#approval">
                    <i class="fa fa-check"></i> Beri persetujuan
                </a>
                <a href="#" class="mt25 btn btn-primary" data-toggle="modal" data-user="direksi" data-target="#reject">
                    <i class="fa fa-ban"></i> Tolak
                </a>
            @endif -->

            <!-- Give condition to update -->
            @if (($data['planning_stage'] == 0 || $data['planning_stage'] == 100) && $user['role_level'] == 2)
                <a href="<?php echo url('perencanaan/ubah'); ?>/{{ $data['id'] }}" class="btn btn-default-bright"><i class="fa fa-edit"></i> Ubah perencanaan </a>
            @endif
        </div>
        <div class="clear"></div>

        <br>

        <i class="fa fa-lg fa-circle text-warning"></i>
        {{ $stage }}

        <hr>
        <dt>Proses persetujuan</dt>
        <dd>
            @if ($data['verified'] > 0)
            <i class="fa fa-lg fa-user text-success"></i>&nbsp;
            Diverifikasi pengadaan: {{ $data['verificator']['name'] }} ( {{ date('d F Y', strtotime($data['verification_date'])) }})
            @else
            <i class="fa fa-lg fa-user"></i>&nbsp;
            -
            @endif
        </dd>
        <!-- <dd>
            @if (array_key_exists(0, $approval))
            <i class="fa fa-lg fa-user text-success"></i>&nbsp;
            Disetujui Manajer: {{ $approval[0]['user']['name'] }} ({{ date('d F Y', strtotime($approval[0]['approval_time'])) }})
            @else
            <i class="fa fa-lg fa-user "></i>&nbsp;
            Menunggu persetujuan Manajer
            @endif
        </dd>
        <dd>
            @if (array_key_exists(1, $approval))
            <i class="fa fa-lg fa-user text-success"></i>&nbsp;
            Disetujui Kepala Divisi: {{ $approval[1]['user']['name'] }} ({{ date('d F Y', strtotime($approval[1]['approval_time'])) }})
            @else
            <i class="fa fa-lg fa-user "></i>&nbsp; Menunggu persetujuan Kepala Divisi
            @endif
        </dd>
        <dd>
            @if (array_key_exists(2, $approval))
            <i class="fa fa-lg fa-user text-success"></i>&nbsp;
            Disetujui Direksi: {{ $approval[2]['user']['name'] }} ({{ date('d F Y', strtotime($approval[2]['approval_time'])) }})
            @else
            <i class="fa fa-lg fa-user "></i>&nbsp; Menunggu persetujuan Direksi
            @endif
        </dd> -->
        <hr>
        <dt>Unit Kerja</dt>
        <dd>{{ $user->unit->name }}</dd>
        <dt>Nama Pengaju</dt>
        <dd>{{ $data['user']['name'] }}</dd>
        <dt>Metode Lelang</dt>
        <dd>{{ $method }}</dd>
        <!--
        <dt>Metode Kualifikasi</dt>
        <dd>
            @if ($data['procurement_qualification'] != null)
            {{ $data['procurement_qualification'] }}
            @else
            -
            @endif
        </dd>
        -->
        <dt>Nama Pekerjaan</dt>
        <dd>{{ $data['title']}} </dd>
        <dt>Nilai HPS</dt>
        <dd>Rp. {{ number_format($data['amount'], 0, ',', '.') }}</dd>
        <dt>Usulan Tanggal Mulai</dt>
        <dd>{{ date('d F Y', strtotime($data['start_date'])) }}</dd>
        <dt>Usulan Penyedia</dt>
        <dd>{{ $vendors }}</dd>
        <hr>
        <dt>Nota Dinas</dt>
        <dd>{{ $data['memo_number']}}</dd>
        @if(!empty($memo))
            <dd>
                <a href="/uploads/{{ $memo['filepath'] }}" target="_blank">{{ $memo['filename'] }}</a>
            </dd>
        @endif
        <dt>SPPP/B</dt>
        <dd>{{ $data['issuance_number'] }}</dd>
        @if(!empty($issuance))
            <dd>
                <a href="/uploads/{{ $issuance['filepath'] }}" target="_blank">{{ $issuance['filename'] }}</a>
            </dd>
        @endif
        <dt>RKS Teknis</dt>
        <dd>RKS-eprocurement</dd>
        @if(!empty($rks))
            <dd>
                <a href="/uploads/{{ $rks['filepath'] }}" target="_blank">{{ $rks['filename'] }}</a>
            </dd>
        @endif

        <hr>
        <dt>Justifikasi </dt>
        <dd>{{ $data['justification'] }}</dd>
        <dt>Catatan Lain</dt>
        <dd>{{ $data['notes'] }}</dd>
        @if ($data['verification_by'])
        <hr>
        <dt>Catatan verifikasi pengada </dt>
        <dd>{{ $data['verification_note'] }}</dd>
        <dt>RKS Administrasi oleh Pengada</dt>
        @if(!empty($rksverify))
            <dd>
                <a href="/uploads/{{ $rksverify['filepath'] }}" target="_blank">{{ $rksverify['filename'] }}</a>
            </dd>
        @endif
        @endif
    </dl>

    <hr>
    <h5>Log Pengajuan</h5>
    @foreach ($data['log'] as $act)
        <div class="vnd-chat-item">
            <div class="col-sm-12">
                <div class="vnd-chat-author">
                    {{ $act['log']}}
                </div>
                <div class="vnd-chat-time">
                    {{ \App\Helpers\AuxHelper::render_date_time($act['created_at']) }}
                </div>
            </div>
            <div class="clear"></div>
        </div>
    @endforeach

    <hr>
    <h5>Log Percakapan</h5>

    @foreach ($data['chat'] as $chat)
    <div class="vnd-chat-item">
            <div class="col-sm-2">
                <div class="vnd-chat-author">
                    {{ $chat['sender']['name'] }}
                </div>
                <div class="vnd-chat-time">
                    {{ \App\Helpers\AuxHelper::render_date_time($chat['created_at']) }}
                </div>
            </div>
            <div class="col-sm-9 vnd-chat-msg">
                {!! html_entity_decode($chat['message']) !!}
            </div>
            <div class="clear"></div>
        </div>
    @endforeach

    <hr>

    komunikasi proses persetujuan

    <form class="form" role="form" action="/perencanaan/chats" method="POST" >
        <textarea id="summernote" name="message"></textarea>
        <input type="hidden" name="id" value="{{ $data['id'] }}">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default-bright">Kirim </button>
    </form>
    <hr>

</div>
