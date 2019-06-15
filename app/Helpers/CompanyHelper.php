<?php // Company Helper

namespace App\Helpers;

use App\Models\Company;
use App\Models\User;
use App\Helpers\UserHelper;

class CompanyHelper
{
    public static function save_data($user_id, $data)
    {
        $province_id                = 0;
        $city_id                    = 0;
    	$postal_code                = 0;
        $postal_code_other          = 0;
        $branch_province_id         = 0;
        $branch_city_id             = 0;
        $branch_postal_code         = 0;
        $branch_postal_code_other   = 0;
        $with_branch                = 0;
        $type_id                    = 0;
        $classification_id          = 0;
        $operational_postal_code_other = 0;

    	if(array_key_exists('province_id', $data)) {
    		$province_id = intval($data['province_id']);
    	}

        if(array_key_exists('city_id', $data)) {
            $city_id = $data['city_id'];
        }

        if(array_key_exists('postal_code', $data)) {
            $postal_code = $data['postal_code'];
        }

        if (array_key_exists('lainnya_postal_code', $data)) {
            $postal_code_other = $data['postal_code_other'];
            $postal_code = 0;
        }

        if(array_key_exists('branch_province_id', $data)) {
            $branch_province_id = intval($data['branch_province_id']);
        }

        if(array_key_exists('branch_city_id', $data)) {
            $branch_city_id = $data['branch_city_id'];
        }

        if(array_key_exists('branch_postal_code', $data)) {
            $branch_postal_code = $data['branch_postal_code'];
        }

        if (array_key_exists('lainnya_branch_postal_code', $data)) {
            $branch_postal_code_other = $data['branch_postal_code_other'];
            $branch_postal_code = 0;
        }

        if(array_key_exists('operational_province_id', $data)) {
            $operational_province_id = intval($data['operational_province_id']);
        }

        if(array_key_exists('operational_city_id', $data)) {
            $operational_city_id = $data['operational_city_id'];
        }

        if(array_key_exists('operational_postal_code', $data)) {
            $operational_postal_code = $data['operational_postal_code'];
        }

        if (array_key_exists('lainnya_operational_postal_code', $data)) {
            $operational_postal_code_other = $data['operational_postal_code_other'];
            $operational_postal_code = 0;
        }

    	if(array_key_exists('with_branch', $data)) {
    		$with_branch = intval($data['with_branch']);
    	}

    	if(array_key_exists('type_id', $data)) {
    		$type_id = intval($data['type_id']);
    	}

        if(array_key_exists('classification_id', $data)) {
            $klasifikasi = '';
            foreach ($data['classification_id'] as $key => $value) {
                $klasifikasi .= $value.'|';
            }
            $classification_id = $klasifikasi;
        }

    	$company = Company::where('user_id', $user_id)->first();

    	if($company == null) {
    		$company          = new Company;
    		$company->user_id = $user_id;
    	}

        $company->email     = $data['email'];
    	$company->name      = $data['name'];
        $company->phone     = $data['phone'];
        $company->fax       = $data['fax'];

    	$company->with_branch          = $with_branch == 1;
    	$company->type_id              = $type_id;
        $company->classification_id    = $classification_id;

        if(array_key_exists('business', $data)) {
            $bsnss = '';
            foreach ($data['business'] as $key => $value) {
                if($key == count($data['business'])-1){
                    $bsnss .= $value;
                }else{
                    $bsnss .= $value . ', ';
                }
            }
            $company->business = $bsnss;
        }

        if($with_branch == 1) {
            $company->address            = $data['address'];
            $company->postal_code        = $postal_code;
            $company->postal_code_other  = $postal_code_other;
            $company->province_id        = $province_id;
            $company->city_id            = $city_id;
            $company->branch_address     = $data['branch_address'];
            $company->branch_postal_code = $branch_postal_code;
            $company->branch_postal_code_other = $branch_postal_code_other;
            $company->branch_province_id = $branch_province_id;
            $company->branch_city_id     = $branch_city_id;
        } else {
            $company->address       = $data['branch_address'];
            $company->postal_code   = $branch_postal_code;
            $company->province_id   = $branch_province_id;
            $company->city_id       = $branch_city_id;
        }

        $company->operational_address       = $data['operational_address'];
        $company->operational_postal_code   = $operational_postal_code;
        $company->operational_postal_code_other   = $operational_postal_code_other;
        $company->operational_province_id   = $operational_province_id;
        $company->operational_city_id       = $operational_city_id;

    	$company->save();

        $user_updated   = UserHelper::set_name($user_id, $company->name);

    	return $company->id;
    }

