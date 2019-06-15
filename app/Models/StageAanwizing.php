<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StageAanwizing extends Model
{
    //
    protected $table = 'stage_aanwizings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'procurement_id',
        'title',
        'description'
    ];
}
