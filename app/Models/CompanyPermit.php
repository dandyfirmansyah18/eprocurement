<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyPermit extends Model
{
    protected $appends = ['type'];

    // Custom Data Getter
    public function getTypeAttribute()
    {
        if($this->type_id == 1) {
            return "IUJK";
        } else if($this->type_id == 2) {
            return "SIUP";
        } else {
            return "SIUI";
        }
    }
}
