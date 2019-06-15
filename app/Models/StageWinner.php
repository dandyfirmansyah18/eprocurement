<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StageWinner extends Model
{
    //
    protected $table = 'stage_winners';
    protected $primaryKey = 'id';
    protected $fillable = [
        'procurement_id',
        'title',
        'description',
        'announcement'
    ];
}
