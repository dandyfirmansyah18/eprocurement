<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'measurements';


    /**
     * Table relationship.
     *
     */
    public function procurement()
    {
        return $this->belongsTo('App\Models\PreProcurement', 'procurement_id');
    }
}
