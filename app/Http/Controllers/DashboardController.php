<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\PreProcurement;
use App\Models\Assessment;
use App\Models\Attachment;
use App\Models\Chat;
use App\Models\User;
use App\Models\Company;
use App\Models\CompanyContact;
use App\Models\CompanyTax;
use App\Models\Enrollment;
use App\Models\CompanyPermit;
use App\Models\CompanyRegistration;
use App\Models\CompanyDeed;
use App\Models\CompanyEmployee;
use App\Models\MasterProvince;
use App\Models\MasterCity;
use App\Models\Option;

use App\Models\PermitSIUP;
use App\Models\PermitIUJK;
use App\Models\PermitSIUI;
use App\Models\PermitSKKemenkumham;
use App\Models\PermitSKDP;
use App\Models\MasterBusinessSIUP;
use App\Models\MasterBusinessIUJK;

use App\Helpers\DataTableHelper;
use App\Helpers\ApprovalHelper;
use App\Helpers\CompanyHelper;
use App\Helpers\ChatHelper;
use App\Helpers\MailHelper;
use App\Helpers\CompanyContactHelper;
use App\Helpers\CompanyTaxHelper;
use App\Helpers\CompanyPermitHelper;
use App\Helpers\CompanyRegistrationHelper;
use App\Helpers\CompanyDeedHelper;
use App\Helpers\CompanyProjectHelper;
use App\Helpers\CompanyExperienceHelper;
use App\Helpers\CompanyPersonnelHelper;
use App\Helpers\CompanyStackholderHelper;
use App\Helpers\CompanyEmployeeHelper;
use App\Helpers\CompanyCertificateHelper;

use Yajra\Datatables\Facades\Datatables;
use App\Http\Controllers\RegistrationController;

use App\Jobs\UserRegistrationWorker;

class DashboardController extends Controller
{
    public function __construct(RegistrationController $_user)
    {
        $this->manageuser = $_user;
    }
    
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function manual_registration($id)
    {
        $user = Auth::user();
        if($user->role_level == 0) {
            dispatch(new UserRegistrationWorker($id));

            return response()->json([
                'status' => 'OK',
                'id' => $id
            ]);
        } else {
            return redirect('/');
        }
    }

    public function form_requestpin()
    {
        $registration_on    = Option::vendor_registration();
        return view('layouts.requestpin', [
            'registration_on'    => $registration_on
        ]);
    }

    public function index()
    {
    	$viewData = array(
            '_content_' => $this->view_dashboard()
        );
        return view('templates.index', $viewData);
    }

    public function procurements()
    {
        $items = DataTableHelper::list_all_procurement();
        return Datatables::of($items)->make(true);
    }

    public function my_procurements()
    {
        $user = Auth::user();
        $items = array();
        if($user->company != null) {
            $items = DataTableHelper::list_my_procurement($user->company->id);
        }
        return Datatables::of($items)->make(true);
    }
    
    public function view_dashboard()
    {
        // return view('layouts.dashboard.dashboard');
        $user = Auth::user();
        if($user->state == 1) {
            if($user->role_level == 1) {
                return view('layouts.dashboard.user');
            } else {
                $count_perencanaan      = PreProcurement::where('proposed', false)->count();
                $count_draft_pengadaan  = 12;
                $count_pengadaan        = PreProcurement::where('proposed', true)->where('worked', false)->count();
                $count_selesai          = PreProcurement::where('worked', true)->count();
                $count_vendor_baru      = DataTableHelper::list_vendor_temp()->count();
                $count_vendor_aktif     = DataTableHelper::list_vendor(true)->count();

                return view('layouts.dashboard.dash', [
                    'count_perencanaan'     => $count_perencanaan,
                    'count_pengadaan'       => $count_pengadaan,
                    'count_selesai'         => $count_selesai,
                    'count_draft_pengadaan' => 12,
                    'count_vendor_baru'     => $count_vendor_baru,
                    'count_vendor_aktif'    => $count_vendor_aktif
                ]);
            }
        }else if($user->state == 0){
            $data = $this->manageuser->form();
            return $data;
        }
    }

