<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserUnit extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_units';

    /**
     * Table relationship.
     *
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'unit_id', 'id');
    }

    public function division()
    {
        return $this->belongsTo('App\Models\UserDivision', 'division_id', 'id');
    }
}
