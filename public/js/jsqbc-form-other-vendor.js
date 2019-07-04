function page_ready() {

    var page_is_disabled = $('#currently_disabled').val() == '';

    $('#trg_savedata').on('click', function(event){
        var form            = $('form#form_other');
        var valid           = true;
        var count_pengurus  = $('#table_pengurus tbody tr').length;
        var count_person    = $('#table_person tbody tr').length;
        var count_exp       = $('#table_exp tbody tr').length;
        var count_job       = $('#table_job tbody tr').length;
        var empty_fields    = [];

        if(count_pengurus == 0) {
            valid = false;
            empty_fields.push('Data Pengurus Perusahaan');
        }

        if(count_person == 0) {
            valid = false;
            empty_fields.push('Data Personalia');
        }

        if(count_exp == 0) {
            valid = false;
            empty_fields.push('Data Pengalaman Perusahaan');
        }

        if(count_job == 0) {
            valid = false;
            empty_fields.push('Data Pekerjaan yang Sedang Dilaksanakan');
        }

        if(valid == true) {
            var form_data = new FormData(form[0]);
            $.ajax({
                type: form.attr("method"),
                url: form.attr("action"),
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result){
                    document.location = '/my_profile';
                },
                error: function(error){
                    console.log(error);
                    alert("Failed. Something went wrong, please try again later.");
                }
            });
        } else {
            var failed_message = 'Harap lengkapi semua data wajib: ' + empty_fields.join(', ');
            alert(failed_message);
        }
        event.preventDefault();
    });

    // Company Job
    $('#trg_modal_job').on('click', function(){
        $('form#form_job input[type=text]').val('');
        $('#job_id').val('');
        $('form#form_job input[type=text]').removeClass('dirty');
    });

    $('#trg_job').on('click', function(event){
        var form = $('form#form_job');
        if(form.valid()) {
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
                    $('#tambahkerja').modal('hide');

                    var result_id = result.id;

                    var job_id = $('#job_id').val();
                    var job_name = $('#job_name').val();
                    var job_field = $('#job_field').val();
                    var job_location = $('#job_location').val();
                    var job_clientname = $('#job_clientname').val();
                    var job_clientphone = $('#job_clientphone').val();
                    var job_contractnumber = $('#job_contractnumber').val();
                    var job_contractvalue = $('#job_contractvalue').val();
                    var job_lastprogress = $('#job_lastprogress').val();
                    var job_progress = $('#job_progress').val();

                    if(job_id != '') {
                        var row_number = parseInt($('#table_job #job_' + job_id + ' .number').text());
                        var updated_row = '';
                        updated_row += '<td class="number">' + row_number + '</td>';
                        updated_row += '<td>' + job_name + '</td>';
                        updated_row += '<td>' + job_field + '</td>';
                        updated_row += '<td>' + job_location + '</td>';
                        updated_row += '<td>' + job_clientname + ' / ' + job_clientphone + '</td>';
                        updated_row += '<td>' + job_contractnumber + ' / ' + job_contractvalue + '</td>';
                        updated_row += '<td>' + job_lastprogress + ' / ' + job_progress + '</td>';

                        if(page_is_disabled){
                            updated_row += '<td><a href="#" class="btn btn-warning trg_modal_job_edit" data-id="' + job_id
                            + '" data-name="' + job_name + '" data-field="' + job_field + '" data-location="' + job_location
                            + '" data-client_name="' + job_clientname + '" data-client_phone="' + job_clientphone
                            + '" data-contract_number="' + job_contractnumber + '" data-contract_value="' + job_contractvalue
                            + '" data-last_progress="' + job_lastprogress + '" data-progress="' + job_progress
                            + '">EDIT</a>';
                            updated_row += '<a data-id="' + job_id + '" href="#" class="btn btn-danger trg_modal_job_delete">HAPUS</a></td>';
                            
                        }

                        $('#table_job #job_' + job_id).html(updated_row);
                    } else {
                        var last_number = parseInt($('#table_job .number').last().text());
                        if(isNaN(last_number)) {
                            last_number = 0;
                        }

                        var new_row = '<tr id="job_' + result_id + '">';
                        new_row += '<td class="number">' + (last_number + 1) + '</td>';
                        new_row += '<td>' + job_name + '</td>';
                        new_row += '<td>' + job_field + '</td>';
                        new_row += '<td>' + job_location + '</td>';
                        new_row += '<td>' + job_clientname + ' / ' + job_clientphone + '</td>';
                        new_row += '<td>' + job_contractnumber + ' / ' + job_contractvalue + '</td>';
                        new_row += '<td>' + job_lastprogress + ' / ' + job_progress + '</td>';

                        if(page_is_disabled){
                            new_row += '<td><a href="#" class="btn btn-warning trg_modal_job_edit" data-id="' + result_id
                            + '" data-name="' + job_name + '" data-field="' + job_field + '" data-location="' + job_location
                            + '" data-client_name="' + job_clientname + '" data-client_phone="' + job_clientphone
                            + '" data-contract_number="' + job_contractnumber + '" data-contract_value="' + job_contractvalue
                            + '" data-last_progress="' + job_lastprogress + '" data-progress="' + job_progress
                            + '">EDIT</a>';
                            new_row += '<a data-id="' + result_id + '" href="#" class="btn btn-danger trg_modal_job_delete">HAPUS</a></td>';
                        }

                        new_row += '</tr>';

                        $('#table_job tbody').append(new_row);
                    }

                    $('form#form_job input[type=text]').val('');

                    page_ready();
                },
                error: function(error){
                    console.log(error);
                    alert("Failed. Something went wrong, please try again later.");
                }
            });
        } else {
            form.data('validator').focusInvalid();
        }
        event.preventDefault();
    });

    $('.trg_modal_job_edit').each(function(){
        var $el = $(this);
        $el.on('click', function(event){
            $('#job_id').val($el.data('id'));
            $('#job_name').val($el.data('name'));
            $('#job_field').val($el.data('field'));
            $('#job_location').val($el.data('location'));
            $('#job_clientname').val($el.data('client_name'));
            $('#job_clientphone').val($el.data('client_phone'));
            $('#job_contractnumber').val($el.data('contract_number'));
            $('#job_contractvalue').val($el.data('contract_value'));
            $('#job_lastprogress').val($el.data('last_progress'));
            $('#job_progress').val($el.data('progress'));

            $('form#form_job input[type=text]').addClass('dirty');

            $('#tambahkerja').modal('show');

            event.preventDefault();
        });
    });

    $('.trg_modal_job_delete').each(function(){
        var $el = $(this);
        $el.on('click', function(event){
            var count_job   = $('#table_job tbody tr').length;
            if(count_job > 1) {
                var sure    = confirm("Apakah anda yakin?");
                if(sure == true) {
                    var job_id = $el.data('id');
                    var form = $('form#form_delete');
                    form.find('#delete_id').val(job_id);
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: form.attr("method"),
                        url: '/daftar/delete_job',
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(result){
                            $('#table_job #job_' + job_id).remove();

                            page_ready();
                        },
                        error: function(error){
                            console.log(error);
                            alert("Failed. Something went wrong, please try again later.");
                        }
                    });
                }
            } else {
                alert('Minimal harus ada 1 data terisi');
            }

            event.preventDefault();
        });
    });

    // Company Experience
    $('#trg_modal_exp').on('click', function(){
        $('form#form_exp input[type=text]').val('');
        $('#exp_id').val('');
        $('form#form_exp input[type=text]').removeClass('dirty');
    });

    $('#trg_exp').on('click', function(event){
        var form = $('form#form_exp');
        if(form.valid()) {
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
                    $('#tambahpengalaman').modal('hide');

                    var result_id = result.id;

                    var exp_id = $('#exp_id').val();
                    var exp_name = $('#exp_name').val();
                    var exp_field = $('#exp_field').val();
                    var exp_location = $('#exp_location').val();
                    var exp_clientname = $('#exp_clientname').val();
                    var exp_clientphone = $('#exp_clientphone').val();
                    var exp_contractnumber = $('#exp_contractnumber').val();
                    var exp_contractvalue = $('#exp_contractvalue').val();
                    var exp_contractdue = $('#exp_contractdue').val();
                    var exp_handover = $('#exp_handover').val();

                    if(exp_id != '') {
                        var row_number = parseInt($('#table_exp #exp_' + exp_id + ' .number').text());
                        var updated_row = '';
                        updated_row += '<td class="number">' + row_number + '</td>';
                        updated_row += '<td>' + exp_name + '</td>';
                        updated_row += '<td>' + exp_field + '</td>';
                        updated_row += '<td>' + exp_location + '</td>';
                        updated_row += '<td>' + exp_clientname + ' / ' + exp_clientphone + '</td>';
                        updated_row += '<td>' + exp_contractnumber + ' / ' + exp_contractvalue + '</td>';
                        updated_row += '<td>' + exp_contractdue + ' / ' + exp_handover + '</td>';

                        if(page_is_disabled){
                            updated_row += '<td><a href="#" class="btn btn-warning trg_modal_exp_edit" data-id="' + exp_id
                            + '" data-name="' + exp_name + '" data-field="' + exp_field + '" data-location="' + exp_location
                            + '" data-client_name="' + exp_clientname + '" data-client_phone="' + exp_clientphone
                            + '" data-contract_number="' + exp_contractnumber + '" data-contract_value="' + exp_contractvalue
                            + '" data-contract_due="' + exp_contractdue + '" data-hand_over="' + exp_handover
                            + '">EDIT</a>';
                            updated_row += '<a data-id="' + exp_id + '" href="#" class="btn btn-danger trg_modal_exp_delete">HAPUS</a></td>';
                            
                        }

                        $('#table_exp #exp_' + exp_id).html(updated_row);
                    } else {
                        var last_number = parseInt($('#table_exp .number').last().text());
                        if(isNaN(last_number)) {
                            last_number = 0;
                        }

                        var new_row = '<tr id="exp_' + result_id + '">';
                        new_row += '<td class="number">' + (last_number + 1) + '</td>';
                        new_row += '<td>' + exp_name + '</td>';
                        new_row += '<td>' + exp_field + '</td>';
                        new_row += '<td>' + exp_location + '</td>';
                        new_row += '<td>' + exp_clientname + ' / ' + exp_clientphone + '</td>';
                        new_row += '<td>' + exp_contractnumber + ' / ' + exp_contractvalue + '</td>';
                        new_row += '<td>' + exp_contractdue + ' / ' + exp_handover + '</td>';

                        if(page_is_disabled){
                            new_row += '<td><a href="#" class="btn btn-warning trg_modal_exp_edit" data-id="' + result_id
                            + '" data-name="' + exp_name + '" data-field="' + exp_field + '" data-location="' + exp_location
                            + '" data-client_name="' + exp_clientname + '" data-client_phone="' + exp_clientphone
                            + '" data-contract_number="' + exp_contractnumber + '" data-contract_value="' + exp_contractvalue
                            + '" data-contract_due="' + exp_contractdue + '" data-hand_over="' + exp_handover
                            + '">EDIT</a>';
                            new_row += '<a data-id="' + result_id + '" href="#" class="btn btn-danger trg_modal_exp_delete">HAPUS</a></td>';
                        }

                        new_row += '</tr>';

                        $('#table_exp tbody').append(new_row);
                    }

                    $('form#form_exp input[type=text]').val('');

                    page_ready();
                },
                error: function(error){
                    console.log(error);
                    alert("Failed. Something went wrong, please try again later.");
                }
            });
        } else {
            form.data('validator').focusInvalid();
        }
        event.preventDefault();
    });

    $('.trg_modal_exp_edit').each(function(){
        var $el = $(this);
        $el.on('click', function(event){
            $('#exp_id').val($el.data('id'));
            $('#exp_name').val($el.data('name'));
            $('#exp_field').val($el.data('field'));
            $('#exp_location').val($el.data('location'));
            $('#exp_clientname').val($el.data('client_name'));
            $('#exp_clientphone').val($el.data('client_phone'));
            $('#exp_contractnumber').val($el.data('contract_number'));
            $('#exp_contractvalue').val($el.data('contract_value'));
            $('#exp_contractdue').val($el.data('contract_due'));
            $('#exp_handover').val($el.data('hand_over'));

            $('form#form_exp input[type=text]').addClass('dirty');

            $('#tambahpengalaman').modal('show');

            event.preventDefault();
        });
    });

    $('.trg_modal_exp_delete').each(function(){
        var $el = $(this);
        $el.on('click', function(event){
            var count_exp   = $('#table_exp tbody tr').length;
            if(count_exp > 1) {
                var sure    = confirm("Apakah anda yakin?");
                if(sure == true) {
                    var exp_id = $el.data('id');
                    var form = $('form#form_delete');
                    form.find('#delete_id').val(exp_id);
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: form.attr("method"),
                        url: '/daftar/delete_experience',
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(result){
                            $('#table_exp #exp_' + exp_id).remove();

                            page_ready();
                        },
                        error: function(error){
                            console.log(error);
                            alert("Failed. Something went wrong, please try again later.");
                        }
                    });
                }
            } else {
                alert('Minimal harus ada 1 data terisi');
            }

            event.preventDefault();
        });
    });

    // Company Certificate
    $('#trg_modal_cert').on('click', function(){
        $('form#form_cert input[type=text]').val('');
        $('#cert_id').val('');
        $('form#form_cert input[type=text]').removeClass('dirty');
    });

    $('#trg_cert').on('click', function(event){
        var form = $('form#form_cert');
        if(form.valid()) {
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
                    $('#tambahsertifikat').modal('hide');

                    var result_id         = result.id;

                    var cert_id           = $('#cert_id').val();
                    var cert_type         = $('#cert_type').val();
                    var cert_number       = $('#cert_number').val();
                    var cert_title        = $('#cert_title').val();
                    var cert_release_date = $('#cert_release_date').val();
                    var cert_expire_date  = $('#cert_expired_date').val();
                    var cert_author       = $('#cert_author').val();
                    var cert_file_name    = $('#certificate_block .dz-filename').text().trim();
                    var cert_file_path    = '/uploads/' + $('#certificate_block .dz-remove').data('filename');

                    if(cert_id != '') {
                        var row_number = parseInt($('#table_cert #cert_' + cert_id + ' .number').text());
                        var updated_row = '';
                        updated_row += '<td class="number">' + row_number + '</td>';
                        updated_row += '<td>' + cert_type + '</td>';
                        updated_row += '<td>' + cert_number + '</td>';
                        updated_row += '<td>' + cert_title + '</td>';
                        updated_row += '<td>' + cert_release_date + '</td>';
                        updated_row += '<td>' + cert_expire_date + '</td>';
                        updated_row += '<td>' + cert_author + '</td>';
                        updated_row += '<td><a href="' + cert_file_path + '" target="_blank">' + cert_file_name + '</a></td>';

                        if(page_is_disabled){
                            updated_row += '<td><a href="#" class="btn btn-warning trg_modal_cert_edit" data-id="' + cert_id
                            + '" data-type="' + cert_type
                            + '" data-number="' + cert_number + '" data-title="' + cert_title + '" data-release_date="' + cert_release_date
                            + '" data-expire_date="' + cert_expire_date + '" data-author="' + cert_author
                            + '">EDIT</a>';
                            updated_row += '<a data-id="' + cert_id + '" href="#" class="btn btn-danger trg_modal_cert_delete">HAPUS</a></td>';
                        }

                        $('#table_cert #cert_' + cert_id).html(updated_row);
                    } else {
                        var last_number = parseInt($('#table_cert .number').last().text());
                        if(isNaN(last_number)) {
                            last_number = 0;
                        }

                        var new_row = '<tr id="cert_' + result_id + '">';
                        new_row += '<td class="number">' + (last_number + 1) + '</td>';
                        new_row += '<td>' + cert_type + '</td>';
                        new_row += '<td>' + cert_number + '</td>';
                        new_row += '<td>' + cert_title + '</td>';
                        new_row += '<td>' + cert_release_date + '</td>';
                        new_row += '<td>' + cert_expire_date + '</td>';
                        new_row += '<td>' + cert_author + '</td>';
                        new_row += '<td><a href="' + cert_file_path + '" target="_blank">' + cert_file_name + '</a></td>';

                        if(page_is_disabled){
                            new_row += '<td><a href="#" class="btn btn-warning trg_modal_cert_edit" data-id="' + result_id
                            + '" data-type="' + cert_type
                            + '" data-number="' + cert_number + '" data-title="' + cert_title + '" data-release_date="' + cert_release_date
                            + '" data-expire_date="' + cert_expire_date + '" data-author="' + cert_author
                            + '">EDIT</a>';
                            new_row += '<a data-id="' + result_id + '" href="#" class="btn btn-danger trg_modal_cert_delete">HAPUS</a></td>';
                        }

                        new_row += '</tr>';

                        $('#table_cert tbody').append(new_row);
                    }

                    $('form#form_cert input[type=text]').val('');

                    page_ready();
                },
                error: function(error){
                    console.log(error);
                    alert("Failed. Something went wrong, please try again later.");
                }
            });
        } else {
            form.data('validator').focusInvalid();
        }
        event.preventDefault();
    });

    $('#trg_modal_cert').on('click', function(event){
        $('#tambahsertifikat').modal('show');

        $.get('/daftar/certificate_id', function(result) {
            var new_id = result.id;

            $('#cert_pseudo_id').val(new_id);
            $('#cert_id').val('');
            $('#cert_type').val('sertifikat');
            $('#cert_number').val('');
            $('#cert_title').val('');
            $('#cert_release_date').val('');
            $('#cert_expired_date').val('');
            $('#cert_author').val('');

            var dropzone_content    = '<div class="dz-message btn btn-default"><h3>Pilih file</h3></div>';
            $('#certificate').removeClass().addClass('dropzone tight').html(dropzone_content);

            var token_certificate   = $('#token_certificate').val();
            var user_id             = $('#company_user_id').val();
            var certificate_params  = {
                '_token': token_certificate,
                'purpose': 'pseudo_certificate_' + new_id,
                'user_id': user_id
            };
            render_upload_box('certificate', '/upload/certificate', certificate_params);

            $('#cert_loader').hide();
            $('#form_cert').show();
        });

        event.preventDefault();
    });

    $('.trg_modal_cert_edit').each(function(){
        var $el = $(this);
        $el.on('click', function(event){
            $('#tambahsertifikat').modal('show');

            $.get('/daftar/certificate_id', function(result) {
                var new_id = result.id;

                $('#cert_pseudo_id').val(new_id);
                $('#cert_id').val($el.data('id'));
                $('#cert_type').val($el.data('type'));
                $('#cert_number').val($el.data('number'));
                $('#cert_title').val($el.data('title'));
                $('#cert_release_date').val($el.data('release_date'));
                $('#cert_expired_date').val($el.data('expired_date'));
                $('#cert_author').val($el.data('author'));

                $('form#form_cert input[type=text]').addClass('dirty');

                var dropzone_content    = '<div class="dz-message btn btn-default"><h3>Pilih file</h3></div>';
                $('#certificate').removeClass().addClass('dropzone tight').html(dropzone_content);

                var token_certificate   = $('#token_certificate').val();
                var user_id             = $('#company_user_id').val();
                var certificate_params  = {
                    '_token': token_certificate,
                    'purpose': 'pseudo_certificate_' + new_id,
                    'user_id': user_id
                };
                render_upload_box('certificate', '/upload/certificate', certificate_params);

                $('#cert_loader').hide();
                $('#form_cert').show();
            });

            event.preventDefault();
        });
    });

    $('.trg_modal_cert_delete').each(function(){
        var $el = $(this);
        $el.on('click', function(event){
            var sure = confirm("Apakah anda yakin?");
            if(sure == true) {
                var cert_id = $el.data('id');
                var form = $('form#form_delete');
                form.find('#delete_id').val(cert_id);
                var formData = new FormData(form[0]);
                $.ajax({
                    type: form.attr("method"),
                    url: '/daftar/delete_certification',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result){
                        $('#table_cert #cert_' + cert_id).remove();

                        page_ready();
                    },
                    error: function(error){
                        console.log(error);
                        alert("Failed. Something went wrong, please try again later.");
                    }
                });
            }

            event.preventDefault();
        });
    });

    // Company Person
    $('#trg_modal_person').on('click', function(){
        $('form#form_person input[type=text]').val('');
        $('#person_id').val('');
        $('form#form_person input[type=text]').removeClass('dirty');
    });

    $('#trg_person').on('click', function(event){
        var form = $('form#form_person');
        if(form.valid()) {
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
                    $('#tambahpersonalia').modal('hide');

                    var result_id = result.id;

                    var person_id = $('#person_id').val();
                    var person_name = $('#person_name').val();
                    var person_birthdate = $('#person_birthdate').val();
                    var person_education = $('#person_education').val();
                    var person_jobtitle = $('#person_jobtitle').val();
                    var person_experience = $('#person_experience').val();
                    var person_expertise = $('#person_expertise').val();

                    if(person_id != '') {
                        var row_number = parseInt($('#table_person #person_' + person_id + ' .number').text());
                        var updated_row = '';
                        updated_row += '<td class="number">' + row_number + '</td>';
                        updated_row += '<td>' + person_name + '</td>';
                        updated_row += '<td>' + person_birthdate + '</td>';
                        updated_row += '<td>' + person_education + '</td>';
                        updated_row += '<td>' + person_jobtitle + '</td>';
                        updated_row += '<td>' + person_experience + '</td>';
                        updated_row += '<td>' + person_expertise + '</td>';

                        if(page_is_disabled){
                            updated_row += '<td><a href="#" class="btn btn-warning trg_modal_person_edit" data-id="' + person_id
                            + '" data-name="' + person_name + '" data-birth_date="' + person_birthdate + '" data-education="' + person_education
                            + '" data-job_title="' + person_jobtitle + '" data-experience="' + person_experience
                            + '" data-expertise="' + person_expertise + '">EDIT</a>';
                            updated_row += '<a data-id="' + person_id + '" href="#" class="btn btn-danger trg_modal_person_delete">HAPUS</a></td>';
                        }

                        $('#table_person #person_' + person_id).html(updated_row);
                    } else {
                        var last_number = parseInt($('#table_person .number').last().text());
                        if(isNaN(last_number)) {
                            last_number = 0;
                        }

                        var new_row = '<tr id="person_' + result_id + '">';
                        new_row += '<td class="number">' + (last_number + 1) + '</td>';
                        new_row += '<td>' + person_name + '</td>';
                        new_row += '<td>' + person_birthdate + '</td>';
                        new_row += '<td>' + person_education + '</td>';
                        new_row += '<td>' + person_jobtitle + '</td>';
                        new_row += '<td>' + person_experience + '</td>';
                        new_row += '<td>' + person_expertise + '</td>';

                        if(page_is_disabled){
                            new_row += '<td><a data-id="' + result_id + '" href="#" class="btn btn-flat trg_modal_person_delete">hapus</a>';
                            new_row += '<a href="#" class="btn btn-flat trg_modal_person_edit" data-id="' + result_id
                            + '" data-name="' + person_name + '" data-birth_date="' + person_birthdate + '" data-education="' + person_education
                            + '" data-job_title="' + person_jobtitle + '" data-experience="' + person_experience
                            + '" data-expertise="' + person_expertise + '">edit</a></td>';
                        }

                        new_row += '</tr>';

                        $('#table_person tbody').append(new_row);
                    }

                    $('form#form_person input[type=text]').val('');

                    page_ready();
                },
                error: function(error){
                    console.log(error);
                    alert("Failed. Something went wrong, please try again later.");
                }
            });
        } else {
            form.data('validator').focusInvalid();
        }
        event.preventDefault();
    });

    $('.trg_modal_person_edit').each(function(){
        var $el = $(this);
        $el.on('click', function(event){
            $('#person_id').val($el.data('id'));
            $('#person_name').val($el.data('name'));
            $('#person_birthdate').val($el.data('birth_date'));
            $('#person_education').val($el.data('education'));
            $('#person_jobtitle').val($el.data('job_title'));
            $('#person_experience').val($el.data('experience'));
            $('#person_expertise').val($el.data('expertise'));

            $('form#form_person input[type=text]').addClass('dirty');

            $('#tambahpersonalia').modal('show');

            event.preventDefault();
        });
    });

    $('.trg_modal_person_delete').each(function(){
        var $el = $(this);
        $el.on('click', function(event){
            var count_person    = $('#table_person tbody tr').length;
            if(count_person > 1) {
                var sure        = confirm("Apakah anda yakin?");
                if(sure == true) {
                    var person_id = $el.data('id');
                    var form = $('form#form_delete');
                    form.find('#delete_id').val(person_id);
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: form.attr("method"),
                        url: '/daftar/delete_person',
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(result){
                            $('#table_person #person_' + person_id).remove();

                            page_ready();
                        },
                        error: function(error){
                            console.log(error);
                            alert("Failed. Something went wrong, please try again later.");
                        }
                    });
                }
            } else {
                alert('Minimal harus ada 1 data terisi');
            }

            event.preventDefault();
        });
    });

    // Company Stakeholder
    $('#trg_modal_holder').on('click', function(){
        $('form#form_holder input[type=text]').val('');
        $('#holder_id').val('');
        $('form#form_holder input[type=text]').removeClass('dirty');
    });

    $('#trg_holder').on('click', function(event){
        var form = $('form#form_holder');
        if(form.valid()) {
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
                    $('#tambahanggota').modal('hide');

                    var result_id = result.id;

                    var holder_id = $('#holder_id').val();
                    var holder_name = $('#holder_name').val();
                    var holder_nationalid = $('#holder_nationalid').val();
                    var holder_nationality = $('#holder_nationality').val();
                    var holder_address = $('#holder_address').val();
                    var holder_percentage = $('#holder_percentage').val();

                    if(holder_id != '') {
                        var row_number = parseInt($('#table_holder #holder_' + holder_id + ' .number').text());
                        var updated_row = '';
                        updated_row += '<td class="number">' + row_number + '</td>';
                        updated_row += '<td>' + holder_name + '</td>';
                        updated_row += '<td>' + holder_nationalid + '</td>';
                        updated_row += '<td>' + holder_nationality + '</td>';
                        updated_row += '<td>' + holder_address + '</td>';
                        updated_row += '<td>' + holder_percentage + '</td>';

                        if(page_is_disabled){
                            updated_row += '<td><a data-id="' + holder_id + '" href="#" class="btn btn-flat trg_modal_holder_delete">hapus</a>';
                            updated_row += '<a href="#" class="btn btn-flat trg_modal_holder_edit" data-id="' + holder_id
                            + '" data-name="' + holder_name + '" data-national_id="' + holder_nationalid + '" data-nationality="' + holder_nationality
                            + '" data-address="' + holder_address + '" data-percentage="' + holder_percentage
                            + '">edit</a></td>';
                        }

                        $('#table_holder #holder_' + holder_id).html(updated_row);
                    } else {
                        var last_number = parseInt($('#table_holder .number').last().text());
                        if(isNaN(last_number)) {
                            last_number = 0;
                        }

                        var new_row = '<tr id="holder_' + result_id + '">';
                        new_row += '<td class="number">' + (last_number + 1) + '</td>';
                        new_row += '<td>' + holder_name + '</td>';
                        new_row += '<td>' + holder_nationalid + '</td>';
                        new_row += '<td>' + holder_nationality + '</td>';
                        new_row += '<td>' + holder_address + '</td>';
                        new_row += '<td>' + holder_percentage + '</td>';

                        if(page_is_disabled){
                            new_row += '<td><a data-id="' + result_id + '" href="#" class="btn btn-flat trg_modal_holder_delete">hapus</a>';
                            new_row += '<a href="#" class="btn btn-flat trg_modal_holder_edit" data-id="' + result_id
                            + '" data-name="' + holder_name + '" data-national_id="' + holder_nationalid + '" data-nationality="' + holder_nationality
                            + '" data-address="' + holder_address + '" data-percentage="' + holder_percentage
                            + '">edit</a></td>';
                        }

                        new_row += '</tr>';

                        $('#table_holder tbody').append(new_row);
                    }

                    $('form#form_holder input[type=text]').val('');

                    page_ready();
                },
                error: function(error){
                    console.log(error);
                    alert("Failed. Something went wrong, please try again later.");
                }
            });
        } else {
            form.data('validator').focusInvalid();
        }
        event.preventDefault();
    });

    $('.trg_modal_holder_edit').each(function(){
        var $el = $(this);
        $el.on('click', function(event){
            $('#holder_id').val($el.data('id'));
            $('#holder_name').val($el.data('name'));
            $('#holder_nationalid').val($el.data('national_id'));
            $('#holder_nationality').val($el.data('nationality'));
            $('#holder_address').val($el.data('address'));
            $('#holder_percentage').val($el.data('percentage'));

            $('form#form_holder input[type=text]').addClass('dirty');

            $('#tambahanggota').modal('show');

            event.preventDefault();
        });
    });

    $('.trg_modal_holder_delete').each(function(){
        var $el = $(this);
        $el.on('click', function(event){
            var count_holder    = $('#table_holder tbody tr').length;
            if(count_holder > 0) {
                var sure        = confirm("Apakah anda yakin?");
                if(sure == true) {
                    var holder_id = $el.data('id');
                    var form = $('form#form_delete');
                    form.find('#delete_id').val(holder_id);
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: form.attr("method"),
                        url: '/daftar/delete_stakeholder',
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(result){
                            $('#table_holder #holder_' + holder_id).remove();

                            page_ready();
                        },
                        error: function(error){
                            console.log(error);
                            alert("Failed. Something went wrong, please try again later.");
                        }
                    });
                }
            } else {
                alert('Minimal harus ada 1 data terisi');
            }

            event.preventDefault();
        });
    });

    // Company Employee
    $('#trg_modal_pengurus').on('click', function(){
        $('form#form_pengurus input[type=text]').val('');
        $('#pengurus_id').val('');
        $('form#form_pengurus input[type=text]').removeClass('dirty');
    });

    $('#trg_pengurus').on('click', function(event){
        var form = $('form#form_pengurus');
        if(form.valid()) {
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
                    $('#tambahpengurus').modal('hide');

                    var result_id = result.id;

                    var pengurus_id = $('#pengurus_id').val();
                    var pengurus_name = $('#pengurus_name').val();
                    var pengurus_nationalid = $('#pengurus_nationalid').val();
                    var pengurus_jobtitle = $('#pengurus_jobtitle').val();

                    if(pengurus_id != '') {
                        var row_number = parseInt($('#table_pengurus #pengurus_' + pengurus_id + ' .number').text());
                        var updated_row = '';
                        updated_row += '<td class="number">' + row_number + '</td>';
                        updated_row += '<td>' + pengurus_name + '</td>';
                        updated_row += '<td>' + pengurus_nationalid + '</td>';
                        updated_row += '<td>' + pengurus_jobtitle + '</td>';

                        if(page_is_disabled){
                            updated_row += '<td><a data-id="' + pengurus_id + '" href="#" class="btn btn-flat trg_modal_pengurus_delete">hapus</a>';
                            updated_row += '<a href="#" class="btn btn-flat trg_modal_pengurus_edit" data-id="' + pengurus_id
                            + '" data-name="' + pengurus_name + '" data-national_id="' + pengurus_nationalid + '" data-job_title="' + pengurus_jobtitle
                            + '">edit</a></td>';
                        }

                        $('#table_pengurus #pengurus_' + pengurus_id).html(updated_row);
                    } else {
                        var last_number = parseInt($('#table_pengurus .number').last().text());
                        if(isNaN(last_number)) {
                            last_number = 0;
                        }

                        var new_row = '<tr id="pengurus_' + result_id + '">';
                        new_row += '<td class="number">' + (last_number + 1) + '</td>';
                        new_row += '<td>' + pengurus_name + '</td>';
                        new_row += '<td>' + pengurus_nationalid + '</td>';
                        new_row += '<td>' + pengurus_jobtitle + '</td>';

                        if(page_is_disabled){
                            new_row += '<td><a data-id="' + result_id + '" href="#" class="btn btn-flat trg_modal_pengurus_delete">hapus</a>';
                            new_row += '<a href="#" class="btn btn-flat trg_modal_pengurus_edit" data-id="' + result_id
                            + '" data-name="' + pengurus_name + '" data-national_id="' + pengurus_nationalid + '" data-job_title="' + pengurus_jobtitle
                            + '">edit</a></td>';
                        }

                        new_row += '</tr>';

                        $('#table_pengurus tbody').append(new_row);
                    }

                    $('form#form_pengurus input[type=text]').val('');

                    page_ready();
                },
                error: function(error){
                    console.log(error);
                    alert("Failed. Something went wrong, please try again later.");
                }
            });
        } else {
            //form.data('validator').focusInvalid();
        }
        event.preventDefault();
    });

    $('.trg_modal_pengurus_edit').each(function(){
        var $el = $(this);
        $el.on('click', function(event){
            $('#pengurus_id').val($el.data('id'));
            $('#pengurus_name').val($el.data('name'));
            $('#pengurus_nationalid').val($el.data('national_id'));
            $('#pengurus_jobtitle').val($el.data('job_title'));

            $('form#form_pengurus input[type=text]').addClass('dirty');

            $('#tambahpengurus').modal('show');

            event.preventDefault();
        });
    });

    $('.trg_modal_pengurus_delete').each(function(){
        var $el = $(this);
        $el.on('click', function(event){
            var count_pengurus  = $('#table_pengurus tbody tr').length;
            if(count_pengurus > 0) {
                var sure        = confirm("Apakah anda yakin?");
                if(sure == true) {
                    var pengurus_id = $el.data('id');
                    var form = $('form#form_delete');
                    form.find('#delete_id').val(pengurus_id);
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: form.attr("method"),
                        url: '/daftar/delete_manager',
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(result){
                            $('#table_pengurus #pengurus_' + pengurus_id).remove();

                            page_ready();
                        },
                        error: function(error){
                            console.log(error);
                            alert("Failed. Something went wrong, please try again later.");
                        }
                    });
                }
            } else {
                alert('Minimal harus ada 1 data terisi');
            }

            event.preventDefault();
        });
    });
}

