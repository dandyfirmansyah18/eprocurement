<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringContract extends Model
{
    public function doc()
    {
        return Attachment::monitoring_entity('contract', $this->id);   
    }

    public function addendum_doc()
    {
        return Attachment::monitoring_entity('addendum', $this->id);   
    }
}
