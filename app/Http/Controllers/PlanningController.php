<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\PreProcurementHelper;
use App\Helpers\AttachmentHelper;
use App\Helpers\ApprovalHelper;
use App\Helpers\ChatHelper;
use App\Helpers\MailHelper;
use App\Helpers\EnrollmentHelper;

use App\Models\PseudoCounter;
use App\Models\PreProcurement;
use App\Models\Attachment;
use App\Models\Enrollment;
use App\Models\Approval;
use App\Models\Company;

use App\Models\UserDivision;
use App\Models\UserDepartment;

use Carbon\Carbon;

class PlanningController extends Controller
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
        $items = PreProcurement::with(['approvals' => function($query){
                                        $query->where('entity_type', 'approval');
                                    }]);

        $items = $items->get()->toJson();

        return $items;
    }

    public function add_new()
    {
        $user = Auth::user();

        $preprocurement = new PreProcurement;

        $memo           = new Attachment;
        $issuance       = new Attachment;
        $rks            = new Attachment;
        $pr            = new Attachment;
        $vendorlist     = Company::where('status', '=', 1)->get()->toArray();
        $vendors        = '';

        $preprocurement_id              = 0;

        $now                            = Carbon::now();
        $preprocurement->start_date     = $now;
        $preprocurement->issuance_date  = $now;
        $preprocurement->memo_date      = $now;
        $preprocurement->pr_date      = $now;
        $preprocurement->back_date      = Carbon::now()->addDays(7);
        $with_back_date                 = '';

        $pseudo_id                      = PseudoCounter::generate('planning');

        return view('layouts.perencanaan.tambah', [
                        'user'              => $user,
                        'unit'              => $user->unit,
                        'data'              => $preprocurement,
                        'vendorlist'        => $vendorlist,
                        'vendors'           => $vendors,
                        'planning_memo'     => null,
                        'planning_issuance' => null,
                        'planning_rks'      => null,
                        'planning_pr'      => null,
                        'with_back_date'    => $with_back_date,
                        'pseudo_id'         => $pseudo_id,
        ]);
    }

    public function update_data($preprocurement_id)
    {
        $user = Auth::user();
        if($user != null)
        {
            $preprocurement = PreProcurement::where('id', $preprocurement_id)->first();

            //Attachment File
            $memo        = Attachment::preprocurement_entity($preprocurement_id, 'memo');
            $issuance    = Attachment::preprocurement_entity($preprocurement_id, 'issuance');
            $rks         = Attachment::preprocurement_entity($preprocurement_id, 'rks');
            $pr         = Attachment::preprocurement_entity($preprocurement_id, 'pr');
            $vendorlist  = Company::all()->toArray();

            //simplify
            $vendors        = '';
            if($preprocurement->enrollments != null) {
              $vendor_ids   = $preprocurement->enrollments->pluck('vendor_id')->toArray();
              $vendors      = join(',', $vendor_ids);
            }

            $with_back_date = '';
            if ($preprocurement->with_back_date) {
              $with_back_date = 'checked';
            }

            if($preprocurement->back_date == null) {
              $preprocurement->back_date      = Carbon::now()->addDays(7);
            }

            $pseudo_id      = 0;

            return view('layouts.perencanaan.tambah', [
                            'user'              => $user,
                            'unit'              => $user->unit,
                            'data'              => $preprocurement,
                            'vendorlist'        => $vendorlist,
                            'vendors'           => $vendors,
                            'planning_memo'     => $memo,
                            'planning_issuance' => $issuance,
                            'planning_rks'      => $rks,
                            'planning_pr'      => $pr,
                            'with_back_date'    => $with_back_date,
                            'pseudo_id'         => $pseudo_id,
            ]);
        }
    }

    public function detail($id)
    {
        $user = Auth::user();
        if($user != null)
        {
            $preprocurement = PreProcurement::with([
                                                    'user',
                                                    'verificator',
                                                    'chat',
                                                    'chat.sender',
                                                    'chat.recipient',
                                                    'attachments' => function($query){
                                                        $query->where('entity_type', 'planning');
                                                    },
                                                    'log'
                                                ])
                                                ->where('id', $id)
                                                ->first()
                                                ->toArray();

            $verification   = Attachment::preprocurement_entity($id, 'verification');

            $vendors        = '-';
            $enrollments    = Enrollment::where('procurement_id', $id)->get();
            if($preprocurement['procurement_method'] >= 3 && $enrollments != null) {
                $names      = $enrollments->pluck('vendor.name')->toArray();
                $vendors    = join(', ', $names);
            }

            $memo       = [];
            $issuance   = [];
            $rks        = [];
            $pr        = [];
            $rksverify  = [];

            $approval   = Approval::preprocurement_entities($preprocurement['id']);

            foreach ($preprocurement['attachments'] as $key => $attachment) {
                switch ($attachment['purpose']) {
                    case 'memo':
                        $memo = $attachment;
                        break;

                    case 'issuance':
                        $issuance = $attachment;
                        break;

                    case 'rks':
                        $rks = $attachment;
                        break;

                    case 'pr':
                        $pr = $attachment;
                        break;

                    case 'verification':
                        $rksverify = $attachment;
                        break;
                }
            }

            $stage  = $this->get_stage($preprocurement['planning_stage']);
            $method = $this->get_method($preprocurement['procurement_method']);

            return view('layouts.perencanaan.detail', [
                            'data'          => $preprocurement,
                            'user'          => $user,
                            'verification'  => $verification,
                            'memo'          => $memo,
                            'issuance'      => $issuance,
                            'rks'           => $rks,
                            'pr'           => $pr,
                            'rksverify'     => $rksverify,
                            'approval'      => $approval,
                            'stage'         => $stage,
                            'method'        => $method,
                            'vendors'       => $vendors
                ]);
        }

        return redirect('/');
    }

    public function draft_list()
    {
        $user = Auth::user();
        // $user = 6;
        if($user != null)
        {
            $items = PreProcurement::with(
                                    [
                                        'approvals' => function($query){
                                            $query->where('entity_type', 'approval');
                                        },
                                        'user.unit'
                                    ])
                                    ->where('proposed', false);

            if($user->role_level == 4) {
                $restriction_id = $user->unit->division_id;
                $user_ids       = \DB::table('users as u')
                                    ->leftJoin('user_units as uu', 'uu.id', '=' , 'u.unit_id')
                                    ->leftJoin('user_divisions as ud', 'ud.id', '=' , 'uu.division_id')
                                    ->select('u.id as id')
                                    ->where('ud.id', $restriction_id)
                                    ->where('u.role_level', 2);
                $items = $items->whereIn('user_id', $user_ids);
            } else if($user->role_level == 5) {
                $restriction_id = $user->unit->division->department_id;
                $user_ids       = \DB::table('users as u')
                                    ->leftJoin('user_units as uu', 'uu.id', '=' , 'u.unit_id')
                                    ->leftJoin('user_divisions as ud', 'ud.id', '=' , 'uu.division_id')
                                    ->leftJoin('user_departments as udp', 'udp.id', '=' , 'ud.department_id')
                                    ->select('u.id as id')
                                    ->where('udp.id', $restriction_id)
                                    ->where('u.role_level', 2);
                $items = $items->whereIn('user_id', $user_ids);
            } else  if($user->role_level == 2) {
                $items = $items->where('user_id', $user->id);
            }

            $items = $items->orderBy('id', 'desc')->get()->toArray();

            return view('layouts.perencanaan.daftarcalon', [
                            'preprocurements'   => $items,
                            'user'              => $user
                ]);
        }

        return redirect('/');
    }

    public function save_data(Request $request)
    {
        $user                   = Auth::user();
        $request->user_id       = $user->id;
        $preprocurement_id      = PreProcurementHelper::save_data($request);

        //Update Status
        $info['id']             = $preprocurement_id;
        $info['stage']          = 0;
        $return_id              = PreProcurementHelper::planning_stage($info);

        if($request->procurement_method >= 3 && !empty($request->vendorlist)){
            $vendor             = EnrollmentHelper::company_save($request, $preprocurement_id);
        }

        $data['entity_type']    = 'planning';
        $data['entity_id']      = $preprocurement_id;

        if($request->pseudo_id != null) {
            AttachmentHelper::parse_pseudo($request->pseudo_id, 'planning', $preprocurement_id);
        }

        // return redirect('/perencanaan/daftar-calon');
        $caption = "Perencanaan";
        return 'MSG#OK#Simpan '.$caption.' berhasil.#perencanaan/daftar-calon';
    }

    public function start_approval(Request $request)
    {
        $preprocurement_id = PreProcurementHelper::start_approval($request);

        //Update Status
        $info['id']         = $preprocurement_id;
        $info['stage']      = 150;
        $return_id          = PreProcurementHelper::planning_stage($info);

        return redirect('/perencanaan/detail/'.$preprocurement_id);
    }

    //Perencana meminta Verifikasi ke Pengada
    public function verifikasi(Request $request)
    {

        $preprocurement_id = PreProcurementHelper::askverify($request);

        //Update Status
        $info['id']         = $preprocurement_id;
        $info['stage']      = 10;
        $return_id          = PreProcurementHelper::planning_stage($info);

        return redirect('/perencanaan/detail/'.$preprocurement_id);
    }

    //Pengada melakukan verifikasi
    public function verify(Request $request)
    {
        $user = Auth::user();
        $request['verification_by']     = $user;
        $request['verification_date']   = Carbon::now();

        $preprocurement_id = PreProcurementHelper::verify($request);

        //Update Status
        $info['id']         = $preprocurement_id;
        $info['stage']      = 100;
        $return_id          = PreProcurementHelper::planning_stage($info);

        $data['temp_id']        = $request->session()->has('temp_id');
        if($data['temp_id']){
            $data['entity_type']    = 'planning';
            $data['purpose']        = 'verification';
            $data['entity_id']      = $preprocurement_id;
            $attachment_memo        = AttachmentHelper::update_id($data);
        }

        return 'OK';
        // return redirect('/perencanaan/detail/'.$preprocurement_id);
    }

    public function approval(Request $request)
    {
        $user = Auth::user();

        //need to update user_level

        $getUserLevel   = Approval::where('entity_type', 'approval')
                                    ->where('entity_id', $request->id)
                                    ->get()
                                    ->toArray();

        $countUserLevel = count($getUserLevel);

        switch ($countUserLevel) {
            case 0:
                # code...
                $user_level = 1;

                //Update Status
                $info['id']         = $request->id;
                $info['stage']      = 200;
                $return_id          = PreProcurementHelper::planning_stage($info);

                break;

            case 1:
                # code...
                $user_level = 2;

                //Update Status
                $info['id']         = $request->id;
                $info['stage']      = 300;
                $return_id          = PreProcurementHelper::planning_stage($info);

                break;

            case 2:
                # code...
                $user_level = 3;

                //Update Status
                $info['id']         = $request->id;
                $info['stage']      = 400;
                $return_id          = PreProcurementHelper::planning_stage($info);

                break;

            default:
                # code...
                $user_level = 1;
                break;
        }

        $data = array(
                    'entity_type'   => 'approval',
                    'entity_id'     => $request->id,
                    'user_id'       => $user->id,
                    'approval_time' => Carbon::now(),
                    'user_level'    => $user_level,
                    'notes'         => $request->notes
                );

        $preprocurement_id = ApprovalHelper::save_data($data);

        return redirect('/perencanaan/detail/'.$request->id.'');
    }

    public function reject(Request $request)
    {
        $user = Auth::user();

        //need to update user_level

        $getUserLevel   = Approval::where('entity_type', 'approval')
                                    ->where('entity_id', $request->id)
                                    ->get()
                                    ->toArray();

        $countUserLevel = count($getUserLevel);

        //Reject on
        switch ($countUserLevel) {
            case 0:
                # manager
                # back to verify 0
                $data = array(
                    'entity_type'   => 'approval',
                    'entity_id'     => $request->id,
                    'user_level'    => 1,
                    'notes'         => $request->notes,
                    'user_id'       => $user->id
                );

                $preprocurement_id  = PreProcurementHelper::revert_start($request->id);
                //Update Status
                $info['id']         = $request->id;
                $info['stage']      = 0;
                $return_id          = PreProcurementHelper::planning_stage($info);

                $preprocurement_id  = ApprovalHelper::reject_data($data);

                break;

            case 1:
                # kepala divisi
                $data = array(
                    'entity_type'   => 'approval',
                    'entity_id'     => $request->id,
                    'user_level'    => 2,
                    'notes'         => $request->notes,
                    'user_id'       => $user->id
                );

                $preprocurement_id  = PreProcurementHelper::revert_start($request->id);
                //Update Status
                $info['id']         = $request->id;
                $info['stage']      = 0;
                $return_id          = PreProcurementHelper::planning_stage($info);

                $preprocurement_id  = ApprovalHelper::reject_data($data);
                break;

            case 2:
                # direksi
                $data = array(
                    'entity_type'   => 'approval',
                    'entity_id'     => $request->id,
                    'user_level'    => 3,
                    'notes'         => $request->notes,
                    'user_id'       => $user->id
                );

                $preprocurement_id = PreProcurementHelper::revert_start($request->id);

                //Update Status
                $info['id']         = $request->id;
                $info['stage']      = 0;
                $return_id          = PreProcurementHelper::planning_stage($info);

                $preprocurement_id = ApprovalHelper::reject_data($data);
                break;
        }

        return redirect('/perencanaan/detail/'.$request->id.'');
    }

    public function upload(Request $request)
    {
        $attachment     = AttachmentHelper::save_data($request);
    }

    public function chats(Request $request)
    {
        $preprocurement             = PreProcurement::with('user')
                                                    ->where('id', $request->id)
                                                    ->first()
                                                    ->toArray();

        $user                       = Auth::user();
        $request['sender_id']       = $user->id;
        $request['recipient_id']    = $preprocurement['user']['id'];
        $request['entity_type']     = 'chat';
        $request['entity_id']       = $request->id;
        $request['message']         = $request->message;

        $chat       = ChatHelper::save_data($request);
        return 'OK';
        // return redirect('/perencanaan/detail/'.$request->id.'');
    }

    public function get_stage($status)
    {
        switch($status){
          case 0:
            $stage = 'Rencana baru';
            break;
          case 10:
            $stage = 'Menunggu verifikasi pengadaan';
            break;
          case 100:
            $stage = 'Terverifikasi pengadaan';
            break;
          case 150:
            $stage = 'Menunggu persetujuan manajer';
            break;
          case 200:
            $stage = 'Disetujui manajer';
            break;
          case -200:
            $stage = 'Ditolak manajer';
            break;
          case 250:
            $stage = 'Menunggu persetujuan kadiv';
            break;
          case 300:
            $stage = 'Disetujui kadiv';
            break;
          case -300:
            $stage = 'Ditolak kadiv';
            break;
          case 350:
            $stage = 'Menunggu persetujuan direksi';
            break;
          case 400:
            $stage = 'Telah terverifikasi dan disetujui';
            break;
          case -400:
            $stage = 'Ditolak direksi';
            break;
        }

        return $stage;
    }

    public function get_method($data)
    {
        switch($data){
            case(1):
              $method = 'Pelelangan/Seleksi Umum';
              break;
            case(2):
              $method = 'Pelelangan Selektif/Seleksi Terbatas';
              break;
            case(3):
              $method = 'Pemilihan Langsung/Seleksi Langsung';
              break;
            case(4):
              $method = 'Penunjukan Langsung';
              break;
            case(5):
              $method = 'Pengadaan Langsung';
              break;
        }

        return $method;
    }
}
