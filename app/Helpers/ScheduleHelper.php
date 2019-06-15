<?php // Draft Helper

namespace App\Helpers;

use Carbon\Carbon;

use App\Models\Measurement;
use App\Models\Schedule;
use App\Helpers\DateHelper;
use App\Models\PreProcurement;
use App\Models\User;
use App\Helpers\MailHelper;


use App\Models\Company;

use App\Models\Attachment;

class ScheduleHelper
{
    public static function draft_save($procurement_id, $data)
    {
        $item                       = Schedule::where('procurement_id', $procurement_id)->first();
        if($item == null) {
            $item                   = new Schedule;
            $item->procurement_id   = $procurement_id;
        }

        if($data['a_start'] != null) {
            $item->a_start          = DateHelper::parse_from_datepicker($data['a_start']);
        }

        if(array_key_exists('b_start', $data) && $data['b_start'] != null) {
            $item->b_start          = DateHelper::parse_from_datepicker($data['b_start']);
            $item->b_announcement   = $data['b_announcement'];
            $item->b_download       = $data['b_download'];
            $item->b_aanwizing      = $data['b_aanwizing'];
        }

        $item->a_announcement       = $data['a_announcement'];
        $item->a_download           = $data['a_download'];
        $item->a_aanwizing          = $data['a_aanwizing'];

        if(array_key_exists('a_p_announcement', $data)) {
            $item->a_p_announcement   = $data['a_p_announcement'];
            $item->a_p_download       = $data['a_p_download'];
            $item->a_p_explanation    = $data['a_p_explanation'];
        }

        if(array_key_exists('b_p_announcement', $data)) {
            $item->b_p_announcement   = $data['b_p_announcement'];
            $item->b_p_download       = $data['b_p_download'];
            $item->b_p_explanation    = $data['b_p_explanation'];
        }

        $item->save();

        return $item->id;
    }


    public static function detail_save($procurement_id, $data)
    {
        if($data['part'] == 'submission'){
            $user_id = PreProcurement::where('id', $procurement_id)->first();
            $user = User::where('id', $user_id->user_id)->first();
            $tmp = str_replace(']', '', str_replace('[', '', $user_id->vendor));
            $vendor = str_replace('"', '', $tmp);
            // echo $str;die();
            $company = Company::where('id', $vendor)->first();

            //Email Cek

            $user_email_data    = [
                'email'             => $company->email,
                'name'              => $company->name,
                'data'              => [
                                          'name'  => $company->name,
                                          'procurement_name' => $user_id->title,
                                        ],
                'type'              => 'user',
                'action'            => 'reminder',
            ];
            MailHelper::queue($user_email_data);
        }
        dd($data['part']);
        $item                               = Schedule::where('procurement_id', $procurement_id)
                                                ->first();

        switch ($data['part']) {
            case 'p_upload':
                $item->a_p_upload           = $data['a'];
                if(array_key_exists('b', $data)) {
                    $item->b_p_upload       = $data['b'];
                }
                break;
            case 'p_evaluation':
                $item->a_p_evaluation       = $data['a'];
                if(array_key_exists('b', $data)) {
                    $item->b_p_evaluation   = $data['b'];
                }
                break;
            case 'p_verification':
                $item->a_p_verification     = $data['a'];
                if(array_key_exists('b', $data)) {
                    $item->b_p_verification = $data['b'];
                }
                break;
            case 'p_selection':
                $item->a_p_selection        = $data['a'];
                if(array_key_exists('b', $data)) {
                    $item->b_p_selection    = $data['b'];
                }
                break;
            case 'p_result':
                $item->a_p_result           = $data['a'];
                if(array_key_exists('b', $data)) {
                    $item->b_p_result       = $data['b'];
                }
                break;
            case 'submission':
                $item->a_submission         = $data['a'];
                if(array_key_exists('b', $data)) {
                    $item->b_submission     = $data['b'];
                }
                break;
            case 'tender':
                $item->a_tender             = $data['a'];
                if(array_key_exists('b', $data)) {
                    $item->b_tender         = $data['b'];
                }
                break;
            case 'phase1':
                $item->a_phase1             = $data['a'];
                if(array_key_exists('b', $data)) {
                    $item->b_phase1         = $data['b'];
                }
                break;
            case 'submission2':
                $item->a_submission2        = $data['a'];
                if(array_key_exists('b', $data)) {
                    $item->b_submission2    = $data['b'];
                }
                break;
            case 'tender2':
                $item->a_tender2            = $data['a'];
                if(array_key_exists('b', $data)) {
                    $item->b_tender2        = $data['b'];
                }
                break;
            case 'evaluation':
                $item->a_evaluation         = $data['a'];
                if(array_key_exists('b', $data)) {
                    $item->b_evaluation     = $data['b'];
                }
                break;
            case 'negotiation':
                $item->a_negotiation        = $data['a'];
                if(array_key_exists('b', $data)) {
                    $item->b_negotiation    = $data['b'];
                }
                break;
            case 'candidate':
                $item->a_candidate          = $data['a'];
                if(array_key_exists('b', $data)) {
                    $item->b_candidate      = $data['b'];
                }
                break;
            case 'winner':
                $item->a_winner             = $data['a'];
                if(array_key_exists('b', $data)) {
                    $item->b_winner         = $data['b'];
                }
                break;
            case 'consultation':
                $item->a_consultation       = $data['a'];
                if(array_key_exists('b', $data)) {
                    $item->b_consultation   = $data['b'];
                }
                break;
            case 'contract':
                $item->a_contract           = $data['a'];
                if(array_key_exists('b', $data)) {
                    $item->b_contract       = $data['b'];
                }
                break;

            default:
                break;
        }

        $item->save();

        return $item->id;
    }

