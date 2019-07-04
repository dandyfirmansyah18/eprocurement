@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">My Profile</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active">My Profile</li>
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
                        <span class="">{{ $company->name.' ( '.$company->type.'. )' }}&nbsp;
                            @if($user->verified)
                            <button type="button" class="btn btn-xs ink-reaction btn-floating-action btn-info"  data-toggle="tooltip" data-placement="top" title="Terverifikasi">
                                <i class="fa fa-check"></i>
                            </button>
                            @endif
                        </span>
                    </h4>
                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item"> 
                        <a class="nav-link active" data-toggle="tab" href="#first5" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">
                                <i class="fa fa-building fa-lg text-danger"  data-toggle="tooltip" data-placement="top" title="Administrasi"></i>
                                &nbsp; Data Perusahaan &nbsp;
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#second5" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">
                                <i class="fa fa-paperclip fa-lg text-danger"  data-toggle="tooltip" data-placement="top" title="Administrasi"></i>
                                &nbsp; Kelengkapan Administrasi
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#third5" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">
                                <i class="fa fa-paste fa-lg text-danger"  data-toggle="tooltip" data-placement="top" title="Administrasi"></i>
                                &nbsp; Data Kelengkapan Lainnya
                            </span>
                        </a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#fourth" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">
                                <!-- <i class="fa fa-book"></i>  -->
                                <i class="fa fa-book fa-lg text-danger"  data-toggle="tooltip" data-placement="top" title="Administrasi"></i>
                                &nbsp; Administrasi
                            </span>
                        </a> 
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="first5" role="tabpanel">
                        <div class="p-20">
                            @include('layouts.dashboard.parts.profile.tab-informasi')
                        </div>
                    </div>
                    <div class="tab-pane" id="second5" role="tabpanel">
                        <div class="p-20">
                            @include('layouts.dashboard.parts.profile.tab-kelengkapan')
                        </div>
                    </div>
                    <div class="tab-pane" id="third5" role="tabpanel">
                        <div class="p-20">
                            @include('layouts.dashboard.parts.profile.tab-lainnya')
                        </div>
                    </div>
                    <div class="tab-pane" id="fourth" role="tabpanel">
                        <div class="p-20">
                            @include('layouts.dashboard.parts.profile.tab-administrasi')
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
<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="change_password_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="change_password_label">Ubah password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form_password" class="form" role="form" action="/pengguna/ubah_password" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{ $user->id }}" readonly>

                    <div class="form-group floating-label">
                        <label>Password Lama</label>
                        <input type="password" id="old_password" class="form-control" name="password[old]" value="" />
                    </div>
                    <div class="form-group floating-label">
                        <label>Password Baru</label>
                        <input type="password" id="new_password" class="form-control" name="password[new]" value="" />
                    </div>
                    <div class="form-group floating-label">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" id="conf_password" class="form-control" name="password[confirmation]" value="" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button id="trg_password" type="button" class="btn btn-primary">
                    <i class="fa fa-save"></i>&nbsp;Ubah Password
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>

<!--Modal permintaan ubah-->
<div class="modal fade" id="ubahdata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Permintaan Ubah Data</h4>
            </div>
            <div class="modal-body">
                <p>Kegiatan ubah data akan merubah data seperti Data Penanggung Jawab, Data Perusahaan, Data Pendirian.</p>
                <p>Jika Anda hanya ingin mengubah "data lainnya" (data personalia, sertifikat, dll), silahkan klik tombol ubah data yang terdapat di profile anda pada tab "data kelengkapan lainnya"</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a href="/my_profile/ubah" class="btn btn-primary ink-reaction"  >
                    <i class="fa fa-check"></i> Lanjutkan Ubah Data
                </a>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
<!--Modal permintaan ubah-->

<div id="active_tab" class="hidden-block">{{ Session::get('tab') }}</div>
@php
    Session::forget('tab');
@endphp
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
        $("#input-2-xs").rating();
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

        var active_tab = $('#active_tab').text().trim();
        if(active_tab != '') {
            $('a[href=#' + active_tab + ']').trigger('click');
        }

        $('#trg_chat').on('click', function(event){
            var message = $('.note-editable').html();
            if(message == '' || message == '<p></p>' || message == '<p><br></p>') {
                // alert('Harap isi pesan');
                swal("","Harap isi Pesan.","error");
            } else {
                // $('form#form_chat').submit();
                var form            = $('form#form_chat');
                var form_data       = new FormData(form[0]);
                $.ajax({
                    type: form.attr("method"),
                    url: form.attr("action"),
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result){
                        call('/my_profile','_content_','Profile Penyedia');
                    },
                    error: function(error){
                        // console.log(error);
                        swal("","Failed. Something went wrong, please try again later.","error");
                    }
                });
            }
            event.preventDefault();
        });

        $('#trg_password').on('click', function(event){
            var old_password    = $('#old_password').val();
            var new_password    = $('#new_password').val();
            var conf_password   = $('#conf_password').val();
            if(old_password != '') {
                if(new_password != '') {
                    if(new_password == conf_password) {
                        var form            = $('form#form_password');
                        var form_data       = new FormData(form[0]);
                        $.ajax({
                            type: form.attr("method"),
                            url: form.attr("action"),
                            data: form_data,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(result){
                                if(result.status == 'OK') {
                                    // alert('Password berhasil diubah');
                                    swal("","Password berhasil diubah","success");
                                } else {
                                    swal("","Password lama salah","error");
                                }
                                $('#change_password').modal('hide');
                            },
                            error: function(error){
                                swal("","Failed. Something went wrong, please try again later.","error");
                            }
                        });
                    } else {
                        swal("","Konfirmasi password tidak sama","error");
                    }
                } else {
                    swal("","Password baru tidak boleh kosong","error");
                }
            } else {
                swal("","Harap mengisi password lama","error");
            }
            event.preventDefault();
        })
    });
</script>