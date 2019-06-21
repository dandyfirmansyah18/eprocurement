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
            <h4 class="text-themecolor">Register User</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active">Register User</li>
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="form_daftarpegawai" class="form floating-label form-validation form-validate" action="daftar/save_pegawai" method="POST" role="form" novalidate="novalidate">
                        <div class="card-body floating-label">
                            <!-- <div class="judulformtop">
                                <i class="fa fa-file-text"></i> Data User Pegawai
                            </div> -->
                            <h4 class="card-title">Register User</h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group floating-label">
                                        <label>Role *</label>
                                        <select class="form-control select2-list" id="role_user" name="role_user">
                                            <option value=""></option>
                                            <option value="2">Perencana</option>
                                            <option value="3">Pengada</option>
                                            <option value="4">Manajer</option>
                                            <option value="5">Kadiv</option>
                                            <option value="6">Direksi</option>
                                        </select>
                                        <input type="hidden" name="metode" id="metode" value="" disabled="disabled">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group floating-label">
                                        <label>Unit *</label>
                                        <input type="hidden" name="userunitlisthidden" id="userunitlisthidden" value="{{ $user_unit }}" disabled="disabled">
                                        <select id="userunitlist" class="form-control select2-list" name="userunitlist">
                                            <option value=""></option>
                                            @foreach($userunitlist as $userunit)
                                                <option value="{{ $userunit['id'] }}">{{ $userunit['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="namalengkap">Nama Lengkap *</label>
                                        <input type="text" class="form-control is-req" id="namalengkap" name="namalengkap" value="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nip">NIP *</label>
                                        <input type="text" class="form-control is-req" id="nip" name="nip" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="text" class="form-control is-req" id="email" name="email" value="">
                                        <p class='help-block' id='emailmessage'></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password">Password *</label>
                                        <input type="password" class="form-control is-req" id="password" name="password" value="">
                                        <!-- <p class='help-block' id='regexmessage'>*Password harus mengandung angka,huruf kapital dan spesial karakter.</p> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="re_password">Re-Type Password *</label>
                                        <input type="password" class="form-control is-req" id="re_password" name="re_password" value="">
                                        <p class='help-block' id='message'></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                                <button id="trg_save" type="submit" class="btn btn-primary ink-reaction simpan-data">
                                    <i class="fa fa-plus"></i>&nbsp;Register User Pegawai
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="reset_password_label" id="save_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="save_modal_label">Data yang disikan kurang lengkap dan tidak sesuai<br>Mohon untuk melengkapi data data yang ada.</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
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
        $('#trg_save').on('click', function(event){

            var valid = true;
            var validemail = true;
            var validregex = true;
            var validpass = true;

            var str = $('#password').val();
            if(str.length == 0){
                validregex = false;
            } else if (str.length < 8) {
                validregex = false;
            } else if (str.length > 32) {
                validregex = false;
            } else if (str.search(/\d/) == -1) {
                validregex = false;
            } else if (str.search(/[a-z]/) == -1) {
                validregex = false;
            } else if (str.search(/[A-Z]/) == -1) {
                validregex = false;
            }else if (str.search(/[\!\@\#\$\%\^\&\*\(\)\-\=\_\+\.\,\<\>\;\:\/\?]/) == -1) {
                validregex = false;
            }else{
                validregex = true;
            }

            var stremail = $('#email').val();
            if(stremail.length == 0){
                validemail = false;
            }else if(stremail.search(/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i) == -1){
                validemail = false;
            }else{
                validemail = true;
            }

            if ($('#password').val() == $('#re_password').val()) {
                validpass = true;
            } else {
                validpass = false;
            }

            $('.is-req').each(function(){
                if($(this).val() == '') {
                    valid           = false;
                }
            });

            if(valid == true && validpass == true && validregex == true && validemail == true) {
                if(valid == true) {
                    var form = $('form#form_daftarpegawai');
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
                            if(result.status == 'ERROR') {
                                swal("", result.message, "error");
                            } else {
                                swal("", "Pendaftaran User Berhasil", "success");
                                // document.location = "/daftar/pegawai";
                                call('/user/list','_content_','Regulation List')
                            }
                        },
                        error: function(error){
                            console.log(error);
                            alert("Failed. Something went wrong, please try again later.");
                        }
                    });
                } else {
                    $('#save_modal').modal();
                }
            }else{
                alert("Failed. Isi Form Anda dengan benar.");
                return false;
            }
            
            event.preventDefault();
        });

        // $('#password').on('keyup', function () {
        //     var str = $('#password').val();
        //     if(str.length == 0){
        //         $('#regexmessage').html('*Password harus mengandung angka,huruf kapital dan spesial karakter.').css('color', 'gray');
        //     } else if (str.length < 8) {
        //         $('#regexmessage').html('Password minimal 8 karakter').css('color', 'red');
        //     } else if (str.length > 32) {
        //         $('#regexmessage').html('Password maksimal 32 karakter').css('color', 'red');
        //     } else if (str.search(/\d/) == -1) {
        //         $('#regexmessage').html('Password harus mengandung angka').css('color', 'red');
        //     } else if (str.search(/[a-z]/) == -1) {
        //         $('#regexmessage').html('Password harus mengandung huruf kecil').css('color', 'red');
        //     } else if (str.search(/[A-Z]/) == -1) {
        //         $('#regexmessage').html('Password harus mengandung huruf kapital').css('color', 'red');
        //     }else if (str.search(/[\!\@\#\$\%\^\&\*\(\)\-\=\_\+\.\,\<\>\;\:\/\?]/) == -1) {
        //         $('#regexmessage').html('Password harus mengandung spesial karakter').css('color', 'red');
        //     }else{
        //         $('#regexmessage').html('Password Kuat').css('color', 'green');
        //     }
        // });

        $('#password, #re_password').on('keyup', function () {
            if ($('#password').val() == $('#re_password').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else {
                $('#message').html('Not Matching').css('color', 'red');
            }     
        });

        $('#email').on('keyup', function () {
            var str = $('#email').val();
            if(str.length == 0){
                $('#emailmessage').html('Tidak Boleh Kosong').css('color', 'red');
            }else if(str.search(/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i) == -1){
                $('#emailmessage').html('Email Tidak Valid').css('color', 'red');
            }else{
                $('#emailmessage').html('Email Valid').css('color', 'green');
            }
        });
    });
</script>