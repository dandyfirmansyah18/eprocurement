<?php // Company Helper

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\CompanyTax;
use App\Models\User;

class CompanyTaxHelper
{
    public static function save_data($user_id, $company_id, $data)
    {
        try{
        	$tax = CompanyTax::where('company_id', $company_id)->first();
        	
        	if($tax == null) {
        		$tax              = new CompanyTax;
        		$tax->company_id  = $company_id;
        	}

        	$tax->taxpayer_number           = $data['taxpayer_number'];
            $tax->last_satisfactionnumber   = $data['last_satisfactionnumber'];
            $tax->last_satisfactionnumber_kedua   = $data['last_satisfactionnumber_kedua'];
            // $tax->last_trimonthlynumber     = $data['last_trimonthlynumber'];
            $tax->sppkpnumber               = $data['sppkpnumber'];
            $tax->sktnumber                 = $data['sktnumber'];

            if($data['release_date'] != null) {
                $release_date = explode('/', $data['release_date']);
                if(count($release_date) > 1){
                    $r_year                     = $release_date[2];
                    $r_month                    = $release_date[1];
                    $r_day                      = $release_date[0];
                    $tax->release_date = Carbon::create($r_year, $r_month, $r_day, 0, 0, 0);
                }
            }

            if(array_key_exists('expired_date', $data)) {
                $expired_date = explode('/', $data['expired_date']);
                if(count($expired_date) > 1){
                    $e_year                     = $expired_date[2];
                    $e_month                    = $expired_date[1];
                    $e_day                      = $expired_date[0];
                    $tax->expired_date = Carbon::create($e_year, $e_month, $e_day, 0, 0, 0);
                }
            }

        	$tax->save();

            $user                   = User::find($user_id);
            $user->taxpayer_number  = $data['taxpayer_number'];
            $user->save();

        	return $tax->id;
        }
        catch(\Exception $e) {
            return 0;
        }
    }
}