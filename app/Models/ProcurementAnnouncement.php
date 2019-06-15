<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcurementAnnouncement extends Model
{
    //
    protected $table = 'procurement_announcements';
    protected $primaryKey = 'id';
    protected $fillable = [
        'procurement_id',
        'activity_date',
        'location',
        'foreword'
    ];
}
