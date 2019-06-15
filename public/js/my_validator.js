function my_validator(formid)
{
	var err = 0;

    $('#'+formid+' :input').each(function(){
	    
	    var elm = $(this);
	    elm.closest('div').find('.form-control-feedback').remove();
    	elm.closest('div').removeClass('has-danger');
    	
    	if(elm.val().trim() === '')
    	{
    		if(elm.attr('required'))
    		{
		        err++;
	    		elm.closest('div').addClass('has-danger');
	    		if(elm.closest('div').hasClass('m-input-icon'))
	    			elm.after('<div class="form-control-feedback">This field is required.</div>');
    			else
    				elm.after('<div class="form-control-feedback">This field is required.</div>');
	    	}
	    }
	    else
	    {
	    	if(elm.attr('type') == 'email')
			{
				if(!validateEmail(elm.val()))
				{
		        	err++;
					elm.closest('div').addClass('has-danger');
		    		elm.after('<div class="form-control-feedback">Email is not valid.</div>');
				}
			}

			if(elm.attr('type') == 'password')
			{	
				
				if (checkpassword(elm) == true) {
					elm.closest('div').removeClass('has-danger');
				}else{
					err++;
					elm.closest('div').addClass('has-danger');
		    		elm.after('<div class="form-control-feedback">'+checkpassword(elm)+'</div>');
				}
			}

			if(elm.attr('name') == 'c_password')
			{
				var password = elm.closest('form').find('input[name=password]').val();
				var c_password = elm.val();

				if(password != c_password)
				{
		        	err++;
					elm.closest('div').addClass('has-danger');
		    		elm.after('<div class="form-control-feedback">These passwords don\'t match. Try again?.</div>');
				}
			}

			if(elm.attr('name') == 'npwp')
			{
				var npwp = ReplaceAll(ReplaceAll(elm.val(), '-', ''), '.', '');
				if(npwp.length < 15)
				{
		        	err++;
					elm.closest('div').addClass('has-danger');
		    		elm.after('<div class="form-control-feedback">NPWP is not valid.</div>');
				}
			}

			if(elm.attr('name') == 'emiten_code')
			{
				var emiten_code = elm.val();
				if(emiten_code.length != 4)
				{
		        	err++;
					elm.closest('div').addClass('has-danger');
		    		elm.after('<div class="form-control-feedback">Kode Emiten is not valid.</div>');
				}
			}
	    }
	});

    if(err > 0)
    	return response = {fail:true};
    else
    	return response = {fail:false};

}

function _validator(elm)
{
	if(elm.closest('div').hasClass('m-input-icon'))
	{
		elm.closest('div').parent().find('.form-control-feedback').remove();
	    elm.closest('div').parent().removeClass('has-danger');
	}
	else
	{
		elm.closest('div').find('.form-control-feedback').remove();
	    elm.closest('div').removeClass('has-danger');
	}

	if(elm.val().trim() === '')
	{
		if(elm.attr('required'))
		{
    		if(elm.closest('div').hasClass('m-input-icon'))
    		{
	    		elm.closest('div').parent().addClass('has-danger');
	    		elm.closest('div').after('<div class="form-control-feedback">This field is required.</div>');
    		}
    		else
    		{
    			elm.closest('div').addClass('has-danger');
	    		elm.after('<div class="form-control-feedback">This field is required.</div>');
    		}
    	}

    }
    else
    {
    	if(elm.attr('type') == 'email')
		{
			if(!validateEmail(elm.val()))
			{
				elm.closest('div').addClass('has-danger');
	    		elm.after('<div class="form-control-feedback">Email is not valid.</div>');
			}
		}

		if(elm.attr('type') == 'password')
		{	
			if (checkpassword(elm) == true) {
				elm.closest('div').removeClass('has-danger');
			}else{
				elm.closest('div').addClass('has-danger');
	    		elm.after('<div class="form-control-feedback">'+checkpassword(elm)+'</div>');
			}
		}

		if(elm.attr('name') == 'c_password')
		{
			var password = elm.closest('form').find('input[name=password]').val();
			var c_password = elm.val();

			if(password != c_password)
			{
				elm.closest('div').addClass('has-danger');
	    		elm.after('<div class="form-control-feedback">These passwords don\'t match. Try again?.</div>');
			}
		}

		if(elm.attr('name') == 'npwp')
		{
			var npwp = ReplaceAll(ReplaceAll(elm.val(), '-', ''), '.', '');
			if(npwp.length < 15)
			{
				elm.closest('div').addClass('has-danger');
	    		elm.after('<div class="form-control-feedback">NPWP is not valid.</div>');
			}
		}

		if(elm.attr('name') == 'emiten_code')
		{
			var emiten_code = elm.val();
			if(emiten_code.length != 4)
			{
				elm.closest('div').addClass('has-danger');
	    		elm.after('<div class="form-control-feedback">Kode Emiten is not valid.</div>');
			}
		}
    }
}

