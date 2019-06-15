<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermitSKDP extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permit_skdp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'document_number',
        'document_date'
    ];

    /**
     * The attributes that are custom assigned.
     *
     * @var array
     */

    /**
     * Table relationship.
     *
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
