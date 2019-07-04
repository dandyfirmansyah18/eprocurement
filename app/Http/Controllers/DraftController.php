<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\ScheduleHelper;
use App\Helpers\AttachmentHelper;
use App\Helpers\MeasurementHelper;
use App\Helpers\PreProcurementHelper;

use App\Models\Approval;
use App\Models\Criterion;
use App\Models\Attachment;
use App\Models\PreProcurement;

class DraftController extends Controller
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
        $user = Auth::user();
        if($user != null)
        {
            $item               = PreProcurement::find($request->id);
            $item_user          = $item->user;

            $verification       = Attachment::preprocurement_entity($item->id, 'verification');

            $memo               = Attachment::preprocurement_entity($item->id, 'memo');
            $issuance           = Attachment::preprocurement_entity($item->id, 'issuance');
            $rks                = Attachment::preprocurement_entity($item->id, 'rks');

            $pre_information    = Attachment::procurement_entity($item->id, 'pre_information');
            $measurement        = $item->measurement;
            $criterions         = $item->criterions;
            $schedule           = $item->schedule;

            $approval           = Approval::preprocurement_entities($item->id);

            if($measurement == null) {
                $measurement    = MeasurementHelper::instantiate();
            } else if($measurement->technical_value == 0) {
                $measurement    = MeasurementHelper::default_value($measurement);
            }

            if($criterions == null) {
                $criterions     = array();
            }

            if($schedule == null) {
                $schedule       = ScheduleHelper::instantiate($item->start_date, $item->back_date, $item->procurement_qualification == 1);
            }

            $disabled   = '';
            if($item->listed == true) {
                $disabled       = 'disabled';
            }

            return view('pengadaan.draft', [
                'item'              => $item,
                'item_user'         => $item_user,
                'user'              => $user,
                'verification'      => $verification,
                'memo'              => $memo,
                'issuance'          => $issuance,
                'rks'               => $rks,
                'measurement'       => $measurement,
                'criterions'        => $criterions,
                'disabled'          => $disabled,
                'schedule'          => $schedule,
                'pre_information'   => $pre_information,
                'approval'          => $approval
            ]);
        }

        return redirect('/');
    }

    public function criterion_save(Request $request)
    {
        $data = array(
            'id'            => $request->id,
            'title'         => $request->title,
            'description'   => $request->description
        );

        $criterion_id       = MeasurementHelper::criterion_save($request->procurement_id, $data);

        $measurement_id     = MeasurementHelper::touch($request->procurement_id, $request->scoring);

        $request->session()->put('tab', 'third');

        return redirect('/pengadaan/draft/' . $request->procurement_id);
    }

    public function criterion_delete(Request $request)
    {
        Criterion::find($request->id)->delete();

        return response()->json([
            'status' => 'OK'
        ]);
    }

    public function qualification_save(Request $request)
    {
        $data = array(
            'id'                => $request->procurement_id,
            'qualification'     => $request->qualification,
            'delivery'          => $request->delivery,
            'pre_notes'         => $request->pre_notes
        );

        $procurement_id     = PreProcurementHelper::set_qualification($data);

        if($request->qualification != 1) {
            AttachmentHelper::remove('procurement', $request->procurement_id, 'pre_information');
        }

        $request->session()->put('tab', 'third');

        return redirect('/pengadaan/draft/' . $request->procurement_id);
    }

    public function measurement_save(Request $request)
    {
        $data = array(
            'method'            => $request->method,
            'technical_value'   => $request->technical_value,
            'money_value'       => $request->money_value,
            'user_id'           => Auth::user()->id
        );

        $measurement_id     = MeasurementHelper::save($request->procurement_id, $data);

        $request->session()->put('tab', 'third');

        return redirect('/pengadaan/draft/' . $request->procurement_id);
    }

    public function schedule_save(Request $request)
    {
        $schedule_id    = ScheduleHelper::draft_save($request->procurement_id, $request->schedule);
        $measurement_id = MeasurementHelper::schedule_touch($request->procurement_id, Auth::user()->id);

        $request->session()->put('tab', 'second');

        return redirect('/pengadaan/draft/' . $request->procurement_id);
    }
}
