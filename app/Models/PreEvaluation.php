<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreEvaluation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pre_evaluations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'enrollment_id',
        'candidate',
        'pass',
        'notes'
    ];
}
