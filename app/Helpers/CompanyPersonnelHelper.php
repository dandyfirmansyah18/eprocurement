<?php // Company Helper

namespace App\Helpers;

use Carbon\Carbon;

use App\Models\CompanyPersonnel;

class CompanyPersonnelHelper
{
    public static function save_data($company_id, $data)
    {
        $item               = new CompanyPersonnel;
        if($data['id'] != null) {
            $item = CompanyPersonnel::find($data['id']);   
        }
        
        if($item == null) {
            $item           = new CompanyPersonnel;
        }

        $item->company_id   = $company_id;
        $item->name         = $data['name'];
        $item->education    = $data['education'];
        $item->job_title    = $data['job_title'];
        $item->experience   = $data['experience'];
        $item->expertise    = $data['expertise'];

        $birth_date = explode('/', $data['birth_date']);
        if(count($birth_date) > 1){
            $e_year          = $birth_date[2];
            $e_month         = $birth_date[1];
            $e_day           = $birth_date[0];
            $item->birth_date = Carbon::create($e_year, $e_month, $e_day, 0, 0, 0);
        }

        $item->save();

        return $item->id;
    }

    public static function delete_data($id)
    {
        $result = false;

        $item = CompanyPersonnel::find($id);
        
        if($item != null) {
            $item->delete();
            $result = true;
        }

        return $result;
    }
}