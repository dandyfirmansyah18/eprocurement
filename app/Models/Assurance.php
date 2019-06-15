<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assurance extends Model
{
    protected $appends = ['type'];

    // Models Relationship
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getTypeAttribute()
    {
        if($this->type_id == 0) {
            return "Jaminan Penawaran";
        } else if($this->type_id == 1) {
            return "Jaminan Sanggahan";
        } else if($this->type_id == 2) {
            return "Jaminan Pekerjaan";
        } else if($this->type_id == 3) {
            return "Jaminan Perawatan";
        } else {
            return "Lainnya";
        }
    }
}
