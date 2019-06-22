function page_ready() {

    var page_is_disabled = $('#currently_disabled').val() == '';

    $("#taxes_taxpayer_number").inputmask('99.999.999.9-999.999', {numericInput: true, rightAlignNumerics: false, removeMaskOnSubmit: true});

    $('#trg_savedata').on('click', function(event){
        var form = $('form#form_registration');
        if(form.valid()) {
            var formData = new FormData(form[0]);
            $.ajax({
                type: form.attr("method"),
                url: form.attr("action"),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#simpan').modal({backdrop: 'static', keyboard: false});
                },
                success: function(result){
                    console.log(result);
                    $('#saved_loader').hide();
                    $('#saved_registration, #saved_btn').show();

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

    $('#trg_registration').on('click', function(event){
        $('#verifikasi').modal('hide');
        // Add By Dandy Firmansyah
        $('#registration_loader').hide();
        $('#failed_message').html('');
        $('#failed_registration, #failed_btn').hide();
        // End Add By Dandy Firmansyah

        $('#registration_loading').modal({backdrop: 'static', keyboard: false});
        
        // Add By Dandy Firmansyah
        $('#registration_loader').show();
        // End Add By Dandy Firmansyah
        
        var type_usaha      = $('#cmp_typeid_dd').val();
        var form            = $('form#form_registration');
        var valid           = true;
        // var count_pengurus  = $('#table_pengurus tbody tr').length;
        // var count_person    = $('#table_person tbody tr').length;
        var count_cert      = $('#table_cert tbody tr').length;
        var count_exp       = $('#table_exp tbody tr').length;
        // var count_job       = $('#table_job tbody tr').length;
        var empty_fields    = [];
        var tab1_fields     = [];
        var tab2_fields     = [];
        var tab3_fields     = [];

        $('#step1 .is_req').each(function(){
            if($(this).val() == '') {
                valid           = false;
                tab1_fields.push($(this).next().text().trim());
            }
        });

        if(tab1_fields.length > 0) {
            var tab1_fields_info  = '<div class="text-center">Penanggung Jawab:&nbsp;';
            tab1_fields_info      += tab1_fields.join(', ');
            tab1_fields_info      += '</div>';
            empty_fields.push(tab1_fields_info);
        }

        $('#step2 .is_req').each(function(){
            if($(this).val() == '') {
                valid           = false;
                tab2_fields.push($(this).next().text().trim());
            }
        });

        if(tab2_fields.length > 0) {
            var tab2_fields_info  = '<div class="text-center">Data Perusahaan:&nbsp;';
            tab2_fields_info      += tab2_fields.join(', ');
            tab2_fields_info      += '</div>';
            empty_fields.push(tab2_fields_info);
        }

        // Start Permit Checker

        /** Add By Dandy Firmansyah 07 Februari 2019 **/

        // for agreement
        var valid_agreement = true;
        // alert(document.getElementById('contact_contractsignin').checked);
        // return false;
        if (document.getElementById('contact_contractsignin').checked === false && document.getElementById('contact_inbankrupt').checked === false && document.getElementById('contact_realdata').checked === false) {
            valid_agreement = false;
            empty_fields.push('<div class="text-center">Agreement Harus Diisi</div>');
        }

        // 0
        var company_profile_file_new   = $('#company_profile .dz-preview').length > 0;
        var company_profile_file_old   = $('#company_profile_block .image-block').length > 0;
        var valid_company_profile_file = company_profile_file_new || company_profile_file_old;
        valid_company_profile = false;
        if (valid_company_profile_file) {
            valid_company_profile = true;
        }else{
            if (type_usaha == '1' || type_usaha == '2') {
                empty_fields.push('<div class="text-center">Data Company Profile</div>');
            }
        }

        var company_struktur_file_new   = $('#company_struktur .dz-preview').length > 0;
        var company_struktur_file_old   = $('#company_struktur_block .image-block').length > 0;
        var valid_company_struktur_file = company_struktur_file_new || company_struktur_file_old;
        valid_company_struktur = false;
        if (valid_company_struktur_file) {
            valid_company_struktur = true;
        }else{
            if (type_usaha == '1') {
                empty_fields.push('<div class="text-center">Struktur Organisasi (terkait penanggung jawab proyek)</div>');
            }
        }

        var company_skt_file_new   = $('#company_skt .dz-preview').length > 0;
        var company_skt_file_old   = $('#company_skt_block .image-block').length > 0;
        var valid_company_skt_file = company_skt_file_new || company_skt_file_old;
        valid_company_skt = false;
        if (valid_company_skt_file) {
            valid_company_skt = true;
        }else{
            if (type_usaha == '1' || type_usaha == '2') {
                empty_fields.push('<div class="text-center">Surat Keterangan Terdaftar [SKT]</div>');
            }
        }

        var company_spkmp_file_new   = $('#company_spkmp .dz-preview').length > 0;
        var company_spkmp_file_old   = $('#company_spkmp_block .image-block').length > 0;
        var valid_company_spkmp_file = company_spkmp_file_new || company_spkmp_file_old;
        valid_company_spkmp = false;
        if (valid_company_spkmp_file) {
            valid_company_spkmp = true;
        }else{
            empty_fields.push('<div class="text-center">Surat Pernyataan Kesanggupan Memenuhi Pengadaan</div>');
        }

        // 1
        var contact_photo_file_new   = $('#contact_photo .dz-preview').length > 0;
        var contact_photo_file_old   = $('#company_contact_block .image-block').length > 0;
        var contact_photo_req_01     = contact_photo_file_new ||  contact_photo_file_old;
        valid_contact_photo = false;
        if (contact_photo_req_01) {
            valid_contact_photo = true;
        }else{
            empty_fields.push('<div class="text-center">KTP Penanggung Jawab</div>');   
        }
        /** End Add By Dandy Firmansyah 07 Februari 2019 **/

        // 2
        var domicile_file_new   = $('#company_domicile .dz-preview').length > 0;
        var domicile_file_old   = $('#company_domicile_block .image-block').length > 0;
        var valid_domicile_file = domicile_file_new || domicile_file_old;
        valid_domicile = false;
        if (valid_domicile_file) {
            valid_domicile = true;
        }else{
            if (type_usaha == '1' || type_usaha == '2') {
                empty_fields.push('<div class="text-center">Surat Keterangan Domisili Perusahaan [SKDP]</div>');
            }
        }

        // 3
        var deed_file_new   = $('#deed_release .dz-preview').length > 0;
        var deed_file_old   = $('#deed_release_block .image-block').length > 0;
        var valid_deed_file = deed_file_new || deed_file_old;
        valid_deed = false;
        if (valid_deed_file) {
            valid_deed = true;
        }else{
            if (type_usaha == '1' || type_usaha == '2' || type_usaha == '3') {
                empty_fields.push('<div class="text-center">Akta Pendirian Perusahaan</div>');   
            }
        }

        // 4
        var deed_renewal_file_new   = $('#deed_renewal .dz-preview').length > 0;
        var deed_renewal_file_old   = $('#deed_renewal_block .image-block').length > 0;
        var valid_deed_renewal_file = deed_renewal_file_new || deed_renewal_file_old;
        valid_deed_renewal = false;
        if (valid_deed_renewal_file) {
            valid_deed_renewal = true;
        }

        // 5
        var sk_kemenkumham_file_new   = $('#company_sk_kemenkumham .dz-preview').length > 0;
        var sk_kemenkumham_file_old   = $('#company_sk_kemenkumham_block .image-block').length > 0;
        var sk_kemenkumham_req_01     = $('#sk_kemenkumham_document_number').val() != '';
        var sk_kemenkumham_req_04     = sk_kemenkumham_file_old || sk_kemenkumham_file_new;
        var valid_sk_kemenkumham      = false;
        if(sk_kemenkumham_req_01 && sk_kemenkumham_req_04) {
            valid_sk_kemenkumham      = true;
        }else{
            if (type_usaha == '1' || type_usaha == '2' || type_usaha == '3') {
                empty_fields.push('<div class="text-center">SK KEMENKUMHAM - Pendirian Perusahaan</div>');   
            }
        }

        var sk_kemenkumham_perubahan_file_new   = $('#company_sk_kemenkumham_perubahan .dz-preview').length > 0;
        var sk_kemenkumham_perubahan_file_old   = $('#company_sk_kemenkumham_perubahan_block .image-block').length > 0;
        var sk_kemenkumham_perubahan_req_01     = $('#sk_kemenkumham_perubahan_document_number').val() != '';
        var sk_kemenkumham_perubahan_req_04     = sk_kemenkumham_perubahan_file_old || sk_kemenkumham_perubahan_file_new;
        var valid_sk_kemenkumham_perubahan      = false;
        if(sk_kemenkumham_perubahan_req_01 && sk_kemenkumham_perubahan_req_04) {
            valid_sk_kemenkumham_perubahan      = true;
        }
        
        // 6
        var siup_file_new   = $('#company_siup .dz-preview').length > 0;
        var siup_file_old   = $('#company_siup_block .image-block').length > 0;
        var siup_req_01     = $('#siup_document_number').val() != '';
        var siup_req_02     = $('#siup_licensor').val() != '';
        var siup_req_03     = $('#siup_release_date').val() != '';
        var siup_req_04     = siup_file_old || siup_file_new;
        var valid_siup      = false;
        if(siup_req_01 && siup_req_02 && siup_req_03 && siup_req_04) {
            valid_siup      = true;
        }else{
            if (type_usaha == '1' || type_usaha == '2') {
                empty_fields.push('<div class="text-center">Surat Izin Usaha Perdagangan [SIUP]</div>');
            }
        }

        // 7
        var iujk_file_new   = $('#company_iujk .dz-preview').length > 0;
        var iujk_file_old   = $('#company_iujk_block .image-block').length > 0;
        var iujk_req_01     = $('#iujk_document_number').val() != '';
        var iujk_req_02     = $('#iujk_licensor').val() != '';
        var iujk_req_03     = $('#iujk_release_date').val() != '';
        var iujk_req_04     = iujk_file_old || iujk_file_new;
        var valid_iujk      = false;
        if(iujk_req_01 && iujk_req_02 && iujk_req_03 && iujk_req_04) {
            valid_iujk      = true;
        }

        // 8
        var company_registration_file_new   = $('#company_registration .dz-preview').length > 0;
        var company_registration_file_old   = $('#company_registration_block .image-block').length > 0;
        var company_registration_req_01     = $('#registration_registration_number').val() != '';
        var company_registration_req_02     = $('#registration_licensor').val() != '';
        var company_registration_req_03     = $('#registration_release_date').val() != '';
        var company_registration_req_04     = $('#registration_expired_date').val() != '';
        var company_registration_req_05     = company_registration_file_old || company_registration_file_new;
        var valid_company_registration      = false;
        if(company_registration_req_01 && company_registration_req_02 && company_registration_req_03 && company_registration_req_04 && company_registration_req_05) {
            valid_company_registration      = true;
        }else{
            if (type_usaha == '1' || type_usaha == '2') {
                empty_fields.push('<div class="text-center">Tanda Daftar Perusahaan [TDP]</div>');
            }
        }

        // 9
        var company_taxpayer_file_new   = $('#company_taxpayer .dz-preview').length > 0;
        var company_taxpayer_file_old   = $('#company_taxpayer_block .image-block').length > 0;
        var company_taxpayer_req_01     = $('#taxes_taxpayer_number').val() != '';
        var company_taxpayer_req_02     = $('#taxes_release_date').val() != '';
        var valid_company_taxpayer_file = company_taxpayer_file_new || company_taxpayer_file_old;
        var valid_company_taxpayer = false;
        if (company_taxpayer_req_01 && company_taxpayer_req_02 && valid_company_taxpayer_file) {
            valid_company_taxpayer = true;
        }else{
            empty_fields.push('<div class="text-center">Nomor Pokok Wajib Pajak [NPWP]</div>');
        }

        // 10
        // bukti pajak tahun terakhir
        var company_taxpayment_file_new   = $('#company_taxpayment .dz-preview').length > 0;
        var company_taxpayment_file_old   = $('#company_taxpayment_block .image-block').length > 0;
        var company_taxpayment_req_01     = $('#taxes_last_satisfactionnumber').val() != '';
        var valid_company_taxpayment_file = company_taxpayment_file_new || company_taxpayment_file_old;
        valid_company_taxpayment = false;
        if (company_taxpayment_req_01 && valid_company_taxpayment_file) {
            valid_company_taxpayment = true;
        }else{
            if (type_usaha == '1') {
                empty_fields.push('<div class="text-center">Bukti Pembayaran Pajak tahun terakhir</div>');
            }
        }

        // bukti pajak 2 tahun terakhir
        var company_taxpayment_kedua_file_new   = $('#company_taxpayment_kedua .dz-preview').length > 0;
        var company_taxpayment_kedua_file_old   = $('#company_taxpayment_kedua_block .image-block').length > 0;
        var company_taxpayment_kedua_req_01     = $('#taxes_last_satisfactionnumber_kedua').val() != '';
        var valid_company_taxpayment_kedua_file = company_taxpayment_kedua_file_new || company_taxpayment_kedua_file_old;
        valid_company_taxpayment_kedua = false;
        if (company_taxpayment_kedua_req_01 && valid_company_taxpayment_kedua_file) {
            valid_company_taxpayment_kedua = true;
        }else{
            if (type_usaha == '1') {
                empty_fields.push('<div class="text-center">Bukti Pembayaran Pajak 2 tahun terakhir</div>');
            }
        }

        // 11
        var company_sppkp_file_new   = $('#company_sppkp .dz-preview').length > 0;
        var company_sppkp_file_old   = $('#company_sppkp_block .image-block').length > 0;
        var company_sppkp_req_01     = $('#taxes_sppkpnumber').val() != '';
        var valid_company_sppkp_file = company_sppkp_file_new || company_sppkp_file_old;
        valid_company_sppkp = false;
        if (company_sppkp_req_01 && valid_company_sppkp_file) {
            valid_company_sppkp = true;
        }else{
            if (type_usaha == '1' || type_usaha == '2') {
                empty_fields.push('<div class="text-center">Surat Pengukuhan Pengusaha Kena Pajak [SPPKP]</div>');   
            }
        }

        // 12
        var company_balance_file_new   = $('#company_balance .dz-preview').length > 0;
        var company_balance_file_old   = $('#company_balance_block .image-block').length > 0;
        var valid_company_balance_file = company_balance_file_new || company_balance_file_old;
        valid_company_balance = false;
        if (valid_company_balance_file) {
            valid_company_balance = true;
        }else{
            if (type_usaha == '1') {
                empty_fields.push('<div class="text-center">Neraca Keuangan 2 tahun terakhir</div>');      
            }
        }
        

        // var siui_file_new   = $('#company_siui .dz-preview').length > 0;
        // var siui_file_old   = $('#company_siui_block .image-block').length > 0;
        // var siui_req_01     = $('#siui_document_number').val() != '';
        // var siui_req_02     = $('#siui_licensor').val() != '';
        // var siui_req_03     = $('#siui_release_date').val() != '';
        // var siui_req_04     = siui_file_old || siui_file_new;
        // var valid_siui      = false;
        // if(siui_req_01 && siui_req_02 && siui_req_03) {
        //     valid_siui      = true;
        // }

        /** Commented By Dandy Firmansyah 15 Februari 2019 **/
        //check siup/iujk/siui
        // var validcek = false;
        // if(valid_siup || valid_iujk){
        //     validcek = true;
        // }
        
        // valid               = valid_siup || valid_iujk;

        // valid               = valid && validcek;
        
        // valid               = valid && valid_deed_file && valid_domicile_file;
        /** End Commented By Dandy Firmansyah 15 Februari 2019 **/
        // End Permit Checker

        $('#step3 .is_req').each(function(){
            if($(this).val() == '') {
                valid           = false;
                tab3_fields.push($(this).next().text().trim());
            }
        });

        if(tab3_fields.length > 0) {
            var tab3_fields_info  = '<div class="text-center">Dokumen Administrasi:&nbsp;';
            tab3_fields_info      += tab3_fields.join(', ');
            tab3_fields_info      += '</div>';
            empty_fields.push(tab3_fields_info);
        }

        // Bisa Follow After
        // if(count_cert == 0) {
        //     valid = false;
        //     empty_fields.push('<div class="text-center">Data Surat/Sertifikat Perusahaan</div>');
        // }
        var valid_pengalaman = true;
        if(count_exp == 0) {
            if (type_usaha == '1' || type_usaha == '2') {
                valid_pengalaman = false;
                empty_fields.push('<div class="text-center">Data Pengalaman Perusahaan</div>');
            }
        }

        if (type_usaha == '1') {
            valid = valid && valid_agreement && valid_company_taxpayment && valid_company_taxpayment_kedua && valid_company_profile && valid_deed && valid_contact_photo && valid_company_taxpayer && 
                    valid_sk_kemenkumham && valid_siup && valid_domicile && valid_company_skt && valid_company_sppkp && valid_company_registration && valid_company_balance && 
                    valid_pengalaman && valid_company_struktur && valid_company_spkmp;
        }else if (type_usaha == '2') {
            valid = valid && valid_agreement && valid_company_profile && valid_deed && valid_contact_photo && valid_company_taxpayer && valid_sk_kemenkumham && valid_siup && 
                    valid_domicile && valid_company_skt && valid_company_sppkp && valid_company_registration && valid_pengalaman && valid_company_spkmp;
        }else if (type_usaha == '3') {
            valid = valid && valid_agreement && valid_deed && valid_contact_photo && valid_company_taxpayer && valid_sk_kemenkumham && valid_company_spkmp;
        }else if (type_usaha == '4') {
            valid = valid && valid_agreement && valid_contact_photo && valid_company_spkmp && valid_company_taxpayer;
        }

        console.log('loop test');
        if(valid == true) {
            var formData = new FormData(form[0]);
            $.ajax({
                type: form.attr("method"),
                url: '/daftar/submit_registrasi',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result){
                    document.location = '/terimakasih';
                    page_ready();
                },
                error: function(error){
                    console.log(error);
                    //alert("Failed. Something went wrong, please try again later.");
                }
            });
        } else if (valid == false) {
            var failed_message = '<strong>Harap lengkapi semua data wajib:</strong><br><span style="color:red;">' + empty_fields.join('') + '</span>';
            $('#failed_message').html(failed_message);
            $('#registration_loader').hide();
            $('#failed_registration, #failed_btn').show();
            return false;
        }
        event.preventDefault();
    });

    $('#trg_back').on('click', function(event){
        $('form#form-logout').submit();
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
            var sure = confirm("Apakah anda yakin?");
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
                            + '">edit</a>';
                            updated_row += '<a data-id="' + exp_id + '" href="#" class="btn btn-danger trg_modal_exp_delete">hapus</a></td>';
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
                            + '">edit</a>';
                            new_row += '<a data-id="' + result_id + '" href="#" class="btn btn-danger trg_modal_exp_delete">hapus</a></td>';
                            
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
            var sure = confirm("Apakah anda yakin?");
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
                    // return false;
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
        // alert('asdasd');

        $.get('/daftar/certificate_id', function(result) {
            var new_id = result.id;
            // alert('returnan');
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
                            updated_row += '<td><a data-id="' + person_id + '" href="#" class="btn btn-flat trg_modal_person_delete">hapus</a>';
                            updated_row += '<a href="#" class="btn btn-flat trg_modal_person_edit" data-id="' + person_id
                            + '" data-name="' + person_name + '" data-birth_date="' + person_birthdate + '" data-education="' + person_education
                            + '" data-job_title="' + person_jobtitle + '" data-experience="' + person_experience
                            + '" data-expertise="' + person_expertise + '">edit</a></td>';
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
            var sure = confirm("Apakah anda yakin?");
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
            var sure = confirm("Apakah anda yakin?");
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
            var sure = confirm("Apakah anda yakin?");
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

            event.preventDefault();
        });
    });
}

function remove_file(filepath, token) {
    var user_id_send = $('#company_user_id').val();
    $.ajax({
        type: 'POST',
        url: '/file/delete',
        data: { 'filepath': filepath, '_token': token, 'user_id': user_id_send },
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

    var npwp_val                    = $('#value_npwp').val();
    $("#taxes_taxpayer_number").val(npwp_val);

    /* File Upload Handlers */
    Dropzone.autoDiscover = false;

    var token_contact_photo         = $('#token_contact_photo').val();
    var token_company_domicile      = $('#token_company_domicile').val();
    var token_company_profile       = $('#token_company_profile').val();
    var token_company_taxpayer      = $('#token_company_taxpayer').val();
    var token_company_taxpayment    = $('#token_company_taxpayment').val();
    var token_company_taxpayment_kedua    = $('#token_company_taxpayment_kedua').val();
    // var token_company_taxreport     = $('#token_company_taxreport').val();
    var token_company_sppkp         = $('#token_company_sppkp').val();
    var token_company_skt           = $('#token_company_skt').val();
    var token_company_struktur      = $('#token_company_struktur').val();
    var token_company_spkmp         = $('#token_company_spkmp').val();
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
        maxFilesize: 4,
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
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
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
        maxFilesize: 4,
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
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_profile').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_profile,
            'purpose': 'profile',
            'user_id': user_id
        },
        maxFilesize: 4,
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

                $('#company_profile_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_profile .dz-image, #company_profile .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_profile .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_profile);
                    $('#company_profile_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_struktur').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_struktur,
            'purpose': 'struktur',
            'user_id': user_id
        },
        maxFilesize: 4,
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

                $('#company_struktur_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_struktur .dz-image, #company_struktur .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_struktur .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_struktur);
                    $('#company_struktur_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_spkmp').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_spkmp,
            'purpose': 'spkmp',
            'user_id': user_id
        },
        maxFilesize: 4,
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

                $('#company_spkmp_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_spkmp .dz-image, #company_spkmp .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_spkmp .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_spkmp);
                    $('#company_spkmp').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
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
        maxFilesize: 4,
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
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
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
        maxFilesize: 4,
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
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_taxpayment_kedua').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_taxpayment_kedua,
            'purpose': 'taxpayment_kedua',
            'user_id': user_id
        },
        maxFilesize: 4,
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

                $('#company_taxpayment_kedua_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_taxpayment_kedua .dz-image, #company_taxpayment_kedua .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_taxpayment_kedua .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_taxpayment_kedua);
                    $('#company_taxpayment_kedua_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
            file.previewElement.classList.add('dz-error');
        }
    });

    // $('#company_taxreport').dropzone({
    //     url: '/upload/company',
    //     paramName: 'files',
    //     params: {
    //         '_token': token_company_taxreport,
    //         'purpose': 'taxreport',
    //         'user_id': user_id
    //     },
    //     maxFilesize: 4,
    //     uploadMultiple: "no",
    //     maxFiles: 1,
    //     parallelUploads: 1,
    //     acceptedFiles: "image/png, image/gif, image/jpeg, .pdf",
    //     addRemoveLinks: true,
    //     removedFile: function(file) {
    //         file.previewElement.remove();
    //     },
    //     init: function() {
    //         this.on("maxfilesexceeded", function() {
    //             if (this.files[1]!=null){
    //                 this.removeFile(this.files[0]);
    //             }
    //         });
    //     },
    //     success: function(file, response) {
    //         if(response.status == 'OK') {
    //             var filepath = response.filepath;
    //             var filename = response.filename;
    //             var remove_btn = file.previewElement.querySelector('.dz-remove');

    //             file.previewElement.classList.add('dz-success');
    //             remove_btn.setAttribute('data-filename', filepath);

    //             $(file.previewElement).parent().parent()
    //             .find('.dropzone').css('margin-top', '0px');

    //             $('#company_taxreport_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

    //             $('#company_taxreport .dz-image, #company_taxreport .dz-details').on('click', function(){
    //                 window.open('/uploads/' + response.filepath,'_blank');
    //             });

    //             $('#company_taxreport .dz-remove').on('click', function(){
    //                 remove_file(filepath, token_company_taxreport);
    //                 $('#company_taxreport_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
    //             });

    //             page_ready();
                // alert('Dokumen Berhasil Di Upload.');
                // swal("","Dokumen Berhasil di Upload","success");
    //         } else {
    //             file.previewElement.classList.add('dz-error');
    //         }
    //     },
    //     error: function(file, response) {
        // alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
        //     this.removeFile(file);
    //         file.previewElement.classList.add('dz-error');
    //     }
    // });

    $('#company_sppkp').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_sppkp,
            'purpose': 'sppkp',
            'user_id': user_id
        },
        maxFilesize: 4,
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

                $('#company_sppkp_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_sppkp .dz-image, #company_sppkp .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_sppkp .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_sppkp);
                    $('#company_sppkp_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_skt').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_skt,
            'purpose': 'skt',
            'user_id': user_id
        },
        maxFilesize: 4,
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

                $('#company_skt_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_skt .dz-image, #company_skt .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_skt .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_skt);
                    $('#company_skt_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_siup').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_permit,
            'purpose': 'siup',
            'user_id': user_id
        },
        maxFilesize: 4,
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

                $('#company_siup_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_siup .dz-image, #company_siup .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_siup .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_permit);
                    $('#company_siup_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_iujk').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_permit,
            'purpose': 'iujk',
            'user_id': user_id
        },
        maxFilesize: 4,
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

                $('#company_iujk_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_iujk .dz-image, #company_iujk .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_iujk .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_permit);
                    $('#company_iujk_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_siui').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_permit,
            'purpose': 'siui',
            'user_id': user_id
        },
        maxFilesize: 4,
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

                $('#company_siui_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_siui .dz-image, #company_siui .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_siui .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_permit);
                    $('#company_siui_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_sk_kemenkumham').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_permit,
            'purpose': 'sk_kemenkumham',
            'user_id': user_id
        },
        maxFilesize: 4,
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

                $('#company_sk_kemenkumham_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_sk_kemenkumham .dz-image, #company_sk_kemenkumham .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_sk_kemenkumham .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_permit);
                    $('#company_sk_kemenkumham_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
            file.previewElement.classList.add('dz-error');
        }
    });

    $('#company_sk_kemenkumham_perubahan').dropzone({
        url: '/upload/company',
        paramName: 'files',
        params: {
            '_token': token_company_permit,
            'purpose': 'sk_kemenkumham_perubahan',
            'user_id': user_id
        },
        maxFilesize: 4,
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

                $('#company_sk_kemenkumham_perubahan_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

                $('#company_sk_kemenkumham_perubahan .dz-image, #company_sk_kemenkumham_perubahan .dz-details').on('click', function(){
                    window.open('/uploads/' + response.filepath,'_blank');
                });

                $('#company_sk_kemenkumham_perubahan .dz-remove').on('click', function(){
                    remove_file(filepath, token_company_permit);
                    $('#company_sk_kemenkumham_perubahan_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
                });

                page_ready();
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
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
        maxFilesize: 4,
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
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
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
        maxFilesize: 4,
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
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
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
        maxFilesize: 4,
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
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
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
        maxFilesize: 4,
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
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                alert('gagal php');
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
            alert('gagal server bos');
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
        maxFilesize: 4,
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
                // alert('Dokumen Berhasil Di Upload.');
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            alert("File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB.");
            this.removeFile(file);
            file.previewElement.classList.add('dz-error');
        }
    });
});
