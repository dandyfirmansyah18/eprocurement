<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $appends = ['tender', 'tender2', 'pre_tender'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'enrollments';


    /**
     * Table relationship.
     *
     */
    public function procurement()
    {
        return $this->belongsTo('App\Models\PreProcurement', 'procurement_id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\Company', 'vendor_id');
    }

    public function evaluation()
    {
        return $this->hasOne('App\Models\StageEvaluation', 'enrollment_id');
    }
    
    public function pre_evaluation()
    {
        return $this->hasOne('App\Models\PreEvaluation', 'enrollment_id');
    }

    /**
     * Custom functions.
     *
     */
    public function getTenderAttribute()
    {
        return StageTender::where('enrollment_id', $this->id)->where('type_id', 0)->first();
    }

    public function getTender2Attribute()
    {
        return StageTender::where('enrollment_id', $this->id)->where('type_id', 1)->first();
    }
    
    public function getPreTenderAttribute()
    {
        return StageTender::where('enrollment_id', $this->id)->where('type_id', 3)->first();
    }

    public function offering()
    {
        return Attachment::enrollment_entity($this->id);
    }

    public function offering2()
    {
       return Attachment::enrollment_entity($this->id, 'second');
    }
    
    public function pre_offering()
    {
        return Attachment::enrollment_entity($this->id, 'pre');
    }
}
