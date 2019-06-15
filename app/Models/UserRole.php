<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role_level';

    /**
     * Table relationship.
     *
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'role_level', 'id');
    }
}
