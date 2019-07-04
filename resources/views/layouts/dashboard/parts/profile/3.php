@php
  use \App\Helpers\DateHelper;
  use \App\Helpers\FormHelper;
  use \App\Helper\AttachmentHelper;
@endphp

<div class="row mt25">
    @if($user->state == 1)
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <a href="/penyedia/ubah_lainnya" class="btn btn-primary btn-block">
                <i class="fa fa-edit"></i>&nbsp;Ubah Data
            </a>
        </div>
    @endif
</div>

<hr>
<div class="mt25">
    <label class="radio-inline checkbox-styled">
        <span>Tabel daftar Surat/Sertifikat Pendukung Perusahaan/</span>
    </label>

    <table class="table no-margin">
        <thead>
            <tr>
                <th>#</th>
                <th>Jenis Surat</th>
                <th>No Surat/Sertifikat</th>
                <th>Nama Surat/Sertifikat</th>
                <th>Tanggal Diterbitkan</th>
                <th>Tanggal Habis Berlaku</th>
                <th>Institusi</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            @for($im = 0; $im < count($certs); $im++)
                @php
                    $doc = $certs[$im]->doc()
                @endphp
                <tr>
                    <td class="number">{{ $im + 1 }}</td>
                    <td>{{ $certs[$im]->type }}</td>
                    <td>{{ $certs[$im]->number }}</td>
                    <td>{{ $certs[$im]->title }}</td>
                    <td>{{ DateHelper::datepicker($certs[$im]->release_date) }}</td>
                    <td>{{ DateHelper::datepicker($certs[$im]->expired_date) }}</td>
                    <td>{{ $certs[$im]->author }}</td>
                    <td>
                        @if($doc != null)
                            {!! FormHelper::file_tag($doc->filepath, $doc->filename) !!}
                        @endif
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>

    <hr>

    <label class="radio-inline checkbox-styled">
        <span>Tabel daftar pengalaman</span>
    </label>

    <table class="table no-margin">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Paket Pekerjaan</th>
                <th>Bidang/Sub Bidang</th>
                <th>Lokasi</th>
                <th>Pemberi Tugas/Pengguna Jasa <br>(Nama/No Telp)</th>
                <th>Kontrak <br>Nomor/Tanggal / Nilai</th>
                <th>Tanggal Selesai <br>Kontrak / BA Serah Terima</th>
            </tr>
        </thead>
        <tbody>
            @for($im = 0; $im < count($exps); $im++)
            <tr>
                <td>{{ $im + 1 }}</td>
                <td>{{ $exps[$im]->name }}</td>
                <td>{{ $exps[$im]->field }}</td>
                <td>{{ $exps[$im]->location }}</td>
                <td>{{ $exps[$im]->client_name }} / {{ $exps[$im]->client_phone }}</td>
                <td>{{ $exps[$im]->contract_number }} / Rp {{ $exps[$im]->contract_value }}</td>
                <td>{{ $exps[$im]->contract_due }} / {{ $exps[$im]->hand_over }}%</td>
            </tr>
            @endfor
        </tbody>
    </table>
</div>
