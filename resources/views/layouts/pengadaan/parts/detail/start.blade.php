@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="tab-pane " id="start">
    <h3>
        Pengumuman dan Undangan Aanwizing
        <span class="pcr-date">{{ $schedule->a_announcement }}</span>
    </h3>

    <div class="judulformtop">
        Undangan berikut merupakan undangan Aanwizing peserta
    </div>

    <form id="form_st01" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/pengadaan/atur/pengumuman" method="POST">
        <input type="hidden" name="procurement_id" id="procurement_id" value="{{ $procurement->id }}" />
        {{ csrf_field() }}
        
        <div class="row">
            <div class="col-md-6">
                @if($inv_announcement != null)
                    <p>Undangan saat ini: </p>
                    {!! FormHelper::file_tag($inv_announcement->filepath, $inv_announcement->filename) !!}
                @endif
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <input type="hidden" name="upload_token" id="upload_token" value="{{ csrf_token() }}">
                    <div id="st01_file" class="dropzone st-dropzone" url="/upload/procurement">
                        <div class="dz-message btn btn-default">
                            <h3>
                                Pilih file
                            </h3>
                        </div>
                    </div>
                    <p class="help-block st-help-block">Unggah undangan baru</p>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group date" id="st01_date_block">
                        <div class="input-group-content">
                            <input type="text" class="form-control" id="st01_date" name="item[activity_date]" value="{{ DateHelper::datepicker($announcement->activity_date) }}">
                            <label>Tanggal kegiatan</label>
                            <p class="help-block">tanggal/bulan/tahun</p>
                        </div>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" id="st01_location" name="item[location]" value="{{ $announcement->location }}">
                    <label>Lokasi Kegiatan</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group floating-label">
                    <textarea type="text" class="form-control" id="st01_foreword" name="item[foreword]">{{ $announcement->foreword }}</textarea>
                    <label>Kata Pengantar Undangan</label>
                </div>
            </div>
            <div class="col-md-6">
                <a id="trg_st01" href="#" class="btn btn-default-bright">
                    <i class="fa fa-save"></i> Simpan Undangan
                </a>
            </div>
            <div class="clear"></div>
        </div>
    </form>
    <hr>

    @php
        $date_diff  = DateHelper::end_date_diff($schedule->a_announcement)
    @endphp
    Status Undangan:
    <br>
    @if($date_diff < 0)
        <i class="fa fa-circle"></i>
        &nbsp;Belum dikirim. Akan dikirimkan pada
        &nbsp;{{ DateHelper::end_date($schedule->a_announcement) }}
    @else
        <i class="fa fa-check-circle"></i>
        &nbsp;Sudah dikirimkan pada
        &nbsp;{{ DateHelper::end_date($schedule->a_announcement) }}
    @endif
    <hr>
</div>

@push('jspage')
    <script>
        $(document).ready(function(){
            $('#st01_date_block').datepicker({
                autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
            });

            $('#trg_st01').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_st01').submit();
                }
                event.preventDefault();
            });
        });
    </script>
@endpush
