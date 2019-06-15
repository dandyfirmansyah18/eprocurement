<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public static function preprocurement_entities($preprocurement_id)
    {

    	return Approval::where('entity_type', 'approval')
                            ->with('user')
                            ->where('entity_id', $preprocurement_id)
                            ->get()->toArray();
    }
}
