<?php // Measurement Helper

namespace App\Helpers;

use App\Models\Criterion;
use App\Models\Measurement;

class MeasurementHelper
{
    public static function save($procurement_id, $data)
    {
        try {
            $technical_value            = floatval($data['technical_value']);
            $money_value                = floatval($data['money_value']);
            $scoring                    = $data['method'] != null && $data['method'] == 'scoring';

            $item                       = Measurement::where('procurement_id', $procurement_id)->first();
            if($item == null) {
                $item                   = new Measurement;
                $item->procurement_id   = $procurement_id;
            }
            $item->evaluation           = true;
            $item->scoring              = $scoring;
            $item->technical_value      = $technical_value;
            $item->money_value          = $money_value;
            $item->evaluation_actor     = $data['user_id'];

            if($item->scoring == false) {
                $item->technical_value  = 0.7;
                $item->money_value      = 0.3;
            }

            $item->save();

            if($item->scoring == false) {
                Criterion::where('procurement_id', $procurement_id)->delete();
            }

            return $item->id;
        }
        catch(\Exception $e) {
            return 0;
        }
    }

    public static function touch($procurement_id, $data)
    {
        try {
            $technical_value            = floatval($data['technical']);
            $money_value                = floatval($data['money']);

            $item                       = Measurement::where('procurement_id', $procurement_id)->first();
            if($item == null) {
                $item                   = new Measurement;
                $item->procurement_id   = $procurement_id;
            }
            $item->scoring              = true;
            $item->technical_value      = $technical_value;
            $item->money_value          = $money_value;

            $item->save();

            return $item->id;
        }
        catch(\Exception $e) {
            return 0;
        }
    }

    public static function schedule_touch($procurement_id, $user_id)
    {
        try {
            $item                      = Measurement::where('procurement_id', $procurement_id)->first();
            if($item == null) {
                $item                  = new Measurement;
                $item->procurement_id  = $procurement_id;
            }
            $item->schedule            = true;
            $item->schedule_actor      = $user_id;

            $item->save();

            return $item->id;
        }
        catch(\Exception $e) {
            return 0;
        }
    }

    public static function criterion_save($procurement_id, $data)
    {
        try {
            $item                   = new Criterion;

            if($data['id'] != null) {
                $item               = Criterion::find($data['id']);
            }

            $item->procurement_id   = $procurement_id;
            $item->title            = $data['title'];
            $item->description      = $data['description'];

            $item->save();

            return $item->id;
        }
        catch(\Exception $e) {
            return 0;
        }
    }

    public static function instantiate()
    {
        $item                    = new Measurement;
        $item->technical_value   = 0.7;
        $item->money_value       = 0.3;

        return $item;
    }

    public static function default_value($item)
    {
        $item->technical_value   = 0.7;
        $item->money_value       = 0.3;

        return $item;
    }
}
