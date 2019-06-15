<?php // Company Helper

namespace App\Helpers;

use Carbon\Carbon;

use App\Models\CompanyStackholder;

class CompanyStackholderHelper
{
    public static function save_data($company_id, $data)
    {
        $item               = new CompanyStackholder;
        if($data['id'] != null) {
            $item = CompanyStackholder::find($data['id']);   
        }
        
        if($item == null) {
            $item           = new CompanyStackholder;
        }

        $item->company_id   = $company_id;
        $item->name         = $data['name'];
        $item->national_id  = $data['national_id'];
        $item->nationality  = $data['nationality'];
        $item->address      = $data['address'];
        $item->percentage   = $data['percentage'];
        
        $item->save();

        return $item->id;
    }

    public static function delete_data($id)
    {
        $result = false;

        $item = CompanyStackholder::find($id);
        
        if($item != null) {
            $item->delete();
            $result = true;
        }

        return $result;
    }
}