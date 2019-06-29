<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Helpers\AuxHelper;
use App\Helpers\MailHelper;
use App\Helpers\UserHelper;
use App\Helpers\DataTableHelper;
use App\Helpers\CompanyHelper;
use App\Helpers\CompanyContactHelper;
use App\Helpers\CompanyTaxHelper;
use App\Helpers\AttachmentHelper;
use App\Helpers\CompanyPermitHelper;
use App\Helpers\CompanyRegistrationHelper;
use App\Helpers\CompanyDeedHelper;
use App\Helpers\CompanyProjectHelper;
use App\Helpers\CompanyExperienceHelper;
use App\Helpers\CompanyPersonnelHelper;
use App\Helpers\CompanyStackholderHelper;
use App\Helpers\CompanyEmployeeHelper;
use App\Helpers\CompanyCertificateHelper;

use App\Models\User;
use App\Models\Attachment;
use App\Models\Company;
use App\Models\CompanyContact;
use App\Models\CompanyTax;
use App\Models\CompanyPermit;
use App\Models\PseudoCounter;
use App\Models\CompanyRegistration;
use App\Models\CompanyDeed;
use App\Models\CompanyEmployee;
use App\Models\MasterProvince;
use App\Models\MasterCity;

use App\Models\PermitSIUP;
use App\Models\PermitIUJK;
use App\Models\PermitSIUI;
use App\Models\PermitSKKemenkumham;
use App\Models\PermitSKDP;
use App\Models\MasterBusinessSIUP;
use App\Models\MasterBusinessIUJK;
use App\Models\UserUnit;
use App\Models\UserRole;


use App\Jobs\UserRegistrationWorker;

use Datatables;

class RegistrationController extends Controller
{
    public function request_pin(Request $request)
    {
        $name = $request->name;
        // $npwp = $request->npwp;
        $email = $request->email;
        $telp = $request->telp;


        $new_pin = AuxHelper::generate_pin();
        // $user_exists = User::where('email', $email)->orWhere('telp', $telp)->first();
        $user_exists = User::where('email', $email)->first();
        if($user_exists != null) {
            if($user_exists->state == 0 || $user_exists->state == 4){
                $action = 'url-register';
            }else if($user_exists->state == 2){
                $action = 'info-verification';
            }else{
                $action = 'user-registered';
            }
        }else{
            $action = 'url-register';
        }
        

        $user_email_data    = [
            'email'             => $email,
            'name'              => $name,
            'data'              => [
                                      'name'        => $name,
                                      'pin'         => $new_pin,
                                      'paramsend'   => base64_encode($email.'~'.$telp.'~'.'paramsend'),
                                    ],
            'type'              => 'user',
            'action'            => $action,
        ];

        if($user_exists != null) {
            // send email again
            if ($action != 'user-registered'){
                $kirim_email = MailHelper::sendEmail($user_email_data);
            }
            return response()->json([
                'action' => $action,
                'status' => 'ERROR',
                'message' => 'Email dan/atau Telp sudah terdaftar'
            ]);
        } else {
            // $user_data = array('name' => $name, 'email' => $email, 'npwp' => $npwp, 'pin' => $new_pin);
            $user_data = array('name' => $name, 'email' => $email, 'telp' => $telp, 'pin' => $new_pin);
            $new_user_id = UserHelper::save_data($user_data);

            // $kirim_email = MailHelper::queue($user_email_data);
            // kirim email buat sendiri -- Dandy Firmansyah 18 Oktober 2018
            $kirim_email = MailHelper::sendEmail($user_email_data);
            return response()->json([
                'action' => $action,
                'status' => 'OK',
                'id' => $new_user_id
            ]);
        }
    }

    public function forgot_password(Request $request)
    {
        $email = $request->email;
        $new_password   = AuxHelper::generate_password();
        $user           = User::where('email', $email)->first();
        if($user->state <> 1){
            return response()->json([
                'status' => 'ERROR',
                // 'message' => 'User Belum Di Verifikasi, Login Pendaftaran Melalui <Menjadi Penyedia>'
                'message' => 'User Belum Di Verifikasi'
            ]);
        }else{

            $updated_id     = UserHelper::forgot_password($email, $new_password);
            if($updated_id == 0) {
                return response()->json([
                    'status' => 'ERROR',
                    'message' => 'User Tidak Ditemukan'
                ]);
            } else if($updated_id == -1){
                return response()->json([
                    'status' => 'ERROR',
                    'message' => 'User Belum Di Verifikasi, Login Pendaftaran Melalui <Menjadi Penyedia>'
                ]);
            } else {
                return response()->json([
                    'status' => 'OK',
                    'id' => $updated_id,
                    'message' => 'Sukses Di Update'
                ]);
            }
        }
    }