    public function profile()
    {
        $user = Auth::user();
        if($user->state == 1) {
            $company            = $user->company;

            if($company != null) {
                $contact            = $company->contact;
                $deed               = $company->deed;
                $assessment         = $company->assessment;
                $tax                = $company->tax;
                $siup               = $company->siup;
                $iujk               = $company->iujk;
                $siui               = $company->siui;
                $sk_kemenkumham     = $company->sk_kemenkumham;
                $skdp               = $company->skdp;
                $registration       = $company->registration;

                $jobs               = $company->projects;
                $exps               = $company->experiences;
                $certs              = $company->certificates;
                $persons            = $company->persons;
                $holders            = $company->holders;
                $employees          = $company->employees;
                $chats              = Chat::company_entries($company->id);

                $rejection          = ApprovalHelper::vendor_rejection_notes($company->id);

                if($contact == null) {
                    $contact        = new CompanyContact;
                }
                if($deed == null) {
                    $deed           = new CompanyDeed;
                }
                if($assessment == null) {
                    $assessment     = new Assessment;
                }
                if($registration == null) {
                    $registration   = new CompanyRegistration;
                }

                if($jobs == null) {
                    $jobs           = array();
                }
                if($exps == null) {
                    $exps           = array();
                }
                if($certs == null) {
                    $certs           = array();
                }
                if($persons == null) {
                    $persons        = array();
                }
                if($holders == null) {
                    $holders        = array();
                }
                if($employees == null) {
                    $employees      = array();
                }

                $contact_photo          = Attachment::company_entity($company->id, 'contact');
                $company_domicile       = Attachment::company_entity($company->id, 'domicile');
                $company_profile        = Attachment::company_entity($company->id, 'profile');
                $company_taxpayer       = Attachment::company_entity($company->id, 'domicile');
                $company_taxpayment     = Attachment::company_entity($company->id, 'taxpayment');
                $company_taxpayment_kedua     = Attachment::company_entity($company->id, 'taxpayment_kedua');
                $company_skt            = Attachment::company_entity($company->id, 'skt');
                $company_sppkp          = Attachment::company_entity($company->id, 'sppkp');
                $company_struktur       = Attachment::company_entity($company->id, 'struktur');
                $company_spkmp          = Attachment::company_entity($company->id, 'spkmp');
                $company_taxreport      = Attachment::company_entity($company->id, 'taxreport');
                $company_siup           = Attachment::company_entity($company->id, 'siup');
                $company_iujk           = Attachment::company_entity($company->id, 'iujk');
                $company_siui           = Attachment::company_entity($company->id, 'siui');
                $company_registration   = Attachment::company_entity($company->id, 'registration');
                $deed_release           = Attachment::company_entity($company->id, 'deed_release');
                $deed_renewal           = Attachment::company_entity($company->id, 'deed_renewal');
                $company_balance        = Attachment::company_entity($company->id, 'balance');
                $company_structure      = Attachment::company_entity($company->id, 'structure');
                $company_sk_kemenkumham = Attachment::company_entity($company->id, 'sk_kemenkumham');
                $company_sk_kemenkumham_perubahan = Attachment::company_entity($company->id, 'sk_kemenkumham_perubahan');
                $active_enrollments     = CompanyHelper::active_enrollment_titles($company->id);
                $finished_enrollments   = CompanyHelper::finished_enrollment_titles($company->id);

                $all_enrollments        = Enrollment::where('vendor_id', $company->id)->get();

                $rating                 = $user->rating;

                return view('layouts.dashboard.profile', [
                    'company' => $company,
                    'user' => $user,
                    'contact' => $contact,
                    'contact_photo' => $contact_photo,
                    'deed' => $deed,
                    'company_domicile' => $company_domicile,
                    'company_struktur' => $company_struktur,
                    'company_profile' => $company_profile,
                    'company_sk_kemenkumham' => $company_sk_kemenkumham,
                    'company_sk_kemenkumham_perubahan' => $company_sk_kemenkumham_perubahan,
                    'assessment' => $assessment,
                    'tax' => $tax,
                    'company_taxpayer' => $company_taxpayer,
                    'company_taxpayment' => $company_taxpayment,
                    'company_taxpayment_kedua' => $company_taxpayment_kedua,
                    'company_taxreport' => $company_taxreport,
                    'company_skt' => $company_skt,
                    'company_sppkp' => $company_sppkp,
                    'company_spkmp' => $company_spkmp,
                    'siup' => $siup,
                    'iujk' => $iujk,
                    'siui' => $siui,
                    'company_siup' => $company_siup,
                    'company_iujk' => $company_iujk,
                    'company_siui' => $company_siui,
                    'registration' => $registration,
                    'company_registration' => $company_registration,
                    'deed_release' => $deed_release,
                    'deed_renewal' => $deed_renewal,
                    'sk_kemenkumham' => $sk_kemenkumham,
                    'skdp' => $skdp,
                    'company_balance' => $company_balance,
                    'jobs' => $jobs,
                    'exps' => $exps,
                    'certs' => $certs,
                    'persons' => $persons,
                    'holders' => $holders,
                    'employees' => $employees,
                    'active_enrollments' => $active_enrollments,
                    'finished_enrollments' => $finished_enrollments,
                    'rejection' => $rejection,
                    'chats' => $chats,
                    'rating' => $rating
                ]);
            }
        }

        return redirect('/');
    }

