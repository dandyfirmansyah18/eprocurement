(function(){
    $.ajaxSetup({
        timeout: 60000,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function(jqXHR, Obj){
            console.log(Obj.url);
            if (Obj.url != '/vendor/set_assessment') {
                loading();
            } 
        },
        complete: function(){
            clearLoading();
        },
        error: function (x, e) {
            console.log(x);
            var msg = '';
            if (x.status == 0) {
                msg = 'Request Aborted!';
            } else if (x.status == 404) {
                msg = 'Page Not Found!';
            } else if (x.status == 500) {
                msg = 'Internal Server Error!';
            } else if (e == 'parsererror') {
                msg = 'Error.\nParsing JSON Request failed!';
            } else if (e == 'timeout') {
                msg = 'Request Timeout!';
            } else if (x.status == 401) {
                msg = 'Authentication Timeout!';
                window.location = site_url + '/logout';
            } else if (x.status == 419) {
                msg = 'Token Mismatch, Authentication Timeout!';
                window.location = site_url + '/logout';
            } else {
                msg = 'Error tidak diketahui: \n' + x.responseText;
            }
            swal('', msg, 'error');
        }
    });
})();

function call(url, div, tit, data) {
    loading();
    $.ajax({
        url: url,
        type:'POST',
        timeout: 1200000,
        cache: false,
        data: {

        },
        success: function(data) {
            if(tit!==''){$('.page-content .page-title').html(tit);}
            $('#' + div).fadeToggle("fast","linear",
                function () {
                    $('#' + div).html(data);
                    $('#' + div).fadeIn("slow");
                }
            );
            clearLoading();
        }
    });
    
}

// Animated Messages Icon 
function messages_animate()
{
    // setInterval(function() {
        $('#m_topbar_messages_icon .m-nav__link-icon').addClass('m-animate-shake');
        $('#m_topbar_messages_icon .m-nav__link-badge').addClass('m-animate-blink');
    // }, 3000);

    // setInterval(function() {
    //     $('#m_topbar_messages_icon .m-nav__link-icon').removeClass('m-animate-shake');
    //     $('#m_topbar_messages_icon .m-nav__link-badge').removeClass('m-animate-blink');
    // }, 6000);
}

function messages_unanimate()
{
    $('#m_topbar_messages_icon .m-nav__link-icon').removeClass('m-animate-shake');
    $('#m_topbar_messages_icon .m-nav__link-badge').removeClass('m-animate-blink');
}

function ReplaceAll(Source, stringToFind, stringToReplace) {
    var temp = Source;
    var index = temp.indexOf(stringToFind);
    while (index != -1) {
        temp = temp.replace(stringToFind, stringToReplace);
        index = temp.indexOf(stringToFind);
    }
    return temp;
}

function FormatNPWP(id) {
    var npwp = $('#' + id).val();
    var result = '';
    if (npwp == '') {
        $('#' + id).val('');
        return false;
    }
    result = npwp.substr(0, 2) + "." + npwp.substr(2, 3) + "." + npwp.substr(5, 3) + "." + npwp.substr(8, 1) + "-" + npwp.substr(9, 3) + "." + npwp.substr(12, 3);
    $('#' + id).val(result);
    return false;
}

function FormatNPWP_alt(npwp) {
    var result = '';
    if (npwp == '') {
        return false;
    }
    result = npwp.substr(0, 2) + "." + npwp.substr(2, 3) + "." + npwp.substr(5, 3) + "." + npwp.substr(8, 1) + "-" + npwp.substr(9, 3) + "." + npwp.substr(12, 3);
    return result;
}

function unFormatNPWP(id) {
    var npwp = $('#' + id).val();

    var result = ReplaceAll(ReplaceAll(npwp, '-', ''), '.', '');

    $('#' + id).val(result);
    return false;
}

function loading() {
    // $('.page-loader').show();
    $(".preloader").show();
}

function clearLoading() {
    $('.preloader').delay(1000).fadeOut("slow");
}

function ThousandSeparator(value, digit) {
    var thausandSepCh = ",";
    var decimalSepCh = ".";
    var tempValue = "";
    var realValue = value + "";
    var devValue = "";
    if (digit == "")
        digit = 3;
    realValue = characterControl(realValue);
    var comma = realValue.indexOf(decimalSepCh);
    if (comma != -1) {
        tempValue = realValue.substr(0, comma);
        devValue = realValue.substr(comma);
        devValue = removeCharacter(devValue, thausandSepCh);
        devValue = removeCharacter(devValue, decimalSepCh);
        devValue = decimalSepCh + devValue;
        if (devValue.length > digit) {
            devValue = devValue.substr(0, digit + 1);
        }
    } else {
        tempValue = realValue;
    }
    tempValue = removeCharacter(tempValue, thausandSepCh);
    var result = "";
    var len = tempValue.length;
    while (len > 3) {
        result = thausandSepCh + tempValue.substr(len - 3, 3) + result;
        len -= 3;
    }
    result = tempValue.substr(0, len) + result;
    
    return result + devValue;
}

function characterControl(value) {
    var tempValue = "";
    var len = value.length;
    for (i = 0; i < len; i++) {
        var chr = value.substr(i, 1);
        if ((chr < '0' || chr > '9') && chr != '.' && chr != ',') {
            chr = '';
        }
        tempValue = tempValue + chr;
    }
    return tempValue;
}

function removeCharacter(v, ch) {
    var tempValue = v + "";
    var becontinue = true;
    while (becontinue == true) {
        var point = tempValue.indexOf(ch);
        if (point >= 0) {
            var myLen = tempValue.length;
            tempValue = tempValue.substr(0, point) + tempValue.substr(point + 1, myLen);
            becontinue = true;
        } else {
            becontinue = false;
        }
    }
    return tempValue;
}

function getMonthYear(date) {
  var monthNames = [
    "Januari", "Februari", "Maret",
    "April", "Mei", "Juni", "Juli",
    "Agustus", "September", "Oktober",
    "November", "Desember"
  ];

  var nDate = date.split("-").reverse().join("-");
  var oDate = new Date(nDate+'-01'.replace(/-/g, "/"));
  var monthIndex = oDate.getMonth();
  var year = oDate.getFullYear();

  return monthNames[monthIndex] + ' ' + year;
}