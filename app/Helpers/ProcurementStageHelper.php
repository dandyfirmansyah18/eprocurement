<?php // Company Helper

namespace App\Helpers;

use App\Models\ProcurementAnnouncement;
use App\Models\ProcurementContract;
use App\Models\PreProcurement;
use App\Models\Attachment;
use App\Models\User;
use App\Helpers\MailHelper;

use App\Models\Company;

use App\Models\StageAanwizing;
use App\Models\StageCandidate;
use App\Models\StageDownload;
use App\Models\StageNegotiation;
use App\Models\StageRefutal;
use App\Models\StageTender;
use App\Models\Invitation;
use App\Models\Memorandum;
use App\Models\StageWinner;
use App\Models\PreEvaluation;

use Carbon\Carbon;

class ProcurementStageHelper
{
    public static function save_invitation($procurement_id, $data)
    {
        $item                       = Invitation::firstOrNew([
                                            'procurement_id'    => $procurement_id,
                                            'purpose'           => $data['purpose']
                                        ]);

        if(array_key_exists('location', $data)) {
            $item->location         = $data['location'];
        }

        if(array_key_exists('foreword', $data)) {
            $item->foreword         = $data['foreword'];
        }

        if(array_key_exists('activity_date', $data)) {
            $item->activity_date    = DateHelper::parse_from_datepicker($data['activity_date']);
        }

        $item->save();

        return $item->id;
    }

    public static function save_memorandum($procurement_id, $data)
    {
        $item               = Memorandum::firstOrNew([
                                        'procurement_id'    => $procurement_id,
                                        'purpose'           => $data['purpose']
                                    ]);

        if(array_key_exists('notes', $data)) {
            $item->notes    = $data['notes'];
        }

        $item->save();

        return $item->id;
    }

    public static function save_announcement($procurement_id, $data)
    {
    	$item                       = ProcurementAnnouncement::firstOrNew([
                                            'procurement_id'    => $procurement_id
                                        ]);

        if(array_key_exists('location', $data)) {
            $item->location         = $data['location'];
        }

        if(array_key_exists('foreword', $data)) {
            $item->foreword         = $data['foreword'];
        }

        if(array_key_exists('activity_date', $data)) {
            $item->activity_date    = DateHelper::parse_from_datepicker($data['activity_date']);
        }

        $item->save();

        $user_id = PreProcurement::where('id', $procurement_id)->first();
        $user = User::where('id', $user_id->user_id)->first();
        $tmp = str_replace(']', '', str_replace('[', '', $user_id->vendor));
        $vendor = str_replace('"', '', $tmp);
        // echo $str;die();
        $company = Company::where('id', $vendor)->first();
        $attachmentplace = Attachment::where('entity_type', 'procurement')->where('entity_id', $procurement_id)->where('purpose', 'invitation')->first();

        //Email Cek

        $user_email_data    = [
            'email'             => $company->email,
            'name'              => $company->name,
            'attachment'        => $attachmentplace->filepath,
            'data'              => [
                                      'name'  => $company->name,
                                      'location'  => $data['location'],
                                      'foreword'  => $data['foreword'],
                                      'activity_date'  => DateHelper::parse_from_datepicker($data['activity_date']),
                                      'attachment'        => $attachmentplace->filepath,
                                    ],
            'type'              => 'user',
            'action'            => 'undangan',
        ];
        MailHelper::queue($user_email_data);

        // $item->update();

    	return $item->id;
    }

    public static function save_download($procurement_id, $data)
    {
        $item                       = StageAanwizing::firstOrNew([
                                            'procurement_id'    => $procurement_id,
                                            'enrollment_id'     => $data['enrollment_id']
                                        ]);

        if($data['type'] == 'technical') {
            $item->technical        = true;
        } else {
            $item->administration   = true;
        }

        $item->save();

        return $item->id;
    }

    public static function save_aanwizing($procurement_id, $data)
    {
    	$item                   = StageAanwizing::firstOrNew([
                                            'procurement_id'    => $procurement_id
                                        ]);

        if(array_key_exists('title', $data)) {
            $item->title        = $data['title'];
        }

        if(array_key_exists('description', $data)) {
            $item->description  = $data['description'];
        }

        $item->save();

    	return $item->id;
    }

    public static function touch_negotiation($procurement_id, $enrollment_id)
    {
        \DB::table('stage_negotiations')
                ->where('procurement_id', $procurement_id)
                ->update(['ongoing' => false]);

        $item                   = new StageNegotiation;
        $item->procurement_id   = $procurement_id;
        $item->enrollment_id    = $enrollment_id;
        $item->ongoing          = true;

        $item->save();

        return $item->id;
    }
    
    public static function save_pre_candidate($data)
    {
        $item               = PreEvaluation::firstOrNew([
                                            'enrollment_id'    => $data['enrollment_id']
                                        ]);

        $item->candidate    = $data['candidate'] == 'true';
        $item->notes        = $data['notes'];
        
        $item->save();

        return $item->id;
    }
    
    public static function save_pre_winner($enrollment_id)
    {
        $item           = PreEvaluation::where('enrollment_id', $enrollment_id)->first();

        if($item != null && $item->candidate) {
            $item->pass = true;
            $item->save();
        }

        return $item->id;
    }

    public static function save_tender($procurement_id, $data)
    {
        $item               = StageTender::firstOrNew([
                                            'procurement_id'    => $procurement_id,
                                            'enrollment_id'     => $data['enrollment_id'],
                                            'type_id'           => intval($data['type'])
                                        ]);
        
        $item->download     = Carbon::now();

        if(array_key_exists('amount', $data) && $data['amount'] != null) {
            $item->amount   = $data['amount'];
        }

        $item->save();

        return $item->id;
    }

    public static function save_candidate($procurement_id, $data)
    {
        $item                   = StageCandidate::firstOrNew([
                                            'procurement_id'    => $procurement_id
                                        ]);

        if(array_key_exists('title', $data)) {
            $item->title        = $data['title'];
        }

        if(array_key_exists('description', $data)) {
            $item->description  = $data['description'];
        }

        $item->save();

        return $item->id;
    }

    public static function save_winner($procurement_id, $data)
    {
    	$item                   = StageWinner::firstOrNew([
                                            'procurement_id'    => $procurement_id
                                        ]);

        if(array_key_exists('title', $data)) {
            $item->title        = $data['title'];
        }

        if(array_key_exists('description', $data)) {
            $item->description  = $data['description'];
        }

        if(array_key_exists('announcement', $data)) {
            $item->announcement = $data['announcement'];
        }

        $item->save();

    	return $item->id;
    }

    public static function save_refutal($procurement_id, $data)
    {
        
        $item                       = StageRefutal::firstOrNew([
                                            'procurement_id'    => $procurement_id
                                        ]);
        // dd('ini');
        $item->type_id              = $data['type_id'];

        if($item->type_id  == 1) {
            $item->new_winner       = $data['new_winner'];
            $item->evaluation       = $data['evaluation'];

            if($data['old_winner'] != 0) {
                $item->old_winner   = $data['old_winner'];
            }
        } else {
            $item->new_winner       = null;
            $item->evaluation       = null;
        }

        $item->save();

        return $item->id;
    }

    public static function save_contract($procurement_id, $data)
    {
        
        $item                   = ProcurementContract::firstOrNew([
                                            'procurement_id'    => $procurement_id
                                        ]);
// dd('ini');
        if(array_key_exists('title', $data)) {
            $item->title        = $data['title'];
        }

        if(array_key_exists('description', $data)) {
            $item->description  = $data['description'];
        }

        $item->save();

        return $item->id;
    }
}
