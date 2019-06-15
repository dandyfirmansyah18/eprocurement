<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicalEvaluation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'technical_evaluations';


    /**
     * Table relationship.
     *
     */
    public function evaluation()
    {
        return $this->belongsTo('App\Models\StageEvaluation', 'evaluation_id', 'id');
    }
}
