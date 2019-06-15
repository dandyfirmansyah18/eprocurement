<?php // Company Helper

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\CompanyRegistration;

class CompanyRegistrationHelper
{
    public static function save_data($company_id, $data)
    {
        try {
        	$registration = CompanyRegistration::where('company_id', $company_id)->first();
        	
        	if($registration == null) {
        		$registration             = new CompanyRegistration;
        		$registration->company_id = $company_id;
        	}

            $registration->registration_number  = $data['registration_number'];
            $registration->licensor             = $data['licensor'];

            if($data['release_date'] != null) {
                $release_date = explode('/', $data['release_date']);
                if(count($release_date) > 1){
                    $r_year                     = $release_date[2];
                    $r_month                    = $release_date[1];
                    $r_day                      = $release_date[0];
                    $registration->release_date = Carbon::create($r_year, $r_month, $r_day, 0, 0, 0);
                }
            }

            if(array_key_exists('expired_date', $data)) {
                $expired_date = explode('/', $data['expired_date']);
                if(count($expired_date) > 1){
                    $e_year                     = $expired_date[2];
                    $e_month                    = $expired_date[1];
                    $e_day                      = $expired_date[0];
                    $registration->expired_date = Carbon::create($e_year, $e_month, $e_day, 0, 0, 0);
                } 
            }

        	$registration->save();

        	return $registration->id;
        }
        catch(\Exception $e) {
            return 0;
        }
    }
}