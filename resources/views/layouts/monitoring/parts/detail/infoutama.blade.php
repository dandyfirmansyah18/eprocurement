<!-- detail dan persetujuan pengadaan -->
<div class="tab-pane active" id="detail" role="tabpanel">
        <div class="p-20">
            <h4>Pelaksana Pekerjaan (pemenang pengadaan) : 
                <a href="/vendor/detail/{{ $winner->id }}">{{ $winner->name }}</a>
            </h4>
            <hr>
                <dl class="mt25 uhui dl-horizontal">
                <dt>Unit Kerja</dt>
                <dd>{{ $user->unit->name }}</dd>
                <dt>Nama Pengaju</dt>
                <dd>{{ $procurements['user']['name'] }}</dd>
                <dt>Metode Lelang</dt>
                <dd>
                    @php
                    switch($procurements['procurement_method']){
                        case(1):
                        echo 'Pelelangan/Seleksi Umum';
                        break;
                        case(2):
                        echo 'Pelelangan Selektif/Seleksi Terbatas';
                        break;
                        case(3):
                        echo 'Pemilihan Langsung/Seleksi Langsung';
                        break;
                        case(4):
                        echo 'Penunjukan Langsung';
                        break;
                        case(5):
                        echo 'Pengadaan Langsung';
                        break;
                    }
                    @endphp
                </dd>
                <dt>Metode Kualifikasi</dt>
                <dd>
                    @if ($procurements['procurement_qualification'] != null)
                    @php
                    switch($procurements['procurement_qualification']){
                        case(1):
                        echo 'Satu sampul';
                        break;
                        case(2):
                        echo 'Dua sampul';
                        break;
                        case(3):
                        echo 'Dua tahap';
                        break;
                    }
                    @endphp
                    @else
                    -
                    @endif
                </dd>
                <dt>Nama Pekerjaan</dt>
                <dd>{{ ucwords($procurements['title'])}} </dd>
                <dt>Nilai HPS</dt>
                <dd>Rp. {{ number_format($procurements['amount'], 0, ',', '.') }}</dd>
                <dt>Usulan Tanggal Mulai</dt>
                <dd>{{ date('d F Y', strtotime($procurements['start_date'])) }}</dd>
                <hr>
                <dt>Nota Dinas</dt>
                <dd>{{ $procurements['memo_number']}}</dd>
                    @if(!empty($memo))
                        <dd>
                            <a href="/uploads/{{ $memo['filepath'] }}" target="_blank">{{ $memo['filename'] }}</a>
                        </dd>
                    @endif
                <dt>SPPP/B</dt>
                <dd>{{ $procurements['issuance_number'] }}</dd>
                    @if(!empty($issuance))
                        <dd>
                            <a href="/uploads/{{ $issuance['filepath'] }}" target="_blank">{{ $issuance['filename'] }}</a>
                        </dd>
                    @endif
                <dt>RKS Teknis</dt>
                <dd>RKS-eprocurement</dd>
                    @if(!empty($rks))
                        <dd>
                            <a href="/uploads/{{ $issuance['filepath'] }}" target="_blank">{{ $rks['filename'] }}</a>
                        </dd>
                    @endif
                <hr>
                <dt>Justifikasi </dt>
                <dd>{{ $procurements['justification'] }}</dd>
                <dt>Catatan Lain</dt>
                <dd>{{ $procurements['notes'] }}</dd>
                <hr>
                <dt>Pelaksana pekerjaan </dt>
                <dd></dd>
            </dl>
            <hr>
            Log Pengajuan ini:

            <br>Pengajuan dibuat pada tanggal {{ date('d F Y', strtotime($procurements['created_at']))}}
            @if ($procurements['verified'])
            <br>
            Persetujuan Supervisor oleh {{ $procurements['verificator']['name']}} pada tanggal {{ date('d F Y', strtotime($procurements['verification_date']))}}
            @endif

            @if (array_key_exists(0, $approval))
            <br>
            Persetujuan Manager oleh {{ $approval[0]['user']['name']}} pada tanggal {{ date('d F Y', strtotime($approval[0]['created_at']))}}
            @endif

            @if (array_key_exists(1, $approval))
            <br>
            Persetujuan Kepala Divisi oleh {{ $approval[1]['user']['name']}} pada tanggal {{ date('d F Y', strtotime($approval[1]['created_at']))}}
            @endif

            @if (array_key_exists(2, $approval))
            <br>
            Persetujuan Direksi oleh {{ $approval[2]['user']['name']}} pada tanggal {{ date('d F Y', strtotime($approval[2]['created_at']))}}
            @endif
            <hr>
        </div>
</div>
