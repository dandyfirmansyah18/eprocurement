@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="card panel collapsed">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#tab_tender" data-target="#stend_addition">
      <header class="teksutama">
          Pembukaan dan Pembuktian Penawaran 2
          <br>
          @if($schedule->a_tender2 != null)
            <span class="pcr-date">
                {{ $schedule->a_tender2 }}
            </span>
          @endif
      </header>
      <div class="tools">
        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
      </div>
    </div>
    <div id="stend_addition" class="collapse">
        <div class="card-body acccardbody">
            <br />
            <div class="judulformtop">BA Pembuktian Penawaran 2</div>
            <p>
                @if($file_tender2 != null)
                    {!! FormHelper::file_tag($file_tender2->filepath, $file_tender2->filename) !!}
                    <p>
                        Catatan: {{ $ba_tender2->notes }}
                    </p>
                @else
                    Belum ada BA Pembuktian Penawaran.
                @endif
            </p>
            <hr>
            <div class="judulformtop">
                Daftar Dokumen 2 yang sudah Diupload peserta
            </div>

            <table class="table table-bordered order-column hover">
                <thead>
                    <td>Nama Perusahaan</td>
                    <td>Waktu upload</td>
                    <td>File</td>
                    <td>Nilai Penawaran</td>
                    <td>Didownload panitia</td>
                </thead>
                @for ($ii = 0; $ii < count($offered_mores); $ii++)
                    @php
                        $st_offering    = $offered_mores[$ii]->offering2();
                        $st_tender      = $offered_mores[$ii]->tender2;
                    @endphp
                    <tr>
                        <td>{{ $offered_mores[$ii]->vendor->name }}</td>
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
