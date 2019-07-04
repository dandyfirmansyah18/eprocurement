@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="tab-pane active" id="first" role="tabpanel">
        @if($measurement != null && $measurement->schedule == true && $measurement->evaluation == true)
        <a id="trg_start" href="#" class="btn btn-primary" {{ $disabled }}><i class="fa fa-play"></i> Mulai Pengadaan</a>
        @else
        <a href="#" class="btn btn-primary disabled" ><i class="fa fa-play"></i> Mulai Pengadaan</a>
        @endif
        <br><p>tombol pengadaan aktif setelah proses drafting lengkap</p>
        <hr>
        <dt>Proses <em>Drafting</em></dt>
        <dd>
            @if($measurement != null && $measurement->evaluation == true)
            <i class="ti-check-box"></i>&nbsp; Kriteria Penilaian
            @else
            <i class="ti-control-stop"></i>&nbsp; Kriteria Penilaian
            @endif
        </dd>
        <dd>
            @if($measurement != null && $measurement->schedule == true)
            <i class="ti-check-box"></i>&nbsp; Jadwal Pengadaan
            @else
            <i class="ti-control-stop"></i>&nbsp; Jadwal Pengadaan
            @endif
        </dd>
        <hr>
        <dt>Unit Kerja</dt>
        <dd>Bagian Umum</dd>
        <dt>Nama Pengaju</dt>
        <dd>{{ $item_user->name }}</dd>
        <dt>Metode Lelang</dt>
        <dd>
            {{ $item->method }}
        </dd>
        <dt>Metode Kualifikasi</dt>
        <dd>
            {{ $item->qualification }}
        </dd>
        <dt>Metode Penyampaian Dokumen</dt>
        <dd>
            {{ $item->deliverable }}
        </dd>
        <dt>Nama Pekerjaan</dt>
        <dd>
            {{ $item->title}}
        </dd>
        <dt>Nilai HPS</dt>
        <dd>
            Rp. {{ number_format($item->amount, 0, ',', '.') }}
        </dd>
        <dt>Usulan Tanggal Mulai</dt>
        <dd>
            {{ DateHelper::long_format($item->start_date) }}
        </dd>

        <hr>

        <dt>Nota Dinas</dt>
        <dd>{{ $item->memo_number }}</dd>
        @if(!empty($memo))
            <dd>
                {!! FormHelper::file_tag($memo->filepath, $memo->filename) !!}
            </dd>
        @endif
        <dt>SPPP/B</dt>
        <dd>{{ $item->issuance_number }}</dd>
        @if(!empty($issuance))
            <dd>
                {!! FormHelper::file_tag($issuance->filepath, $issuance->filename) !!}
            </dd>
        @endif
        <dt>RKS Teknis</dt>
        <dd>RKS-eprocurement</dd>
        @if(!empty($rks))
            <dd>
                {!! FormHelper::file_tag($rks->filepath, $rks->filename) !!}
            </dd>
        @endif
        <hr>
        <dt>Justifikasi </dt>
        <dd>
            {{ $item->justification }}
        </dd>
        <dt>Catatan Lain</dt>
        <dd>
            {{ $item->notes }}
        </dd>
    <!-- <hr>
    Log Pengajuan ini:

    <br>Pengajuan dibuat pada tanggal {{ DateHelper::long_format($item->created_at) }}
    @if ($item->verified && $item->verification_by != null)
        <br>
        Persetujuan Supervisor oleh {{ $item->verificator->name }} pada tanggal {{ DateHelper::long_format($item->verification_date) }}
    @endif

    @if (array_key_exists(0, $approval))
        <br>
        Persetujuan Manager oleh {{ $approval[0]['user']['name'] }} pada tanggal {{ DateHelper::long_format($approval[0]['created_at']) }}
    @endif

    @if (array_key_exists(1, $approval))
        <br>
        Persetujuan Kepala Divisi oleh {{ $approval[1]['user']['name'] }} pada tanggal {{ DateHelper::long_format($approval[1]['created_at']) }}
    @endif

    @if (array_key_exists(2, $approval))
        <br>
        Persetujuan Direksi oleh {{ $approval[2]['user']['name'] }} pada tanggal {{ DateHelper::long_format($approval[2]['created_at']) }}
    @endif
    <hr> -->
</div>
