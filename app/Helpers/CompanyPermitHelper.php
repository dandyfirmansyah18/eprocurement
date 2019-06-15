<?php // Company Helper

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\CompanyPermit;
use App\Models\PermitSIUP;
use App\Models\PermitIUJK;
use App\Models\PermitSIUI;
use App\Models\PermitSKKemenkumham;
use App\Models\PermitSKDP;

class CompanyPermitHelper
{
    public static function save_data($company_id, $data)
    {
        try {
        	$permit = CompanyPermit::where('company_id', $company_id)->first();

        	if($permit == null) {
        		$permit               = new CompanyPermit;
        		$permit->company_id   = $company_id;
        	}

        	$permit->type_id            = intval($data['type_id']);
            $permit->document_number    = $data['document_number'];
            $permit->licensor           = $data['licensor'];

            if($data['release_date'] != null) {
                $release_date = explode('/', $data['release_date']);
                if(count($release_date) > 1){
                    $r_year                 = $release_date[2];
                    $r_month                = $release_date[1];
                    $r_day                  = $release_date[0];
                    $permit->release_date   = Carbon::create($r_year, $r_month, $r_day, 0, 0, 0);
                }
            }

            if(array_key_exists('expired_date', $data)) {
                $expired_date = explode('/', $data['expired_date']);
                if(count($expired_date) > 1){
                    $e_year                 = $expired_date[2];
                    $e_month                = $expired_date[1];
                    $e_day                  = $expired_date[0];
                    $permit->expired_date   = Carbon::create($e_year, $e_month, $e_day, 0, 0, 0);
                }
            }

        	$permit->save();

        	return $permit->id;
        }
        catch(\Exception $e) {
            return 0;
        }
    }

    public static function save_siup($company_id, $data)
    {
        try {
            $sub_business = '';
            $sub_business_siup_other = '';

        	$item                   = PermitSIUP::where('company_id', $company_id)->first();

        	if($item == null) {
        		$item               = new PermitSIUP;
        		$item->company_id   = $company_id;
        	}

        	$item->type_id          = intval($data['type_id']);
            $item->document_number  = $data['document_number'];
            $item->licensor         = $data['licensor'];

            if($data['release_date'] != null) {
                $item->release_date = DateHelper::parse_from_datepicker($data['release_date']);
            }

            if(array_key_exists('expired_date', $data) && $data['expired_date'] != null) {
                $item->expired_date = DateHelper::parse_from_datepicker($data['expired_date']);
            }

            if(array_key_exists('sub_business', $data)) {
                $sub_business = '';
                foreach ($data['sub_business'] as $key => $value) {
                    if($key == count($data['sub_business']) - 1){
                        $sub_business .= $value;
                    }else{
                        $sub_business .= $value . ', ';
                    }
                }
            }

            if (array_key_exists('sub_business_siup_other_cb', $data)) {
                $sub_business_siup_other = $data['sub_business_siup_other'];
                $sub_business = '';
            }

            $item->sub_business = $sub_business;
            $item->sub_business_siup_other = $sub_business_siup_other;
        	$item->save();

        	return $item->id;
        }
        catch(\Exception $e) {
            \Log::error(print_r($e->getMessage(), true));
        }
    }

    public static function save_iujk($company_id, $data)
    {
        try {
            $sub_business = '';
            $sub_business_iujk_other = '';
        	$item                   = PermitIUJK::where('company_id', $company_id)->first();

        	if($item == null) {
        		$item               = new PermitIUJK;
        		$item->company_id   = $company_id;
        	}

        	$item->type_id          = intval($data['type_id']);
            $item->document_number  = $data['document_number'];
            $item->licensor         = $data['licensor'];

            if($data['release_date'] != null) {
                $item->release_date = DateHelper::parse_from_datepicker($data['release_date']);
            }

            if(array_key_exists('expired_date', $data) && $data['expired_date'] != null) {
                $item->expired_date = DateHelper::parse_from_datepicker($data['expired_date']);
            }

            if(array_key_exists('sub_business', $data)) {
                $sub_business = '';
                foreach ($data['sub_business'] as $key => $value) {
                    if($key == count($data['sub_business']) - 1){
                        $sub_business .= $value;
                    }else{
                        $sub_business .= $value . ', ';
                    }
                }
            }

            if (array_key_exists('sub_business_iujk_other_cb', $data)) {
                $sub_business_iujk_other = $data['sub_business_iujk_other'];
                $sub_business = '';
            }

            $item->sub_business = $sub_business;
            $item->sub_business_iujk_other = $sub_business_iujk_other;
        	$item->save();

        	return $item->id;
        }
        catch(\Exception $e) {
            \Log::error(print_r($e->getMessage(), true));
        }
    }

    public static function save_siui($company_id, $data)
    {
        try {
        	$item                   = PermitSIUI::where('company_id', $company_id)->first();

        	if($item == null) {
        		$item               = new PermitSIUI;
        		$item->company_id   = $company_id;
        	}

            $item->document_number  = $data['document_number'];
            $item->licensor         = $data['licensor'];

            if($data['release_date'] != null) {
                $item->release_date = DateHelper::parse_from_datepicker($data['release_date']);
            }

            if(array_key_exists('expired_date', $data) && $data['expired_date'] != null) {
                $item->expired_date = DateHelper::parse_from_datepicker($data['expired_date']);
            }

        	$item->save();

        	return $item->id;
        }
        catch(\Exception $e) {
            \Log::error(print_r($e->getMessage(), true));
        }
    }

    public static function save_sk_kemenkumham($company_id, $data)
    {
        try {
            $item                   = PermitSKKemenkumham::where('company_id', $company_id)->first();

            if($item == null) {
                $item               = new PermitSKKemenkumham;
                $item->company_id   = $company_id;
            }

            $item->document_number              = $data['document_number'];
            $item->document_number_perubahan    = $data['document_number_perubahan'];
            $item->save();

            return $item->id;
        }
        catch(\Exception $e) {
            \Log::error(print_r($e->getMessage(), true));
        }
    }

    public static function save_skdp($company_id, $data)
    {
        try {
            $item                   = PermitSKDP::where('company_id', $company_id)->first();

            if($item == null) {
                $item               = new PermitSKDP;
                $item->company_id   = $company_id;
            }

            $item->document_number              = $data['document_number'];
            if($data['document_date'] != null) {
                $item->document_date = DateHelper::parse_from_datepicker($data['document_date']);
            }
            $item->save();

            return $item->id;
        }
        catch(\Exception $e) {
            \Log::error(print_r($e->getMessage(), true));
        }
    }
}