    public static function save_update_data($user_id, $data)
    {
        $province_id                = 0;
        $city_id                    = 0;
        $postal_code                = 0;
        $postal_code_other          = 0;
        $branch_province_id         = 0;
        $branch_city_id             = 0;
        $branch_postal_code         = 0;
        $branch_postal_code_other   = 0;
        $with_branch                = 0;
        $type_id                    = 0;
        $classification_id          = 0;
        $operational_postal_code_other = 0;

        if(array_key_exists('province_id', $data)) {
            $province_id = intval($data['province_id']);
        }

        if(array_key_exists('city_id', $data)) {
            $city_id = $data['city_id'];
        }

        if(array_key_exists('postal_code', $data)) {
            $postal_code = $data['postal_code'];
        }

        if (array_key_exists('lainnya_postal_code', $data)) {
            $postal_code_other = $data['postal_code_other'];
            $postal_code = 0;
        }

        if(array_key_exists('branch_province_id', $data)) {
            $branch_province_id = intval($data['branch_province_id']);
        }

        if(array_key_exists('branch_city_id', $data)) {
            $branch_city_id = $data['branch_city_id'];
        }

        if(array_key_exists('branch_postal_code', $data)) {
            $branch_postal_code = $data['branch_postal_code'];
        }

        if (array_key_exists('lainnya_branch_postal_code', $data)) {
            $branch_postal_code_other = $data['branch_postal_code_other'];
            $branch_postal_code = 0;
        }

        if(array_key_exists('operational_province_id', $data)) {
            $operational_province_id = intval($data['operational_province_id']);
        }

        if(array_key_exists('operational_city_id', $data)) {
            $operational_city_id = $data['operational_city_id'];
        }

        if(array_key_exists('operational_postal_code', $data)) {
            $operational_postal_code = $data['operational_postal_code'];
        }

        if (array_key_exists('lainnya_operational_postal_code', $data)) {
            $operational_postal_code_other = $data['operational_postal_code_other'];
            $operational_postal_code = 0;
        }

        if(array_key_exists('with_branch', $data)) {
            $with_branch = intval($data['with_branch']);
        }

        if(array_key_exists('type_id', $data)) {
            $type_id = intval($data['type_id']);
        }

        if(array_key_exists('classification_id', $data)) {
            $klasifikasi = '';
            foreach ($data['classification_id'] as $key => $value) {
                $klasifikasi .= $value.'|';
            }
            $classification_id = $klasifikasi;
        }

        $company = Company::where('user_id', $user_id)->first();

        $company->email     = $data['email'];
        $company->name      = $data['name'];
        $company->phone     = $data['phone'];
        $company->fax       = $data['fax'];

        $company->with_branch          = $with_branch == 1;
        $company->type_id              = $type_id;
        $company->classification_id    = $classification_id;

        if(array_key_exists('business', $data)) {
            $bsnss = '';
            foreach ($data['business'] as $key => $value) {
                # code...
                if($key == count($data['business']) - 1){
                    $bsnss .= $value;
                }else{
                    $bsnss .= $value.',';
                }
            }
            $company->business = $bsnss;
        }

        if($with_branch == 1) {
            $company->address            = $data['address'];
            $company->postal_code        = $postal_code;
            $company->postal_code_other  = $postal_code_other;
            $company->province_id        = $province_id;
            $company->city_id            = $city_id;
            $company->branch_address     = $data['branch_address'];
            $company->branch_postal_code = $branch_postal_code;
            $company->branch_postal_code_other = $branch_postal_code_other;
            $company->branch_province_id = $branch_province_id;
            $company->branch_city_id     = $branch_city_id;
        } else {
            $company->address       = $data['branch_address'];
            $company->postal_code   = $branch_postal_code;
            $company->province_id   = $branch_province_id;
            $company->city_id       = $branch_city_id;
        }

        $company->operational_address       = $data['operational_address'];
        $company->operational_postal_code   = $operational_postal_code;
        $company->operational_postal_code_other   = $operational_postal_code_other;
        $company->operational_province_id   = $operational_province_id;
        $company->operational_city_id       = $operational_city_id;
        
        $company->save();

        // $user_updated   = UserHelper::set_name_and_revalidation($user_id, $company->name);

        return $company->id;
    }

    public static function active_enrollment_titles($company_id)
    {
        $items = \DB::table('enrollments as pe')
                    ->leftJoin('pre_procurements as p', 'p.id', '=' , 'pe.procurement_id')
                    ->select('pe.id as id', 'p.title as title')
                    ->where('p.worked', false)
                    ->where('pe.vendor_id', $company_id);

        return $items->get();
    }

    public static function finished_enrollment_titles($company_id)
    {
        $items = \DB::table('enrollments as pe')
                    ->leftJoin('pre_procurements as p', 'p.id', '=' , 'pe.procurement_id')
                    ->select('pe.id as id', 'p.title as title')
                    ->where('p.worked', true)
                    ->where('pe.vendor_id', $company_id);

        return $items->get();
    }

    public static function touch($user_id)
    {
        $user           = User::find($user_id);

        if($user != null) {
            $company    = Company::where('user_id', $user_id)->first();

            if($company == null) {
                $company            = new Company;
                $company->user_id   = $user_id;
                $company->email     = $user->email;
                $company->name      = $user->name;
                $company->save();
            }

            return $company->id;
        } else {
            return 0;
        }
    }
}
