@extends('layouts.main')

@section('title','Halaman Detail Pengadaan')

@push('csspage')
    <link rel="stylesheet" href="{{ URL::asset('css/libs/summernote/summernote.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('js/libs/rating/star-rating.min.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/libs/dropzone/dropzone-theme.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/libs/daterange/daterangepicker.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}"  type="text/css"/>
@endpush

@section('content')
<!-- BEGIN content SECTION -->
<section class="style-default-bright">
    <div class="section-header">
        <h3>
            <span class="">{{ ucwords($procurement['title']) }}&nbsp;</span>
            <small>
                <i class="fa fa-circle" style="color:orange"></i>:&nbsp;Sudah dilaksanakan&nbsp;;&nbsp;
                <i class="fa fa-circle-o"></i>:&nbsp;sedang berlangsung&nbsp;
            </small>
        </h3>
    </div>
    <div class="section-body mt0">
        <div class="row">
            <div class="col-md-12">
                <div class="card tabs-left style-default-light">
                    <ul class="card-head nav nav-tabs" data-toggle="tabs">
                        <li class="active">
                            <a href="#first1">
                                <i class="fa fa-file-text"></i> &nbsp; Detail Pengadaan &nbsp;
                            </a>
                        </li>
                        <li>
                            <a href="#first2">
                                <i class="fa fa-users"></i> &nbsp; Daftar Peserta &nbsp;
                            </a>
                        </li>
                        @if($procurement->procurement_qualification == 1)
                            <li>
                                <a href="#pra">
                                    {!! $procurement->render_stage_icon(1) !!}&nbsp;Prakualifikasi
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="#start">
                                {!! $procurement->render_stage_icon(2) !!}&nbsp;1. Pengumuman/Undangan
                            </a>
                        </li>
                        <li>
                            <a href="#dok">
                                {!! $procurement->render_stage_icon(3) !!}&nbsp;2. Download Dokumen
                            </a>
                        </li>
                        <li>
                            <a href="#aanwizing">
                                {!! $procurement->render_stage_icon(4) !!}&nbsp;3. Aanwizing
                            </a>
                        </li>
                        <li>
                            <a href="#tawareval">
                                {!! $procurement->render_stage_icon(5) !!}&nbsp;4. Upload Penawaran
                            </a>
                        </li>
                        <li>
                            <a href="#buka">
                                {!! $procurement->render_stage_icon(6) !!}&nbsp;5. Pembukaan Penawaran
                            </a>
                        </li>
                        <li>
                            <a href="#eval">
                                {!! $procurement->render_stage_icon(7) !!}&nbsp;6. Evaluasi Penawaran
                            </a>
                        </li>
                        <li>
                            <a href="#nego">
                                {!! $procurement->render_stage_icon(10) !!}&nbsp;7. Negosiasi
                            </a>
                        </li>
                        @if($procurement->procurement_method != 5)
                        <li>
                            <a href="#calonpem">
                                {!! $procurement->render_stage_icon(6) !!}&nbsp;8. Pengusulan Calon Pemenang
                            </a>
                        </li>
                        <li>
                            <a href="#evalpengumuman">
                                {!! $procurement->render_stage_icon(7) !!}&nbsp;9. Penetapan dan Pengumuman Pemenang
                            </a>
                        </li>
                        <li>
                            <a href="#sanggah">
                                {!! $procurement->render_stage_icon(8) !!}&nbsp;10. Sanggahan
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="#kontrak">
                                {!! $procurement->render_stage_icon(9) !!}&nbsp;11. SK Penetapan Pemenang
                            </a>
                        </li>

                    </ul>
                    <div class="pt0 card-body tab-content style-default-bright">
                        @include('pengadaan.parts.detail.infoutama')

                        @include('pengadaan.parts.detail.penyedia')

                        @if($procurement->procurement_qualification == 1)
                            @include('pengadaan.parts.detail.pra')
                        @endif

                        @include('pengadaan.parts.detail.start')

                        @include('pengadaan.parts.detail.dok')

                        @include('pengadaan.parts.detail.aanwizing')

                        @include('pengadaan.parts.detail.tawareval')

                        @include('pengadaan.parts.detail.buka')

                        @include('pengadaan.parts.detail.eval')

                        @include('pengadaan.parts.detail.nego')

                        @include('pengadaan.parts.detail.calonpem')

                        @include('pengadaan.parts.detail.evalpengumuman')

                        @include('pengadaan.parts.detail.sanggah')

                        @include('pengadaan.parts.detail.kontrak')
                    </div><!--end .card-body -->
                </div><!--end .card -->
            </div>

        </div>
    </div>
</section>
<!-- END content SECTION -->
@endsection