    public static function instantiate($start_date, $back_date, $with_prequal = false)
    {
        $item                           = new Schedule;
        $item->a_start                  = Carbon::parse($start_date);
        $a_date                         = clone $item->a_start;

        if($with_prequal) {
            $item->a_p_announcement     = DateHelper::datetime_picker($a_date->addDay());
            $item->a_p_download         = DateHelper::datetime_picker($a_date->addDay());
            $item->a_p_explanation      = DateHelper::datetime_picker($a_date->addDay());
            $item->a_p_upload           = DateHelper::datetime_picker($a_date->addDay());
            $item->a_p_evaluation       = DateHelper::datetime_picker($a_date->addDay());
            $item->a_p_verification     = DateHelper::datetime_picker($a_date->addDay());
            $item->a_p_selection        = DateHelper::datetime_picker($a_date->addDay());
            $item->a_p_result           = DateHelper::datetime_picker($a_date->addDay());
        }

        $item->a_announcement           = DateHelper::datetime_picker($a_date->addDay());
        $item->a_download               = DateHelper::datetime_picker($a_date->addDay());
        $item->a_aanwizing              = DateHelper::datetime_picker($a_date->addDay());
        $item->a_submission             = DateHelper::datetime_picker($a_date->addDay());
        $item->a_tender                 = DateHelper::datetime_picker($a_date->addDay());
        $item->a_evaluation             = DateHelper::datetime_picker($a_date->addDay());
        $item->a_phase1                 = DateHelper::datetime_picker($a_date->addDay());
        $item->a_submission2            = DateHelper::datetime_picker($a_date->addDay());
        $item->a_tender2                = DateHelper::datetime_picker($a_date->addDay());
        $item->a_negotiation            = DateHelper::datetime_picker($a_date->addDay());
        $item->a_candidate              = DateHelper::datetime_picker($a_date->addDay());
        $item->a_winner                 = DateHelper::datetime_picker($a_date->addDay());
        $item->a_consultation           = DateHelper::datetime_picker($a_date->addDay());
        $item->a_contract               = DateHelper::datetime_picker($a_date->addDay());

        if($back_date != null) {
            $item->b_start              = Carbon::parse($back_date);
        } else {
            $item->b_start              = Carbon::parse($start_date)->addDays(7);
        }
        $b_date                         = clone $item->b_start;

        if($with_prequal) {
            $item->b_p_announcement     = DateHelper::datetime_picker($b_date->addDay());
            $item->b_p_download         = DateHelper::datetime_picker($b_date->addDay());
            $item->b_p_explanation      = DateHelper::datetime_picker($b_date->addDay());
            $item->b_p_upload           = DateHelper::datetime_picker($b_date->addDay());
            $item->b_p_evaluation       = DateHelper::datetime_picker($b_date->addDay());
            $item->b_p_verification     = DateHelper::datetime_picker($b_date->addDay());
            $item->b_p_selection        = DateHelper::datetime_picker($b_date->addDay());
            $item->b_p_result           = DateHelper::datetime_picker($b_date->addDay());
        }

        $item->b_announcement           = DateHelper::datetime_picker($b_date->addDay());
        $item->b_download               = DateHelper::datetime_picker($b_date->addDay());
        $item->b_aanwizing              = DateHelper::datetime_picker($b_date->addDay());
        $item->b_submission             = DateHelper::datetime_picker($b_date->addDay());
        $item->b_tender                 = DateHelper::datetime_picker($b_date->addDay());
        $item->b_evaluation             = DateHelper::datetime_picker($b_date->addDay());
        $item->b_phase1                 = DateHelper::datetime_picker($b_date->addDay());
        $item->b_submission2            = DateHelper::datetime_picker($b_date->addDay());
        $item->b_tender2                = DateHelper::datetime_picker($b_date->addDay());
        $item->b_negotiation            = DateHelper::datetime_picker($b_date->addDay());
        $item->b_candidate              = DateHelper::datetime_picker($b_date->addDay());
        $item->b_winner                 = DateHelper::datetime_picker($b_date->addDay());
        $item->b_consultation           = DateHelper::datetime_picker($b_date->addDay());
        $item->b_contract               = DateHelper::datetime_picker($b_date->addDay());

        return $item;
    }
}
