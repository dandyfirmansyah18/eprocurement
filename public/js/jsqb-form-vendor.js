$(document).ready(function() {
    $('.jenis_tambah').click(function() {
        var test = $(this).val();
        $('div.pilihan').hide();
        $('#pilihan' + test).show();
    });

    $('#tanggalsiup').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });

    $('#tanggalnpwpstart').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });

    $('#tanggalnpwpend').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    $('#siup_release_date').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    $('#siup_expired_date').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    $('#iujk_release_date').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    $('#iujk_expired_date').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    $('#tanggalsiuistart').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    $('#tanggalsiuiend').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    $('#registration_release_date').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    $('#tanggaltdpend').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });

    // Akta Perusahaan
    $('#tanggal_dikeluarkan_akta').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    $('#tanggal_pengesahan_akta').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    $('#dtf_deed_renewaled').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    $('#dtf_deed_renewal_confirmed').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });

    $('#tanggallahirpersonalia').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    $('#tanggalpersonalia_mulai').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    $('#tanggalpersonalia_selesai').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    $('#tanggalproyek').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    $('#cert_release_date_block').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    $('#cert_expired_date_block').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });

    $('#skdp_document_date').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });

    $(".select2-list").select2({
      allowClear: true,
      width: '100%'
    });

    $('#statuslokasi').on('change', function() {
      if ( this.value == '1')
      {
        $("#branch_detail").show();
      }
      else
      {
        $("#branch_detail").hide();
      }
    });

    $('#kuasa').on('click', function(){
      $('.boks').show();
    });

    $('#sendiri').on('click', function(){
      $('.boks').hide();
    });

    //field dokumen admin
    var max_fields1      = 3; //maximum input boxes allowed
    var wrapper1         = $(".input_fields_wrap_elemen"); //Fields wrapper
    var add_button1      = $(".add_field_button_elemen"); //Add button ID
    var isi11            = '<div class="form-group floating-label"><input type="text" class="form-control" id="regular2"><label for="regular2">Nama Elemen Rekanan</label></div>'
    var ilangin1         = '<div class="col-sm-2"><a class="btn btn-flat remove_field1" href="#"><i class="fa fa-trash"></i>  Hapus isian ini</a></div></div></div>'
    var xo1 = 1; //initlal text box count
    $(add_button1).click(function(e){ //on add input button click
        e.preventDefault();
        if(xo1 < max_fields1){ //max input box allowed
            xo1++; //text box increment
            $(wrapper1).append(isi11+ilangin1); //add input box
        }
    });

    $(wrapper1).on("click",".remove_field1", function(e){ //user click on remove text
        //e.preventDefault(); $(this).parent('div').remove(); xo1--;
        e.preventDefault(); $(this).parents('.hapusin1').remove(); xo1--;
    });

    // dropdown saved values
    var cmp_withbranch          = $('#cmp_withbranch').val();
    var cmp_province            = $('#cmp_province').val();
    var cmpb_province           = $('#cmpb_province').val();
    var operational_province    = $('#operational_province').val();
    var cmp_city                = $('#cmp_city').val();
    var cmpb_city               = $('#cmpb_city').val();
    var operational_city        = $('#operational_city').val();
    var cmp_postalcode          = $('#cmp_postalcode').val();
    var cmpb_postalcode         = $('#cmpb_postalcode').val();
    var operational_postalcode  = $('#operational_postalcode').val();
    var cmp_address             = $('#cmp_address').val();
    var cmpb_address            = $('#cmpb_address').val();;
    var operational_address     = $('#operational_address').val();;
    var cmp_typeid              = $('#cmp_typeid').val();
    var cmp_classificationid    = $('#cmp_classificationid').val();
    var cmp_business            = $('#cmp_business').val();

    if(cmp_withbranch == '0') {

      // changeprovince(cmp_province,'domicile',cmp_city);
      // changecity(cmp_city,'domicile',cmp_postalcode);

      $('#cmpb_province_dd').val(cmp_province);
      // $('#cmpb_province_dd').change();

      // $('#cmpb_city_dd').val(cmp_city);
      // $('#cmpb_city_dd').change();

      // $('#cmpb_postalcode_dd').val(cmp_postalcode);
      // $('#cmpb_postalcode_dd').change();

      if(cmp_address != '') {
        $('#cmpb_address').val(cmp_address);
        $('#cmpb_address').addClass('dirty');
      }

      // if(cmp_postalcode != '') {
      //   $('#cmpb_postalcode').val(cmp_postalcode);
      //   $('#cmpb_postalcode').addClass('dirty');
      // }

    } else {

      // changeprovince(cmp_province,'cabang',cmp_city);
      // changecity(cmp_city,'cabang',cmp_postalcode);

      // $('#cmp_province_dd').val(cmp_province);
      // $('#cmp_province_dd').change();

      // $('#cmp_city_dd').val(cmp_city);
      // $('#cmp_city_dd').change();

      // $('#cmp_postalcode_dd').val(cmp_postalcode);
      // $('#cmp_postalcode_dd').change();

      // changeprovince(cmpb_province,'domicile',cmpb_city);
      // changecity(cmpb_city,'domicile',cmpb_postalcode);

      // $('#cmpb_province_dd').val(cmpb_province);
      // $('#cmpb_province_dd').change();

      // $('#cmpb_city_dd').val(cmpb_city);
      // $('#cmpb_city_dd').change();

      // $('#cmpb_postalcode_dd').val(cmpb_postalcode);
      // $('#cmpb_postalcode_dd').change();
    }

    // changeprovince(operational_province,'operational',operational_city);
    // changecity(operational_city,'operational',operational_postalcode);

    // $('#operational_province_dd').val(operational_province);
    // $('#operational_province_dd').change();

    // $('#operational_city_dd').val(operational_city);
    // $('#operational_city_dd').change();

    // $('#operational_postalcode_dd').val(operational_postalcode);
    // $('#operational_postalcode_dd').change();

    if(cmp_withbranch != '') {
      $('#statuslokasi').val(cmp_withbranch);
      $('#statuslokasi').change();
    }

    if(cmp_typeid != '') {
      $('#cmp_typeid_dd').val(cmp_typeid);
      $('#cmp_typeid_dd').change();
    }

    if($('#cmp_classificationid').length > 0 && cmp_classificationid != '') {
      var classification = cmp_classificationid.split('|');
      for(i=0; i<classification.length;i++){
          classification[i] = parseInt(classification[i]);
      }
      $('#cmp_classificationid_dd').val(classification);
      $('#cmp_classificationid_dd').change();
    }

    if($('#cmp_business').length > 0 && cmp_business != '') {
      var business = cmp_business.split(',');
      for(i=0; i<business.length;i++){
          business[i] = (business[i]);
      }
      $('#cmp_business_dd').val(business);
      $('#cmp_business_dd').change();
    }

    // Start Company Permit
    var siup_subbusiness_value  = $('#siup_subbusiness_value').val();
    if($('#siup_subbusiness').length > 0 && siup_subbusiness_value != '') {
      var siup_subbusiness = siup_subbusiness_value.split(', ');
      $('#siup_subbusiness').val(siup_subbusiness);
      $('#siup_subbusiness').change();
    }


    var siup_type_id_val  = $('#siup_type_id_val').val();
    if($('#siup_type_id').length > 0 && siup_type_id_val != '') {
      $('#siup_type_id').val(siup_type_id_val);
      $('#siup_type_id').change();
    }

    var iujk_subbusiness_value  = $('#iujk_subbusiness_value').val();
    if($('#iujk_subbusiness').length > 0 && iujk_subbusiness_value != '') {
      var iujk_subbusiness = iujk_subbusiness_value.split(', ');
      $('#iujk_subbusiness').val(iujk_subbusiness);
      $('#iujk_subbusiness').change();
    }


    var iujk_type_id_val  = $('#iujk_type_id_val').val();
    if($('#iujk_type_id').length > 0 && iujk_type_id_val != '') {
      $('#iujk_type_id').val(iujk_type_id_val);
      $('#iujk_type_id').change();
    }
    // End Company Permit

    /** Add By Dandy Firmansyah 07 Februari 2019 **/

    // 1 = PT
    // 2 = CV
    // 3 = Koperasi
    // 4 = Perorangan

    // alert($('#cmp_typeid').val());
    change_typeid($('#cmp_typeid').val());
    /** End Add By Dandy Firmansyah 07 Februari 2019 **/

    /** Add By Dandy Firmansyah 22 Maret 2019 **/
    var lainnya_operational_postal_code = $('#lainnya_operational_postal_code').prop("checked");
    var lainnya_branch_postal_code      = $('#lainnya_branch_postal_code').prop("checked");
    var lainnya_postal_code             = $('#lainnya_postal_code').prop("checked");
    var sub_business_siup_other_cb      = $('#sub_business_siup_other_cb').prop("checked");
    var sub_business_iujk_other_cb      = $('#sub_business_iujk_other_cb').prop("checked");

    if (lainnya_operational_postal_code == true) {
      $('#span_operational_postal_code').hide();
      $('#span_operational_postal_code_other').show();
    }else{
      $('#span_operational_postal_code').show();
      $('#span_operational_postal_code_other').hide();
    }

    if (lainnya_branch_postal_code == true) {
      $('#span_branch_postal_code').hide();
      $('#span_branch_postal_code_other').show();
    }else{
      $('#span_branch_postal_code').show();
      $('#span_branch_postal_code_other').hide();
    }

    if (lainnya_postal_code == true) {
      $('#span_postal_code').hide();
      $('#span_postal_code_other').show();
    }else{
      $('#span_postal_code').show();
      $('#span_postal_code_other').hide();
    }

    if (sub_business_siup_other_cb == true) {
      $('#span_sub_business_siup').hide();
      $('#span_sub_business_siup_other').show();
    }else{
      $('#span_sub_business_siup').show();
      $('#span_sub_business_siup_other').hide();
    }

    if (sub_business_iujk_other_cb == true) {
      $('#span_sub_business_iujk').hide();
      $('#span_sub_business_iujk_other').show();
    }else{
      $('#span_sub_business_iujk').show();
      $('#span_sub_business_iujk_other').hide();
    }
    /** End Add By Dandy Firmansyah 22 Maret 2019 **/

});

