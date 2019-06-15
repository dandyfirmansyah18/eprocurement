<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StageCandidate extends Model
{
    //
    protected $table = 'stage_candidates';
    protected $primaryKey = 'id';
    protected $fillable = [
        'procurement_id',
        'title',
        'description'
    ];
}
