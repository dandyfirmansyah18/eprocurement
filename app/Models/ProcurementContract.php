<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcurementContract extends Model
{
    //
    protected $table = 'procurement_contracts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'procurement_id',
        'title',
        'description'
    ];
}