@push('modal')
    <!--Modal -->
    <div class="modal fade" id="verifikasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="formModalLabel">Ubah Catatan Vendor</h4>
                </div>
                <div class="modal-body">
                    <form class="form" role="form">


                        <div class="form-group floating-label">
                            <textarea type="text" class="form-control" id="regular2">doing good </textarea>
                            <label for="regular2">Catatan</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div>
    </div>

    <!--Modal penawaran-->
    <div class="modal fade" id="penawaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="formModalLabel">Unduh penawaran</h4>
                </div>
                <div class="modal-body">
                    <p>File penawaran hanya dapat diunduh pada hari kegiatan pembukaan penawaran</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>

    <!-- Schedule Modal -->
    <div class="modal fade" id="schedule_modal" tabindex="-1" role="dialog" aria-labelledby="schedule_modal_label">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="schedule_modal_label">Atur Jadwal Kegiatan</h4>
                </div>
                <div class="modal-body">
                    <form id="form_schedule" class="form" role="form" action="/pengadaan/atur/jadwal" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                        <input type="hidden" id="sch_tab" name="tab_path" value="" />
                        <input type="hidden" id="sch_part" name="item[part]" value="" />

                        <div class="row">
                            <div class="col-md-3">
                                Tanggal Kegiatan
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input id="sch_date" class="form-control daterange" type="text" name="item[a]" value="" />
                                    <label class="tiny-label">Tanggal Kegiatan Sebenarnya</label>
                                </div>
                            </div>

                            @if($procurement->with_back_date)
                                <div class="col-md-8 col-md-offset-3">
                                    <div class="form-group">
                                        <input id="sch_backdate" class="form-control daterange" type="text" name="item[b]" value="" />
                                        <label class="tiny-label">Tanggal Backdate</label>
                                    </div>
                                </div>
                            @endif
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button id="trg_schedule_save" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div>
    </div>

    <div class="hidden-block">
        <form id="form_work" method="POST" action="/pengadaan/selesai">
            {{ csrf_field() }}
            <input type="hidden" id="work_id" name="id" value="{{ $procurement->id }}" />
        </form>
    </div>

    <div id="active_tab" class="hidden-block">{{ Session::get('tab') }}</div>
    @php
        Session::forget('tab');
    @endphp
@endpush

