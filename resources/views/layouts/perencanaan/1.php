<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Detail Monitoring Pekerjaan</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active">Detail Perencanaan</li>
                </ol>
                <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>
                        <a href="#">{{ $data['title']}}</a> &nbsp;
                            <button type="button" class="btn btn-xs ink-reaction btn-floating-action btn-warning"  data-toggle="tooltip" data-placement="top" title="Proses Persetujuan">
                                <i class="fa fa-pencil"></i>
                            </button>
                    </h4>
                    <div class="col-md-12">
                        <div class="card tabs style-default-light">
                            <ul class="card-head nav nav-tabs" data-toggle="tabs">
                                <li class="active">
                                    <a href="#first5">
                                        <i class="fa fa-file-text"></i> &nbsp; Detail Perencanaan &nbsp;
                                    </a>
                                </li>
                            </ul>
                            <div class="pt0 card-body tab-content style-default-bright">
                                @include('layouts.perencanaan.parts.approval.infoutama')
                                @include('layouts.perencanaan.parts.approval.atasan')
                            </div>
                        </div><!--end .card-body -->
                    </div><!--end .card -->
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('.confirm-modal').each(function(){
        var $el = $(this);
        $el.click(function(event){
            var strconfirm = confirm("apakah anda yakin?");
            if (strconfirm == true) {
                $el.unbind('click').trigger('click');
            }

            event.preventDefault();
        });
    });

    $("#input-2-xs").rating();
    $('.summernote').summernote({
        height: 350, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        focus: false // set focus to editable area after initializing summernote
    });

    $('.inline-editor').summernote({
        airMode: true
    });
    window.edit = function() {
            $(".click2edit").summernote()
        },
        window.save = function() {
            $(".click2edit").summernote('destroy');
        }


    $('#summernote0').summernote({
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
    $('#summernote01010').summernote({
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
    $('#tanggalverifikasi').datepicker("setDate", new Date());
    $('#tanggalpersetujuan').datepicker("setDate", new Date());
    $('#tanggalpenolakan').datepicker("setDate", new Date());

    var verification_file_uploaded = $('#verification_file_block').find('.image-block').length;
    if(verification_file_uploaded == 0) {
        $('#verification_file_block').find('.help-block').css('bottom', '-10px').css('right', '30px');
        $('#verification_file_block').find('.dropzone').css('margin-top', '30px');
    }

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
});

$('#trg_verifikasi_bro').on('click', function(event){
    var form = $('form#form_verifikasi');
    var formData = new FormData(form[0]);
    $.ajax({
        type: form.attr("method"),
        url: form.attr("action"),
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(result){
            $('#verifikasi').modal('hide');
            var id_bro = '{{ $data["id"]}}';
            swal("","Perencanaan diverifikasi","success");
            // document.location = get_pure_link();
            call('perencanaan/detail/'+id_bro,'_content_','Terverifikasi');
        },
        error: function(error){
            swal("","Terjadi kesalahan, harap hubungi pihak terkait.","error");
        }
    });
    event.preventDefault();
});
</script>
