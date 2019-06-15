<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermitSIUI extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permit_s_i_u_is';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'document_number',
        'licensor',
        'release_date',
        'expired_date'
    ];

    /**
     * Table relationship.
     *
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
