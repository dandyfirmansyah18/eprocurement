<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterCity extends Model
{
    public function province()
    {
        return $this->belongsTo('App\Models\MasterProvince', 'province_code', 'province_code');
    }
}
