<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Detail Perencanaan</h4>
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
                <div class="card-body p-b-0">
                    <h4 class="card-title">
                        <span class="">{{ $data['title']}}&nbsp;
                            <button type="button" class="btn btn-xs ink-reaction btn-floating-action btn-warning"  data-toggle="tooltip" data-placement="top" title="Terverifikasi">
                                <i class="fa fa-edit"></i>
                            </button>
                        </span>
                    </h4>
                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item"> 
                        <a class="nav-link active" data-toggle="tab" href="#first5" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">
                                &nbsp; Detail Perencanaan &nbsp;
                            </span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="first5" role="tabpanel">
                        <div class="p-20">
                        @include('layouts.perencanaan.parts.approval.infoutama')
                        @include('layouts.perencanaan.parts.approval.atasan')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<script>
    $(function () {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }
        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();
        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function () {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function () {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function () {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function () {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
</script>
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
    $('#summernote').summernote({
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

    $('#trg_komunikasi').on('click', function(event){
        var form = $('form#form_komunikasi');
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
                swal("","Komunikasi berhasil dikirim.","success");
                // document.location = get_pure_link();
                var id_bro = "{{ $data['id'] }}";
                call('/perencanaan/detail/'+id_bro,'_content_','Terverifikasi');
            },
            error: function(error){
                swal("","Terjadi kesalahan, Komunikasi gagal dikirim.","error");
            }
        });
        event.preventDefault();
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
</script>