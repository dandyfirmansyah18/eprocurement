<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringPayment extends Model
{
    public function doc()
    {
        return Attachment::monitoring_entity('payment', $this->id);   
    }
}
