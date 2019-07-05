<div class="tab-pane" id="first2">
    <h3>Daftar Peserta Pengadaan</h3>

    <div class="table-responsive">
        <table id="tabelvendor" class="table table-bordered order-column hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Perusahaan</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @for ($ii = 0; $ii < count($enrollments); $ii++)
                    @php
                        $vendor         = $enrollments[$ii]->vendor;
                        $pre_evaluation = $enrollments[$ii]->pre_evaluation;
                    @endphp
                    <tr>
                        <td>{{ $ii + 1 }}</td>
                        <td><a href="<?php echo url('vendor/detail/' . $vendor->id); ?>">{{ $vendor->name }}</a></td>
                        <td>
                            {{ $vendor->address }}
                            @if ($vendor->province_id > 0)
                                ,&nbsp;{{ $vendor->city->name }}
                            @endif
                        </td>
                        <td>{{ $vendor->phone }}</td>
                        <td>
                            @if($enrollments[$ii]->winner)
                                Pemenang Pengadaan
                            @elseif($negotiating_id == $enrollments[$ii]->id)
                                Negosiasi
                            @elseif($pre_evaluation != null)
                                @if($pre_evaluation->pass)
                                    Lolos Prakualifikasi
                                @else
                                    Tidak Lolos Prakualifikasi
                                @endif
                            @else
                                Peserta Pengadaan
                            @endif
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div><!--end .table-responsive -->

    <em class="text-caption">tabel peserta</em>
</div>