@push('jspage')
<script type="text/javascript" src="{{ URL::asset('js/libs/summernote/summernote.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/libs/rating/star-rating.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/libs/dropzone/dropzone.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/libs/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/libs/moment/moment-id.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/libs/daterange/daterangepicker.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#input-2-xs").rating();

    $('#trg_schedule_save').on('click', function(event){
        $('form#form_schedule').submit();
        event.preventDefault();
    })

    $('#summernote2').summernote({
        height: 150,
        placeholder: 'tulis pesan',
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'table', 'hr']]
        ]
    });

    $('#summernote3').summernote({
        height: 150,
        placeholder: 'tulis pesan',
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'table', 'hr']]
        ]
    });

    $('#tanggalverifikasi').datepicker({
        autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });

    // Attachment Handler
    Dropzone.autoDiscover = false;
    var procurement_id  = $('#procurement_id').val();
    var upload_token    = $('#upload_token').val();

    // Start Announcement
    $('#st01_file').dropzone({
        url: '/upload/procurement',
        paramName: 'files',
        params: {
            '_token': upload_token,
            'purpose': 'invitation',
            'procurement_id': procurement_id
        },
        maxFilesize: 70,
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

                $(file.previewElement).parent().parent().parent()
                .find('.help-block').css('bottom', '-10px').css('right', '30px');

                $(file.previewElement).parent().parent()
                .find('.dropzone').css('margin-top', '0px');

                $('#st01_file .dz-image, #st01_file .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#st01_file .dz-remove').on('click', function(){
                    remove_file(filepath, token_contact_photo);
                });

                //page_ready();
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });
    // End Announcement

    // Start Aanwizing
    $('#trg_st03').on('click', function(event){
        var confirmation = confirm("Apakah anda yakin?");
        if (confirmation == true) {
            $('form#form_st03').submit();
        }
        event.preventDefault();
    });

    $('#st03_file').dropzone({
        url: '/upload/procurement',
        paramName: 'files',
        params: {
            '_token': upload_token,
            'purpose': 'aanwizing',
            'procurement_id': procurement_id
        },
        maxFilesize: 70,
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

                $(file.previewElement).parent().parent().parent()
                .find('.help-block').css('bottom', '-10px').css('right', '30px');

                $(file.previewElement).parent().parent()
                .find('.dropzone').css('margin-top', '0px');

                $('#st03_file .dz-image, #st03_file .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#st03_file .dz-remove').on('click', function(){
                    remove_file(filepath, token_contact_photo);
                });

                //page_ready();
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });
    //End Aanwizing

    // Start Tender
    $('#trg_st04').on('click', function(event){
        var confirmation = confirm("Apakah anda yakin?");
        if (confirmation == true) {
            $('form#form_st04').submit();
        }
        event.preventDefault();
    });

    $('#st04_file').dropzone({
        url: '/upload/procurement',
        paramName: 'files',
        params: {
            '_token': upload_token,
            'purpose': 'tender',
            'procurement_id': procurement_id
        },
        maxFilesize: 70,
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

                $(file.previewElement).parent().parent().parent()
                .find('.help-block').css('bottom', '-10px').css('right', '30px');

                $(file.previewElement).parent().parent()
                .find('.dropzone').css('margin-top', '0px');

                $('#st04_file .dz-image, #st04_file .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#st04_file .dz-remove').on('click', function(){
                    remove_file(filepath, token_contact_photo);
                });

                //page_ready();
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });
    // End Tender

    // Start Candidate
    $('#st06_file').dropzone({
        url: '/upload/procurement',
        paramName: 'files',
        params: {
            '_token': upload_token,
            'purpose': 'candidate',
            'procurement_id': procurement_id
        },
        maxFilesize: 70,
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

                $(file.previewElement).parent().parent().parent()
                .find('.help-block').css('bottom', '-10px').css('right', '30px');

                $(file.previewElement).parent().parent()
                .find('.dropzone').css('margin-top', '0px');

                $('#st06_file .dz-image, #st06_file .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#st06_file .dz-remove').on('click', function(){
                    remove_file(filepath, token_contact_photo);
                });

                //page_ready();
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });
    // End Candidate

    // Start Winner
    $('#st07_file').dropzone({
        url: '/upload/procurement',
        paramName: 'files',
        params: {
            '_token': upload_token,
            'purpose': 'winner',
            'procurement_id': procurement_id
        },
        maxFilesize: 70,
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

                $(file.previewElement).parent().parent().parent()
                .find('.help-block').css('bottom', '-10px').css('right', '30px');

                $(file.previewElement).parent().parent()
                .find('.dropzone').css('margin-top', '0px');

                $('#st07_file .dz-image, #st07_file .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#st07_file .dz-remove').on('click', function(){
                    remove_file(filepath, token_contact_photo);
                });

                //page_ready();
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });
    // End Winner

    // Start Refutal
    $('#st08_file').dropzone({
        url: '/upload/procurement',
        paramName: 'files',
        params: {
            '_token': upload_token,
            'purpose': 'refutal',
            'procurement_id': procurement_id
        },
        maxFilesize: 70,
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

                $(file.previewElement).parent().parent().parent()
                .find('.help-block').css('bottom', '-10px').css('right', '30px');

                $(file.previewElement).parent().parent()
                .find('.dropzone').css('margin-top', '0px');

                $('#st08_file .dz-image, #st08_file .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#st08_file .dz-remove').on('click', function(){
                    remove_file(filepath, token_contact_photo);
                });

                //page_ready();
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });
    // End Refutal

    // Start Contract
    $('#st09_file').dropzone({
        url: '/upload/procurement',
        paramName: 'files',
        params: {
            '_token': upload_token,
            'purpose': 'contract',
            'procurement_id': procurement_id
        },
        maxFilesize: 70,
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

                $(file.previewElement).parent().parent().parent()
                .find('.help-block').css('bottom', '-10px').css('right', '30px');

                $(file.previewElement).parent().parent()
                .find('.dropzone').css('margin-top', '0px');

                $('#st09_file .dz-image, #st09_file .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#st09_file .dz-remove').on('click', function(){
                    remove_file(filepath, token_contact_photo);
                });

                //page_ready();
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });
    // End Contract

    $('#trg_work').on('click', function(event){
        var confirmation = confirm("Apakah anda yakin?");
        if (confirmation == true) {
            $('form#form_work').submit();
        }
        event.preventDefault();
    });

    var highest_score   = 0;
    $('#tabel_evaluation .score').each(function(){
        var $el   = $(this);
        var score = parseInt($el.text());
        if(score > highest_score) {
            highest_score = score;
        }
    });
    var highest_el      = $('#tabel_evaluation .score.' + highest_score);
    highest_el.before('<i class="fa fa-check text-success"></i>');

    var highest_candidate   = 0;
    $('#tabel_evaluation .score').each(function(){
        var $el   = $(this);
        var score = parseInt($el.text());
        if(score > highest_candidate) {
            highest_candidate = score;
        }
    });
    var highest_candidate_el  = $('#tabel_candidates .score.' + highest_candidate);
    highest_candidate_el.before('<i class="fa fa-check text-success"></i>');

    var active_tab = $('#active_tab').text().trim();
    if(active_tab != '') {
        $('a[href=#' + active_tab + ']').trigger('click');
    }
});
</script>
<script type="text/javascript" src="{{ URL::asset('js/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
@endpush
