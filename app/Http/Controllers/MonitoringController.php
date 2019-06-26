<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Helpers\AttachmentHelper;
use App\Helpers\UserHelper;
use App\Helpers\DataTableHelper;
use App\Helpers\MonitoringHelper;

use App\Models\Assurance;
use App\Models\Attachment;
use App\Models\Enrollment;
use App\Models\Rating;
use App\Models\FileLog;
use App\Models\MonitoringWork;
use App\Models\MonitoringPayment;
use App\Models\MonitoringContract;
use App\Models\PreProcurement;

use Yajra\Datatables\Facades\Datatables;

class MonitoringController extends Controller
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
        $user = Auth::user();
        $procurements = PreProcurement::where('worked', true)->get();

        return view('layouts.monitoring.daftar', [
            'procurements'  => $procurements,
            'user'          => $user
        ]);
    }

    public function detail($id)
    {
        $user = Auth::user();
        $procurements       = PreProcurement::where('id', $id)
                                                ->with(
                                                    [
                                                        'user',
                                                        'verificator',
                                                        'approvals' => function($query){
                                                            $query->where('entity_type', 'approval');
                                                        },
                                                        'approvals.user',
                                                        'assurances'
                                                    ])
                                                ->first()
                                                ->toArray();

        $approval                 = $procurements['approvals'];
        $works                    = MonitoringWork::where('procurement_id', $id)->get();
        $payments                 = MonitoringPayment::where('procurement_id', $id)->get();
        $assurances               = $procurements['assurances'];
        $contract                 = MonitoringContract::where('procurement_id', $id)->first();
        $contract_doc             = new Attachment;
        $addendum_doc             = new Attachment;
        $contract_logs            = array();

        $assurance                = new Assurance;
        $assurance->start_date    = Carbon::now();
        $assurance->end_date      = Carbon::now()->addDays(3);
        $enrollment               = Enrollment::where('procurement_id', $procurements['id'])->first();
        $winner                   = $enrollment->vendor;

        $rating                   = Rating::where('procurement_id', $procurements['id'])->first();
        if($rating == null) {
            $rating               = new Rating;
        }

        if($contract != null) {
            $contract_doc   = $contract->doc();
            $addendum_doc   = $contract->addendum_doc();

            if($contract_doc != null) {
                $contract_logs       = FileLog::where('attachment_id', $contract_doc->id)->get();
            }
        } else {
            $contract               = new MonitoringContract;
            $contract->doc_date     = Carbon::now();
            $contract->start_date   = Carbon::now()->addDays(3);
            $contract->end_date     = Carbon::now()->addDays(6);
        }

        return view('layouts.monitoring.detail', [
            'procurements'  => $procurements,
            'user'          => $user,
            'approval'      => $approval,
            'works'         => $works,
            'payments'      => $payments,
            'assurances'    => $assurances,
            'assurance'     => $assurance,
            'contract'      => $contract,
            'contract_doc'  => $contract_doc,
            'addendum_doc'  => $addendum_doc,
            'contract_logs' => $contract_logs,
            'winner'        => $winner,
            'rating'        => $rating
        ]);
    }

    public function work_monitoring(Request $request)
    {
        $user_id                = Auth::user()->id;
        $procurement_id         = $request->procurement_id;
        $data                   = $request->monitoring;

        $monitoring_id          = MonitoringHelper::save_work($user_id, $procurement_id, $data);

        $uploaded_file          = $request->file('monitoring_ba_doc');
        if ($uploaded_file != null) {
            $timestamp          = time();
            $extension          = $uploaded_file->getClientOriginalExtension();
            $original_filename  = $uploaded_file->getClientOriginalName();
            $target_filename    = 'monitoring/' . $timestamp . '.' . $extension;

            Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_file));

            $data = array(
                'entity_type'   => 'monitoring_work',
                'entity_id'     => $monitoring_id,
                'filepath'   => $target_filename,
                'filename' => $original_filename
            );

            $attachment_id      = AttachmentHelper::save_data($data);
        }

        $request->session()->put('tab', 'laporankerja');

        return redirect('/monitor/detail/' . $procurement_id);
    }

    public function payment_monitoring(Request $request)
    {
        $user_id                = Auth::user()->id;
        $procurement_id         = $request->procurement_id;
        $data                   = $request->monitoring;

        $monitoring_id          = MonitoringHelper::save_payment($user_id, $procurement_id, $data);

        $uploaded_file          = $request->file('monitoring_ba_doc');
        if ($uploaded_file != null) {
            $timestamp          = time();
            $extension          = $uploaded_file->getClientOriginalExtension();
            $original_filename  = $uploaded_file->getClientOriginalName();
            $target_filename    = 'monitoring/' . $timestamp . '.' . $extension;

            Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_file));

            $data = array(
                'entity_type'   => 'monitoring_payment',
                'entity_id'     => $monitoring_id,
                'filepath'   => $target_filename,
                'filename' => $original_filename
            );

            $attachment_id      = AttachmentHelper::save_data($data);
        }

        $request->session()->put('tab', 'laporanbayar');

        return redirect('/monitor/detail/' . $procurement_id);
    }

    public function warranty_monitoring(Request $request)
    {
        $user_id                = Auth::user()->id;
        $procurement_id         = $request->procurement_id;
        $data                   = $request->monitoring;

        $monitoring_id          = MonitoringHelper::save_assurance($user_id, $procurement_id, $data);

        $uploaded_file          = $request->file('monitoring_doc');
        if ($uploaded_file != null) {
            $timestamp          = time();
            $extension          = $uploaded_file->getClientOriginalExtension();
            $original_filename  = $uploaded_file->getClientOriginalName();
            $target_filename    = 'monitoring/' . $timestamp . '.' . $extension;

            Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_file));

            $data = array(
                'entity_type'   => 'assurance',
                'purpose'       => 'id_' . $monitoring_id,
                'entity_id'     => $monitoring_id,
                'filepath'   => $target_filename,
                'filename' => $original_filename
            );

            $attachment_id      = AttachmentHelper::save_data($data);
        }

        $request->session()->put('tab', 'jaminan');

        return redirect('/monitor/detail/' . $procurement_id);
    }

    public function contract_monitoring(Request $request)
    {
        $user_id                = Auth::user()->id;
        $procurement_id         = $request->procurement_id;
        $data                   = $request->monitoring;

        $monitoring_id          = MonitoringHelper::save_contract($user_id, $procurement_id, $data);

        $uploaded_file          = $request->file('monitoring_doc');
        if ($uploaded_file != null) {
            $timestamp          = time();
            $extension          = $uploaded_file->getClientOriginalExtension();
            $original_filename  = $uploaded_file->getClientOriginalName();
            $target_filename    = 'monitoring/' . $timestamp . '.' . $extension;

            Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_file));

            $data = array(
                'entity_type'   => 'monitoring_contract',
                'entity_id'     => $monitoring_id,
                'filepath'   => $target_filename,
                'filename' => $original_filename
            );

            $attachment_id      = AttachmentHelper::save_data($data);
        }

        $addendum_file          = $request->file('monitoring_addendum');
        if ($addendum_file != null) {
            $add_timestamp          = time();
            $add_extension          = $addendum_file->getClientOriginalExtension();
            $add_original_filename  = $addendum_file->getClientOriginalName();
            $add_target_filename    = 'monitoring/' . $add_timestamp . '.' . $add_extension;

            Storage::disk('local')->put('public/' . $add_target_filename,  File::get($addendum_file));

            $add_data = array(
                'entity_type'   => 'monitoring_addendum',
                'entity_id'     => $monitoring_id,
                'filepath'   => $add_target_filename,
                'filename' => $add_original_filename
            );

            $add_attachment_id      = AttachmentHelper::save_data($add_data);
        }

        $request->session()->put('tab', 'kontrak');

        return redirect('/monitor/detail/' . $procurement_id);
    }

    public function rating(Request $request)
    {
        $user_id                = intval($request->user_id);
        $procurement_id         = intval($request->procurement_id);
        $data                   = $request->rate;

        $monitoring_id          = MonitoringHelper::save_rating($user_id, $procurement_id, $data);
        $updated_id             = UserHelper::set_rating($user_id);

        $request->session()->put('tab', 'evaluasi');

        return redirect('/monitor/detail/' . $procurement_id);
    }
}