    public function form($param='')
    {   
        $user = Auth::user();
        if($user != null && ($user->state == 0 || $user->state == 4)) {
            $company                = new Company;
            $contact                = new CompanyContact;
            $tax                    = new CompanyTax;
            $siup                   = new PermitSIUP;
            $iujk                   = new PermitIUJK;
            $siui                   = new PermitSIUI;
            $sk_kemenkumham         = new PermitSKKemenkumham;
            $skdp                   = new PermitSKDP;
            $registration           = new CompanyRegistration;
            $deed                   = new CompanyDeed;
            $contact_photo          = new Attachment;
            $company_domicile       = new Attachment;
            $company_profile        = new Attachment;
            $company_taxpayer       = new Attachment;
            $company_taxpayment     = new Attachment;
            $company_taxpayment_kedua     = new Attachment;
            // $company_taxreport      = new Attachment;
            $company_sppkp          = new Attachment;
            $company_skt            = new Attachment;
            $company_struktur       = new Attachment;
            $company_spkmp          = new Attachment;
            $company_permit         = new Attachment;
            $company_registration   = new Attachment;
            $company_siup           = new Attachment;
            $company_iujk           = new Attachment;
            $company_siui           = new Attachment;
            $company_sk_kemenkumham = new Attachment;
            $company_sk_kemenkumham_perubahan = new Attachment;
            $deed_release           = new Attachment;
            $deed_renewal           = new Attachment;
            $company_balance        = new Attachment;
            $company_structure      = new Attachment;
            $certificate            = new Attachment;

            $company_jobs       = array();
            $company_exps       = array();
            $company_certs      = array();
            $company_persons    = array();
            $company_holders    = array();
            $company_employees  = array();
            $certificates       = array();

            $bus_siup           = MasterBusinessSIUP::with(['subs'])->whereNull('parent_id')->get();
            $bus_iujk           = MasterBusinessIUJK::with(['subs'])->whereNull('parent_id')->get();

            $company_id = 0;

            $company->name      = $user->name;
            $company->email     = $user->email;
            $company->phone     = $user->telp;

            $tax->taxpayer_number       = "";
            $registration->release_date = "00/00/0000";
            $registration->expired_date = "00/00/0000";
            $deed->released             = "00/00/0000";
            $deed->confirmed            = "00/00/0000";
            $deed->renewaled            = "00/00/0000";
            $deed->renewal_confirmed    = "00/00/0000";

            $siup->release_date         = "00/00/0000";
            $siup->expired_date         = "00/00/0000";
            $iujk->release_date         = "00/00/0000";
            $iujk->expired_date         = "00/00/0000";
            $siui->release_date         = "00/00/0000";
            $siui->expired_date         = "00/00/0000";

            if($user->company != null) {
                $company = $user->company;

                $contact_photo          = Attachment::company_entity($company->id, 'contact');
                $company_domicile       = Attachment::company_entity($company->id, 'domicile');
                $company_profile        = Attachment::company_entity($company->id, 'profile');
                $company_taxpayer       = Attachment::company_entity($company->id, 'taxpayer');
                $company_taxpayment     = Attachment::company_entity($company->id, 'taxpayment');
                $company_taxpayment_kedua     = Attachment::company_entity($company->id, 'taxpayment_kedua');
                // $company_taxreport      = Attachment::company_entity($company->id, 'taxreport');
                $company_sppkp          = Attachment::company_entity($company->id, 'sppkp');
                $company_skt            = Attachment::company_entity($company->id, 'skt');
                $company_struktur       = Attachment::company_entity($company->id, 'struktur');
                $company_spkmp          = Attachment::company_entity($company->id, 'spkmp');
                $company_siup           = Attachment::company_entity($company->id, 'siup');
                $company_iujk           = Attachment::company_entity($company->id, 'iujk');
                $company_siui           = Attachment::company_entity($company->id, 'siui');
                $company_sk_kemenkumham = Attachment::company_entity($company->id, 'sk_kemenkumham');
                $company_sk_kemenkumham_perubahan = Attachment::company_entity($company->id, 'sk_kemenkumham_perubahan');
                $company_registration   = Attachment::company_entity($company->id, 'registration');
                $deed_release           = Attachment::company_entity($company->id, 'deed_release');
                $deed_renewal           = Attachment::company_entity($company->id, 'deed_renewal');
                $company_balance        = Attachment::company_entity($company->id, 'balance');
                $company_structure      = Attachment::company_entity($company->id, 'structure');

                $company_jobs = $company->projects;
                $company_exps = $company->experiences;
                $company_certs = $company->certificates;

                $company_persons = $company->persons;
                $company_holders = $company->holders;
                $company_employees = $company->employees;

                if($company->contact != null) {
                    $contact = $company->contact;
                }

                if($company->tax != null) {
                    $tax = $company->tax;
                }

                // Company Permits
                if($company->siup != null) {
                    $siup = $company->siup;
                }
                if($company->iujk != null) {
                    $iujk = $company->iujk;
                }
                if($company->siui != null) {
                    $siui = $company->siui;
                }

                if($company->sk_kemenkumham != null) {
                    $sk_kemenkumham = $company->sk_kemenkumham;
                }

                if($company->skdp != null) {
                    $skdp = $company->skdp;
                }

                if($company->registration != null) {
                    $registration = $company->registration;
                }

                if($company->deed != null) {
                    $deed = $company->deed;
                }

                if($company->email == null) {
                    $company->email = $user->email;
                }
            }

            $readonly = "";
            if($user->state == 2) {
                $readonly = "disabled";
            }

            $provinces  = MasterProvince::all();
            // branch
            if ($company->with_branch == '0') {
                if ($company->province_id) {
                    $branch_dropdown_city = MasterCity::where('province_code',$company->province_id)->groupby('city')->get();
                }else{
                    $branch_dropdown_city = NULL;
                }

                if ($company->city_id) {
                    $branch_dropdown_postalcode = MasterCity::where('city', $company->city_id)->get();
                }else{
                    $branch_dropdown_postalcode = NULL;
                }

                $branch_province_id = $company->province_id;
                $branch_city_id = $company->city_id;
                $branch_postal_code = $company->postal_code;
                $branch_postal_code_other = $company->postal_code_other;
                // cabang
                $cabang_dropdown_city = NULL;
                $cabang_dropdown_postalcode = NULL; 

                $province_id_fix = NULL;
                $city_id_fix = NULL;
                $postal_code_fix = NULL;
                $postal_code_other_fix = '0';
            }else{
                // branch
                if ($company->branch_province_id) {
                    $branch_dropdown_city = MasterCity::where('province_code',$company->branch_province_id)->groupby('city')->get();
                }else{
                    $branch_dropdown_city = NULL;
                }

                if ($company->branch_city_id) {
                    $branch_dropdown_postalcode = MasterCity::where('city', $company->branch_city_id)->get();
                }else{
                    $branch_dropdown_postalcode = NULL;
                }

                $branch_province_id = $company->branch_province_id;
                $branch_city_id = $company->branch_city_id;
                $branch_postal_code = $company->branch_postal_code;
                $branch_postal_code_other = $company->branch_postal_code_other;

                // cabang
                if ($company->province_id) {
                    $cabang_dropdown_city = MasterCity::where('province_code',$company->province_id)->groupby('city')->get();
                }else{
                    $cabang_dropdown_city = NULL;
                }

                if ($company->branch_city_id) {
                    $cabang_dropdown_postalcode = MasterCity::where('city', $company->city_id)->get();
                }else{
                    $cabang_dropdown_postalcode = NULL;
                }

                $province_id_fix = $company->province_id;
                $city_id_fix = $company->city_id;
                $postal_code_fix = $company->postal_code;
                $postal_code_other_fix = $company->postal_code_other;
            }


            // operational
            if ($company->operational_province_id) {
                $operational_dropdown_city = MasterCity::where('province_code',$company->operational_province_id)->groupby('city')->get();
            }else{
                $operational_dropdown_city = NULL;
            }

            if ($company->operational_city_id) {
                $operational_dropdown_postalcode = MasterCity::where('city', $company->operational_city_id)->get();
            }else{
                $operational_dropdown_postalcode = NULL;
            }

            // Add By Dandy Firmansyah 07 05 2019 - Flag untuk daftar tidak pake sesion
            $not_session = 'not_session';
            // End Add By Dandy Firmansyah 07 05 2019

            return view('layouts.daftar.daftar', [
                            'user'                                 => $user,
                            'company'                              => $company,
                            'contact'                              => $contact,
                            'contact_photo'                        => $contact_photo,
                            'tax'                                  => $tax,
                            'registration'                         => $registration,
                            'deed'                                 => $deed,
                            'company_domicile'                     => $company_domicile,
                            'company_profile'                      => $company_profile,
                            'company_taxpayer'                     => $company_taxpayer,
                            'company_taxpayment'                   => $company_taxpayment,
                            'company_taxpayment_kedua'             => $company_taxpayment_kedua,
                            // 'company_taxreport'                 => $company_taxreport,
                            'company_sppkp'                        => $company_sppkp,
                            'company_skt'                          => $company_skt,
                            'company_struktur'                     => $company_struktur,
                            'company_spkmp'                        => $company_spkmp,
                            'company_registration'                 => $company_registration,
                            'deed_release'                         => $deed_release,
                            'deed_renewal'                         => $deed_renewal,
                            'company_balance'                      => $company_balance,
                            'company_structure'                    => $company_structure,
                            'readonly'                             => $readonly,
                            'company_jobs'                         => $company_jobs,
                            'company_exps'                         => $company_exps,
                            'company_certs'                        => $company_certs,
                            'company_persons'                      => $company_persons,
                            'company_holders'                      => $company_holders,
                            'company_employees'                    => $company_employees,
                            'provinces'                            => $provinces,
                            'certificates'                         => $certificates,
                            'siup'                                 => $siup,
                            'iujk'                                 => $iujk,
                            'siui'                                 => $siui,
                            'sk_kemenkumham'                       => $sk_kemenkumham,
                            'skdp'                                 => $skdp,
                            'company_siup'                         => $company_siup,
                            'company_iujk'                         => $company_iujk,
                            'company_siui'                         => $company_siui,
                            'company_sk_kemenkumham'               => $company_sk_kemenkumham,
                            'company_sk_kemenkumham_perubahan'     => $company_sk_kemenkumham_perubahan,
                            'bus_siup'                             => $bus_siup,
                            'bus_iujk'                             => $bus_iujk,
                            'branch_dropdown_city'                 => $branch_dropdown_city,
                            'branch_dropdown_postalcode'           => $branch_dropdown_postalcode,
                            'cabang_dropdown_city'                 => $cabang_dropdown_city,
                            'cabang_dropdown_postalcode'           => $cabang_dropdown_postalcode,
                            'operational_dropdown_city'            => $operational_dropdown_city,
                            'operational_dropdown_postalcode'      => $operational_dropdown_postalcode,
                            'branch_province_id'                   => $branch_province_id,
                            'branch_city_id'                       => $branch_city_id,
                            'branch_postal_code'                   => $branch_postal_code,
                            'branch_postal_code_other'             => $branch_postal_code_other,
                            'province_id_fix'                      => $province_id_fix,
                            'city_id_fix'                          => $city_id_fix,
                            'postal_code_fix'                      => $postal_code_fix,
                            'postal_code_other_fix'                => $postal_code_other_fix,
                            'not_session'                          => $not_session
                  ]);
        } else if ($user->state == 2) {
            return view('layouts.daftar.menunggu_verifikasi');
        } else {
            Auth::logout();
            return redirect('/');
        }
    }

