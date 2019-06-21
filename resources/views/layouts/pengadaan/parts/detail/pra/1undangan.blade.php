@php
    use \App\Helpers\DateHelper;
@endphp

<div class="card panel expanded">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#prakualifikasi" data-target="#pra1">
      <header class="teksutama">
        1. Mulai Prakualifikasi
        <br>
        @if($schedule->a_p_announcement != null)
            <span class="pcr-date">
                {{ $schedule->a_p_announcement }}
            </span>
        @endif
      </header>
      <div class="tools">
        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
      </div>
    </div>
    <div id="pra1" class="collapse in">
        <div class="card-body acccardbody">
          <br />
          <h4>Pengumuman kegiatan, Pendaftaran Peserta dan Undangan Aanwizing Prakualifikasi</h4>
          <hr>
          <form id="form_pann_invitation" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/pengadaan/atur/undangan" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
            <input type="hidden" name="tab_path" value="pra" />
            <input type="hidden" name="item[purpose]" value="p_announcement" />
            <div class="row">
                <div class="col-md-6">
                    @if($file_p_announcement != null)
                        <p>Undangan saat ini: </p>
                        <a href="/uploads/{{ $file_p_announcement->filepath }}" target="_blank">{{ $file_p_announcement->filename }}</a>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="file" class="form-control" name="invitation_doc">
                        <p class="help-block">Upload Undangan baru</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group date" id="inv_p_announcement_block">
                            <div class="input-group-content">
                                <input type="text" class="form-control" id="inv_p_announcement" name="item[activity_date]" value="{{ DateHelper::datepicker($inv_p_announcement->activity_date) }}">
                                <label>Tanggal kegiatan</label>
                                <p class="help-block">tanggal/bulan/tahun</p>
                            </div>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="item[location]" value="{{ $inv_p_announcement->location }}">
                        <label>Lokasi Kegiatan</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group floating-label">
                        <textarea type="text" class="form-control" name="item[foreword]">{{ $inv_p_announcement->foreword }}</textarea>
                        <label>Kata Pengantar Undangan</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <a id="trg_pann_invitation" href="#" class="btn btn-default-bright">
                        <i class="fa fa-save"></i>&nbsp;Simpan Undangan
                    </a>
                </div>
            </div>
        </form>
          <hr>
          Status Undangan:
          <br />
          @if($schedule->a_p_announcement != null)
              @php
                  $date_diff  = DateHelper::end_date_diff($schedule->a_p_announcement)
              @endphp
              @if($date_diff < 0)
                  <i class="fa fa-circle"></i> Belum dikirim. Akan dikirimkan pada {{ explode(' - ', $schedule->a_p_announcement)[1] }}
              @else
                  <i class="fa fa-check-circle"></i> Sudah dikirimkan pada {{ explode(' - ', $schedule->a_p_announcement)[1] }}
              @endif
          @else
              <i class="fa fa-circle"></i> Belum dikirim. Harap mengatur jadwal kegiatan terlebih dahulu.
          @endif
        </div>
    </div>
</div><!--end .panel -->

@push('jspage')
    <script>
        $(document).ready(function(){
            $('#inv_p_announcement_block').datepicker({
                autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
            });

            $('#trg_pann_invitation').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_pann_invitation').submit();
                }
                event.preventDefault();
            });
        });
    </script>
@endpush