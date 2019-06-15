<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'assessments';


    /**
     * Table relationship.
     *
     */
    public function vendor()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
