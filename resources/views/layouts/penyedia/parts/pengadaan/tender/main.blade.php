@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="card panel expanded">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#tab_tender" data-target="#stend_main">
      <header class="teksutama">
          Pembukaan dan Pembuktian Penawaran
          <br>
          @if($schedule->a_tender != null)
            <span class="pcr-date">
                {{ $schedule->a_tender }}
            </span>
          @endif
      </header>
      <div class="tools">
        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
      </div>
    </div>
    <div id="stend_main" class="collapse in">
        <div class="card-body acccardbody">
            <br />
            <div class="judulformtop">BA Pembuktian Penawaran</div>
            <p>
                @if($file_tender != null)
                    {!! FormHelper::file_tag($file_tender->filepath, $file_tender->filename) !!}
                    <p>
                        Catatan: {{ $ba_tender->notes }}
                    </p>
                @else
                    Belum ada BA Pembuktian Penawaran.
                @endif
            </p>
            <hr>
            <div class="judulformtop">
                Daftar Dokumen yang sudah Diupload peserta
            </div>

            <table class="table table-bordered order-column hover">
                <thead>
                    <td>Nama Perusahaan</td>
                    <td>Waktu upload</td>
                    <td>File</td>
                    <td>Nilai Penawaran</td>
                    <td>Didownload panitia</td>
                </thead>
                @for ($ii = 0; $ii < count($offereds); $ii++)
                    @php
                        $st_offering   = $offereds[$ii]->offering();
                        $st_tender  = $offereds[$ii]->tender;
                    @endphp
                    <tr>
                        <td>{{ $offereds[$ii]->vendor->name }}</td>
                        <td>{{ DateHelper::time_format($st_offering->created_at) }}</td>
                        <td>
                            {!! FormHelper::file_tag($st_offering->filepath, $st_offering->filename) !!}
                        </td>
                        @if($st_tender != null)
                            <td>{!! $st_tender->amount !!}</td>
                            <td>{{ DateHelper::time_format($st_tender->download) }}</td>
                        @else
                            <td></td>
                            <td>Belum didownload</td>
                        @endif
                    </tr>
                @endfor
            </table>
            <div class="clear"></div>
        </div>
    </div>
</div><!--end .panel -->
