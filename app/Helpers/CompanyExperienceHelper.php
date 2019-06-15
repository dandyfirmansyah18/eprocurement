<?php // Company Helper

namespace App\Helpers;

use Carbon\Carbon;

use App\Models\CompanyExperience;

class CompanyExperienceHelper
{
    public static function save_data($company_id, $data)
    {
        $item                   = new CompanyExperience;
        if($data['id'] != null) {
            $item = CompanyExperience::find($data['id']);   
        }
        
        if($item == null) {
            $item              = new CompanyExperience;
        }

        $item->company_id       = $company_id;
        $item->name             = $data['name'];
        $item->field            = $data['field'];
        $item->location         = $data['location'];
        $item->client_name      = $data['client_name'];
        $item->client_phone     = $data['client_phone'];
        $item->contract_number  = $data['contract_number'];
        $item->contract_value   = $data['contract_value'];

        if(array_key_exists('contract_due', $data)) {
            $contract_due           = explode('/', $data['contract_due']);
            if(count($contract_due) > 1){
                $e_year             = $contract_due[2];
                $e_month            = $contract_due[1];
                $e_day              = $contract_due[0];
                $item->contract_due = Carbon::create($e_year, $e_month, $e_day, 0, 0, 0);
            }
        }

        if(array_key_exists('hand_over', $data)) {
            $hand_over              = explode('/', $data['hand_over']);
            if(count($contract_due) > 1){
                $e_year             = $hand_over[2];
                $e_month            = $hand_over[1];
                $e_day              = $hand_over[0];
                $item->hand_over    = Carbon::create($e_year, $e_month, $e_day, 0, 0, 0);
            }
        }

        $item->save();

        return $item->id;
    }

    public static function delete_data($id)
    {
        $result = false;

        $item = CompanyExperience::find($id);
        
        if($item != null) {
            $item->delete();
            $result = true;
        }

        return $result;
    }
}