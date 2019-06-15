<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    public function sender()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function recipient()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public static function company_entries($company_id)
    {
    	return Chat::where('entity_type', 'vendor')->where('entity_id', $company_id)->get();
    }
}