    public function save_data(Request $request)
    {
        $user_id            = intval($request->company["user_id"]);
        $company_id         = CompanyHelper::save_data($user_id, $request->company);
        $contact_id         = CompanyContactHelper::save_data($company_id, $request->contact);
        $tax_id             = CompanyTaxHelper::save_data($user_id, $company_id, $request->taxes);
        $siup_id            = CompanyPermitHelper::save_siup($company_id, $request->siup);
        $iujk_id            = CompanyPermitHelper::save_iujk($company_id, $request->iujk);
        $sk_kemenkumham_id  = CompanyPermitHelper::save_sk_kemenkumham($company_id, $request->sk_kemenkumham);
        $skdp_id            = CompanyPermitHelper::save_skdp($company_id, $request->skdp);
        $registration_id    = CompanyRegistrationHelper::save_data($company_id, $request->registration);
        $deed_id            = CompanyDeedHelper::save($company_id, $request->deeds);

        return response()->json([
            'status' => 'OK',
            'id' => $company_id
        ]);
    }

    public function register(Request $request)
    {
        $user_id            = intval($request->company["user_id"]);
        $company_id         = CompanyHelper::save_data($user_id, $request->company);
        $contact_id         = CompanyContactHelper::save_data($company_id, $request->contact);
        $tax_id             = CompanyTaxHelper::save_data($user_id, $company_id, $request->taxes);
        $siup_id            = CompanyPermitHelper::save_siup($company_id, $request->siup);
        $iujk_id            = CompanyPermitHelper::save_iujk($company_id, $request->iujk);
        $sk_kemenkumham_id  = CompanyPermitHelper::save_sk_kemenkumham($company_id, $request->sk_kemenkumham);
        $skdp_id            = CompanyPermitHelper::save_skdp($company_id, $request->skdp);
        $registration_id    = CompanyRegistrationHelper::save_data($company_id, $request->registration);
        $deed_id            = CompanyDeedHelper::save($company_id, $request->deeds);

        $registered_user    = UserHelper::set_registered($user_id);
        if ($registered_user) {
            $send_email = MailHelper::send_email_register($registered_user->id);   
        }

        return response()->json([
            'status' => 'OK',
            'id' => $company_id
        ]);
    }

