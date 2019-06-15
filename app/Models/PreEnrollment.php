<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreEnrollment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pre_enrollments';


    /**
     * Table relationship.
     *
     */
    public function vendor()
    {
        return $this->belongsTo('App\Models\Company', 'vendor_id');
    }

    public function procurement()
    {
       return $this->belongsTo('App\Models\PreProcurement', 'procurement_id');
    }
}
