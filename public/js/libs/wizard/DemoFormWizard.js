(function(namespace, $) {
	"use strict";

	var DemoFormWizard = function() {
		// Create reference to this instance
		var o = this;
		// Initialize app when document is ready
		$(document).ready(function() {
			o.initialize();
		});

	};
	var p = DemoFormWizard.prototype;

	// =========================================================================
	// INIT
	// =========================================================================

	p.initialize = function() {
		this._initWizard1();
		this._initWizard2();
	};

	// =========================================================================
	// WIZARD 1
	// =========================================================================

	p._initWizard1 = function() {
		var o = this;
		$('#rootwizard1').bootstrapWizard({
			onTabShow: function(tab, navigation, index) {
				o._handleTabShow(tab, navigation, index, $('#rootwizard1'));
			}
		});
	};

	p._handleTabShow = function(tab, navigation, index, wizard){
		var total = navigation.find('li').length;
		var current = index + 0;
		var percent = (current / (total - 1)) * 100;
		var percentWidth = 100 - (100 / total) + '%';
		
		navigation.find('li').removeClass('done');
		navigation.find('li.active').prevAll().addClass('done');
		
		wizard.find('.progress-bar').css({width: percent + '%'});
		$('.form-wizard-horizontal').find('.progress').css({'width': percentWidth});
	};
	
	// =========================================================================
	// WIZARD 1
	// =========================================================================
	p._initWizard2 = function() {
		var o = this;
		$('#rootwizard2').bootstrapWizard({
			onTabShow: function(tab, navigation, index) {
				o._handleTabShow(tab, navigation, index, $('#rootwizard2'));
			},
	  		onNext: function(tab, navigation, index) {
				
				var form = $('#rootwizard2').find('.form-validation');
	  			var valid = form.valid();
	  			if(!valid) {
	  				form.data('validator').focusInvalid();
	  				return false;
	  			}

	  			/** Add By Dandy Firmansyah 06 Maret 2019 **/

	  			if (index == 1) {
	  				var contact_photo_file_new   = $('#contact_photo .dz-preview').length > 0;
			        var contact_photo_file_old   = $('#company_contact_block .image-block').length > 0;
			        var contact_photo_req_01     = contact_photo_file_new ||  contact_photo_file_old;
			        if (contact_photo_req_01) {
			        }else{
			            alert('File KTP Penanggung Jawab Wajib Diisi.');
			            return false;
			        }
	  			}else if (index == 2) {
	  				var type_usaha = $('#cmp_typeid_dd').val();

	  				var company_profile_file_new   = $('#company_profile .dz-preview').length > 0;
			        var company_profile_file_old   = $('#company_profile_block .image-block').length > 0;
			        var valid_company_profile_file = company_profile_file_new || company_profile_file_old;
			        if (valid_company_profile_file) {
			        }else{
			            if (type_usaha == '1' || type_usaha == '2') {
							document.getElementById('company_profile_block').scrollIntoView();
							document.getElementById("text_company_profile").style.color = 'red';
							document.getElementById("text_company_profile").style.fontWeight = 'bold';

							setTimeout(function(){ 
									document.getElementById("text_company_profile").style.color = 'black';
									document.getElementById("text_company_profile").style.fontWeight = 'normal';								
								}, 2000
							);
			                alert('File Company Profile Harus Diisi.')
			                return false;
			            }
			        }

			        var domicile_file_new   = $('#company_domicile .dz-preview').length > 0;
			        var domicile_file_old   = $('#company_domicile_block .image-block').length > 0;
			        var valid_domicile_file = domicile_file_new || domicile_file_old;
			        if (valid_domicile_file) {
			        }else{
			            if (type_usaha == '1' || type_usaha == '2') {
			            	document.getElementById('company_domicile_block').scrollIntoView();
							document.getElementById("text_company_domicile").style.color = 'red';
							document.getElementById("text_company_domicile").style.fontWeight = 'bold';

							setTimeout(function(){ 
									document.getElementById("text_company_domicile").style.color = 'black';
									document.getElementById("text_company_domicile").style.fontWeight = 'normal';								
								}, 2000
							);
			                alert('File Surat Keterangan Domisili Perusahaan [SKDP] Harus Diisi.')
			                return false;
			            }
			        }

			        var company_struktur_file_new   = $('#company_struktur .dz-preview').length > 0;
			        var company_struktur_file_old   = $('#company_struktur_block .image-block').length > 0;
			        var valid_company_struktur_file = company_struktur_file_new || company_struktur_file_old;
			        if (valid_company_struktur_file) {
			        }else{
			        	if (type_usaha == '1') {
			        		document.getElementById('company_struktur_block').scrollIntoView();
							document.getElementById("text_company_struktur").style.color = 'red';
							document.getElementById("text_company_struktur").style.fontWeight = 'bold';

							setTimeout(function(){ 
									document.getElementById("text_company_struktur").style.color = 'black';
									document.getElementById("text_company_struktur").style.fontWeight = 'normal';								
								}, 2000
							);
			        		alert('File Struktur Organisasi Perusahaan Harus Diisi.');
			        		return false;
			        	}
			        }
	  			}else if (index == 3) {
	  				var type_usaha = $('#cmp_typeid_dd').val();

	  				var deed_file_new   = $('#deed_release .dz-preview').length > 0;
			        var deed_file_old   = $('#deed_release_block .image-block').length > 0;
			        var valid_deed_file = deed_file_new || deed_file_old;
			        if (valid_deed_file) {
			        }else{
			            if (type_usaha == '1' || type_usaha == '2' || type_usaha == '3') {
			            	document.getElementById('deed_release_block').scrollIntoView();
							document.getElementById("text_deed_release").style.color = 'red';
							document.getElementById("text_deed_release").style.fontWeight = 'bold';

							setTimeout(function(){ 
									document.getElementById("text_deed_release").style.color = 'black';
									document.getElementById("text_deed_release").style.fontWeight = 'normal';								
								}, 2000
							);
			            	alert('Data Akta Pendirian Perusahaan Harus Diisi');
			            	return false;
			            }
			        }

			        var sk_kemenkumham_file_new   = $('#company_sk_kemenkumham .dz-preview').length > 0;
			        var sk_kemenkumham_file_old   = $('#company_sk_kemenkumham_block .image-block').length > 0;
			        var sk_kemenkumham_req_01     = $('#sk_kemenkumham_document_number').val() != '';
			        var sk_kemenkumham_req_04     = sk_kemenkumham_file_old || sk_kemenkumham_file_new;
			        if(sk_kemenkumham_req_01 && sk_kemenkumham_req_04) {
			        }else{
			            if (type_usaha == '1' || type_usaha == '2' || type_usaha == '3') {
			            	document.getElementById('company_sk_kemenkumham_block').scrollIntoView();
							document.getElementById("text_company_sk_kemenkumham").style.color = 'red';
							document.getElementById("text_company_sk_kemenkumham").style.fontWeight = 'bold';

							setTimeout(function(){ 
									document.getElementById("text_company_sk_kemenkumham").style.color = 'black';
									document.getElementById("text_company_sk_kemenkumham").style.fontWeight = 'normal';								
								}, 2000
							);
			            	alert('Data SK KEMENKUMHAM - Pendirian Perusahaan Harus Diisi');
			            	return false;
			            }
			        }

			        var siup_file_new   = $('#company_siup .dz-preview').length > 0;
			        var siup_file_old   = $('#company_siup_block .image-block').length > 0;
			        var siup_req_01     = $('#siup_document_number').val() != '';
			        var siup_req_02     = $('#siup_licensor').val() != '';
			        var siup_req_03     = $('#siup_release_date').val() != '';
			        var siup_req_04     = siup_file_old || siup_file_new;
			        if(siup_req_01 && siup_req_02 && siup_req_03 && siup_req_04) {
			        }else{
			            if (type_usaha == '1' || type_usaha == '2') {
			            	document.getElementById('company_siup_block').scrollIntoView();
							document.getElementById("text_company_siup").style.color = 'red';
							document.getElementById("text_company_siup").style.fontWeight = 'bold';

							setTimeout(function(){ 
									document.getElementById("text_company_siup").style.color = 'black';
									document.getElementById("text_company_siup").style.fontWeight = 'normal';								
								}, 2000
							);
			            	alert('Data Surat Izin Usaha Perdagangan [SIUP] Harus Diisi');
			            	return false;
			            }
			        }

			        var company_registration_file_new   = $('#company_registration .dz-preview').length > 0;
					var company_registration_file_old   = $('#company_registration_block .image-block').length > 0;
					var company_registration_req_01     = $('#registration_registration_number').val() != '';
					var company_registration_req_02     = $('#registration_licensor').val() != '';
					var company_registration_req_03     = $('#registration_release_date').val() != '';
					var company_registration_req_04     = $('#registration_expired_date').val() != '';
					var company_registration_req_05     = company_registration_file_old || company_registration_file_new;
					if(company_registration_req_01 && company_registration_req_02 && company_registration_req_03 && company_registration_req_04 && company_registration_req_05) {
					}else{
					    if (type_usaha == '1' || type_usaha == '2') {
					    	document.getElementById('company_registration_block').scrollIntoView();
							document.getElementById("text_company_registration").style.color = 'red';
							document.getElementById("text_company_registration").style.fontWeight = 'bold';

							setTimeout(function(){ 
									document.getElementById("text_company_registration").style.color = 'black';
									document.getElementById("text_company_registration").style.fontWeight = 'normal';								
								}, 2000
							);
					    	alert('Data Tanda Daftar Perusahaan [TDP] Harus Diisi');
			            	return false;
					    }
					}

					var company_taxpayer_file_new   = $('#company_taxpayer .dz-preview').length > 0;
			        var company_taxpayer_file_old   = $('#company_taxpayer_block .image-block').length > 0;
			        var company_taxpayer_req_01     = $('#taxes_taxpayer_number').val() != '';
			        var company_taxpayer_req_02     = $('#taxes_release_date').val() != '';
			        var valid_company_taxpayer_file = company_taxpayer_file_new || company_taxpayer_file_old;
			        if (company_taxpayer_req_01 && company_taxpayer_req_02 && valid_company_taxpayer_file) {
			        }else{
			        	document.getElementById('company_taxpayer_block').scrollIntoView();
						document.getElementById("text_company_taxpayer").style.color = 'red';
						document.getElementById("text_company_taxpayer").style.fontWeight = 'bold';

						setTimeout(function(){ 
								document.getElementById("text_company_taxpayer").style.color = 'black';
								document.getElementById("text_company_taxpayer").style.fontWeight = 'normal';								
							}, 2000
						);
			        	alert('Data Nomor Pokok Wajib Pajak [NPWP] Harus Diisi');
			            return false;
			        }

			        // bukti pajak tahun terakhir
			        var company_taxpayment_file_new   = $('#company_taxpayment .dz-preview').length > 0;
			        var company_taxpayment_file_old   = $('#company_taxpayment_block .image-block').length > 0;
			        var company_taxpayment_req_01     = $('#taxes_last_satisfactionnumber').val() != '';
			        var valid_company_taxpayment_file = company_taxpayment_file_new || company_taxpayment_file_old;
			        if (company_taxpayment_req_01 && valid_company_taxpayment_file) {
			        }else{
			            if (type_usaha == '1') {
			            	document.getElementById('company_taxpayment_block').scrollIntoView();
							document.getElementById("text_company_taxpayment").style.color = 'red';
							document.getElementById("text_company_taxpayment").style.fontWeight = 'bold';

							setTimeout(function(){ 
									document.getElementById("text_company_taxpayment").style.color = 'black';
									document.getElementById("text_company_taxpayment").style.fontWeight = 'normal';								
								}, 2000
							);
			            	alert('Data Bukti Pembayaran Pajak tahun terakhir Harus Diisi');
			            	return false;
			            }
			        }

			        // bukti pajak 2 tahun terakhir
			        var company_taxpayment_kedua_file_new   = $('#company_taxpayment_kedua .dz-preview').length > 0;
			        var company_taxpayment_kedua_file_old   = $('#company_taxpayment_kedua_block .image-block').length > 0;
			        var company_taxpayment_kedua_req_01     = $('#taxes_last_satisfactionnumber_kedua').val() != '';
			        var valid_company_taxpayment_kedua_file = company_taxpayment_kedua_file_new || company_taxpayment_kedua_file_old;
			        if (company_taxpayment_kedua_req_01 && valid_company_taxpayment_kedua_file) {
			        }else{
			            if (type_usaha == '1') {
			            	document.getElementById('company_taxpayment_kedua_block').scrollIntoView();
							document.getElementById("text_company_taxpayment_kedua").style.color = 'red';
							document.getElementById("text_company_taxpayment_kedua").style.fontWeight = 'bold';

							setTimeout(function(){ 
									document.getElementById("text_company_taxpayment_kedua").style.color = 'black';
									document.getElementById("text_company_taxpayment_kedua").style.fontWeight = 'normal';								
								}, 2000
							);
			            	alert('Data Bukti Pembayaran Pajak 2 tahun terakhir Harus Diisi');
			            	return false;
			            }
			        }

			        var company_skt_file_new   = $('#company_skt .dz-preview').length > 0;
			        var company_skt_file_old   = $('#company_skt_block .image-block').length > 0;
			        var valid_company_skt_file = company_skt_file_new || company_skt_file_old;
			        if (valid_company_skt_file) {
			        }else{
			            if (type_usaha == '1' || type_usaha == '2') {
			            	document.getElementById('company_skt_block').scrollIntoView();
							document.getElementById("text_company_skt").style.color = 'red';
							document.getElementById("text_company_skt").style.fontWeight = 'bold';

							setTimeout(function(){ 
									document.getElementById("text_company_skt").style.color = 'black';
									document.getElementById("text_company_skt").style.fontWeight = 'normal';								
								}, 2000
							);
			            	alert('Data Surat Keterangan Terdaftar [SKT] Harus Diisi');
			            	return false;
			            }
			        }

			        var company_sppkp_file_new   = $('#company_sppkp .dz-preview').length > 0;
			        var company_sppkp_file_old   = $('#company_sppkp_block .image-block').length > 0;
			        var company_sppkp_req_01     = $('#taxes_sppkpnumber').val() != '';
			        var valid_company_sppkp_file = company_sppkp_file_new || company_sppkp_file_old;
			        if (company_sppkp_req_01 && valid_company_sppkp_file) {
			        }else{
			            if (type_usaha == '1' || type_usaha == '2') {
			            	document.getElementById('company_sppkp_block').scrollIntoView();
							document.getElementById("text_company_sppkp").style.color = 'red';
							document.getElementById("text_company_sppkp").style.fontWeight = 'bold';

							setTimeout(function(){ 
									document.getElementById("text_company_sppkp").style.color = 'black';
									document.getElementById("text_company_sppkp").style.fontWeight = 'normal';								
								}, 2000
							);
			            	alert('Data Surat Pengukuhan Pengusaha Kena Pajak [SPPKP] Harus Diisi');
			            	return false;
			            }
			        }

			        var company_balance_file_new   = $('#company_balance .dz-preview').length > 0;
			        var company_balance_file_old   = $('#company_balance_block .image-block').length > 0;
			        var valid_company_balance_file = company_balance_file_new || company_balance_file_old;
			        if (valid_company_balance_file) {
			        }else{
			            if (type_usaha == '1') {
			            	document.getElementById('company_balance_block').scrollIntoView();
							document.getElementById("text_company_balance").style.color = 'red';
							document.getElementById("text_company_balance").style.fontWeight = 'bold';

							setTimeout(function(){ 
									document.getElementById("text_company_balance").style.color = 'black';
									document.getElementById("text_company_balance").style.fontWeight = 'normal';								
								}, 2000
							);
			            	alert('Data Neraca Keuangan 2 tahun terakhir Harus Diisi');
			            	return false;
			            }
			        }

			        var company_spkmp_file_new   = $('#company_spkmp .dz-preview').length > 0;
			        var company_spkmp_file_old   = $('#company_spkmp_block .image-block').length > 0;
			        var valid_company_spkmp_file = company_spkmp_file_new || company_spkmp_file_old;
			        if (valid_company_spkmp_file) {
			        }else{
			        	document.getElementById('company_spkmp_block').scrollIntoView();
						document.getElementById("text_company_spkmp").style.color = 'red';
						document.getElementById("text_company_spkmp").style.fontWeight = 'bold';

						setTimeout(function(){ 
								document.getElementById("text_company_spkmp").style.color = 'black';
								document.getElementById("text_company_spkmp").style.fontWeight = 'normal';								
							}, 2000
						);
			        	alert('Data Surat Pernyataan Kesanggupan Memenuhi Pengadaan Harus Diisi');
			            return false;
			        }

	  			}

	  			/** End Add By Dandy Firmansyah 06 Maret 2019 **/

	  		}
		});
	};

	p._handleTabShow = function(tab, navigation, index, wizard){
		var total = navigation.find('li').length;
		var current = index + 0;
		var percent = (current / (total - 1)) * 100;
		var percentWidth = 100 - (100 / total) + '%';
		
		navigation.find('li').removeClass('done');
		navigation.find('li.active').prevAll().addClass('done');
		
		wizard.find('.progress-bar').css({width: percent + '%'});
		$('.form-wizard-horizontal').find('.progress').css({'width': percentWidth});
	};
	
	// =========================================================================
	namespace.DemoFormWizard = new DemoFormWizard;
}(this.materialadmin, jQuery)); // pass in (namespace, jQuery):
