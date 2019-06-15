<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attachment;

class CompanyCertificate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_certificates';


    /**
     * Table relationship.
     *
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function doc()
    {
        $file   = Attachment::company_entity($this->company_id, 'certificate_' . $this->id);
        return $file;
    }
}
