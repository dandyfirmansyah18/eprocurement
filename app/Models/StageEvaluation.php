<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StageEvaluation extends Model
{
    protected $appends = ['score'];

    public function enrollment()
    {
        return $this->belongsTo('App\Models\Enrollment', 'enrollment_id', 'id');
    }

    public function techevs()
    {
        return $this->hasMany('App\Models\TechnicalEvaluation', 'evaluation_id');
    }

    public function getScoreAttribute()
    {
        if($this->max_score > 0) {
            $raw_score  = (($this->monev_score + $this->techev_score) / $this->max_score) * 100;
            $score      = ceil($raw_score);
            return $score;
        } else {
            return '';
        }
    }
}
