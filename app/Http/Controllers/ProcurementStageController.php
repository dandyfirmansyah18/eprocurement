<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\ProcurementAnnouncement;
use App\Helpers\ScheduleHelper;
use App\Helpers\AttachmentHelper;
use App\Helpers\ProcurementStageHelper;

class ProcurementStageController extends Controller
{
    public function save_announcement(Request $request)
    {
        $data           = array(
            'location'          => $request->item['location'],
            'foreword'          => $request->item['foreword'],
            'activity_date'     => $request->item['activity_date']
        );

        $item_id        = ProcurementStageHelper::save_announcement($request->procurement_id, $data);

        $request->session()->put('tab', 'start');

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }

    public function save_schedule(Request $request)
    {
        $schedule_id    = ScheduleHelper::detail_save($request->procurement_id, $request->item);

        $request->session()->put('tab', $request->tab_path);

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }

    public function save_invitation(Request $request)
    {
        $invitation_id    = ProcurementStageHelper::save_invitation($request->procurement_id, $request->item);

        $uploaded_file          = $request->file('invitation_doc');
        if ($uploaded_file != null) {
            $timestamp          = time();
            $extension          = $uploaded_file->getClientOriginalExtension();
            $original_filename  = $uploaded_file->getClientOriginalName();
            $target_filename    = 'procurement/' . $timestamp . '.' . $extension;

            Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_file));

            $data = array(
                'entity_type'   => 'procurement',
                'entity_id'     => $request->procurement_id,
                'purpose'       => $request->item['purpose'],
                'filepath'   => $target_filename,
                'filename' => $original_filename
            );

            $attachment_id      = AttachmentHelper::save_data($data);
        }

        if($request->item['purpose'] == 'evaluation') {
            $stage_id           = ProcurementStageHelper::touch_negotiation($request->procurement_id, $request->item['enrollment_id']);
        }

        $request->session()->put('tab', $request->tab_path);

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }

    public function save_memorandum(Request $request)
    {
        $invitation_id    = ProcurementStageHelper::save_memorandum($request->procurement_id, $request->item);

        $uploaded_file          = $request->file('memorandum_doc');
        if ($uploaded_file != null) {
            $timestamp          = time();
            $extension          = $uploaded_file->getClientOriginalExtension();
            $original_filename  = $uploaded_file->getClientOriginalName();
            $target_filename    = 'procurement/' . $timestamp . '.' . $extension;

            Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_file));

            $purpose            = $request->item['purpose'];
            if(array_key_exists('base_purpose', $request->item) && $request->item['base_purpose'] != null) {
                $purpose        = $request->item['base_purpose'] . $invitation_id;
            }

            $data = array(
                'entity_type'   => 'procurement',
                'entity_id'     => $request->procurement_id,
                'purpose'       => $purpose,
                'filepath'   => $target_filename,
                'filename' => $original_filename
            );

            $attachment_id      = AttachmentHelper::save_data($data);
        }

        $request->session()->put('tab', $request->tab_path);

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }

    public function save_download(Request $request)
    {
        $item_id        = ProcurementStageHelper::save_download($request->procurement_id, $request->item);

        return response()->json([
            'status' => 'OK',
            'id' => $item_id
        ]);
    }

    public function save_aanwizing(Request $request)
    {
        $data           = array(
            'title'         => $request->item['title'],
            'description'   => $request->item['description']
        );

        $item_id        = ProcurementStageHelper::save_aanwizing($request->procurement_id, $data);

        $request->session()->put('tab', 'aanwizing');

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }

    public function save_negotiation(Request $request)
    {
        $item_id = ProcurementStageHelper::touch_negotiation($request->procurement_id, $request->enrollment_id);

        $request->session()->put('tab', $request->tab_path);

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }
    
    public function open_tender(Request $request)
    {
        $item_id = ProcurementStageHelper::save_tender($request->procurement_id, $request->item);

        return response()->json([
            'status' => 'OK',
            'id' => $item_id
        ]);
    }
    
    public function open_pre_tender(Request $request)
    {
        $item_id = ProcurementStageHelper::save_tender($request->procurement_id, $request->item);

        return response()->json([
            'status' => 'OK',
            'id' => $item_id
        ]);
    }
    
    public function save_pre_evaluation(Request $request)
    {
        $enrollment_ids = $request->enrollment_id;
        $candidates = $request->candidate;
        $notes = $request->notes;

        for($ii = 0; $ii < count($enrollment_ids); $ii++) {
            $data = array(
                'enrollment_id' => $enrollment_ids[$ii],
                'candidate'     => $candidates[$ii],
                'notes'         => $notes[$ii],
            );

            $item_id = ProcurementStageHelper::save_pre_candidate($data);
        }

        $request->session()->put('tab', 'pra');

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }
    
    public function save_pre_winners(Request $request)
    {
        $enrollment_ids = $request->enrollment_id;
        
        for($ii = 0; $ii < count($enrollment_ids); $ii++) {
            $item_id = ProcurementStageHelper::save_pre_winner($enrollment_ids[$ii]);
        }

        $request->session()->put('tab', 'pra');

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }

    public function save_tender(Request $request)
    {
        $enrollment_ids = explode(',', $request->item['enrollment_ids']);
        $amounts        = explode(',', $request->item['amounts']);
        for($ii = 0; $ii < count($enrollment_ids); $ii++) {
            $data       = array(
                'enrollment_id' => intval($enrollment_ids[$ii]),
                'type'          => $request->item['type'],
                'amount'        => intval($amounts[$ii])
            );
            $item_id    = ProcurementStageHelper::save_tender($request->procurement_id, $data);
        }

        $request->session()->put('tab', $request->tab_path);

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }

    public function save_candidate(Request $request)
    {
        $data       = array(
            'title'         => $request->item['title'],
            'description'   => $request->item['description']
        );

        $item_id    = ProcurementStageHelper::save_candidate($request->procurement_id, $data);

        $request->session()->put('tab', 'calonpem');

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }

    public function save_winner_announcement(Request $request)
    {
        $data       = array(
            'title'         => $request->item['title'],
            'description'   => $request->item['description']
        );

        $item_id    = ProcurementStageHelper::save_winner($request->procurement_id, $data);

        $request->session()->put('tab', 'evalpengumuman');

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }

    public function save_winner_preambule(Request $request)
    {
        $data       = array(
            'announcement'  => $request->item['announcement']
        );

        $item_id    = ProcurementStageHelper::save_winner($request->procurement_id, $data);

        $request->session()->put('tab', 'evalpengumuman');

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }

    public function save_refutal(Request $request)
    {
        $item_id = ProcurementStageHelper::save_refutal($request->procurement_id, $request->item);
        // dd('aaa');
        $request->session()->put('tab', 'sanggah');

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }

    public function save_contract(Request $request)
    {
        $data       = array(
            'title'         => $request->item['title'],
            'description'   => $request->item['description']
        );

        $item_id    = ProcurementStageHelper::save_contract($request->procurement_id, $data);

        $request->session()->put('tab', 'kontrak');

        return redirect('/pengadaan/detail/' . $request->procurement_id);
    }
}
