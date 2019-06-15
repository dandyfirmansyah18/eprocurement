<?php // Assessment Helper

namespace App\Helpers;

use App\Models\Company;
use App\Models\Assessment;

class AssessmentHelper
{
    public static function vendor_save($company_id, $part, $checked)
    {
        $company                                        = Company::find($company_id);
        $value                                          = $checked == 1;

        if($company != null) {
            $assessment                                 = $company->assessment;
            if($assessment == null) {
                $assessment                             = new Assessment;
                $assessment->vendor_id                  = $company->id;
            }

            switch ($part) {
                case 'company_data':
                    $assessment->company_data           = $value;
                    break;
                case 'contact_data':
                    $assessment->contact_data           = $value;
                    break;
                case 'tax':
                    $assessment->tax                    = $value;
                    break;
                case 'permit':
                    $assessment->permit                 = $value;
                    break;
                case 'registration':
                    $assessment->registration           = $value;
                    break;
                case 'deed_establishment':
                    $assessment->deed_establishment     = $value;
                    break;
                case 'deed_renewal':
                    $assessment->deed_renewal           = $value;
                    break;
                case 'balance':
                    $assessment->balance                = $value;
                    break;
                case 'managers':
                    $assessment->managers               = $value;
                    break;
                case 'stakeholders':
                    $assessment->stakeholders           = $value;
                    break;
                case 'personnels':
                    $assessment->personnels             = $value;
                    break;
                case 'experiences':
                    $assessment->experiences            = $value;
                    break;
                case 'projects':
                    $assessment->projects               = $value;
                    break;
                case 'certificates':
                    $assessment->certificates           = $value;
                    break;
                case 'spkmp':
                    $assessment->spkmp                  = $value;
                    break;

                default:
                    break;
            }

            $assessment->save();
        }

        return $company;
    }

    public static function checked_all($type_id, $perlu_deed_renewal, $assessment)
    {
        $result = false;
        
        if($assessment != null) {
            if ($type_id == '4') {
                $result = $assessment->company_data && $assessment->contact_data &&
                            $assessment->tax && $assessment->experiences && 
                            $assessment->certificates && $assessment->spkmp;
            }else{
                if ($perlu_deed_renewal == '1') {
                    $result = $assessment->company_data && $assessment->contact_data &&
                                $assessment->tax && $assessment->permit &&
                                $assessment->registration && $assessment->deed_establishment &&
                                $assessment->deed_renewal && $assessment->balance &&
                                $assessment->experiences && $assessment->certificates && $assessment->spkmp;
                }else{
                    $result = $assessment->company_data && $assessment->contact_data &&
                                $assessment->tax && $assessment->permit &&
                                $assessment->registration && $assessment->deed_establishment && $assessment->balance &&
                                $assessment->experiences && $assessment->certificates && $assessment->spkmp;
                }
            }
        }

        return $result;
    }
}