// function checkpassword(elm)
// {
// 	var str = elm.val();	
// 	if (str.length < 6) {	  
// 	  	elm.closest('div').addClass('has-danger');
// 	    elm.after('<div class="form-control-feedback">Password minimal 6 karakter</div>');
// 	} else if (str.length > 32) {
// 		elm.closest('div').addClass('has-danger');
// 	    elm.after('<div class="form-control-feedback">Password maksimal 32 karakter</div>');	  
// 	} else if (str.search(/\d/) == -1) {
// 		elm.closest('div').addClass('has-danger');
// 	    elm.after('<div class="form-control-feedback">Password harus mengandung angka</div>');	  
// 	} else if (str.search(/[a-z]/) == -1) {
// 		elm.closest('div').addClass('has-danger');
// 	    elm.after('<div class="form-control-feedback">Password harus mengandung huruf kecil</div>');	  
// 	} else if (str.search(/[A-Z]/) == -1) {
// 		elm.closest('div').addClass('has-danger');
// 	    elm.after('<div class="form-control-feedback">Password harus mengandung huruf kapital</div>');	  
// 	}else if (str.search(/[\!\@\#\$\%\^\&\*\(\)\-\=\_\+\.\,\<\>\;\:\/\?]/) == -1) {
// 		elm.closest('div').addClass('has-danger');
// 	    elm.after('<div class="form-control-feedback">Password harus mengandung spesial karakter</div>');	  
// 	}else {		
// 		elm.closest('div').removeClass('has-danger');
// 	}
// }

function checkpassword(elm)
{
	var str = elm.val();	
	if (str.length < 6) {	  	  	
	    return 'Password minimal 6 karakter';
	} else if (str.length > 32) {		
	    return 'Password maksimal 32 karakter';
	} else if (str.search(/\d/) == -1) {		
	    return 'Password harus mengandung angka';
	} else if (str.search(/[a-zA-Z]/) == -1) {		
	    return 'Password harus mengandung huruf';
	// } else if (str.search(/[a-z]/) == -1) {		
	//     return 'Password harus mengandung huruf kecil';
	// } else if (str.search(/[A-Z]/) == -1) {		
	//     return 'Password harus mengandung huruf kapital';
	// }else if (str.search(/[\!\@\#\$\%\^\&\*\(\)\-\=\_\+\.\,\<\>\;\:\/\?]/) == -1) {		
	//     return 'Password harus mengandung spesial karakter';
	}else {		
		return true;
	}
}

function wizard_validator(formid, step)
{
	var err = 0;

    $('#'+formid).find('#m_wizard_form_step_'+step+' :input').each(function(){
	    
	    var elm = $(this);
	    elm.closest('div').find('.form-control-feedback').remove();
    	elm.closest('div').removeClass('has-danger');
    	
    	if(elm.val().trim() === '')
    	{
    		if(elm.attr('required'))
    		{
		        err++;
	    		elm.closest('div').addClass('has-danger');
	    		elm.after('<div class="form-control-feedback">This field is required.</div>');
	    	}
	    }
	    else
	    {
	    	if(elm.attr('type') == 'email')
			{
				if(!validateEmail(elm.val()))
				{
		        	err++;
					elm.closest('div').addClass('has-danger');
		    		elm.after('<div class="form-control-feedback">Email is not valid.</div>');
				}
			}

			if(elm.attr('name') == 'c_password')
			{
				var password = elm.closest('form').find('input[name=password]').val();
				var c_password = elm.val();

				if(password != c_password)
				{
		        	err++;
					elm.closest('div').addClass('has-danger');
		    		elm.after('<div class="form-control-feedback">These passwords don\'t match. Try again?.</div>');
				}
			}

			if(elm.attr('name') == 'npwp')
			{
				var npwp = ReplaceAll(ReplaceAll(elm.val(), '-', ''), '.', '');
				if(npwp.length < 15)
				{
		        	err++;
					elm.closest('div').addClass('has-danger');
		    		elm.after('<div class="form-control-feedback">NPWP is not valid.</div>');
				}
			}

			if(elm.attr('name') == 'emiten_code')
			{
				var emiten_code = elm.val();
				if(emiten_code.length != 4)
				{
		        	err++;
					elm.closest('div').addClass('has-danger');
		    		elm.after('<div class="form-control-feedback">Kode Emiten is not valid.</div>');
				}
			}
	    }
	});

    if(err > 0)
    	return response = {fail:true};
    else
    	return response = {fail:false};
}