/** Add By Dandy Firmansyah 22 Maret 2019 **/
function operational_postal_code_change(){
  if (document.getElementById('lainnya_operational_postal_code').checked) 
  {
    $('#span_operational_postal_code').hide();
    $('#span_operational_postal_code_other').show();
  } else {
    $('#span_operational_postal_code').show();
    $('#span_operational_postal_code_other').hide();
  }
}

function branch_postal_code_change(){
  if (document.getElementById('lainnya_branch_postal_code').checked) 
  {
    $('#span_branch_postal_code').hide();
    $('#span_branch_postal_code_other').show();
  } else {
    $('#span_branch_postal_code').show();
    $('#span_branch_postal_code_other').hide();
  }
}

function postal_code_change(){
  if (document.getElementById('lainnya_postal_code').checked) 
  {
    $('#postal_code').hide();
    $('#postal_code_other').show();
  } else {
    $('#postal_code').show();
    $('#postal_code_other').hide();
  }
}

function sub_business_siup_change(){
  if (document.getElementById('sub_business_siup_other_cb').checked) 
  {
    $('#span_sub_business_siup').hide();
    $('#span_sub_business_siup_other').show();
  } else {
    $('#span_sub_business_siup').show();
    $('#span_sub_business_siup_other').hide();
  }
}

