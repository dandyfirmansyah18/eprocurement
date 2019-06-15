<?php // Company Certificate Helper

namespace App\Helpers;

use App\Models\CompanyCertificate;

class CompanyCertificateHelper
{
    public static function save($company_id, $data)
    {
        $item               = new CompanyCertificate;
        if($data['id'] != null) {
            $item = CompanyCertificate::find($data['id']);
        }
        
        $item->company_id             = $company_id;
        $item->title                  = $data['title'];
        $item->number                 = $data['number'];
        $item->author                 = $data['author'];
        $item->type                   = $data['type'];

        if($data['release_date'] != null) {
            $item->release_date       = DateHelper::parse_from_datepicker($data['release_date']);
        }

        if($data['expired_date'] != null) {
            $item->expired_date       = DateHelper::parse_from_datepicker($data['expired_date']);
        }

        $item->save();

        return $item->id;
    }

    public static function delete_data($id)
    {
        $result = false;

        $item = CompanyCertificate::find($id);

        if($item != null) {
            $item->delete();
            $result = true;
        }

        return $result;
    }
}
