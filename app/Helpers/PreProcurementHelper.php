<?php // PreProcurement Helper

namespace App\Helpers;

use App\Models\PreProcurement;
use App\Models\Enrollment;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use App\Helpers\ActivityHelper;

class PreProcurementHelper
{

    public static function save_data($data)
    {
        $new_item                           = false;
        $item                               = PreProcurement::where('id', $data['id'])
                                                                ->first();
        if($item == null){
            $item                           = new PreProcurement;
            $item->user_id                  = $data['user_id'];
            $new_item                       = true;
        }

        $item->procurement_method           = $data['procurement_method'];
        $item->procurement_qualification    = $data['procurement_qualification'];
        $item->vendor                       = json_encode($data['vendorlist']);
        $item->title                        = $data['title'];
        $item->amount                       = $data['amount'];
        $item->memo_number                  = $data['memo_number'];
        $item->issuance_number              = $data['issuance_number'];
        $item->notes                        = $data['notes'];
        $item->justification                = $data['justification'];

        if($data['start_date'] != null) {
          $start_date = explode('/', $data['start_date']);
          if(count($start_date) > 1){
              $s_year                   = $start_date[2];
              $s_month                  = $start_date[1];
              $s_day                    = $start_date[0];
              $item->start_date      = Carbon::create($s_year, $s_month, $s_day, 0, 0, 0);
          }
        }

        if($data['memo_date'] != null) {
          $memo_date = explode('/', $data['memo_date']);
          if(count($memo_date) > 1){
              $m_year                   = $memo_date[2];
              $m_month                  = $memo_date[1];
              $m_day                    = $memo_date[0];
              $item->memo_date      = Carbon::create($m_year, $m_month, $m_day, 0, 0, 0);
          }
        }

        if($data['issuance_date'] != null) {
          $issuance_date = explode('/', $data['issuance_date']);
          if(count($issuance_date) > 1){
              $i_year                   = $issuance_date[2];
              $i_month                  = $issuance_date[1];
              $i_day                    = $issuance_date[0];
              $item->issuance_date      = Carbon::create($i_year, $i_month, $i_day, 0, 0, 0);
          }
        }

        $item->with_back_date               = array_key_exists('with_back_date', $data) && $data['with_back_date'] != null;

        if(array_key_exists('pre_notes', $data) && $item->procurement_qualification == 1) {
            $item->pre_notes                = $data['pre_notes'];
        }

        if($item->with_back_date && $data['back_date'] != null) {
          $back_date = explode('/', $data['back_date']);
          if(count($back_date) > 1){
              $b_year                   = $back_date[2];
              $b_month                  = $back_date[1];
              $b_day                    = $back_date[0];
              $item->back_date          = Carbon::create($b_year, $b_month, $b_day, 0, 0, 0);
          }
        }

      	$item->save();

        if($new_item) {
            //Create Activity Log
            $user = Auth::user();
            $logdata['entity_type']   = 'planning';
            $logdata['entity_id']     = $item->id;
            $logdata['user_id']       = $user->id;
            $logdata['action']        = 'new';
            $logdata['previous_value']= '';
            $logdata['new_value']     = '';
            $logdata['changed_field'] = '';

            $log_id = ActivityHelper::write_log($logdata);
        }

        if(!$new_item && $item->procurement_method < 3) {
            EnrollmentHelper::clear($item->id);
        }

      	return $item->id;
    }

    public static function verify($data)
    {
        $item = PreProcurement::where('id', $data['id'])->first();

        $item->verification_by      = $data['verification_by']->id;
        $item->verification_date    = Carbon::now();
        $item->verification_note    = $data['verification_note'];
        $item->verified             = 1;
        $item->start_approval       = 1;
        $item->proposed = 1;

        $item->save();

        //Create Activity Log
        $user = Auth::user();
        $logdata['entity_type']   = 'planning';
        $logdata['entity_id']     = $item->id;
        $logdata['user_id']       = $user->id;
        $logdata['action']        = 'verified';
        $logdata['previous_value']= '';
        $logdata['new_value']     = '';
        $logdata['changed_field'] = '';

        $log_id = ActivityHelper::write_log($logdata);

        return $item->id;
    }

    public static function askverify($data)
    {
        $item = PreProcurement::where('id', $data['id'])->first();

        $item->verified             = -1;

        $item->save();

        //Create Activity Log
        /*
        $user = Auth::user();
        $logdata['entity_type']   = 'planning';
        $logdata['entity_id']     = $item->id;
        $logdata['user_id']       = $user->id;
        $logdata['action']        = 'toVerify';
        $logdata['previous_value']= '';
        $logdata['new_value']     = '';
        $logdata['changed_field'] = '';

        $log_id = ActivityHelper::write_log($logdata);
        */

        return $item->id;
    }

    public static function start_approval($data)
    {
        $item = PreProcurement::where('id', $data['id'])->first();

        $item->start_approval = 1;

        $item->save();

        //Create Activity Log
        /*
        $user = Auth::user();
        $logdata['entity_type']   = 'planning';
        $logdata['entity_id']     = $item->id;
        $logdata['user_id']       = $user->id;
        $logdata['action']        = 'start_approval';
        $logdata['previous_value']= '';
        $logdata['new_value']     = '';
        $logdata['changed_field'] = '';

        $log_id = ActivityHelper::write_log($logdata);
        */

        return $item->id;
    }

    public static function planning_stage($data)
    {
        $item = PreProcurement::where('id', $data['id'])->first();

        $item->planning_stage = $data['stage'];

        $item->save();

        return $item->id;
    }

    public static function revert_start($id)
    {
        $item = PreProcurement::where('id', $id)->first();

        $item->start_approval   = 0;
        $item->verified         = 0;

        $item->save();

        return $item->id;
    }

    public static function procurement($id)
    {
        // dd('die');
        $item = PreProcurement::find($id);
        $item->proposed = 1;
        $item->save();
        
        return $item->id;

    }

    public static function set_qualification($data)
    {
        $item                                = PreProcurement::find($data['id']);

        $item->procurement_qualification    = $data['qualification'];
        $item->delivery_method              = $data['delivery'];

        if(array_key_exists('pre_notes', $data) && $item->procurement_qualification == 1) {
            $item->pre_notes                = $data['pre_notes'];
        } else {
            $item->pre_notes                = null;
        }

        $item->save();

        return $item->id;
    }

    public static function set_listed($id)
    {
        $listed_count           = PreProcurement::where('listed', true)->count();
        $item                   = PreProcurement::find($id);
        $item->procurement_id   = $listed_count + 1;
        $item->listed           = true;
        $item->save();

        return $item->id;
    }

    public static function set_worked($id)
    {
        $item           = PreProcurement::find($id);
        $item->worked   = true;
        $item->save();

        return $item->id;
    }

    public static function set_winer($id, $data)
    {
        $result         = false;
        $items          = Enrollment::where('procurement_id', $id)->get();

        if($items != null && count($items) > 0 && count($data['counter_id']) > 0) {
            foreach ($data['counter_id'] as $index) {
                $vendor_id      = intval($data['vendor_id'][$index]);
                $notes          = $data['notes'][$index];
                $chosen         = array_key_exists('chosen', $data) && array_key_exists($index, $data['chosen']);

                $item           = $items->where('vendor_id', $vendor_id)->first();
                $item->notes    = $notes;
                $item->winner   = $chosen;
                $item->save();

                $result         = true;
            }
        }

        return $result;
    }
}