    public function pseudo_certificate_id()
    {
        $new_counter_id = PseudoCounter::generate('certificate');

        return response()->json([
            'status' => 'OK',
            'id' => $new_counter_id
        ]);
    }

    // Start Company Job Transactions
    public function save_job(Request $request)
    {
        $company_id = CompanyHelper::touch($request->user_id);
        $item_id    = CompanyProjectHelper::save_data($company_id, $request->job);

        return response()->json([
            'status' => 'OK',
            'id' => $item_id
        ]);
    }

    public function delete_job(Request $request)
    {
        $result = CompanyProjectHelper::delete_data($request->id);

        return response()->json([
            'status' => 'OK',
            'result' => $result
        ]);
    }
    // End Company Job Transactions

    // Start Company Experience Transactions
    public function save_experience(Request $request)
    {
        $company_id = CompanyHelper::touch($request->user_id);
        $item_id    = CompanyExperienceHelper::save_data($company_id, $request->exp);

        return response()->json([
            'status' => 'OK',
            'id' => $item_id
        ]);
    }

    public function delete_experience(Request $request)
    {
        $result = CompanyExperienceHelper::delete_data($request->id);

        return response()->json([
            'status' => 'OK',
            'result' => $result
        ]);
    }
    // End Company Experience Transactions

