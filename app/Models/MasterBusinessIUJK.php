<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterBusinessIUJK extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_business_i_u_j_ks';

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
        return $this->hasMany('App\Models\MasterBusinessIUJK', 'parent_id');
    }
}