    public function chat(Request $request)
    {
        $chat       = $request->chat;

        $chat_id    = ChatHelper::save_data($chat);

        $request->session()->put('tab', 'fourth');

        return redirect('/my_profile');
    }

    public function update_data()
    {
        $user = Auth::user();

            if($user->company != null) {
                $company                = $user->company;
                $siup                   = new PermitSIUP;
                $iujk                   = new PermitIUJK;
                $siui                   = new PermitSIUI;
                $sk_kemenkumham         = new PermitSKKemenkumham;
                $skdp                   = new PermitSKDP;

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
                
                $bus_siup           = MasterBusinessSIUP::with(['subs'])->whereNull('parent_id')->get();
                $bus_iujk           = MasterBusinessIUJK::with(['subs'])->whereNull('parent_id')->get();

                $company_jobs = $company->projects;
                $company_exps = $company->experiences;
                $company_certs = $company->certifications;

                $certificates = [];

                if($company_certs != null){
                    foreach ($company_certs as $key => $value) {
                        # code...
                        $certificates[] = Attachment::certificate_entity($value->id, 'certificate');
                    }
                }

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
            // dd('asdasasd');

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


            return view('penyedia.ubah', [
                            'user'                  => $user,
                            'company'               => $company,
                            'contact'               => $contact,
                            'contact_photo'         => $contact_photo,
                            'tax'                   => $tax,
                            'siup'                  => $siup,
                            'iujk'                  => $iujk,
                            'siui'                  => $siui,
                            'sk_kemenkumham'        => $sk_kemenkumham,
                            'skdp'                  => $skdp,
                            'company_siup'          => $company_siup,
                            'company_iujk'          => $company_iujk,
                            'company_siui'          => $company_siui,
                            'company_sk_kemenkumham' => $company_sk_kemenkumham,
                            'company_sk_kemenkumham_perubahan' => $company_sk_kemenkumham_perubahan,
                            'registration'          => $registration,
                            'deed'                  => $deed,
                            'company_domicile'      => $company_domicile,
                            'company_profile'       => $company_profile,
                            'company_taxpayer'      => $company_taxpayer,
                            'company_taxpayment'    => $company_taxpayment,
                            'company_taxpayment_kedua'   => $company_taxpayment_kedua,
                            // 'company_taxreport'     => $company_taxreport,
                            'company_sppkp'         => $company_sppkp,
                            'company_skt'           => $company_skt,
                            'company_struktur'      => $company_struktur,
                            'company_spkmp'         => $company_spkmp,
                            'company_registration'  => $company_registration,
                            'deed_release'          => $deed_release,
                            'deed_renewal'          => $deed_renewal,
                            'company_balance'       => $company_balance,
                            'company_structure'     => $company_structure,
                            'readonly'              => $readonly,
                            'company_jobs'          => $company_jobs,
                            'company_exps'          => $company_exps,
                            'company_certs'         => $company_certs,
                            'company_persons'       => $company_persons,
                            'company_holders'       => $company_holders,
                            'company_employees'     => $company_employees,
                            'provinces'             => $provinces,
                            'certificates'          => $certificates,
                            'bus_siup'              => $bus_siup,
                            'bus_iujk'              => $bus_iujk,
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
                            'postal_code_other_fix'                => $postal_code_other_fix
                  ]);
    }

    public function edit_other()
    {

        $user = Auth::user();

            if($user->company != null) {
                $company = $user->company;
                $contact_photo          = Attachment::company_entity($company->id, 'contact');
                $company_domicile       = Attachment::company_entity($company->id, 'domicile');
                $company_taxpayer       = Attachment::company_entity($company->id, 'taxpayer');
                $company_taxpayment     = Attachment::company_entity($company->id, 'taxpayment');
                $company_taxreport      = Attachment::company_entity($company->id, 'taxreport');
                $company_permit         = Attachment::company_entity($company->id, 'permit');
                $company_registration   = Attachment::company_entity($company->id, 'registration');
                $deed_release           = Attachment::company_entity($company->id, 'deed_release');
                $deed_renewal           = Attachment::company_entity($company->id, 'deed_renewal');
                $company_balance        = Attachment::company_entity($company->id, 'balance');
                $company_structure      = Attachment::company_entity($company->id, 'structure');

                $certificates       = array();

                $company_jobs = $company->projects;
                $company_exps = $company->experiences;
                $company_certs = $company->certificates;

                $company_persons = $company->persons;
                $company_holders = $company->holders;
                $company_employees = $company->employees;

                if($company->contact != null) {
                    $contact = $company->contact;
                }else{
                    $contact = '';
                }

                if($company->tax != null) {
                    $tax = $company->tax;
                }else{
                    $tax = '';
                }

                if($company->permit != null) {
                    $permit = $company->permit;
                }else{
                    $permit = '';
                }

                if($company->registration != null) {
                    $registration = $company->registration;
                }else{
                    $registration = '';
                }                

                if($company->deed != null) {
                    $deed = $company->deed;
                }else{
                    $deed = '';
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

            return view('layouts.penyedia.ubah-lainnya', [
                            'user'                  => $user,
                            'company'               => $company,
                            'contact'               => $contact,
                            'contact_photo'         => $contact_photo,
                            'tax'                   => $tax,
                            'permit'                => $permit,
                            'registration'          => $registration,
                            'deed'                  => $deed,
                            'company_domicile'      => $company_domicile,
                            'company_taxpayer'      => $company_taxpayer,
                            'company_taxpayment'    => $company_taxpayment,
                            'company_taxreport'     => $company_taxreport,
                            'company_permit'        => $company_permit,
                            'company_registration'  => $company_registration,
                            'deed_release'          => $deed_release,
                            'deed_renewal'          => $deed_renewal,
                            'company_balance'       => $company_balance,
                            'company_structure'     => $company_structure,
                            'readonly'              => $readonly,
                            'company_jobs'          => $company_jobs,
                            'company_exps'          => $company_exps,
                            'company_certs'         => $company_certs,
                            'company_persons'       => $company_persons,
                            'company_holders'       => $company_holders,
                            'company_employees'     => $company_employees,
                            'provinces'             => $provinces,
                            'certificates'          => $certificates
                  ]);
    }


    public function save_data(Request $request)
    {
        $user_id          = Auth::user()->id;
        $company_id       = CompanyHelper::save_update_data($user_id, $request->company);
        $contact_id       = CompanyContactHelper::save_data($company_id, $request->contact);
        $tax_id           = CompanyTaxHelper::save_data($user_id, $company_id, $request->taxes);
        // $permit_id        = CompanyPermitHelper::save_data($company_id, $request->permits);
        $siup_id          = CompanyPermitHelper::save_siup($company_id, $request->siup);
        $iujk_id          = CompanyPermitHelper::save_iujk($company_id, $request->iujk);
        $siui_id          = CompanyPermitHelper::save_siui($company_id, $request->siui);
        $sk_kemenkumham_id  = CompanyPermitHelper::save_sk_kemenkumham($company_id, $request->sk_kemenkumham);
        $skdp_id            = CompanyPermitHelper::save_skdp($company_id, $request->skdp);
        $registration_id  = CompanyRegistrationHelper::save_data($company_id, $request->registration);
        $deed_id          = CompanyDeedHelper::save($company_id, $request->deeds);

        return response()->json([
            'status'    => 'OK',
            'id'        => $company_id
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

        $data['entity_type']    = 'certificate';
        $data['entity_id']      = $item_id;

        $data['temp_id']            = $request->session()->has('temp_id');
        if($data['temp_id']){
            $data['purpose']        = 'certificate';
            $attachment_certificate = AttachmentHelper::update_id($data);
            $request->session()->forget('temp_id');
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
    // End Company Employee Transactions
}
