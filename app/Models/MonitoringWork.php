<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringWork extends Model
{
    public function doc()
    {
        return Attachment::monitoring_entity('work', $this->id);   
    }
}
