<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Helpers\ApprovalHelper;
use App\Helpers\AssessmentHelper;
use App\Helpers\AuxHelper;
use App\Helpers\ChatHelper;
use App\Helpers\CompanyHelper;
use App\Helpers\DataTableHelper;
use App\Helpers\MailHelper;
use App\Helpers\UserHelper;
use App\Helpers\DateHelper;

use App\Models\Attachment;
use App\Models\Chat;
use App\Models\Company;
use App\Models\CompanyContact;
use App\Models\CompanyDeed;
use App\Models\CompanyEmployee;
use App\Models\CompanyPermit;
use App\Models\CompanyRegistration;
use App\Models\CompanyTax;
use App\Models\Assessment;
use App\Models\Enrollment;
use App\Models\PermitSIUP;
use App\Models\PermitIUJK;
use App\Models\PermitSIUI;
use Excel;

use Datatables;

class VendorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function main_list()
    {
        return view('layouts.penyedia.daftar');
    }

    public function candidate_list()
    {
        return view('layouts.penyedia.daftarcalon');
    }

    public function black_list()
    {
        return view('layouts.penyedia.blacklist');
    }

    public function black_members()
    {
        $items = DataTableHelper::list_vendor_blacklisted();
        return Datatables::of($items)->make(true);
    }

    public function main_members()
    {
        $items = DataTableHelper::list_vendor(true);
        return Datatables::of($items)->make(true);
    }

    public function candidate_members()
    {
        $items = DataTableHelper::list_vendor_temp();
        return Datatables::of($items)->make(true);
    }

    public function add_new()
    {
        return view('layouts.penyedia.tambah');
    }

    public function detail($vendor_id)
    {
        $now                = Carbon::now();
        $default_penalty    = Carbon::now()->addDays(3);

        $company            = Company::find($vendor_id);
        $user               = $company->user;

        $contact            = $company->contact;
        $deed               = $company->deed;
        $assessment         = $company->assessment;
        $tax                = $company->tax;
        $siup               = $company->siup;
        $iujk               = $company->iujk;
        $sk_kemenkumham     = $company->sk_kemenkumham;
        $skdp               = $company->skdp;
        // $siui               = $company->siui;
        $registration       = $company->registration;

        // $jobs               = $company->projects;
        $exps               = $company->experiences;
        $cert               = $company->certificates;
        // $persons            = $company->persons;
        // $holders            = $company->holders;
        // $employees          = $company->employees;
        $chats              = Chat::company_entries($vendor_id);

        if($contact == null) {
            $contact        = new CompanyContact;
        }
        if($deed == null) {
            $deed           = new CompanyDeed;
        }
        if($assessment == null) {
            $assessment     = new Assessment;
        }
        if($tax == null) {
            $tax            = new CompanyTax;
        }
        if($registration == null) {
            $registration   = new CompanyRegistration;
        }

        // if($jobs == null) {
        //     $jobs           = array();
        // }
        if($exps == null) {
            $exps           = array();
        }
        if($cert == null) {
            $cert           = array();
        }
        // if($persons == null) {
        //     $persons        = array();
        // }
        // if($holders == null) {
        //     $holders        = array();
        // }
        // if($employees == null) {
        //     $employees      = array();
        // }

        $contact_photo          = Attachment::company_entity($company->id, 'contact');
        $company_domicile       = Attachment::company_entity($company->id, 'domicile');
        $company_profile        = Attachment::company_entity($company->id, 'profile');
        $company_operational    = Attachment::company_entity($company->id, 'operational');
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
        $company_sk_kemenkumham = Attachment::company_entity($company->id, 'sk_kemenkumham');
        $company_sk_kemenkumham_perubahan = Attachment::company_entity($company->id, 'sk_kemenkumham_perubahan');
        // $company_siui           = Attachment::company_entity($company->id, 'siui');
        $company_registration   = Attachment::company_entity($company->id, 'registration');
        $deed_release           = Attachment::company_entity($company->id, 'deed_release');
        $deed_renewal           = Attachment::company_entity($company->id, 'deed_renewal');
        $company_balance        = Attachment::company_entity($company->id, 'balance');
        $company_structure      = Attachment::company_entity($company->id, 'structure');

        $active_enrollments     = CompanyHelper::active_enrollment_titles($company->id);
        $finished_enrollments   = CompanyHelper::finished_enrollment_titles($company->id);

        $all_enrollments        = Enrollment::where('vendor_id', $company->id)->get();

        $rating                 = $user->rating;

        $disabled = '';
        if($user->state == 0 || $user->state == 5 || $user->state == 6) {
            $disabled       = 'disabled';
        }

        $rejection          = ApprovalHelper::vendor_rejection_notes($company->id);

        if ($deed_renewal != null && $deed->renewal_number) {
            $perlu_deed_renewal = '1';
        }else{
            $perlu_deed_renewal = '0';
        }

        $assessed_all       = AssessmentHelper::checked_all($company->type_id, $perlu_deed_renewal, $assessment);

        return view('layouts.penyedia.detail', [
                        'company'                   => $company,
                        'user'                      => $user,
                        'contact'                   => $contact,
                        'contact_photo'             => $contact_photo,
                        'deed'                      => $deed,
                        'company_domicile'          => $company_domicile,
                        'company_profile'           => $company_profile,
                        'now'                       => $now,
                        'default_penalty'           => $default_penalty,
                        'disabled'                  => $disabled,
                        'assessment'                => $assessment,
                        'tax'                       => $tax,
                        'company_taxpayer'          => $company_taxpayer,
                        'company_taxpayment'        => $company_taxpayment,
                        'company_taxpayment_kedua'  => $company_taxpayment_kedua,
                        'company_sppkp'             => $company_sppkp,
                        'company_skt'               => $company_skt,
                        'company_struktur'          => $company_struktur,
                        'company_spkmp'             => $company_spkmp,
                        // 'company_taxreport'      => $company_taxreport,
                        'siup'                      => $siup,
                        'iujk'                      => $iujk,
                        'sk_kemenkumham'            => $sk_kemenkumham,
                        'skdp'                      => $skdp,
                        // 'siui'                   => $siui,
                        'company_siup'              => $company_siup,
                        'company_iujk'              => $company_iujk,
                        'company_sk_kemenkumham'    => $company_sk_kemenkumham,
                        'company_sk_kemenkumham_perubahan'    => $company_sk_kemenkumham_perubahan,
                        // 'company_siui'           => $company_siui,
                        'registration'              => $registration,
                        'company_registration'      => $company_registration,
                        'deed_release'              => $deed_release,
                        'deed_renewal'              => $deed_renewal,
                        'company_balance'           => $company_balance,
                        // 'jobs'                      => $jobs,
                        'exps'                      => $exps,
                        'cert'                      => $cert,
                        // 'persons'                   => $persons,
                        // 'holders'                   => $holders,
                        // 'employees'                 => $employees,
                        'active_enrollments'        => $active_enrollments,
                        'finished_enrollments'      => $finished_enrollments,
                        'rejection'                 => $rejection,
                        'chats'                     => $chats,
                        'assessed_all'              => $assessed_all,
                        'rating'                    => $rating
        ]);
    }

    public function notes(Request $request)
    {
        $user_id    = intval($request->user_id);
        $notes      = $request->notes;

        $user_id    = UserHelper::set_notes($user_id, $notes);

        return response()->json([
            'status'  => 'OK',
            'id'      => $user_id
        ]);
    }

    public function reset_password(Request $request)
    {
        UserHelper::reset_password($request->id);

        $request->session()->put('tab', 'fourth');

        return redirect('/vendor/detail/' . $request->company_id);
    }

    public function set_assessment(Request $request)
    {
        $company_id     = intval($request->company_id);
        $parts          = $request->part;
        $checked        = intval($request->checked);

        $company        = AssessmentHelper::vendor_save($company_id, $parts, $checked);

        return response()->json([
            'status'  => 'OK',
            'id'      => $company
        ]);
    }

    public function chat(Request $request)
    {
        $chat       = $request->chat;

        $chat_id    = ChatHelper::save_data($chat);

        $request->session()->put('tab', 'fourth');

        return redirect('/vendor/detail/' . $request->chat['entity_id']);
    }

    public function penalty(Request $request)
    {
        $user_id            = $request->user_id;
        $current_user_id    = Auth::user()->id;

        $updated_id         = UserHelper::penaltied($user_id, $request);

        $user_level         = 1;
        if($request->action == 'freeze') {
            $user_level     = 5;
        } else if($request->action == 'blacklist') {
            $user_level     = 6;
        }

        if($user_level > 4) {
            $approval_data  = [
              'entity_type'   => 'vendor',
              'entity_id'     => $request->company_id,
              'user_level'    => $user_level,
              'user_id'       => $current_user_id,
              'notes'         => $request->notes,
              'action'        => $request->action
            ];
            $approval_id    = ApprovalHelper::save_data($approval_data);
        }

        $request->session()->put('tab', 'fourth');

        return redirect('/vendor/detail/' . $request->company_id);
    }

    public function print_data(Request $request)
    {
        $now                = Carbon::now();

        $company            = Company::find($request->id);
        $user               = $company->user;

        $contact            = $company->contact;
        $deed               = $company->deed;
        $tax                = $company->tax;
        $permit             = $company->permit;
        $registration       = $company->registration;

        $jobs               = $company->projects;
        $exps               = $company->experiences;
        $persons            = $company->persons;
        $holders            = $company->holders;
        $employees          = $company->employees;

        if($contact == null) {
            $contact        = new CompanyContact;
        }
        if($deed == null) {
            $deed           = new CompanyDeed;
        }
        if($tax == null) {
            $tax            = new CompanyTax;
        }
        if($permit == null) {
            $permit         = new CompanyPermit;
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
        if($persons == null) {
            $persons        = array();
        }
        if($holders == null) {
            $holders        = array();
        }
        if($employees == null) {
            $employees      = array();
        }

        return view('prints.permohonan', [
                        'company'               => $company,
                        'user'                  => $user,
                        'contact'               => $contact,
                        'deed'                  => $deed,
                        'now'                   => $now,
                        'tax'                   => $tax,
                        'permit'                => $permit,
                        'registration'          => $registration,
                        'jobs'                  => $jobs,
                        'exps'                  => $exps,
                        'persons'               => $persons,
                        'holders'               => $holders,
                        'employees'             => $employees,
        ]);
    }

    public function print_certificate(Request $request)
    {
        $company            = Company::find($request->id);
        $user               = $company->user;
        $ceksk              = false;
        for($i=0; $i<count($company->attachment); $i++){
            if($company->attachment[$i]->purpose == 'domicile'){
                $ceksk = true;
            }
        }
        // print_r(count($company->attachment));die();
        

        if($user->state != 1) {
            return redirect('/vendor/detail/' . $request->id);
        }

        return view('prints.keterangan', [
                      'company'               => $company,
                      'user'                  => $user,
                      'ceksk'                 => $ceksk,
        ]);
    }
    
    public function skrtproccess(Request $request)
    {
        $company            = Company::find($request->idCompany);
        $email              = $company->email;
        // $email = 'nanda.arif@edi-indonesia.co.id';
        $name               = $company->name;
        $user_email_data    = [
            'email'             => $email,
            'name'              => $name,
            'data'              => [
                                      'name'  => $name,
                                    ],
            'type'              => 'user',
            'action'            => 'skrtproccess',
        ];

        $kirim_email = MailHelper::queue($user_email_data);
        return redirect('/vendor/detail/' . $request->idCompany);
        return response()->json([
            'status' => 'OK'            
        ]);
    }

    public function skrtdone(Request $request)
    {
        $company            = Company::find($request->idCompany);
        $email              = $company->email;
        $name               = $company->name;
        $user_email_data    = [
            'email'             => $email,
            'name'              => $name,
            'data'              => [
                                      'name'  => $name,
                                    ],
            'type'              => 'user',
            'action'            => 'skrtdone',
        ];

        $kirim_email = MailHelper::queue($user_email_data);
        return redirect('/vendor/detail/' . $request->idCompany);
        return response()->json([
            'status' => 'OK'
        ]);
    }

    public function exportexcel($status)
    {
        if ($status == 'aktif') {
            $nama_excel = 'Penyedia Terverifikasi/Aktif';
        }else if ($status == 'baru') {
            $nama_excel = 'Penyedia Baru/Tidak Aktif';
        }else{
            $nama_excel = 'Penyedia Blacklist';
        }

        $items = DataTableHelper::list_vendor_excel($status);
        Excel::create($nama_excel, function($excel) use($nama_excel, $status, $items) {
            $excel->sheet('Sheet 1', function($sheet) use($nama_excel, $status, $items) {
            $sheet->loadView('excel/penyedia')
              ->with("nama_excel",$nama_excel)
              ->with("status",$status)
              ->with("items",$items);
            });
        })->export('xls');
    }
}
