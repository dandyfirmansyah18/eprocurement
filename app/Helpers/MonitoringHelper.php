<?php // Company Helper

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Rating;
use App\Models\Assurance;
use App\Models\MonitoringPayment;
use App\Models\MonitoringWork;
use App\Models\MonitoringContract;

class MonitoringHelper
{
    public static function save_work($user_id, $procurement_id, $data)
    {
        $item                   = new MonitoringWork;

        if($data['id'] != null) {
            $item               = MonitoringWork::find($data['id']);
        }

        if($data['ba_date'] != null) {
            $ba_date = explode('-', $data['ba_date']);
            if(count($ba_date) > 1){
                $r_year         = $ba_date[0];
                $r_month        = $ba_date[1];
                $r_day          = $ba_date[2];
                $item->ba_date  = Carbon::create($r_year, $r_month, $r_day, 0, 0, 0);
            }
        }

        $item->user_id          = $user_id;
        $item->procurement_id   = $procurement_id;
        $item->notes            = $data['notes'];
        $item->ba_number        = $data['ba_number'];
        $item->percentage       = $data['percentage'];
        $item->save();

        return $item->id;
    }

    public static function save_payment($user_id, $procurement_id, $data)
    {
        $item                   = new MonitoringPayment;

        if($data['id'] != null) {
            $item               = MonitoringPayment::find($data['id']);
        }

        if($data['ba_date'] != null) {
            $ba_date = explode('-', $data['ba_date']);
            if(count($ba_date) > 1){
                $r_year         = $ba_date[0];
                $r_month        = $ba_date[1];
                $r_day          = $ba_date[2];
                $item->ba_date  = Carbon::create($r_year, $r_month, $r_day, 0, 0, 0);
            }
        }

        $item->user_id          = $user_id;
        $item->procurement_id   = $procurement_id;
        $item->notes            = $data['notes'];
        $item->ba_number        = $data['ba_number'];
        $item->step             = $data['step'];
        $item->amount           = $data['amount'];
        $item->save();

        return $item->id;
    }

    public static function save_assurance($user_id, $procurement_id, $data, $type_id = -1)
    {
        $item                       = new Assurance;

        if($data['id'] != null) {
            $item                   = Assurance::find($data['id']);
        }

        if($data['start_date'] != null) {
            $start_date = explode('-', $data['start_date']);
            if(count($start_date) > 1){
                $r_year             = $start_date[0];
                $r_month            = $start_date[1];
                $r_day              = $start_date[2];
                $item->start_date   = Carbon::create($r_year, $r_month, $r_day, 0, 0, 0);
            }
        }

        if($data['end_date'] != null) {
            $end_date = explode('-', $data['end_date']);
            if(count($end_date) > 1){
                $e_year             = $end_date[0];
                $e_month            = $end_date[1];
                $e_day              = $end_date[2];
                $item->end_date     = Carbon::create($e_year, $e_month, $e_day, 0, 0, 0);
            }
        }

        $item->user_id              = $user_id;
        $item->procurement_id       = $procurement_id;
        $item->notes                = $data['notes'];
        $item->amount               = $data['amount'];

        if($type_id > -1) {
          $item->type_id            = $type_id;
        } else {
          if(array_key_exists('type_id', $data)) {
            $item->type_id          = $data['type_id'];
          }
        }

        if(array_key_exists('phase', $data)) {
            $item->phase            = $data['phase'];
        }

        $item->save();

        return $item->id;
    }

    public static function save_contract($user_id, $procurement_id, $data)
    {
        $item                       = MonitoringContract::where('procurement_id', $procurement_id)->first();

        if($item == null) {
            $item                   = new MonitoringContract;
            $item->procurement_id   = $procurement_id;
        }
        //echo $data['doc_date'];
        if($data['doc_date'] != null) {
            $doc_date = explode('-', $data['doc_date']);
            if(count($doc_date) > 1){
                $d_year             = $doc_date[0];
                $d_month            = $doc_date[1];
                $d_day              = $doc_date[2];
                $item->doc_date     = Carbon::create($d_year, $d_month, $d_day, 0, 0, 0);
            }
        }

        if($data['start_date'] != null) {
            $start_date = explode('-', $data['start_date']);
            if(count($start_date) > 1){
                $r_year             = $start_date[0];
                $r_month            = $start_date[1];
                $r_day              = $start_date[2];
                $item->start_date   = Carbon::create($r_year, $r_month, $r_day, 0, 0, 0);
            }
        }

        if($data['end_date'] != null) {
            $end_date = explode('-', $data['end_date']);
            if(count($end_date) > 1){
                $e_year             = $end_date[0];
                $e_month            = $end_date[1];
                $e_day              = $end_date[2];
                $item->end_date     = Carbon::create($e_year, $e_month, $e_day, 0, 0, 0);
            }
        }

        $item->user_id              = $user_id;
        $item->notes                = $data['notes'];
        $item->kind_id              = $data['kind_id'];
        $item->doc_number           = $data['doc_number'];
        $item->addendum             = $data['addendum'];
        $item->save();

        return $item->id;
    }

    public static function save_rating($user_id, $procurement_id, $data)
    {
        $item                       = Rating::where('procurement_id', $procurement_id)->first();

        if($item == null) {
            $item                   = new Rating;
            $item->procurement_id   = $procurement_id;
        }

        
        $delivery                   = $data['delivery'];
        $quality                    = $data['quality'];
        $case                       = $data['case'];
        $rate                       = ($delivery + $quality + $case) / 3;

        $item->delivery             = $delivery;
        $item->quality              = $quality;
        $item->case                 = $case;
        $item->rate                 = $rate;
        $item->vendor_id            = $data['vendor_id'];

        $item->save();

        return $item->id;
    }
}
