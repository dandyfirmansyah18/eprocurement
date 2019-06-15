<?php // Company Helper

namespace App\Helpers;

use App\Models\CompanyContact;

class CompanyContactHelper
{
    public static function save_data($company_id, $data)
    {
        try{
        	$contact = CompanyContact::where('company_id', $company_id)->first();
        	
        	if($contact == null) {
        		$contact              = new CompanyContact;
        		$contact->company_id  = $company_id;
        	}

        	$contact->name         = $data['name'];
            $contact->job_title    = $data['job_title'];
            $contact->phone        = $data['phone'];
            $contact->handphone    = $data['handphone'];
            $contact->email        = $data['email'];
            $contact->national_id  = $data['national_id'];

            $contact->contract_signin =  array_key_exists('contract_signin', $data);
            $contact->in_bankrupt     =  array_key_exists('in_bankrupt', $data);
            $contact->real_data       =  array_key_exists('real_data', $data);

        	$contact->save();

        	return $contact->id;
        }
        catch(\Exception $e) {
            return 0;
        }
    }
}