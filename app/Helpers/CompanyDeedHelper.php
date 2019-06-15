<?php // Company Deed Helper

namespace App\Helpers;

use App\Models\CompanyDeed;

class CompanyDeedHelper
{
    public static function save($company_id, $data)
    {
        try {
        	$item                           = CompanyDeed::where('company_id', $company_id)->first();

        	if($item == null) {
        		$item                         = new CompanyDeed;
        		$item->company_id             = $company_id;
        	}

            $item->number                 = $data['number'];
            $item->notary                 = $data['notary'];
            $item->renewal_number         = $data['renewal_number'];
            $item->renewal_notary         = $data['renewal_notary'];

            if($data['released'] != null) {
                $item->released           = DateHelper::parse_from_datepicker($data['released']);
            }

            if($data['renewaled'] != null) {
                $item->renewaled          = DateHelper::parse_from_datepicker($data['renewaled']);
            }

            if($data['confirmed'] != null) {
                $item->confirmed          = DateHelper::parse_from_datepicker($data['confirmed']);
            }

            if($data['renewal_confirmed'] != null) {
                $item->renewal_confirmed  = DateHelper::parse_from_datepicker($data['renewal_confirmed']);
            }

        	$item->save();

        	return $item->id;
        }
        catch(\Exception $e) {
            return 0;
        }
    }
}
