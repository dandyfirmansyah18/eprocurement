<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    public static function company_entity($company_id, $purpose)
    {
        return Attachment::where('entity_type', 'company')
                            ->where('entity_id', $company_id)
                            ->where('purpose', $purpose)
                            ->first();
    }

    public static function preprocurement_entity($preprocurement_id, $purpose)
    {

        return Attachment::where('entity_type', 'planning')
                            ->where('entity_id', $preprocurement_id)
                            ->where('purpose', $purpose)
                            ->first();
    }

    public static function procurement_entity($procurement_id, $purpose)
    {

        return Attachment::where('entity_type', 'procurement')
                            ->where('entity_id', $procurement_id)
                            ->where('purpose', $purpose)
                            ->first();
    }

    public static function enrollment_entity($enrollment_id, $purpose = null)
    {
        if($purpose != null) {
            return Attachment::where('entity_type', 'enrollment')
                                ->where('entity_id', $enrollment_id)
                                ->where('purpose', $purpose)
                                ->first();
        } else {
            return Attachment::where('entity_type', 'enrollment')
                                ->where('entity_id', $enrollment_id)
                                ->first();
        }
    }

    public static function monitoring_entity($type, $monitoring_id)
    {

        return Attachment::where('entity_type', 'monitoring_' . $type)
                            ->where('entity_id', $monitoring_id)
                            ->first();
    }

    public static function assurance_entity($id)
    {

        return Attachment::where('entity_type', 'assurance')
                            ->where('purpose', 'id_' . $id)
                            ->first();
    }

    public static function procurement_assurance_entity($procurement_id, $id)
    {

        return Attachment::where('entity_type', 'assurance')
                            ->where('entity_id', $procurement_id)
                            ->where('purpose', 'id_' . $id)
                            ->first();
    }

    public static function certificate_entity($certificate_id, $purpose)
    {

        return Attachment::where('entity_type', 'certificate')
                            ->where('entity_id', $certificate_id)
                            ->where('purpose', $purpose)
                            ->first();
    }
}