function remove_file(filepath, token) {
    $.ajax({
        type: 'POST',
        url: '/file/delete',
        data: { 'filepath': filepath, '_token': token },
        cache: false,
        success: function(success){
            page_ready();
        },
        error: function(error){
            console.log(error);
            alert("Something went wrong, please try again later.");
        }
    });
}


$(document).ready(function(){
    page_ready();

    /* File Upload Handlers */
    Dropzone.autoDiscover = false;

    var token_contact_photo         = $('#token_contact_photo').val();
    var token_company_domicile      = $('#token_company_domicile').val();
    var token_company_taxpayer      = $('#token_company_taxpayer').val();
    var token_company_taxpayment    = $('#token_company_taxpayment').val();
    var token_company_taxreport     = $('#token_company_taxreport').val();
    var token_company_permit        = $('#token_company_permit').val();
    var token_company_registration  = $('#token_company_registration').val();
    var token_deed_release          = $('#token_deed_release').val();
    var token_deed_renewal          = $('#token_deed_renewal').val();
    var token_company_balance       = $('#token_company_balance').val();
    var token_company_structure     = $('#token_company_structure').val();
    var user_id                     = $('#company_user_id').val();

    $('#contact_photo').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_contact_photo,
            'purpose': 'contact',
            'user_id': user_id
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

                $('#contact_photo .dz-image, #contact_photo .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#contact_photo .dz-remove').on('click', function(){
                    remove_file(filepath, token_contact_photo);
                    $('#company_contact_block').find('.help-block').css('bottom', '-20px').css('right', '10px');
                });

                page_ready();
                alert('Dokumen Berhasil Di Upload.');
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_domicile').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_domicile,
            'purpose': 'domicile',
            'user_id': user_id
        },
        maxFilesize: 70,
        uploadMultiple: "no",
        maxFiles: 1,
        parallelUploads: 1,
        acceptedFiles: "image/png, image/gif, image/jpeg, .pdf",
        addRemoveLinks: true,
        removedFile: function(file) {
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

                $('#company_domicile_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_domicile .dz-image, #company_domicile .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_domicile .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_domicile);
                    $('#company_domicile_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                alert('Dokumen Berhasil Di Upload.');
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_taxpayer').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_taxpayer,
            'purpose': 'taxpayer',
            'user_id': user_id
        },
        maxFilesize: 70,
        uploadMultiple: "no",
        maxFiles: 1,
        parallelUploads: 1,
        acceptedFiles: "image/png, image/gif, image/jpeg, .pdf",
        addRemoveLinks: true,
        removedFile: function(file) {
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

                $('#company_taxpayer_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_taxpayer .dz-image, #company_taxpayer .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_taxpayer .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_taxpayer);
                    $('#company_taxpayer_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                alert('Dokumen Berhasil Di Upload.');
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_taxpayment').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_taxpayment,
            'purpose': 'taxpayment',
            'user_id': user_id
        },
        maxFilesize: 70,
        uploadMultiple: "no",
        maxFiles: 1,
        parallelUploads: 1,
        acceptedFiles: "image/png, image/gif, image/jpeg, .pdf",
        addRemoveLinks: true,
        removedFile: function(file) {
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

                $('#company_taxpayment_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_taxpayment .dz-image, #company_taxpayment .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_taxpayment .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_taxpayment);
                    $('#company_taxpayment_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                alert('Dokumen Berhasil Di Upload.');
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_taxreport').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_taxreport,
            'purpose': 'taxreport',
            'user_id': user_id
        },
        maxFilesize: 70,
        uploadMultiple: "no",
        maxFiles: 1,
        parallelUploads: 1,
        acceptedFiles: "image/png, image/gif, image/jpeg, .pdf",
        addRemoveLinks: true,
        removedFile: function(file) {
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

                $('#company_taxreport_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_taxreport .dz-image, #company_taxreport .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_taxreport .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_taxreport);
                    $('#company_taxreport_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                alert('Dokumen Berhasil Di Upload.');
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_permit').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_permit,
            'purpose': 'permit',
            'user_id': user_id
        },
        maxFilesize: 70,
        uploadMultiple: "no",
        maxFiles: 1,
        parallelUploads: 1,
        acceptedFiles: "image/png, image/gif, image/jpeg, .pdf",
        addRemoveLinks: true,
        removedFile: function(file) {
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

                $('#company_permit_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_permit .dz-image, #company_permit .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_permit .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_permit);
                    $('#company_permit_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                alert('Dokumen Berhasil Di Upload.');
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_registration').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_registration,
            'purpose': 'registration',
            'user_id': user_id
        },
        maxFilesize: 70,
        uploadMultiple: "no",
        maxFiles: 1,
        parallelUploads: 1,
        acceptedFiles: "image/png, image/gif, image/jpeg, .pdf",
        addRemoveLinks: true,
        removedFile: function(file) {
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

                $('#company_registration_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_registration .dz-image, #company_registration .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_registration .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_registration);
                    $('#company_registration_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                alert('Dokumen Berhasil Di Upload.');
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#deed_release').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_deed_release,
            'purpose': 'deed_release',
            'user_id': user_id
        },
        maxFilesize: 70,
        uploadMultiple: "no",
        maxFiles: 1,
        parallelUploads: 1,
        acceptedFiles: "image/png, image/gif, image/jpeg, .pdf",
        addRemoveLinks: true,
        removedFile: function(file) {
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

                $('#deed_release_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#deed_release .dz-image, #deed_release .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#deed_release .dz-remove').on('click', function(){
                    remove_file(filepath, token_deed_release);
                    $('#deed_release_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                alert('Dokumen Berhasil Di Upload.');
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#deed_renewal').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_deed_renewal,
            'purpose': 'deed_renewal',
            'user_id': user_id
        },
        maxFilesize: 70,
        uploadMultiple: "no",
        maxFiles: 1,
        parallelUploads: 1,
        acceptedFiles: "image/png, image/gif, image/jpeg, .pdf",
        addRemoveLinks: true,
        removedFile: function(file) {
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

                $('#deed_renewal_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#deed_renewal .dz-image, #deed_renewal .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#deed_renewal .dz-remove').on('click', function(){
                    remove_file(filepath, token_deed_renewal);
                    $('#deed_renewal_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                alert('Dokumen Berhasil Di Upload.');
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_balance').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_balance,
            'purpose': 'balance',
            'user_id': user_id
        },
        maxFilesize: 70,
        uploadMultiple: "no",
        maxFiles: 1,
        parallelUploads: 1,
        acceptedFiles: "image/png, image/gif, image/jpeg, .pdf",
        addRemoveLinks: true,
        removedFile: function(file) {
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

                $('#company_balance_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_balance .dz-image, #company_balance .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_balance .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_balance);
                    $('#company_balance_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                alert('Dokumen Berhasil Di Upload.');
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_structure').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_structure,
            'purpose': 'structure',
            'user_id': user_id
        },
        maxFilesize: 70,
        uploadMultiple: "no",
        maxFiles: 1,
        parallelUploads: 1,
        acceptedFiles: "image/png, image/gif, image/jpeg, .pdf",
        addRemoveLinks: true,
        removedFile: function(file) {
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

                $('#company_structure_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_structure .dz-image, #company_structure .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_structure .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_structure);
                    $('#company_structure_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                alert('Dokumen Berhasil Di Upload.');
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            file.previewElement.classList.add('dz-error');
        }
    });
});
