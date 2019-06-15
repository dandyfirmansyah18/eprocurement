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

		// User Management
		// Route::post('/daftar/pegawai','RegistrationController@form_pegawai');
		Route::post('/user/list','RegistrationController@user_list');
		Route::get('/user/data', 'RegistrationController@user_data');
		Route::post('/user/register','RegistrationController@user_register');
		Route::post('/daftar/save_pegawai','RegistrationController@save_pegawai')->name('save_pegawai');

		// Perencanaan
		Route::get('/perencanaan/daftar', 'PlanningController@main_list');
		Route::get('/perencanaan/daftar-calon', 'PlanningController@draft_list');
		Route::post('/perencanaan/tambah', 'PlanningController@add_new');
		Route::get('/perencanaan/ubah/{id}', 'PlanningController@update_data');
		Route::post('/perencanaan/simpan', 'PlanningController@save_data')->name('preprocurement_save');
		Route::post('/perencanaan/mulai', 'PlanningController@start_approval')->name('preprocurement_start');
		Route::post('/perencanaan/verify/{id}', 'PlanningController@verify')->name('preprocurement_verify');
		Route::post('/perencanaan/verifikasi', 'PlanningController@verifikasi')->name('preprocurement_askverify');
		Route::post('/perencanaan/approval/{id}','PlanningController@approval')->name('preprocurement_approval');
		Route::post('/perencanaan/reject','PlanningController@reject')->name('preprocurement_reject');
		Route::post('/perencanaan/chats','PlanningController@chats')->name('preprocurement_chat');
		Route::get('/perencanaan/detail/{id}', 'PlanningController@detail');
		Route::get('/perencanaan/upload', 'PlanningController@upload');

		// upload file attactment
		Route::post('/upload/company', 'AttachmentController@company_entity_upload');
		Route::post('/file/delete', 'AttachmentController@remove_by_path');
		Route::post('/upload/pseudo_planning', 'AttachmentController@pseudo_planning_entity_upload');
		Route::post('/upload/planning', 'AttachmentController@planning_entity_upload');
		Route::post('/upload/procurement', 'AttachmentController@procurement_entity_upload');
		Route::post('/upload/certificate', 'AttachmentController@certificate_entity_upload');


	});
});
