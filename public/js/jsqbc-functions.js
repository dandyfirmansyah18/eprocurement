function render_combobox_value(element_id, value_id) {
    var value = $('#' + value_id).val();
    if(value != '') {
      $('#' + element_id).val(value);
      $('#' + element_id).change();
    }
}

function attach_combobox_action_for_tight_label(element_id, value_id) {
    $('#' + element_id).on('change', function(){
        var $el     = $(this);
        var value   = $el.val();
        $('#' + value_id).val(value);

        if(value != '') {
            $el.addClass('dirty');
            $el.parent().find('.tight-label').addClass('dirty');
        } else {
            $el.removeClass('dirty');
            $el.parent().find('.tight-label').removeClass('dirty');
        }
    });
}

function attach_button_action_to_empty_modal(element_id, modal_id) {
    $('#' + element_id).on('click', function(event){
        $('#' + modal_id + ' form .form-control').val('');
        $('#' + modal_id + ' form .form-control').removeClass('dirty');
        $('#' + modal_id).modal();
        event.preventDefault();
    });
}

function render_checkbox_value(checked_id, nonchecked_id, value_id) {
    var value = $('#' + value_id).val();
    if(value != '' && value == 1) {
        $('#' + checked_id).trigger('click');
    } else {
        $('#' + nonchecked_id).trigger('click');
    }
}

function submit_form(element_id) {
    // alert('asdasdad');
    // return false;
    var form = $('form#' + element_id);
		var datasend = new FormData(form[0]);
    $.ajax({
			type: form.attr("method"),
      url: form.attr("action"),
      data: datasend,
			headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      timeout: 1200000,
      processData: false,
      contentType: false,
      success: function(data){
        var isiMsg = '';
        var url_next = '';
        var arrdata = data.split('#');
        if (arrdata[0].trim()==='MSG')
        {
            if (arrdata[1] === 'OK') {
                isiMsg = arrdata[2];
                url_next = arrdata[3]; 
                swal("", isiMsg, "success");
                document.getElementById(formid).reset();
                call(url_next,'_content_','Regulation List')
            } else {
                isiMsg = arrdata[2];
                swal("", isiMsg, "error");
            }
        }
        else 
        {
            swal("", data, "error");
        }
      }
		})
}

function submit_form_with_ajax(element_id, before_callback, success_callback) {
    var form = $('form#' + element_id);
    var formData = new FormData(form[0]);
    $.ajax({
        type: form.attr("method"),
        url: form.attr("action"),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            before_callback();
        },
        success: function(result){
            alert('Berhasil dihapus');
            success_callback();
        },
        error: function(error){
            console.log(error);
            alert("Failed. Something went wrong, please try again later.");
        }
    });
}

function enable_session_tab() {
    var active_tab = $('#active_tab').text().trim();
    if(active_tab != '') {
        $('a[href=#' + active_tab + ']').trigger('click');
    }
}

function render_datepicker_format(value) {
    var splitted    = value.split('-');
    return splitted[2] + '/' + splitted[1] + '/' + splitted[0];
}

function render_upload_box(element_id, url, parameters) {
    Dropzone.autoDiscover = false;
    var dropzoned = $('#' + element_id).dropzone({
      url: url,
      paramName: 'files',
      params: parameters,
      maxFilesize: 2,
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

          $('#' + element_id + ' .dz-image, #' + element_id + ' .dz-details').on('click', function(){
            window.open('/uploads/' + response.filepath,'_blank');
          });

          $('#' + element_id + ' .dz-remove').on('click', function(){
            remove_file(filepath, token_contact_photo);
          });
        } else {
          file.previewElement.classList.add('dz-error');
        }
      },
      error: function(file, response) {
        file.previewElement.classList.add('dz-error');
      }
    });

    return dropzoned;
}

function limit_ktp(element)
{
    var max_chars = 16;
    if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
    }
}

/** Add By Dandy Firmansyah 12 Maret 2019 **/
function changeprovince(value, type, valuedit='')
{
  if (value) {
    if (type == 'domicile') {
      var select2 = document.getElementById('cmpb_city_dd');
      var comboboxid = 'cmpb_city_dd';
    }else if (type == 'operational') {
      var select2 = document.getElementById('operational_city_dd');
      var comboboxid = 'operational_city_dd';
    }else if (type == 'cabang') {
      var select2 = document.getElementById('cmp_city_dd');
      var comboboxid = 'cmp_city_dd';
    }

    var hitungdone = 0;
    $.ajax({
        type: 'GET',
        url: "/get_city/"+value,
        dataType: 'json',
        success: function(data) {
          $("#"+comboboxid+" option").remove();
          var opt2 = document.createElement('option');
          data.forEach( function (value)
          {
            hitungdone++;
            var opt2 = document.createElement('option');
            opt2.value = value.city;
            opt2.innerHTML = value.city;
            select2.appendChild(opt2);
            // var newState = new Option(value.city, value.city, true, true);
            // $("#"+comboboxid).append(newState);

            // if (hitungdone == data.length) {
            //   if (valuedit) {
            //     // $("#"+comboboxid).val(valuedit).trigger("change");
            //     $('#'+comboboxid).val(valuedit);
            //     $('#'+comboboxid).change();
            //   }
            // }
          });
        }
    })
  }
}

function changecity(value, type, valuedit='')
{
  if (value) {
    if (type == 'domicile') {
      var select2 = document.getElementById('cmpb_postalcode_dd');
      var comboboxid = 'cmpb_postalcode_dd';
    }else if (type == 'operational') {
      var select2 = document.getElementById('operational_postalcode_dd');
      var comboboxid = 'operational_postalcode_dd';
    }else if (type == 'cabang') {
      var select2 = document.getElementById('cmp_postalcode_dd');
      var comboboxid = 'cmp_postalcode_dd';
    }

    var hitungdone = 0;

    $.ajax({
        type: 'GET',
        url: "/get_postalcode/"+value,
        dataType: 'json',
        success: function(data) {
          $("#"+comboboxid+" option").remove();
          var opt2 = document.createElement('option');
          data.forEach( function (value)
          {
              hitungdone++; 
              var opt2 = document.createElement('option');
              opt2.value = value.id;
              opt2.innerHTML = value.sub_district+' - '+value.urban+' - '+value.postal_code;
              select2.appendChild(opt2);
              // var newState = new Option(value.id, value.sub_district+' - '+value.urban+' - '+value.postal_code, true, true);
              // $("#"+comboboxid).append(newState);
              // if (hitungdone == data.length) {
              //   if (valuedit) {
              //     // $("#"+comboboxid).val(valuedit).trigger("change");
              //     $('#'+comboboxid).val(valuedit);
              //     $('#'+comboboxid).change();
              //   }
              // }
          });

        }
    })
  } 
}

/** End Add By Dandy Firmansyah 12 Maret 2019 **/
