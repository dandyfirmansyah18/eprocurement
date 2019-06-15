<?php // Company Helper

namespace App\Helpers;

use Carbon\Carbon;

use App\Models\CompanyPegawai;

class CompanyPegawaiHelper
{
    public static function save_data($company_id, $data)
    {
        $item               = new CompanyPegawai;
        if($data['id'] != null) {
            $item = CompanyPegawai::find($data['id']);   
        }
        
        if($item == null) {
            $item           = new CompanyPegawai;
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

        $item = CompanyPegawai::find($id);
        
        if($item != null) {
            $item->delete();
            $result = true;
        }

        return $result;
    }
}