    // Start Company Certification Transactions
    public function save_certification(Request $request)
    {
        $company_id = CompanyHelper::touch($request->user_id);
        $item_id    = CompanyCertificateHelper::save($company_id, $request->cert);

        $data['entity_type']    = 'company';
        $data['entity_id']      = $company_id;

        if($request->pseudo_id != null) {
            $data['purpose']    = 'pseudo_certificate_' . $request->pseudo_id;
            $data['new_purpose']    = 'certificate_' . $item_id;
            AttachmentHelper::parse_pseudo_with_purpose($data);
        }

        return response()->json([
            'status'    => 'OK',
            'id'        => $item_id
        ]);
    }

    public function delete_certification(Request $request)
    {
        $result = CompanyCertificateHelper::delete_data($request->id);

        return response()->json([
            'status' => 'OK',
            'result' => $result
        ]);
    }
    // End Company Certification Transactions

    // Start Company Person Transactions
    public function save_person(Request $request)
    {
        $company_id = CompanyHelper::touch($request->user_id);
        $item_id    = CompanyPersonnelHelper::save_data($company_id, $request->person);

        return response()->json([
            'status' => 'OK',
            'id' => $item_id
        ]);
    }

    public function delete_person(Request $request)
    {
        $result = CompanyPersonnelHelper::delete_data($request->id);

        return response()->json([
            'status' => 'OK',
            'result' => $result
        ]);
    }
    // End Company Person Transactions

