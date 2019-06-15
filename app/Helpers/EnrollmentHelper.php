<?php // Company Helper

namespace App\Helpers;

use App\Models\Enrollment;

class EnrollmentHelper
{
    public static function clear($preprocurement_id)
    {
        $removed_current_items  = Enrollment::where('procurement_id', $preprocurement_id)->delete();

        return true;
    }

    public static function company_save($data, $preprocurement_id)
    {
        $removed_current_items      = Enrollment::where('procurement_id', $preprocurement_id)->delete();

        foreach ($data['vendorlist'] as $key => $value) {
                $item                   = new Enrollment;
                $item->vendor_id        = $value;
                $item->procurement_id   = $preprocurement_id;

                $item->save();
        }

        return $preprocurement_id;
    }

    public static function save($preprocurement_id, $vendor_id)
    {
        $item                       = new Enrollment;
        $item->vendor_id            = $vendor_id;
        $item->procurement_id       = $preprocurement_id;

        $item->save();

        return $item->id;
    }
}
