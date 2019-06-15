<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermitIUJK extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permit_i_u_j_ks';

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
        $result = '-';
        switch ($this->type_id) {
            case 1:
                $result = 'K1 (Kecil)';
                break;
            case 2:
                $result = 'K2 (Kecil)';
                break;
            case 3:
                $result = 'M1 (Menengah)';
                break;
            case 4:
                $result = 'M2 (Menengah)';
                break;
            case 5:
                $result = 'B (Besar)';
                break;
            default:
                break;
        }
        return $result;
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
