<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invitations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'procurement_id',
        'purpose',
        'activity_date',
        'location',
        'foreword'
    ];
}
