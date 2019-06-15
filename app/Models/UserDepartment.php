<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDepartment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_departments';

    /**
     * Table relationship.
     *
     */
    public function divisions()
    {
        return $this->hasMany('App\Models\UserDivision', 'department_id', 'id');
    }
}