function sub_business_iujk_change(){
  if (document.getElementById('sub_business_iujk_other_cb').checked) 
  {
    $('#span_sub_business_iujk').hide();
    $('#span_sub_business_iujk_other').show();
  } else {
    $('#span_sub_business_iujk').show();
    $('#span_sub_business_iujk_other').hide();
  }
}

// var operational_postal_code1 = document.getElementById('lainnya_operational_postal_code');
// operational_postal_code1.addEventListener('change', (event) => {
//   if (event.target.checked) {
//     $('#span_operational_postal_code').hide();
//     $('#span_operational_postal_code_other').show();
//   } else {
//     $('#span_operational_postal_code').show();
//     $('#span_operational_postal_code_other').hide();
//   }
// })

// var branch_postal_code1 = document.getElementById('lainnya_branch_postal_code');
// branch_postal_code1.addEventListener('change', (event) => {
//   if (event.target.checked) {
//     $('#span_branch_postal_code').hide();
//     $('#span_branch_postal_code_other').show();
//   } else {
//     $('#span_branch_postal_code').show();
//     $('#span_branch_postal_code_other').hide();
//   }
// })

// var postal_code1 = document.getElementById('lainnya_postal_code');
// postal_code1.addEventListener('change', (event) => {
//   if (event.target.checked) {
//     $('#span_postal_code').hide();
//     $('#span_postal_code_other').show();
//   } else {
//     $('#span_postal_code').show();
//     $('#span_postal_code_other').hide();
//   }
// })