    // Start Company Stackholder Transactions
    public function save_stakeholder(Request $request)
    {
        $company_id = CompanyHelper::touch($request->user_id);
        $item_id    = CompanyStackholderHelper::save_data($company_id, $request->holder);

        return response()->json([
            'status' => 'OK',
            'id' => $item_id
        ]);
    }

    public function delete_stakeholder(Request $request)
    {
        $result = CompanyStackholderHelper::delete_data($request->id);

        return response()->json([
            'status' => 'OK',
            'result' => $result
        ]);
    }
    // End Company Stackholder Transactions

    // Start Company Employee Transactions
    public function save_manager(Request $request)
    {
        $company_id = CompanyHelper::touch($request->user_id);
        $item_id    = CompanyEmployeeHelper::save_data($company_id, $request->pengurus);

        return response()->json([
            'status' => 'OK',
            'id' => $item_id
        ]);
    }

    public function delete_manager(Request $request)
    {
        $result = CompanyEmployeeHelper::delete_data($request->id);

        return response()->json([
            'status' => 'OK',
            'result' => $result
        ]);
    }

    public function user_register()
    {
        $user = Auth::user();
        
        $userunitlist = UserUnit::all()->toArray();
        $userrolelist = UserRole::all()->toArray();
        $user_unit = '';
        
        return view('layouts.user.form', [
                        'user'              => $user,
                        'user_unit'         => $user_unit,
                        'userunitlist'      => $userunitlist,
                        'userrolelist'     => $userrolelist,
        ]);
    }

    public function form_reset_password()
    {
        $user = Auth::user();
        $userunitlist = UserUnit::all()->toArray();
        $user_unit = '';
        // print_r($user);die();


        return view('daftar.reset_password', [
                        'user'              => $user,
        ]);
    }

    public function save_pegawai(Request $request)
    {
        $name = $request->namalengkap;
        $email = $request->email;
        $nip = $request->nip;
        $password = $request->password;
        $role_user = $request->role_user;
        $unit_id = $request->userunitlist;
        // print_r($password);die();
        $user_exists = User::where('email', $email)->first();
        if($user_exists != null) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Email dan/atau NPWP sudah terdaftar'
            ]);
        } else {

            $user_data = array('name' => $name, 'email' => $email, 'nip' => $nip, 'password' => $password, 'role_user' => $role_user, 'unit_id' =>$unit_id);

            $new_user_id = UserHelper::save_pegawai($user_data);

            return response()->json([
                'status' => 'OK',
                'id' => $new_user_id
            ]);
        }
    }

    public function save_reset_password(Request $request)
    {
        $name = $request->namalengkap;
        $email = $request->email;
        $nip = $request->nip;
        $oldpassword = bcrypt($request->oldpassword);
        $password = $request->password;
        // print_r($password);die();

        $user_exists = User::where('email', $email)->first();
        $oldpassworddb = $user_exists->password;
        // if($oldpassworddb != $oldpassword) {
        //     return response()->json([
        //         'status' => 'ERROR',
        //         'message' => 'Password Lama Tidak Cocok'
        //     ]);
        // } else {

            $user_data = array('name' => $name, 'email' => $email, 'nip' => $nip, 'password' => $password);

            $new_user_id = UserHelper::save_reset_password($user_data);

            return response()->json([
                'status' => 'OK',
                'id' => $new_user_id
            ]);
        // }
    }

    public function user_list(){
        return view('layouts.user.list');
    }
    
    public function vendorstatus_list(){
        return view('daftar.daftar_vendor');
    }


    // public function list_userplanning()
    // {
    //     $items = DataTableHelper::list_user_planning();
    //     return Datatables::of($items)->make(true);
    // }

    public function user_data()
    {
        $items = DataTableHelper::user_data();
        return Datatables::of($items)->make(true);
    }

    public function list_vendorstatus()
    {
        $items = DataTableHelper::list_vendor_status();
        // print_r($items);die();
        return Datatables::of($items)->make(true);
    }
    // End Company Employee Transactions

    /** Add By Dandy Firmansyah 12 Maret 2019 **/
    public function get_city($province_id)
    {
        $data = MasterCity::where('province_code',$province_id)->groupby('city')->get();
        return json_encode($data);
    }

    public function get_postalcode($city_name='')
    {
        $data = MasterCity::where('city', $city_name)->get();
        return json_encode($data);
    }
    /** End Add By Dandy Firmansyah 12 Maret 2019 **/
}

