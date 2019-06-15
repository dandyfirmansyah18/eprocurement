<?php // Company Helper

namespace App\Helpers;

use Carbon\Carbon;

use App\Models\CompanyEmployee;

class CompanyEmployeeHelper
{
    public static function save_data($company_id, $data)
    {
        $item               = new CompanyEmployee;
        if($data['id'] != null) {
            $item = CompanyEmployee::find($data['id']);   
        }
        
        if($item == null) {
            $item           = new CompanyEmployee;
        }

        $item->company_id   = $company_id;
        $item->name         = $data['name'];
        $item->national_id  = $data['national_id'];
        $item->job_title    = $data['job_title'];
        
        $item->save();

        return $item->id;
    }

    public static function delete_data($id)
    {
        $result = false;

        $item = CompanyEmployee::find($id);
        
        if($item != null) {
            $item->delete();
            $result = true;
        }

        return $result;
    }
}