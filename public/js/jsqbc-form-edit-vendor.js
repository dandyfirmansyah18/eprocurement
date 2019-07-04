function page_ready() {

    var page_is_disabled = $('#currently_disabled').val() == '';

    $("#taxes_taxpayer_number").inputmask('99.999.999.9-999.999', {numericInput: true, rightAlignNumerics: false, removeMaskOnSubmit: true});

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
        var count_cert      = $('#table_cert tbody tr').length;
        var count_exp       = $('#table_exp tbody tr').length;
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

        if (type_usaha == '1') {
            valid = valid && valid_agreement && valid_company_taxpayment && valid_company_taxpayment_kedua && valid_company_profile && valid_deed && valid_contact_photo && valid_company_taxpayer && 
                    valid_sk_kemenkumham && valid_siup && valid_domicile && valid_company_skt && valid_company_sppkp && valid_company_registration && valid_company_balance && 
                    valid_company_struktur && valid_company_spkmp;
        }else if (type_usaha == '2') {
            valid = valid && valid_agreement && valid_company_profile && valid_deed && valid_contact_photo && valid_company_taxpayer && valid_sk_kemenkumham && valid_siup && 
                    valid_domicile && valid_company_skt && valid_company_sppkp && valid_company_registration && valid_company_spkmp;
        }else if (type_usaha == '3') {
            valid = valid && valid_agreement && valid_deed && valid_contact_photo && valid_company_taxpayer && valid_sk_kemenkumham && valid_company_spkmp;
        }else if (type_usaha == '4') {
            valid = valid && valid_agreement && valid_contact_photo && valid_company_spkmp && valid_company_taxpayer;
        }

        if(valid == true) {
            var formData = new FormData(form[0]);
            $.ajax({
                type: form.attr("method"),
                url: form.attr("action"),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result){
                    // document.location = '/terimakasih';
                    swal("","Data Perusahaan berhasil dirubah.","success");
                    // document.location = '/my_profile';
                    $('#verifikasi').modal('hide');
                    $('#registration_loading').modal('hide');
                    call('/my_profile','_content_','Profile Penyedia');
                    // page_ready();
                },
                error: function(error){
                    console.log(error);
                    swal("","Failed. Something went wrong, please try again later.","error");
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
            swal("","Something went wrong, please try again later.","error");
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
    // var token_company_taxreport     = $('#token_company_taxreport').val();
    var token_company_taxpayment_kedua    = $('#token_company_taxpayment_kedua').val();
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                // swal("","Dokumen Berhasil di Upload","success");
    //         } else {
    //             file.previewElement.classList.add('dz-error');
    //         }
    //     },
    //     error: function(file, response) {
        // swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
            this.removeFile(file);
            file.previewElement.classList.add('dz-error');
        }
    });

    // $('#company_permit').dropzone({
    //     url: '/upload/company',
    //     paramName: 'files',
    //     params: {
    //         '_token': token_company_permit,
    //         'purpose': 'permit',
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

    //             $('#company_permit_block').find('.help-block').css('bottom', '-20px').css('width', '100%');

    //             $('#company_permit .dz-image, #company_permit .dz-details').on('click', function(){
    //                 window.open('/uploads/' + response.filepath,'_blank');
    //             });

    //             $('#company_permit .dz-remove').on('click', function(){
    //                 remove_file(filepath, token_company_permit);
    //                 $('#company_permit_block').find('.help-block').css('bottom', '-20px').css('width', '100%');
    //             });

    //             page_ready();
    //             alert('Dokumen Berhasil Di Upload.');
    //         } else {
    //             file.previewElement.classList.add('dz-error');
    //         }
    //     },
    //     error: function(file, response) {
    //         file.previewElement.classList.add('dz-error');
    //     }
    // });

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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
            this.removeFile(file);
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
                swal("","Dokumen Berhasil di Upload","success");
            } else {
                file.previewElement.classList.add('dz-error');
            }
        },
        error: function(file, response) {
            swal("","File yang Anda Upload harus PNG, GIF, JPG, PDF dengan ukuran Maks 4 MB","error");
            this.removeFile(file);
            file.previewElement.classList.add('dz-error');
        }
    });
});
