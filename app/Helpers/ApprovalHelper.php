<?php // Company Helper

namespace App\Helpers;

use App\Helpers\ActivityHelper;

use Carbon\Carbon;

use App\Models\Approval;

class ApprovalHelper
{

    public static function save_data($data)
    {
        $item = Approval::where('entity_type', $data['entity_type'])
                            ->where('entity_id', $data['entity_id'])
                            ->where('user_level', $data['user_level'])
                            ->first();

        if($item == null) {
            $item               = new Approval;
            $item->entity_type  = $data['entity_type'];
            $item->entity_id    = $data['entity_id'];
            $item->user_level   = $data['user_level'];
        }

        $item->user_id          = $data['user_id'];
        $item->notes            = $data['notes'];

        if(array_key_exists('approval_time', $data)) {
            $item->approval_time    = $data['approval_time'];
        } else {
            $item->approval_time    = Carbon::now();
        }

    	$item->save();

        switch ($data['user_level']) {
            case 1:
                $data['action'] = 'approval_1';
                # code...
                break;

            case 2:
                # code...
                $data['action'] = 'approval_2';
                break;

            case 3:
                # code...
                $data['action'] = 'approval_3';
                break;

            default:
                # code...
                break;
        }

        $data['previous_value'] = null;
        $data['new_value']      = null;
        $data['changed_field']  = null;
        $log_id = ActivityHelper::write_log($data);

    	return $item->id;
    }

    public static function reject_data($data)
    {

        $item = Approval::where('entity_type', $data['entity_type'])
                            ->where('entity_id', $data['entity_id'])
                            ->delete(); 

        switch ($data['user_level']) {
            case 1:
                $data['action'] = 'reject_1';
                # code...
                break;

            case 2:
                # code...
                $data['action'] = 'reject_2';
                break;

            case 3:
                # code...
                $data['action'] = 'reject_3';
                break;

            default:
                # code...
                break;
        }

        $data['notes']          = $data['notes'];
        $data['previous_value'] = null;
        $data['new_value']      = null;
        $data['changed_field']  = null;
        $log_id = ActivityHelper::write_log($data);

        return $data['entity_id'];
    }

    public static function vendor_rejection_notes($company_id)
    {
        $item = Approval::where('entity_type', 'vendor')
                            ->where('entity_id', $company_id)
                            ->where('user_level', 3)
                            ->first();
        if($item != null) {
            return $item->notes;
        }

        return '';
    }
}
