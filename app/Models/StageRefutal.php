<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StageRefutal extends Model
{
    //
    protected $table = 'stage_refutals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'procurement_id',
        'type_id',
        'old_winner',
        'new_winner',
        'evaluation'
    ];
}
