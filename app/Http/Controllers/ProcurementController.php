<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Attachment;
use App\Models\Invitation;
use App\Models\Memorandum;
use App\Models\FileLog;
use App\Models\PreProcurement;
use App\Models\Measurement;
use App\Models\Criterion;
use App\Models\Assurance;
use App\Models\Company;

use App\Models\ProcurementAnnouncement;
use App\Models\ProcurementContract;
use App\Models\StageAanwizing;
use App\Models\StageCandidate;
use App\Models\StageDownload;
use App\Models\StageEvaluation;
use App\Models\StageNegotiation;
use App\Models\StageRefutal;
use App\Models\StageTender;
use App\Models\StageWinner;
use App\Models\Schedule;

use App\Helpers\DataTableHelper;
use App\Helpers\PreProcurementHelper;
use App\Helpers\ScheduleHelper;
use App\Helpers\EvaluationHelper;

use Yajra\Datatables\Facades\Datatables;

class ProcurementController extends Controller
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
        return view('layouts.pengadaan.daftar');
    }

    public function myproc_list()
    {
        return view('layouts.pengadaan.daftarmyproc');
    }

    public function add_new(Request $request)
    {

        $procurement = PreProcurementHelper::procurement($request->id);

        return redirect('/pengadaan/daftar-calon');
    }

    public function detail(Request $request)
    {
        $procurement_array      = PreProcurement::find($request->id);

        $now                    = Carbon::now();
        $item                   = PreProcurement::with([
                                    'attachments' => function($query){
                                        $query->where('entity_type', 'procurement')
                                            ->orWhere('entity_type', 'planning');
                                    },
                                    'assurances' => function($query){
                                        $query->where('type_id', 1);
                                    },
                                    'approvals' => function($query){
                                        $query->where('entity_type', 'approval');
                                    },
                                    'approvals.user',
                                    'user',
                                    'enrollments',
                                    'schedule',
                                    'criterions',
                                    'negotiations',
                                    'measurement',
                                    'announcement',
                                    'downloads',
                                    'pre_downloads',
                                    'aanwizing',
                                    'memorandums',
                                    'candidate',
                                    'winner',
                                    'refutal',
                                    'contract',
                                    'invitations'
                                ])->find($request->id);
        // dd($item);

        $user                   = $item->user;
        $enrollments            = $item->enrollments;
        $schedule               = $item->schedule;
        $criterions             = $item->criterions;
        $raw_negotiations       = $item->negotiations;
        $measurement            = $item->measurement;
        $assurances             = $item->assurances;
        $announcement           = $item->announcement;
        $approvals              = $item->approvals->toArray();
        $downloads              = $item->downloads;
        $pre_downloads          = $item->pre_downloads;
        $aanwizing              = $item->aanwizing;
        $candidate              = $item->candidate;
        $winner                 = $item->winner;
        $refutal                = $item->refutal;
        $contract               = $item->contract;
        // $item['render_stage_icon'] = '<i class="fa fa-circle" style="color:orange"></i>';
        // dd($item);

        $doc_adm                = $item->attachments
                                    ->where('entity_type', 'planning')
                                    ->where('purpose', 'verification')
                                    ->first();
        $doc_tech               = $item->attachments
                                    ->where('entity_type', 'planning')
                                    ->where('purpose', 'rks')
                                    ->first();
        $inv_announcement       = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'invitation')
                                    ->first();
        $inv_aanwizing          = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'aanwizing')
                                    ->first();
        $file_tender            = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'tender')
                                    ->first();
        $file_tender2           = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'tender2')
                                    ->first();
        $file_candidate         = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'candidate')
                                    ->first();
        $file_winner            = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'winner')
                                    ->first();
        $file_refutal           = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'refutal')
                                    ->first();
        $file_contract          = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'contract')
                                    ->first();
        $file_evaluation        = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'evaluation')
                                    ->first();
        $file_submission        = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'submission')
                                    ->first();
        $file_submission2       = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'submission2')
                                    ->first();
        $file_p_announcement    = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'p_announcement')
                                    ->first();
        $file_p_download        = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'pre_information')
                                    ->first();
        $file_p_upload          = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'p_upload')
                                    ->first();
        $file_p_explanation     = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'p_explanation')
                                    ->first();
        $file_p_evaluation      = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'p_evaluation')
                                    ->first();
        $file_p_result          = $item->attachments
                                    ->where('entity_type', 'procurement')
                                    ->where('purpose', 'p_result')
                                    ->first();

        $ba_tender              = $item->memorandums
                                    ->where('purpose', 'tender')
                                    ->first();
        $ba_tender2             = $item->memorandums
                                    ->where('purpose', 'tender2')
                                    ->first();
        $mmr_negotiations       = $item->memorandums
                                    ->where('purpose', 'like', 'nego_%')
                                    ->first();
        $ba_p_explanation       = $item->memorandums
                                    ->where('purpose', 'p_explanation')
                                    ->first();
        $ba_p_evaluation        = $item->memorandums
                                    ->where('purpose', 'p_evaluation')
                                    ->first();
        $ba_p_result            = $item->memorandums
                                    ->where('purpose', 'p_result')
                                    ->first();

        $inv_submission         = $item->invitations
                                    ->where('purpose', 'submission')
                                    ->first();
        $inv_submission2        = $item->invitations
                                    ->where('purpose', 'submission2')
                                    ->first();
        $inv_evaluation         = $item->invitations
                                    ->where('purpose', 'evaluation')
                                    ->first();
        $inv_p_announcement     = $item->invitations
                                    ->where('purpose', 'p_announcement')
                                    ->first();
        $inv_p_upload           = $item->invitations
                                    ->where('purpose', 'p_upload')
                                    ->first();

        $current_winner         = 0;
        $candidate_highest      = 0;
        $candidate_next         = 0;
        $negotiating_id         = 0;
        $negotiating_name       = '';
        $candidate_arr          = array();
        $pre_downloadeds        = array();
        $pre_undownloadeds      = array();
        $downloadeds            = array();
        $undownloadeds          = array();
        $pre_offereds           = array();
        $pre_unoffereds         = array();
        $offereds               = array();
        $unoffereds             = array();
        $offered_mores          = array();
        $unoffered_mores        = array();
        $negotiations           = array();

        $log_invitations        = array();
        $log_aanwizings         = array();
        $log_tenders            = array();
        $log_tender_mores       = array();
        $log_candidates         = array();
        $log_winners            = array();
        $log_contracts          = array();

        $download_ids           = $downloads->where('technical', true)
                                            ->where('administration', true)
                                            ->pluck('enrollment_id')
                                            ->toArray();
        $pre_download_ids       = $pre_downloads->where('download', true)
                                                ->pluck('enrollment_id')
                                                ->toArray();

        if($announcement == null) {
            $announcement   = new ProcurementAnnouncement;
        }
        if($inv_announcement != null) {
            $log_invitations    = FileLog::where('attachment_id', $inv_announcement->id)->get();
        }

        if($schedule == null) {
            $schedule       = ScheduleHelper::instantiate($item->start_date, $item->back_date, $item->procurement_qualification == 1);
        }

        foreach ($enrollments as $enroll) {
            if(in_array($enroll->id, $download_ids)) {
                array_push($downloadeds, $enroll);
            } else {
                array_push($undownloadeds, $enroll);
            }

            if(in_array($enroll->id, $pre_download_ids)) {
                array_push($pre_downloadeds, $enroll);
            } else {
                array_push($pre_undownloadeds, $enroll);
            }

            if($enroll->winner) {
                $current_winner = $enroll->vendor_id;
            }

            if($enroll->pre_offering() != null) {
                array_push($pre_offereds, $enroll);
            } else {
                array_push($pre_unoffereds, $enroll);
            }

            if($enroll->offering() != null) {
                array_push($offereds, $enroll);
            } else {
                array_push($unoffereds, $enroll);
            }

            if($enroll->offering2() != null) {
                array_push($offered_mores, $enroll);
            } else {
                array_push($unoffered_mores, $enroll);
            }

            $raw_negotiation    =   $raw_negotiations->where('enrollment_id', $enroll->id)->first();
            if($raw_negotiation != null) {
                if($raw_negotiation->ongoing) {
                    $negotiating_id     = $enroll->id;
                    $negotiating_name   = $enroll->vendor->name;
                } else {
                    $negotiation_data   = array(
                        'id'      =>  $enroll->vendor_id,
                        'name'      =>  $enroll->vendor->name
                    );
                    array_push($negotiations, $negotiation_data);
                }
            }

            $enroll_evaluation  = $enroll->evaluation;
            $enroll_tender      = $enroll->tender;
            if($enroll_evaluation != null && $enroll_tender != null) {
                $passed_evaluation  = $enroll_evaluation->pass_adm && $enroll_evaluation->pass_doc;
                if($procurement->delivery_method == 3) {
                    $passed_evaluation = $passed_evaluation && $enroll_evaluation->pass_second;
                }
                $candidate_data = array(
                    'id'        => $enroll->id,
                    'score'     => $enroll_evaluation->score,
                    'passed'    => $passed_evaluation,
                    'amount'    => $enroll_tender->amount
                );
                array_push($candidate_arr, $candidate_data);
            }
        }

        $temp_hscore    = 0;
        $temp_hmoney    = 0;
        $temp_nscore    = 0;
        foreach($candidate_arr as $candidate_data) {
            if($measurement->scoring) {
                if($temp_hscore == $candidate_data['score']) {
                    if($temp_hmoney > $candidate_data['amount']) {
                        $candidate_highest  = $candidate_data['id'];
                    } else {
                        $candidate_next     = $candidate_data['id'];
                    }
                } else if($temp_hscore < $candidate_data['score']) {
                    $temp_hscore = $candidate_data['score'];
                    $temp_hmoney = $candidate_data['amount'];
                    $candidate_highest  = $candidate_data['id'];
                }

                if($temp_nscore < $candidate_data['score'] && $temp_nscore < $temp_hscore) {
                    $temp_nscore = $candidate_data['score'];
                    $candidate_next     = $candidate_data['id'];
                }
            } else {
                if($temp_hmoney == 0) {
                    $temp_hmoney = $candidate_data['amount'];
                }

                if($candidate_data['passed'] && $temp_hmoney >= $candidate_data['amount']) {
                    $candidate_highest  = $candidate_data['id'];
                } else {
                    $candidate_next     = $candidate_data['id'];
                }
            }
        }

        if($aanwizing == null) {
            $aanwizing   = new StageAanwizing;
        }
        if($inv_aanwizing != null) {
            $log_aanwizings    = FileLog::where('attachment_id', $inv_aanwizing->id)->get();
        }

        if($ba_tender == null) {
            $ba_tender      = new Memorandum;
        }
        if($file_tender != null) {
            $log_tenders    = FileLog::where('attachment_id', $file_tender->id)->get();
        }
        if($ba_tender2 == null) {
            $ba_tender2     = new Memorandum;
        }
        if($file_tender2 != null) {
            $log_tender_mores    = FileLog::where('attachment_id', $file_tender2->id)->get();
        }

        if($candidate == null) {
            $candidate   = new StageCandidate;
        }
        if($file_candidate != null) {
            $log_candidates     = FileLog::where('attachment_id', $file_candidate->id)->get();
        }

        if($winner == null) {
            $winner   = new StageWinner;
        }
        if($file_winner != null) {
            $log_winners        = FileLog::where('attachment_id', $file_winner->id)->get();
        }

        if($refutal == null) {
            $refutal   = new StageRefutal;
        }

        if($contract == null) {
            $contract   = new ProcurementContract;
        }
        if($file_contract != null) {
            $log_contracts      = FileLog::where('attachment_id', $file_contract->id)->get();
        }

        if($inv_submission == null) {
            $inv_submission     = new Invitation;
        }

        if($inv_evaluation == null) {
            $inv_evaluation     = new Invitation;
        }

        if($inv_submission2 == null) {
            $inv_submission2    = new Invitation;
        }

        if($inv_p_announcement == null) {
            $inv_p_announcement = new Invitation;
        }

        if($inv_p_upload == null) {
            $inv_p_upload = new Invitation;
        }

        $log_p_explanation      = array();
        if($ba_p_explanation == null) {
            $ba_p_explanation   = new Memorandum;
        }
        if($file_p_explanation != null) {
            $log_p_explanation  = FileLog::where('attachment_id', $file_p_explanation->id)->get();
        }

        $log_p_evaluation      = array();
        if($ba_p_evaluation == null) {
            $ba_p_evaluation   = new Memorandum;
        }
        if($file_p_evaluation != null) {
            $log_p_evaluation  = FileLog::where('attachment_id', $file_p_evaluation->id)->get();
        }

        $log_p_result      = array();
        if($ba_p_result == null) {
            $ba_p_result   = new Memorandum;
        }
        if($file_p_result != null) {
            $log_p_result  = FileLog::where('attachment_id', $file_p_result->id)->get();
        }

        return view('layouts.pengadaan.detail', [
            'now'                   => $now,
            'procurement'           => $item,
            'enrollments'           => $enrollments,
            'schedule'              => $schedule,
            'criterions'            => $criterions,
            'announcement'          => $announcement,
            'inv_announcement'      => $inv_announcement,
            'log_invitations'       => $log_invitations,
            'aanwizing'             => $aanwizing,
            'inv_aanwizing'         => $inv_aanwizing,
            'log_aanwizings'        => $log_aanwizings,
            'negotiations'          => $negotiations,
            'negotiating_id'        => $negotiating_id,
            'negotiating_name'      => $negotiating_name,
            'ba_tender'             => $ba_tender,
            'file_tender'           => $file_tender,
            'log_tenders'           => $log_tenders,
            'ba_tender2'            => $ba_tender2,
            'file_tender2'          => $file_tender2,
            'log_tender_mores'      => $log_tender_mores,
            'candidate'             => $candidate,
            'file_candidate'        => $file_candidate,
            'log_candidates'        => $log_candidates,
            'refutal'               => $refutal,
            'file_refutal'          => $file_refutal,
            'contract'              => $contract,
            'file_contract'         => $file_contract,
            'log_contracts'         => $log_contracts,
            'winner'                => $winner,
            'file_winner'           => $file_winner,
            'log_winners'           => $log_winners,
            'approvals'             => $approvals,
            'procurement_array'     => $procurement_array,
            'user'                  => $user,
            'doc_adm'               => $doc_adm,
            'doc_tech'              => $doc_tech,
            'pre_downloadeds'       => $pre_downloadeds,
            'pre_undownloadeds'     => $pre_undownloadeds,
            'downloadeds'           => $downloadeds,
            'undownloadeds'         => $undownloadeds,
            'assurances'            => $assurances,
            'current_winner'        => $current_winner,
            'pre_offereds'          => $pre_offereds,
            'pre_unoffereds'        => $pre_unoffereds,
            'offereds'              => $offereds,
            'unoffereds'            => $unoffereds,
            'inv_submission'        => $inv_submission,
            'file_submission'       => $file_submission,
            'inv_submission2'       => $inv_submission2,
            'file_submission2'      => $file_submission2,
            'inv_evaluation'        => $inv_evaluation,
            'file_evaluation'       => $file_evaluation,
            'offered_mores'         => $offered_mores,
            'unoffered_mores'       => $unoffered_mores,
            'measurement'           => $measurement,
            'mmr_negotiations'      => $mmr_negotiations,
            'candidate_highest'     => $candidate_highest,
            'candidate_next'        => $candidate_next,
            'inv_p_announcement'    => $inv_p_announcement,
            'file_p_announcement'   => $file_p_announcement,
            'file_p_download'       => $file_p_download,
            'inv_p_upload'          => $inv_p_upload,
            'file_p_upload'         => $file_p_upload,
            'ba_p_explanation'      => $ba_p_explanation,
            'file_p_explanation'    => $file_p_explanation,
            'log_p_explanation'     => $log_p_explanation,
            'ba_p_evaluation'       => $ba_p_evaluation,
            'file_p_evaluation'     => $file_p_evaluation,
            'log_p_evaluation'      => $log_p_evaluation,
            'ba_p_result'           => $ba_p_result,
            'file_p_result'         => $file_p_result,
            'log_p_result'          => $log_p_result,
        ]);
    }

    public function draft_list()
    {
        $user = Auth::user();
        $procurements = PreProcurement::with(['approvals' => function($query){
                                            $query->where('entity_type', 'approval');
                                        }])
                                        ->where('proposed',1)
                                        ->orderBy('id', 'desc')
                                        ->get()
                                        ->toArray();

        return view('layouts.pengadaan.daftarcalon', [
            'procurements'   => $procurements,
            'user'           => $user
        ]);
    }

    public function proposed_list()
    {
        $user   = Auth::user();
        $items  = array();

        if($user->role_level == 4) {
            $items = DataTableHelper::list_proposed_procurement($user->role_level, $user->unit_id);
        } else {
            $items = DataTableHelper::list_proposed_procurement($user->role_level, $user->id);
        }

        return Datatables::of($items)->make(true);
    }

    public function start_list(Request $request)
    {
        $procurement_id = PreProcurementHelper::set_listed($request->id);
        $caption = 'Mulai Pengadaan';
        return 'MSG#OK#Simpan '.$caption.' berhasil.#/pengadaan/daftar/';
        // return redirect('/pengadaan/daftar/');
    }

    public function listed_list()
    {
        $items = DataTableHelper::list_listed_procurement();
        return Datatables::of($items)->make(true);
    }

    public function listed_list_vendor()
    {
        $user   = Auth::user();
        $vendor = Company::where('user_id', $user->id)->first();
        // print_r($vendor);die();
        $items = DataTableHelper::list_listed_procurement_vendor($vendor->id);
        return Datatables::of($items)->make(true);
    }

    public function eval_scoring(Request $request)
    {
        $data = array(
            'counter_id'    => $request->counter_id,
            'mark'          => $request->mark,
            'notes'         => $request->notes
        );

        $mark = 0;
        if($request->money_mark != null) {
            $mark   = intval($request->money_mark);
        }

        $evaluation_id  = EvaluationHelper::touch($request->enrollment_id);
        $t_evaluation   = EvaluationHelper::save_techev($evaluation_id, $data);
        $m_evaluation   = EvaluationHelper::save_monev($request->enrollment_id, $request->criterion, $mark);

        $request->session()->put('tab', 'eval');

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }

    public function eval_nonscoring(Request $request)
    {
        $evaluation_id  = EvaluationHelper::touch($request->enrollment_id);
        $m_evaluation   = EvaluationHelper::save_nonscoring($evaluation_id, $request->item);

        $request->session()->put('tab', 'eval');

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }

    public function state_winner(Request $request)
    {
        $procurement_id = PreProcurementHelper::set_winer($request->procurement_id, $request->winner);

        $request->session()->put('tab', 'evalpengumuman');

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }

    public function finish(Request $request)
    {
        $procurement_id = PreProcurementHelper::set_worked($request->id);

        return redirect('/monitor/daftar/');
    }
}
