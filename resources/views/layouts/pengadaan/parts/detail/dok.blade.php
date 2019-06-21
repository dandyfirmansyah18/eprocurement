@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="tab-pane " id="dok">
    <h3>
        Download Dokumen Lelang
        <span class="pcr-date">{{ $schedule->a_download }}</span>
    </h3>
    <div class="judulformtop">
        Daftar File Kegiatan Pengadaan yang Dapat Didownload Peserta
    </div>
    <dl class="">
        <dt>File RKS Teknis</dt>
            <dd>
                <form class="form" role="form" action="/pengadaan/ubahrksadmin/{{ $procurement['id'] }}" method="POST" >
                <div>
                    <div id="rks_file_block" class="form-group dropzone-block tight">
                        <input type="hidden" name="token_rks_file" id="token_rks_file" value="{{ csrf_token() }}">
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user['id'] }}">
                        <input type="hidden" id="preprocurement_id" name="preid" value="{{ $procurement['id'] }}">
                        <div class="upload-block">
                            @if($doc_tech != null && $doc_tech->filename != null)
                            <div class="image-block">
                                {!! FormHelper::file_tag($doc_tech->filepath, $doc_tech->filename) !!}
                            </div>
                            @endif
                            <div id="rks_file" class="dropzone tight" url="/upload/memo">
                                <div class="dz-message btn btn-default">
                                    <h5>
                                        Pilih file
                                    </h5>
                                </div>
                            </div>
                            <br>
                            {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                        </div>
                        <div class="clear"></div>
                        <p class="help-block"></p>
                        <div class="clear"></div>
                    </div>
                </div>
                </form>
            </dd>
            <hr>
            <dt>File RKS Administrasi</dt>
            <dd>
                <form class="form" role="form" action="/pengadaan/ubahrks/{{ $procurement['id'] }}" method="POST" >
                <div>
                    <div id="verification_file_block" class="form-group dropzone-block tight">
                        <input type="hidden" name="token_verification_file" id="token_verification_file" value="{{ csrf_token() }}">
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user['id'] }}">
                        <input type="hidden" id="preprocurement_id" name="preid" value="{{ $procurement['id'] }}">
                        <div class="upload-block">
                            @if($doc_adm != null && $doc_adm->filename != null)
                            <div class="image-block">
                                {!! FormHelper::file_tag($doc_adm->filepath, $doc_adm->filename) !!}
                            </div>
                            @endif
                            <div id="verification_file" class="dropzone tight" url="/upload/memo">
                                <div class="dz-message btn btn-default">
                                    <h5>
                                        Pilih file
                                    </h5>
                                </div>
                            </div>
                            <br>
                            {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                        </div>
                        <div class="clear"></div>
                        <p class="help-block"></p>
                        <div class="clear"></div>
                    </div>
                </div>
                </form>
            </dd>
    </dl>
    <hr>
    <h4>Daftar peserta yang <strong>belum</strong> mendownload seluruh file</h4>
    <ol>
        @for ($ii = 0; $ii < count($undownloadeds); $ii++)
            <li>{{ $undownloadeds[$ii]->vendor->name }}</li>
        @endfor
    </ol>
    <br>
    <h4>Daftar peserta yang <strong>sudah</strong> mendownload seluruh file</h4>
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
            Dropzone.autoDiscover = false;
            var token_verification_file = $('#token_verification_file').val();
            var user_id = $('#user_id').val();
            var id      = $('#preprocurement_id').val();
            $('#verification_file').dropzone({
                url: '/upload/planning',
                paramName: 'files',
                params: {
                    '_token': token_verification_file,
                    'purpose': 'verification',
                    'id': id,
                    'user_id': user_id
                },
                maxFilesize: 10,
                uploadMultiple: "no",
                maxFiles: 1,
                parallelUploads: 1,
                acceptedFiles: "image/png, image/gif, image/jpeg, .pdf",
                addRemoveLinks: true,
                removedFile: function(file) {
                    $(file.previewElement).parent().parent().parent()
                    .find('.help-block').css('bottom', '30px').css('right', '10px');
                    $(file.previewElement).parent().parent()
                    .find('.dropzone').css('margin-top', '30px');

                    file.previewElement.remove();
                },
                init: function() {
                    this.on("maxfilesexceeded", function() {
                        if (this.files[1]!=null){
                            this.removeFile(this.files[0]);
                        }
                    });
                },
                success: function(file, response) {
                    if(response.status == 'OK') {
                        var filepath = response.filepath;
                        var filename = response.filename;
                        var remove_btn = file.previewElement.querySelector('.dz-remove');

                        file.previewElement.classList.add('dz-success');
                        remove_btn.setAttribute('data-filename', filepath);

                        $(file.previewElement).parent().parent()
                        .find('.dropzone').css('margin-top', '0px');

                        $('#verification_file .dz-image, #verification_file .dz-details').on('click', function(){
                            window.open('/uploads/' + response.filepath,'_blank');
                        });

                        $('#verification_file .dz-remove').on('click', function(){
                            $.ajax({
                                type: 'POST',
                                url: '/file/delete',
                                data: { 'filepath': filepath, '_token': token_verification_file },
                                cache: false,
                                success: function(success){
                                    alert("Dokumen Berhasil Di Upload.");
                                    //console.log(success);
                                    //window.location = window.location.href;
                                },
                                error: function(error){
                                    console.log(error);
                                    alert("Something went wrong, please try again later.");
                                }
                            });
                        });
                    } else {
                        file.previewElement.classList.add('dz-error');
                    }
                },
                error: function(file, response) {
                    file.previewElement.classList.add('dz-error');
                }
            });


            var token_rks_file = $('#token_rks_file').val();
            var user_id = $('#user_id').val();
            var id      = $('#preprocurement_id').val();
            $('#rks_file').dropzone({
                url: '/upload/planning',
                paramName: 'files',
                params: {
                    '_token': token_rks_file,
                    'purpose': 'rks',
                    'id': id,
                    'user_id': user_id
                },
                maxFilesize: 10,
                uploadMultiple: "no",
                maxFiles: 1,
                parallelUploads: 1,
                acceptedFiles: "image/png, image/gif, image/jpeg, .pdf",
                addRemoveLinks: true,
                removedFile: function(file) {
                    $(file.previewElement).parent().parent().parent()
                    .find('.help-block').css('bottom', '30px').css('right', '10px');
                    $(file.previewElement).parent().parent()
                    .find('.dropzone').css('margin-top', '30px');

                    file.previewElement.remove();
                },
                init: function() {
                    this.on("maxfilesexceeded", function() {
                        if (this.files[1]!=null){
                            this.removeFile(this.files[0]);
                        }
                    });
                },
                success: function(file, response) {
                    if(response.status == 'OK') {
                        var filepath = response.filepath;
                        var filename = response.filename;
                        var remove_btn = file.previewElement.querySelector('.dz-remove');

                        file.previewElement.classList.add('dz-success');
                        remove_btn.setAttribute('data-filename', filepath);

                        $(file.previewElement).parent().parent()
                        .find('.dropzone').css('margin-top', '0px');

                        $('#rks_file .dz-image, #verification_file .dz-details').on('click', function(){
                            window.open('/uploads/' + response.filepath,'_blank');
                        });

                        $('#rks_file .dz-remove').on('click', function(){
                            $.ajax({
                                type: 'POST',
                                url: '/file/delete',
                                data: { 'filepath': filepath, '_token': token_rks_file },
                                cache: false,
                                success: function(success){
                                    alert("Dokumen Berhasil Di Upload.");
                                    //console.log(success);
                                    //window.location = window.location.href;
                                },
                                error: function(error){
                                    console.log(error);
                                    alert("Something went wrong, please try again later.");
                                }
                            });
                        });
                    } else {
                        file.previewElement.classList.add('dz-error');
                    }
                },
                error: function(file, response) {
                    file.previewElement.classList.add('dz-error');
                }
            });

        });
    </script>
@endpush
