<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StageTender extends Model
{
    //
    protected $table = 'stage_tenders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'procurement_id',
        'enrollment_id',
        'type_id',
        'download',
        'amount'
    ];
}
