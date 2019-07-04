<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Assurance;
use App\Models\Attachment;
use App\Models\Company;
use App\Models\FileLog;
use App\Models\Invitation;
use App\Models\Memorandum;
use App\Models\PreProcurement;
use App\Models\Enrollment;

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

use App\Helpers\AttachmentHelper;
use App\Helpers\DataTableHelper;
use App\Helpers\MonitoringHelper;
use App\Helpers\PreProcurementHelper;
use App\Helpers\EvaluationHelper;
use App\Helpers\EnrollmentHelper;

use Yajra\Datatables\Facades\Datatables;

class EnrollmentController extends Controller
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
    
    public function detail(Request $request)
    {
        $procurement_array      = PreProcurement::find($request->id);

        $now                    = Carbon::now();
        $item                   = PreProcurement::with([
                                    'attachments' => function($query){
                                        $query->where('entity_type', 'procurement')
                                            ->orWhere('entity_type', 'planning');
                                    },
                                    'assurances',
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

        $user                   = $item->user;
        $enrollments            = $item->enrollments;
        $schedule               = $item->schedule;
        $criterions             = $item->criterions;
        $raw_negotiations       = $item->negotiations;
        $measurement            = $item->measurement;
        $assurances             = $item->assurances;
        $announcement           = $item->announcement;
        $downloads              = $item->downloads;
        $pre_downloads          = $item->pre_downloads;
        $aanwizing              = $item->aanwizing;
        $candidate              = $item->candidate;
        $winner                 = $item->winner;
        $refutal                = $item->refutal;
        $contract               = $item->contract;

        $doc_adm                = $item->attachments
                                    ->where('entity_type', 'planning')
                                    ->where('purpose', 'verification')
                                    ->first();
        $file_rks               = $item->attachments
                                    ->where('entity_type', 'planning')
                                    ->where('purpose', 'rks')
                                    ->first();
        $file_memo              = $item->attachments
                                    ->where('entity_type', 'planning')
                                    ->where('purpose', 'memo')
                                    ->first();
        $file_issuance          = $item->attachments
                                    ->where('entity_type', 'planning')
                                    ->where('purpose', 'issuance')
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
        if($announcement == null) {
            $announcement   = new ProcurementAnnouncement;
        }

        if($aanwizing == null) {
            $aanwizing   = new StageAanwizing;
        }

        $negotiating_id         = 0;
        $negotiating_name       = '';
        $offereds               = array();
        $unoffereds             = array();
        $offered_mores          = array();
        $unoffered_mores        = array();
        $pre_offereds           = array();
        $pre_unoffereds         = array();

        foreach ($enrollments as $enroll) {
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
            
            $raw_negotiation    =   $raw_negotiations->where('enrollment_id', $enroll->id)
                                                        ->where('ongoing', true)
                                                        ->first();
            if($raw_negotiation != null) {
                $negotiating_id     = $enroll->id;
                $negotiating_name   = $enroll->vendor->name;
            }
        }

        if($candidate == null) {
            $candidate   = new StageCandidate;
        }

        if($winner == null) {
            $winner   = new StageWinner;
        }

        if($refutal == null) {
            $refutal   = new StageRefutal;
        }

        if($contract == null) {
            $contract   = new ProcurementContract;
        }

        $current_company  = Company::where('user_id', Auth::user()->id)->first();
        $enrolled         = 0;
        $file_upload      = null;
        $file_upload2     = null;
        $file_p_upload    = null;

        $enrollment       = null;
        if($current_company != null) {
          $enrollment     = $enrollments->where('vendor_id', $current_company->id)->first();
          if($enrollment != null) {
            $enrolled     = 1;
            $file_upload  = $enrollment->offering();
            $file_upload2 = $enrollment->offering2();
            $file_p_upload  = $enrollment->pre_offering();
          }
        } else {
          $enrolled       = -1;
        }

        $jaminan          = $assurances->where('type_id', 0)->where('phase', 1)->first();
        $jaminan2         = $assurances->where('type_id', 0)->where('phase', 2)->first();
        $file_jaminan     = null;
        $file_jaminan2    = null;
        if($jaminan == null) {
          $jaminan                = new Assurance;
          $jaminan->start_date    = Carbon::now();
          $jaminan->end_date      = Carbon::now()->addDays(7);
        } else {
          $file_jaminan         = Attachment::procurement_assurance_entity($item->id, $jaminan->id);
        }
        if($jaminan2 == null) {
            $jaminan2                = new Assurance;
            $jaminan2->start_date    = Carbon::now();
            $jaminan2->end_date      = Carbon::now()->addDays(7);
        } else {
            $file_jaminan2      = Attachment::procurement_assurance_entity($item->id, $jaminan2->id);
        }

        $sanggahan        = $assurances->where('type_id', 1)->first();
        $file_sanggahan   = null;
        if($sanggahan == null) {
          $sanggahan              = new Assurance;
          $sanggahan->start_date  = Carbon::now();
          $sanggahan->end_date    = Carbon::now()->addDays(7);
        } else {
          $file_sanggahan         = Attachment::procurement_assurance_entity($item->id, $sanggahan->id);
        }
        
        if($inv_p_announcement == null) {
            $inv_p_announcement = new Invitation;
        }
        
        if($inv_p_upload == null) {
            $inv_p_upload = new Invitation;
        }
        
        if($ba_p_explanation == null) {
            $ba_p_explanation   = new Memorandum;
        }
        
        if($ba_p_evaluation == null) {
            $ba_p_evaluation   = new Memorandum;
        }
        
        if($ba_p_result == null) {
            $ba_p_result   = new Memorandum;
        }
        
        return view('penyedia.pengadaan', [
                        'now'                   => $now,
                        'procurement'           => $item,
                        'enrollments'           => $enrollments,
                        'schedule'              => $schedule,
                        'criterions'            => $criterions,
                        'announcement'          => $announcement,
                        'inv_announcement'      => $inv_announcement,
                        'aanwizing'             => $aanwizing,
                        'inv_aanwizing'         => $inv_aanwizing,
                        'negotiating_id'        => $negotiating_id,
                        'negotiating_name'      => $negotiating_name,
                        'ba_tender'             => $ba_tender,
                        'file_tender'           => $file_tender,
                        'ba_tender2'            => $ba_tender2,
                        'file_tender2'          => $file_tender2,
                        'candidate'             => $candidate,
                        'file_candidate'        => $file_candidate,
                        'refutal'               => $refutal,
                        'file_refutal'          => $file_refutal,
                        'contract'              => $contract,
                        'file_contract'         => $file_contract,
                        'winner'                => $winner,
                        'file_winner'           => $file_winner,
                        'procurement_array'     => $procurement_array,
                        'user'                  => $user,
                        'file_issuance'         => $file_issuance,
                        'file_memo'             => $file_memo,
                        'file_rks'              => $file_rks,
                        'sanggahan'             => $sanggahan,
                        'file_sanggahan'        => $file_sanggahan,
                        'enrollment'            => $enrollment,
                        'enrolled'              => $enrolled,
                        'file_upload'           => $file_upload,
                        'jaminan'               => $jaminan,
                        'file_jaminan'          => $file_jaminan,
                        'file_upload2'          => $file_upload2,
                        'jaminan2'              => $jaminan2,
                        'file_jaminan2'         => $file_jaminan2,
                        'doc_adm'               => $doc_adm,
                        'pre_offereds'          => $pre_offereds,
                        'pre_unoffereds'        => $pre_unoffereds,
                        'offereds'              => $offereds,
                        'unoffereds'            => $unoffereds,
                        'offered_mores'         => $offered_mores,
                        'unoffered_mores'       => $unoffered_mores,
                        'inv_p_announcement'    => $inv_p_announcement,
                        'file_p_announcement'   => $file_p_announcement,
                        'file_p_download'       => $file_p_download,
                        'inv_p_upload'          => $inv_p_upload,
                        'file_p_upload'         => $file_p_upload,
                        'ba_p_explanation'      => $ba_p_explanation,
                        'file_p_explanation'    => $file_p_explanation,
                        'ba_p_evaluation'       => $ba_p_evaluation,
                        'file_p_evaluation'     => $file_p_evaluation,
                        'ba_p_result'           => $ba_p_result,
                        'file_p_result'         => $file_p_result,
        ]);
    }

    public function warranty_offering(Request $request)
    {
        $user_id                = Auth::user()->id;
        $procurement_id         = $request->procurement_id;
        $data                   = $request->assurance;

        $monitoring_id          = MonitoringHelper::save_assurance($user_id, $procurement_id, $data, 0);

        $uploaded_file          = $request->file('assurance_doc');
        if ($uploaded_file != null) {
            $timestamp          = time();
            $extension          = $uploaded_file->getClientOriginalExtension();
            $original_filename  = $uploaded_file->getClientOriginalName();
            $target_filename    = 'assurance/' . $timestamp . '.' . $extension;

            Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_file));

            $data = array(
                'entity_type'   => 'assurance',
                'purpose'       => 'id_' . $monitoring_id,
                'entity_id'     => $procurement_id,
                'filepath'   => $target_filename,
                'filename' => $original_filename
            );

            $attachment_id      = AttachmentHelper::save_data($data);
        }

        $request->session()->put('tab', 'tawareval');

        return redirect('/penyedia/pengadaan/' . $procurement_id);
    }

    public function warranty_refutal(Request $request)
    {
        $user_id                = Auth::user()->id;
        $procurement_id         = $request->procurement_id;
        $data                   = $request->assurance;

        $monitoring_id          = MonitoringHelper::save_assurance($user_id, $procurement_id, $data, 1);

        $uploaded_file          = $request->file('assurance_doc');
        if ($uploaded_file != null) {
            $timestamp          = time();
            $extension          = $uploaded_file->getClientOriginalExtension();
            $original_filename  = $uploaded_file->getClientOriginalName();
            $target_filename    = 'assurance/' . $timestamp . '.' . $extension;

            Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_file));

            $data = array(
                'entity_type'   => 'assurance',
                'purpose'       => 'id_' . $monitoring_id,
                'entity_id'     => $procurement_id,
                'filepath'   => $target_filename,
                'filename' => $original_filename
            );

            $attachment_id      = AttachmentHelper::save_data($data);
        }

        $request->session()->put('tab', 'sanggah');

        return redirect('/penyedia/pengadaan/' . $procurement_id);
    }

    public function register(Request $request)
    {
        $user_id                = Auth::user()->id;
        $procurement_id         = $request->procurement_id;

        $current_company  = Company::where('user_id', Auth::user()->id)->first();
        if($current_company != null) {
          $enrollment_id  = EnrollmentHelper::save($procurement_id, $current_company->id);
        }

        return $procurement_id;
        // return redirect('/penyedia/pengadaan/' . $procurement_id);
    }

    public function offering(Request $request)
    {
        $user_id                = Auth::user()->id;
        $procurement_id         = $request->procurement_id;

        $current_company  = Company::where('user_id', Auth::user()->id)->first();
        if($current_company != null) {
          $enrollment     = Enrollment::where('procurement_id', $procurement_id)->where('vendor_id', $current_company->id)->first();
          if($enrollment != null) {
            $uploaded_file          = $request->file('assurance_doc');
            if ($uploaded_file != null) {
                $timestamp          = time();
                $extension          = $uploaded_file->getClientOriginalExtension();
                $original_filename  = $uploaded_file->getClientOriginalName();
                $target_filename    = 'enrollment/' . $timestamp . '.' . $extension;

                Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_file));

                $data = array(
                    'entity_type'   => 'enrollment',
                    'entity_id'     => $enrollment->id,
                    'filepath'   => $target_filename,
                    'filename' => $original_filename
                );

                $attachment_id      = AttachmentHelper::save_data($data);
            }
          }
        }

        $request->session()->put('tab', 'tawareval');

        return redirect('/penyedia/pengadaan/' . $procurement_id);
    }
    
    public function offering_second(Request $request)
    {
        $user_id                = Auth::user()->id;
        $procurement_id         = $request->procurement_id;

        $current_company  = Company::where('user_id', Auth::user()->id)->first();
        if($current_company != null) {
            $enrollment     = Enrollment::where('procurement_id', $procurement_id)->where('vendor_id', $current_company->id)->first();
            if($enrollment != null) {
            $uploaded_file          = $request->file('assurance_doc');
            if ($uploaded_file != null) {
                $timestamp          = time();
                $extension          = $uploaded_file->getClientOriginalExtension();
                $original_filename  = $uploaded_file->getClientOriginalName();
                $target_filename    = 'enrollment/' . $timestamp . '.' . $extension;

                Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_file));

                $data = array(
                    'entity_type'   => 'enrollment',
                    'entity_id'     => $enrollment->id,
                    'purpose'       => 'second',
                    'filepath'   => $target_filename,
                    'filename' => $original_filename
                );

                $attachment_id      = AttachmentHelper::save_data($data);
            }
            }
        }

        $request->session()->put('tab', 'tawareval');

        return redirect('/penyedia/pengadaan/' . $procurement_id);
    }
    
    public function pre_offering(Request $request)
    {
        $user_id                = Auth::user()->id;
        $procurement_id         = $request->procurement_id;

        $current_company  = Company::where('user_id', Auth::user()->id)->first();
        if($current_company != null) {
            $enrollment     = Enrollment::where('procurement_id', $procurement_id)->where('vendor_id', $current_company->id)->first();
            if($enrollment != null) {
            $uploaded_file          = $request->file('assurance_doc');
            if ($uploaded_file != null) {
                $timestamp          = time();
                $extension          = $uploaded_file->getClientOriginalExtension();
                $original_filename  = $uploaded_file->getClientOriginalName();
                $target_filename    = 'enrollment/' . $timestamp . '.' . $extension;

                Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_file));

                $data = array(
                    'entity_type'   => 'enrollment',
                    'entity_id'     => $enrollment->id,
                    'purpose'       => 'pre',
                    'filepath'   => $target_filename,
                    'filename' => $original_filename
                );

                $attachment_id      = AttachmentHelper::save_data($data);
            }
            }
        }

        $request->session()->put('tab', 'pra');

        return redirect('/penyedia/pengadaan/' . $procurement_id);
    }
}
