@php
    use \App\Helpers\DateHelper;
@endphp

<div class="tab-pane" id="second" role="tabpanel">
    <div class="col-md-4">
    <a id="trg_schedule" href="#" class="btn btn-primary btn-block" >
        <i class="fa fa-save"></i> Simpan Jadwal Pengadaan
    </a>
    </div>
    <hr>
    <form id="form_schedule" class="form" action="/draft/schedule_save" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="procurement_id" value="{{ $item->id }}" />
        <div id="tight_date" class=" row">
            <div class="col-md-3">
                Mulai Pengadaan
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="input-group date" id="tanggal_a_start">
                        <div class="input-group-content">
                            <label>Tanggal kegiatan sebenarnya</label>
                            <input type="text" class="form-control" name="schedule[a_start]" value="{{ DateHelper::datepicker($schedule->a_start) }}">
                            
                        </div>
                    </div>
                </div>
            </div>

            @if($item->with_back_date)
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group date" id="tanggal_b_start">
                            <div class="input-group-content">
                                
                                <label>Tanggal backdate administrasi</label>
                                <input type="text" class="form-control" name="schedule[b_start]" value="{{ DateHelper::datepicker($schedule->b_start) }}">
                                
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="clear"></div>
        </div>

        <br>

        @if($item->procurement_qualification == 1)
            <div class="row">
                <div class="col-md-3">
                    Pengumuman Pra-kualifikasi
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
                        <input class="form-control daterange" type="text" name="schedule[a_p_announcement]" value="{{ $schedule->a_p_announcement }}" />
                    </div>
                </div>

                @if($item->with_back_date)
                    <div class="col-md-8 col-md-offset-3">
                        <div class="form-group">
                            
                            <label class="tiny-label">Tanggal Backdate</label>
                            <input class="form-control daterange" type="text" name="schedule[b_p_announcement]" value="{{ $schedule->b_p_announcement }}" />
                        </div>
                    </div>
                @endif
                <div class="clear"></div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-3">
                    Download Dokumen Pra-kualifikasi
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        
                        <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
                        <input class="form-control daterange" type="text" name="schedule[a_p_download]" value="{{ $schedule->a_p_download }}" />
                    </div>
                </div>

                @if($item->with_back_date)
                    <div class="col-md-8 col-md-offset-3">
                        <div class="form-group">
                            
                            <label class="tiny-label">Tanggal Backdate</label>
                            <input class="form-control daterange" type="text" name="schedule[b_p_download]" value="{{ $schedule->b_p_download }}" />
                        </div>
                    </div>
                @endif
                <div class="clear"></div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-3">
                    Penjelasan Dokumen Pra-kualifikasi
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        
                        <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
                        <input class="form-control daterange" type="text" name="schedule[a_p_explanation]" value="{{ $schedule->a_p_explanation }}" />
                    </div>
                </div>

                @if($item->with_back_date)
                    <div class="col-md-8 col-md-offset-3">
                        <div class="form-group">
                            
                            <label class="tiny-label">Tanggal Backdate</label>
                            <input class="form-control daterange" type="text" name="schedule[b_p_explanation]" value="{{ $schedule->b_p_explanation }}" />
                        </div>
                    </div>
                @endif
                <div class="clear"></div>
            </div>

            <br>
        @endif

        <div class="row">
            <div class="col-md-3">
                Pengumuman / Undangan
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    
                    <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
                    <input class="form-control daterange" type="text" name="schedule[a_announcement]" value="{{ $schedule->a_announcement }}" />
                </div>
            </div>

            @if($item->with_back_date)
                <div class="col-md-8 col-md-offset-3">
                    <div class="form-group">
                        
                        <label class="tiny-label">Tanggal Backdate</label>
                        <input class="form-control daterange" type="text" name="schedule[b_announcement]" value="{{ $schedule->b_announcement }}" />
                    </div>
                </div>
            @endif
            <div class="clear"></div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-3">
                Download Dokumen
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    
                    <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
                    <input class="form-control daterange" type="text" name="schedule[a_download]" value="{{ $schedule->a_download }}" />
                </div>
            </div>

            @if($item->with_back_date)
                <div class="col-md-8 col-md-offset-3">
                    <div class="form-group">
                        
                        <label class="tiny-label">Tanggal Backdate</label>
                        <input class="form-control daterange" type="text" name="schedule[b_download]" value="{{ $schedule->b_download }}" />
                    </div>
                </div>
            @endif
            <div class="clear"></div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-3">
                Aanwizing
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    
                    <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
                    <input class="form-control daterange" type="text" name="schedule[a_aanwizing]" value="{{ $schedule->a_aanwizing }}" />
                </div>
            </div>

            @if($item->with_back_date)
                <div class="col-md-8 col-md-offset-3">
                    <div class="form-group">
                        
                        <label class="tiny-label">Tanggal Backdate</label>
                        <input class="form-control daterange" type="text" name="schedule[b_aanwizing]" value="{{ $schedule->b_aanwizing }}" />
                    </div>
                </div>
            @endif
            <div class="clear"></div>
        </div>

        <br>

    </form>
</div>


<link rel="stylesheet" href="{{ asset('css/libs/daterange/daterangepicker.css') }}"  type="text/css"/>

<script type="text/javascript" src="{{ asset('js/libs/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/libs/moment/moment-id.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/libs/daterange/daterangepicker.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Format: 09/10/2017 12:00 - 15/10/2017 11:59
        //moment.locale('id');
        $('.daterange').daterangepicker({
            daysOfWeekDisabled: [0,6],
            timePicker: true,
            timePicker24Hour: true,
            timePickerIncrement: 10,
            locale: {
                format: 'LLLL'
            }
        });

        $('#tanggal_a_start').datepicker({
            autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
        });

        if ($('#tanggal_b_start').length > 0) {
            $('#tanggal_b_start').datepicker({
                autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
            });
        }

        $('#trg_schedule').on('click', function(event){
            submit_form('form_schedule');
            event.preventDefault();
        });
    });
</script>