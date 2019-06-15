<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDivision extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_divisions';

    /**
     * Table relationship.
     *
     */
    public function units()
    {
        return $this->hasMany('App\Models\UserUnit', 'division_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\UserDepartment', 'department_id', 'id');
    }
}
