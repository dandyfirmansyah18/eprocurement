<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermitSIUP extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permit_s_i_u_ps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'type_id',
        'document_number',
        'licensor',
        'release_date',
        'expired_date',
        'sub_business'
    ];

    /**
     * The attributes that are custom assigned.
     *
     * @var array
     */
    protected $appends = ['qualification'];

    public function getQualificationAttribute()
    {
        if($this->type_id == 1) {
            return "Kecil";
        } else if($this->type_id == 2) {
            return "Menengah";
        } else if($this->type_id == 3) {
            return "Besar";
        } else {
            return "";
        }
    }

    /**
     * Table relationship.
     *
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