// var sub_business_siup1 = document.getElementById('sub_business_siup_other_cb');
// sub_business_siup1.addEventListener('change', (event) => {
//   if (event.target.checked) {
//     $('#span_sub_business_siup').hide();
//     $('#span_sub_business_siup_other').show();
//   } else {
//     $('#span_sub_business_siup').show();
//     $('#span_sub_business_siup_other').hide();
//   }
// })

// var sub_business_iujk1 = document.getElementById('sub_business_iujk_other_cb');
// sub_business_iujk1.addEventListener('change', (event) => {
//   if (event.target.checked) {
//     $('#span_sub_business_iujk').hide();
//     $('#span_sub_business_iujk_other').show();
//   } else {
//     $('#span_sub_business_iujk').show();
//     $('#span_sub_business_iujk_other').hide();
//   }
// })


/** End Add By Dandy Firmansyah 22 Maret 2019 **/

/** Add By Dandy Firmansyah 07 Februari 2019 **/
function change_typeid(id)
{
  // PT
  if (id == '4') {
    $('#company_domicile_block').hide();
    $('#div_akta').hide();
    $('#div_iut').hide();
    $('#div_struktur').hide();
    $('#div_iut').hide();
    $('#div_sk_kemenkumham').hide();
    $('#div_siup').hide();
    $('#div_skt').hide();
    $('#div_sppkp').hide();
    $('#div_tdp').hide();
    $('#div_neraca_keuangan').hide();
    $('#judul_izin_usaha').hide();

    // bukti pajak 2 tahun terakhir
    $('#taxes_last_satisfactionnumber').removeClass("is_req");
    $("#taxes_last_satisfactionnumber").prop('required',false);

    $('#taxes_last_satisfactionnumber_kedua').removeClass("is_req");
    $("#taxes_last_satisfactionnumber_kedua").prop('required',false);

    // akta pendirian perusahaan
    $('#no_akta_pendirian').removeClass("is_req");
    $("#no_akta_pendirian").prop('required',false);
    $('#nama_notaris_pendirian').removeClass("is_req");
    $("#nama_notaris_pendirian").prop('required',false);
    $('#tanggal_dikeluarkan_akta').removeClass("is_req");
    $("#tanggal_dikeluarkan_akta").prop('required',false);

    // sk kemenkumham
    $('#sk_kemenkumham_document_number').removeClass("is_req");
    $("#sk_kemenkumham_document_number").prop('required',false);
    $('#tanggal_pengesahan_akta').removeClass("is_req");
    $("#tanggal_pengesahan_akta").prop('required',false);

    // siup
    $('#siup_document_number').removeClass('is_req');
    $('#siup_document_number').prop('required',false);
    $('#siup_licensor').removeClass('is_req');
    $('#siup_licensor').prop('required',false);
    $('#siup_release_date').removeClass('is_req');
    $('#siup_release_date').prop('required',false);
    $('#siup_expired_date').removeClass('is_req');
    $('#siup_expired_date').prop('required',false);

    // sppkp
    $('#taxes_sppkpnumber').removeClass('is_req');
    $('#taxes_sppkpnumber').prop('required',false);

    // tdp
    $('#registration_registration_number').removeClass('is_req');
    $('#registration_registration_number').prop('required',false);
    $('#registration_licensor').removeClass('is_req');
    $('#registration_licensor').prop('required',false);
    $('#registration_release_date').removeClass('is_req');
    $('#registration_release_date').prop('required',false);
    $('#registration_expired_date').removeClass('is_req');
    $('#registration_expired_date').prop('required',false);

    // skt
    $('#taxes_sktnumber').removeClass('is_req');
    $('#taxes_sktnumber').prop('required',false);
    
    
  }else { // CV
    $('#company_domicile_block').show();
    $('#div_akta').show();
    $('#div_iut').show();
    $('#div_struktur').show();
    $('#div_iut').show();
    $('#div_sk_kemenkumham').show();
    $('#div_siup').show();
    $('#div_skt').show();
    $('#div_sppkp').show();
    $('#div_tdp').show();
    $('#div_neraca_keuangan').show();
    $('#judul_izin_usaha').show();

    // bukti pajak 2 tahun terakhir
    if (id == '1') {
      $('#taxes_last_satisfactionnumber').addClass("is_req");
      $("#taxes_last_satisfactionnumber").prop('required',true);

      $('#taxes_last_satisfactionnumber_kedua').addClass("is_req");
      $("#taxes_last_satisfactionnumber_kedua").prop('required',true);
    }else{
      $('#taxes_last_satisfactionnumber').removeClass("is_req");
      $("#taxes_last_satisfactionnumber").prop('required',false);

      $('#taxes_last_satisfactionnumber_kedua').removeClass("is_req");
      $("#taxes_last_satisfactionnumber_kedua").prop('required',false);
    }

    // akta pendirian perusahaan
    $('#no_akta_pendirian').addClass("is_req");
    $("#no_akta_pendirian").prop('required',true);
    $('#nama_notaris_pendirian').addClass("is_req");
    $("#nama_notaris_pendirian").prop('required',true);
    $('#tanggal_dikeluarkan_akta').addClass("is_req");
    $("#tanggal_dikeluarkan_akta").prop('required',true);

    // sk kemenkumham
    $('#sk_kemenkumham_document_number').addClass("is_req");
    $("#sk_kemenkumham_document_number").prop('required',true);
    $('#tanggal_pengesahan_akta').addClass("is_req");
    $("#tanggal_pengesahan_akta").prop('required',true);

    // siup
    if (id == '1' || id == '2') {
      $('#siup_document_number').addClass('is_req');
      $('#siup_document_number').prop('required',true);
      $('#siup_licensor').addClass('is_req');
      $('#siup_licensor').prop('required',true);
      $('#siup_release_date').addClass('is_req');
      $('#siup_release_date').prop('required',true);
      $('#siup_expired_date').addClass('is_req');
      $('#siup_expired_date').prop('required',true);
    }else{
      $('#siup_document_number').removeClass('is_req');
      $('#siup_document_number').prop('required',false);
      $('#siup_licensor').removeClass('is_req');
      $('#siup_licensor').prop('required',false);
      $('#siup_release_date').removeClass('is_req');
      $('#siup_release_date').prop('required',false);
      $('#siup_expired_date').removeClass('is_req');
      $('#siup_expired_date').prop('required',false);
    }

    // sppkp
    if (id == '1' || id == '2') {
      $('#taxes_sppkpnumber').addClass('is_req');
      $('#taxes_sppkpnumber').prop('required',true);
    }else{
      $('#taxes_sppkpnumber').removeClass('is_req');
      $('#taxes_sppkpnumber').prop('required',false);
    } 

    // TDP
    if (id == '1' || id == '2') {
      $('#registration_registration_number').addClass('is_req');
      $('#registration_registration_number').prop('required',true);
      $('#registration_licensor').addClass('is_req');
      $('#registration_licensor').prop('required',true);
      $('#registration_release_date').addClass('is_req');
      $('#registration_release_date').prop('required',true);
      $('#registration_expired_date').addClass('is_req');
      $('#registration_expired_date').prop('required',true);
    }else{
      $('#registration_registration_number').removeClass('is_req');
      $('#registration_registration_number').prop('required',false);
      $('#registration_licensor').removeClass('is_req');
      $('#registration_licensor').prop('required',false);
      $('#registration_release_date').removeClass('is_req');
      $('#registration_release_date').prop('required',false);
      $('#registration_expired_date').removeClass('is_req');
      $('#registration_expired_date').prop('required',false);
    } 

    // skt
    if (id == '1' || id == '2') {
      $('#taxes_sktnumber').addClass('is_req');
      $('#taxes_sktnumber').prop('required',true);
    }else{
      $('#taxes_sktnumber').removeClass('is_req');
      $('#taxes_sktnumber').prop('required',false);
    }

  }
}
/** End Add By Dandy Firmansyah 07 Februari 2019 **/
