<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterBusinessSIUP extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_business_s_i_u_ps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'title',
    ];
    
    /**
     * Table relationship.
     *
     */
    public function subs()
    {
        return $this->hasMany('App\Models\MasterBusinessSIUP', 'parent_id');
    }
}
