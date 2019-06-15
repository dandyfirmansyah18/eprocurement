<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterProvince extends Model
{
	protected $primaryKey = 'province_code';
    public function cities()
    {
        return $this->hasMany('App\Models\MasterCity', 'province_code', 'province_code');
    }
}
