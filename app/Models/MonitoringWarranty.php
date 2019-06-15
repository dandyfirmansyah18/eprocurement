<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringWarranty extends Model
{
    public function doc()
    {
        return Attachment::monitoring_entity('warranty', $this->id);   
    }
}