function front_validator(formid)
{
	var err = 0;

    $('#'+formid+' :input').each(function(){
	    
	    var elm = $(this);
	    elm.closest('div').find('.help-block').remove();
    	elm.closest('div').removeClass('has-error');
    	
    	if(elm.val().trim() === '')
		{
			if(elm.attr('required'))
			{
				err++;
	    		elm.closest('div').addClass('has-error');
	    		// elm.after('<span id="name-error" class="help-block help-block-error">This field is required.</span>');
	    	}

	    }
	    else
	    {
	    	if(elm.attr('type') == 'email')
			{
				if(!validateEmail(elm.val()))
				{
					err++;
					elm.closest('div').addClass('has-error');
		    		elm.after('<span id="name-error" class="help-block help-block-error">Email is not valid.</span>');
				}
			}

			if(elm.attr('name') == 'c_password')
			{
				var password = elm.closest('form').find('input[name=password]').val();
				var c_password = elm.val();

				if(password != c_password)
				{
					err++;
					elm.closest('div').addClass('has-error');
		    		elm.after('<span id="name-error" class="help-block help-block-error">These passwords don\'t match. Try again?.</span>');
				}
			}

			if(elm.attr('name') == 'npwp')
			{
				var npwp = ReplaceAll(ReplaceAll(elm.val(), '-', ''), '.', '');
				if(npwp.length < 15)
				{
					err++;
					elm.closest('div').addClass('has-error');
		    		elm.after('<span id="name-error" class="help-block help-block-error">NPWP is not valid.</span>');
				}
			}
	    }
	});

    if(err > 0)
    	return response = {fail:true};
    else
    	return response = {fail:false};

}

function __front_validator(elm)
{
	elm.closest('div').find('.help-block').remove();
    elm.closest('div').removeClass('has-error');

	if(elm.val().trim() === '')
	{
		if(elm.attr('required'))
		{
    		elm.closest('div').addClass('has-error');
    		elm.after('<span id="name-error" class="help-block help-block-error">This field is required.</span>');
    	}

    }
    else
    {
    	if(elm.attr('type') == 'email')
		{
			if(!validateEmail(elm.val()))
			{
				elm.closest('div').addClass('has-error');
	    		elm.after('<span id="name-error" class="help-block help-block-error">Email is not valid.</span>');
			}
		}

		if(elm.attr('name') == 'c_password')
		{
			var password = elm.closest('form').find('input[name=password]').val();
			var c_password = elm.val();

			if(password != c_password)
			{
				elm.closest('div').addClass('has-error');
	    		elm.after('<span id="name-error" class="help-block help-block-error">These passwords don\'t match. Try again?.</span>');
			}
		}

		if(elm.attr('name') == 'npwp')
		{
			var npwp = ReplaceAll(ReplaceAll(elm.val(), '-', ''), '.', '');
			if(npwp.length < 15)
			{
				elm.closest('div').addClass('has-error');
	    		elm.after('<span id="name-error" class="help-block help-block-error">NPWP is not valid.</span>');
			}
		}
    }
}

function checkEmailifExist(formid, email)
{
	$.ajax({
		type: 'GET',
		url: "/reference/checkemailifexist",
		data: {email : email},
		success: function(data){
			var elm = $('#'+formid).find('input[name=email]');
			if(data > 0)
			{
				elm.val('');
				elm.closest('div').addClass('has-danger');
		    	elm.after('<div class="form-control-feedback">Email &nbsp;&nbsp;<b>'+email+'</b>&nbsp;&nbsp; is already in use.</div>');
			}
			else
			{
				elm.closest('div').find('.form-control-feedback').remove();
    			elm.closest('div').removeClass('has-danger');
			}
		}
	})
}

function checkEmitenCodeifExist(formid, emiten_code)
{
	$.ajax({
		type: 'GET',
		url: "/reference/checkEmitenCodeifexist",
		data: {emiten_code : emiten_code},
		success: function(data){
			var elm = $('#'+formid).find('input[name=emiten_code]');
			if(data > 0)
			{
				elm.val('');
				elm.closest('div').addClass('has-danger');
		    	elm.after('<div class="form-control-feedback">Emiten Code &nbsp;&nbsp;<b>'+emiten_code+'</b>&nbsp;&nbsp; is already in use.</div>');
			}
			else
			{
				elm.closest('div').find('.form-control-feedback').remove();
    			elm.closest('div').removeClass('has-danger');
			}
		}
	})
}

function checkNpwpifExist(formid, npwp)
{
	$.ajax({
		type: 'GET',
		url: "/reference/checkNpwpifexist",
		data: {npwp : npwp},
		success: function(data){
			var elm = $('#'+formid).find('input[name=npwp]');
			if(data > 0)
			{
				elm.val('');
				elm.closest('div').addClass('has-danger');
		    	elm.after('<div class="form-control-feedback">Npwp &nbsp;&nbsp;<b>'+npwp+'</b>&nbsp;&nbsp; is already in use.</div>');
			}
			else
			{
				elm.closest('div').find('.form-control-feedback').remove();
    			elm.closest('div').removeClass('has-danger');
			}
		}
	})
}

function validateEmail(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}