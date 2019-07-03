@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="tab-pane p-20" id="dok" role="tabpanel">
    <h4>
        Download Dokumen Lelang
    </h4>
    <h8>{{ $schedule->a_download }}</h8>
    <hr>
    <div class="judulformtop">
        Daftar File Kegiatan Pengadaan yang Dapat Didownload Peserta
    </div>
    <dl class="">
        <dt>File RKS Teknis</dt>
        <dd>
            @if($doc_tech != null)
                {!! FormHelper::file_tag($doc_tech->filepath, $doc_tech->filename) !!}
            @endif
            &nbsp;
        </dd>
        <hr>
        <dt>File RKS Administrasi</dt>
        <dd>
            @if($doc_adm != null)
                {!! FormHelper::file_tag($doc_adm->filepath, $doc_adm->filename) !!}
            @endif
            &nbsp;
        </dd>
    </dl>
    <hr>
    <h6>Daftar peserta yang <strong>belum</strong> mendownload seluruh file</h6>
    <ol>
        @for ($ii = 0; $ii < count($undownloadeds); $ii++)
            <li>{{ $undownloadeds[$ii]->vendor->name }}</li>
        @endfor
    </ol>
    <br>
    <h6>Daftar peserta yang <strong>sudah</strong> mendownload seluruh file</h6>
    <ol>
        @for ($ii = 0; $ii < count($downloadeds); $ii++)
            <li>{{ $downloadeds[$ii]->vendor->name }}&nbsp;({{ DateHelper::time_format($downloadeds[$ii]->updated_at) }})</li>
        @endfor
    </ol>
    <hr>
</div>

@push('jspage')
    <script>
        $(document).ready(function(){
            $('#trg_sch_submission').on('click', function(event){
                var $el     = $(this);
                $('#sch_tab').val('tawareval');
                $('#sch_part').val('submission');

                if($el.data('actual') != '') {
                    $('#sch_date').val($el.data('actual'));
                }

                if($('#sch_backdate').length > 0 && $el.data('back') != '') {
                    $('#sch_backdate').val($el.data('back'));
                }

                $('.daterange').daterangepicker({
                    daysOfWeekDisabled: [0,6],
                    timePicker: true,
                    timePicker24Hour: true,
                    timePickerIncrement: 10,
                    locale: {
                        format: 'LLLL'
                    }
                });

                $('#schedule_modal').modal();
                event.preventDefault();
            });
        });
    </script>
@endpush
