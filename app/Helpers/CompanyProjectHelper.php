<?php // Company Helper

namespace App\Helpers;

use Carbon\Carbon;

use App\Models\CompanyProject;

class CompanyProjectHelper
{
    public static function save_data($company_id, $data)
    {
        $item                   = new CompanyProject;
        if($data['id'] != null) {
            $item = CompanyProject::find($data['id']);   
        }
        
        if($item == null) {
            $item              = new CompanyProject;
        }

        $item->company_id       = $company_id;
        $item->name             = $data['name'];
        $item->field            = $data['field'];
        $item->location         = $data['location'];
        $item->client_name      = $data['client_name'];
        $item->client_phone     = $data['client_phone'];
        $item->contract_number  = $data['contract_number'];
        $item->contract_value   = $data['contract_value'];
        $item->progress         = $data['progress'];

        if(array_key_exists('last_progress', $data)) {
            $last_progress              = explode('/', $data['last_progress']);
            if(count($last_progress) > 1){
                $e_year                 = $last_progress[2];
                $e_month                = $last_progress[1];
                $e_day                  = $last_progress[0];
                $item->last_progress    = Carbon::create($e_year, $e_month, $e_day, 0, 0, 0);
            }
        }

        $item->save();

        return $item->id;
    }

    public static function delete_data($id)
    {
        $result = false;

        $item = CompanyProject::find($id);
        
        if($item != null) {
            $item->delete();
            $result = true;
        }

        return $result;
    }
}