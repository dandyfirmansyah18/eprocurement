<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['log'])->group(function(){
	Route::get('/', ['as'=>'login', 'uses'=>'Auth\LoginController@login']);
	Route::get('/login','Auth\LoginController@login');
	Route::get('/signup','Auth\LoginController@signup');
	Route::get('/signin','Auth\LoginController@login');
	Route::post('/register/request_pin','Auth\LoginController@request_pin');
	Route::post('/postlogin','Auth\LoginController@postLogin');
	Route::middleware(['auth'])->group(function(){
		Route::get('dashboard', ['as'=>'dashboard', 'uses'=>'DashboardController@index']);
		Route::post('dashboard', 'DashboardController@view_dashboard');
		Route::get('logout', 'Auth\LoginController@logout');

		// Vendor Management
		Route::post('/vendor/daftar', 'VendorController@main_list');
		Route::post('/vendor/daftar-calon', 'VendorController@candidate_list');
		Route::get('/vendor/tambah', 'VendorController@add_new');
		Route::get('/vendor/detail/{vendor_id}', 'VendorController@detail');
		Route::get('/vendor/members', 'VendorController@main_members');
		Route::get('/vendor/candidates', 'VendorController@candidate_members');
		Route::post('/vendor/notes', 'VendorController@notes');
		Route::post('/vendor/set_assessment', 'VendorController@set_assessment');
		Route::get('/vendor/print/{id}', 'VendorController@print_data');
		Route::get('/vendor/certificate/{id}', 'VendorController@print_certificate');
		Route::post('/vendor/chat', 'VendorController@chat');
		Route::post('/vendor/penalty', 'VendorController@penalty');
		Route::post('/vendor/reset_password', 'VendorController@reset_password');
		Route::get('/vendor/blacklists', 'VendorController@black_members');
		Route::post('/vendor/daftarhitam', 'VendorController@black_list');
		Route::post('/vendor/detail/{vendor_id}', 'VendorController@detail');

		// Verifikasi Penyedia
		Route::get('/penyedia/blacklists', 'VendorController@black_members');
		Route::post('/pengguna/ubah_password', 'UserController@update_password');
		Route::post('/penyedia/ubah_lainnya', 'DashboardController@edit_other');
		Route::post('/penyedia/verifikasi_terima', 'VerificationController@vendor_accept');
		Route::post('/penyedia/verifikasi_ulang', 'VerificationController@vendor_redo');
		Route::post('/penyedia/verifikasi_tolak', 'VerificationController@vendor_reject');
		Route::post('/penyedia/skrtprocess', 'VendorController@skrtproccess');
		Route::post('/penyedia/skrtdone', 'VendorController@skrtdone');

		// User Management
		// Route::post('/daftar/pegawai','RegistrationController@form_pegawai');
		Route::post('/user/list','RegistrationController@user_list');
		Route::get('/user/data', 'RegistrationController@user_data');
		Route::post('/user/register','RegistrationController@user_register');
		Route::post('/daftar/save_pegawai','RegistrationController@save_pegawai')->name('save_pegawai');

		// Perencanaan
		Route::get('/perencanaan/daftar', 'PlanningController@main_list');
		Route::post('/perencanaan/daftar-calon', 'PlanningController@draft_list');
		Route::post('/perencanaan/tambah', 'PlanningController@add_new');
		Route::get('/perencanaan/ubah/{id}', 'PlanningController@update_data');
		Route::post('/perencanaan/simpan', 'PlanningController@save_data')->name('preprocurement_save');
		Route::post('/perencanaan/mulai', 'PlanningController@start_approval')->name('preprocurement_start');
		Route::post('/perencanaan/verify/{id}', 'PlanningController@verify')->name('preprocurement_verify');
		Route::post('/perencanaan/verifikasi', 'PlanningController@verifikasi')->name('preprocurement_askverify');
		Route::post('/perencanaan/approval/{id}','PlanningController@approval')->name('preprocurement_approval');
		Route::post('/perencanaan/reject','PlanningController@reject')->name('preprocurement_reject');
		Route::post('/perencanaan/chats','PlanningController@chats')->name('preprocurement_chat');
		Route::post('/perencanaan/detail/{id}', 'PlanningController@detail');
		Route::get('/perencanaan/upload', 'PlanningController@upload');

		// Pengadaan
		Route::post('/pengadaan/daftar', 'ProcurementController@main_list');
		Route::post('/pengadaan/daftar-calon', 'ProcurementController@draft_list');
		/*Route::get('/pengadaan/tambah/{id}', 'ProcurementController@add_new');*/
		Route::post('/pengadaan/tambah', 'ProcurementController@add_new')->name('procurement_save');
		Route::get('/pengadaan/detail/{id}', 'ProcurementController@detail');
		Route::get('/pengadaan/drafts', 'ProcurementController@proposed_list');
		Route::get('/pengadaan/listed', 'ProcurementController@listed_list');
		Route::post('/pengadaan/evaluasi_scoring', 'ProcurementController@eval_scoring');
		Route::post('/pengadaan/ubahrks/{id}', 'ProcurementController@ubahrks');
		Route::post('/pengadaan/ubahrksadmin/{id}', 'ProcurementController@ubahrksadmin');
		Route::post('/pengadaan/evaluasi_nonscoring', 'ProcurementController@eval_nonscoring');
		Route::post('/pengadaan/pemenang', 'ProcurementController@state_winner');
		Route::post('/pengadaan/mulai', 'ProcurementController@start_list');
		Route::post('/pengadaan/selesai', 'ProcurementController@finish');

		// Draft Routes
		Route::get('/pengadaan/draft/{id}', 'DraftController@detail');
		Route::post('/draft/criterion_save', 'DraftController@criterion_save');
		Route::post('/draft/criterion_delete', 'DraftController@criterion_delete');
		Route::post('/draft/measurement_save', 'DraftController@measurement_save');
		Route::post('/draft/qualification_save', 'DraftController@qualification_save');
		Route::post('/draft/schedule_save', 'DraftController@schedule_save');

		Route::post('/pengadaan/atur/jadwal', 'ProcurementStageController@save_schedule');
		Route::post('/pengadaan/atur/pengumuman', 'ProcurementStageController@save_announcement');
		Route::post('/pengadaan/atur/dokumen', 'ProcurementStageController@save_download');
		Route::post('/pengadaan/atur/undangan', 'ProcurementStageController@save_invitation');
		Route::post('/pengadaan/atur/memoranda', 'ProcurementStageController@save_memorandum');
		Route::post('/pengadaan/atur/pembukaan', 'ProcurementStageController@open_tender');
		Route::post('/pengadaan/atur/pra_pembukaan', 'ProcurementStageController@open_pre_tender');
		Route::post('/pengadaan/atur/pra_evaluasi', 'ProcurementStageController@save_pre_evaluation');
		Route::post('/pengadaan/atur/pra_lolos', 'ProcurementStageController@save_pre_winners');
		Route::post('/pengadaan/atur/tender', 'ProcurementStageController@save_tender');
		Route::post('/pengadaan/atur/negosiasi', 'ProcurementStageController@save_negotiation');
		Route::post('/jadwal/pengadaan/aanwizing', 'ProcurementStageController@save_aanwizing');
		Route::post('/jadwal/pengadaan/kandidat', 'ProcurementStageController@save_candidate');
		Route::post('/jadwal/pengadaan/pemenang_pengumuman', 'ProcurementStageController@save_winner_announcement');
		Route::post('/jadwal/pengadaan/pemenang_pengantar', 'ProcurementStageController@save_winner_preambule');
		Route::post('/pengadaan/atur/sanggahan', 'ProcurementStageController@save_refutal');
		Route::post('/jadwal/pengadaan/kontrak', 'ProcurementStageController@save_contract');
        
        // Monitoring Pekerjaan
        Route::post('/monitor/daftar', 'MonitoringController@main_list');
        Route::get('/monitor/detail/{id}', 'MonitoringController@detail');
        Route::get('/monitor/list', 'MonitoringController@worked_list');
        Route::post('/monitor/kontrak', 'MonitoringController@contract_monitoring');
        Route::post('/monitor/jaminan', 'MonitoringController@warranty_monitoring');
        Route::post('/monitor/laporankerja', 'MonitoringController@work_monitoring');
        Route::post('/monitor/laporanbayar', 'MonitoringController@payment_monitoring');
        Route::post('/monitor/rating', 'MonitoringController@rating');
        
		// upload file attactment
		Route::post('/upload/company', 'AttachmentController@company_entity_upload');
		Route::post('/file/delete', 'AttachmentController@remove_by_path');
		Route::post('/upload/pseudo_planning', 'AttachmentController@pseudo_planning_entity_upload');
		Route::post('/upload/planning', 'AttachmentController@planning_entity_upload');
		Route::post('/upload/procurement', 'AttachmentController@procurement_entity_upload');
		Route::post('/upload/certificate', 'AttachmentController@certificate_entity_upload');

		// registrasi	
		Route::post('/daftar', 'RegistrationController@form')->name('registration_form');
		Route::post('/daftar/simpan', 'RegistrationController@save_data')->name('registration_save');
		Route::get('/get_city/{province_id}', 'RegistrationController@get_city');
		Route::get('/get_postalcode/{city_name}', 'RegistrationController@get_postalcode');
		Route::get('/daftar/certificate_id', 'RegistrationController@pseudo_certificate_id');
		Route::post('/daftar/save_experience', 'RegistrationController@save_experience');
		Route::post('/daftar/save_newpassword', 'RegistrationController@save_reset_password');
		Route::post('/daftar/save_certification', 'RegistrationController@save_certification');
		Route::post('/daftar/submit_registrasi', 'RegistrationController@register')->name('registration_submit');
		Route::post('/daftar/menunggu_verifikasi', 'RegistrationController@menunggu_verifikasi'); // new

		// My Profile
		Route::post('/my_profile', 'DashboardController@profile');
		Route::get('/my_profile/ubah', 'DashboardController@update_data');
		Route::post('/my_profile/simpan', 'DashboardController@save_data')->name('registration_save_update');
		Route::post('/my_profile/save_job', 'DashboardController@save_job');
		Route::post('/my_profile/save_experience', 'DashboardController@save_experience');
		Route::post('/my_profile/save_certification', 'DashboardController@save_certification');
		Route::post('/my_profile/save_person', 'DashboardController@save_person');
		Route::post('/my_profile/save_stakeholder', 'DashboardController@save_stakeholder');
		Route::post('/my_profile/save_manager', 'DashboardController@save_manager');
		Route::post('/my_profile/delete_job', 'DashboardController@delete_job');
		Route::post('/my_profile/delete_experience', 'DashboardController@delete_experience');
		Route::post('/my_profile/delete_certification', 'DashboardController@delete_certification');
		Route::post('/my_profile/delete_person', 'DashboardController@delete_person');
		Route::post('/my_profile/delete_stakeholder', 'DashboardController@delete_stakeholder');
		Route::post('/my_profile/delete_manager', 'DashboardController@delete_manager');
		Route::get('/dashboard/procurements', 'DashboardController@procurements');
		Route::get('/dashboard/my_procurements', 'DashboardController@my_procurements');
		Route::post('/dashboard/chat', 'DashboardController@chat');
		Route::get('/dashboard/reqpin','DashboardController@form_requestpin');

		// Dashboard
		Route::get('/public/vendors', 'StaticController@vendors');
		Route::get('/public/procurements', 'StaticController@procurements');
	});
});
