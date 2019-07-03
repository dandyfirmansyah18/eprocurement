<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'province_id',
        'postal_code',
        'phone',
        'fax',
        'with_branch',
        'type_id',
        'status',
        'qualification_id',
        'classification_id',
        'business',
        'branch_address',
        'branch_province_id',
        'branch_postal_code',
        'email'
    ];

    /**
     * The attributes that are custom assigned.
     *
     * @var array
     */
    protected $appends = ['type', 'qualification', 'branch', 'branch_print', 'business_text'];

    public function getTypeAttribute()
    {
        if($this->type_id == 1) {
            return "PT";
        } else if($this->type_id == 2) {
            return "CV";
        } else if($this->type_id == 3) {
            return "Koperasi";
        } else {
            return "Perseorangan";
        }
    }

    public function getQualificationAttribute()
    {
        $result = '-';
        $siup   = $this->siup;
        $iujk   = $this->iujk;
        if($siup != null) {
            switch ($siup->type_id) {
                case 1:
                    $result = 'Kecil';
                    break;
                case 2:
                    $result = 'Menengah';
                    break;
                case 3:
                    $result = 'Besar';
                    break;
                default:
                    break;
            }
        } else if($iujk != null) {
            switch ($iujk->type_id) {
                case 1:
                    $result = 'K1 (Kecil)';
                    break;
                case 2:
                    $result = 'K2 (Kecil)';
                    break;
                case 3:
                    $result = 'M1 (Menengah)';
                    break;
                case 4:
                    $result = 'M2 (Menengah)';
                    break;
                case 5:
                    $result = 'B (Besar)';
                    break;
                default:
                    break;
            }
        }

        return $result;
    }

    public function getBusinessTextAttribute()
    {
        if($this->business == 1) {
            return "IT";
        } else if($this->business == 2) {
            return "Konstruksi";
        } else if($this->business == 3) {
            return "Lainnya";
        } else {
            return "";
        }
    }

    public function getBranchAttribute()
    {
        if($this->with_branch == true) {
            return "Kantor Pusat dan Kantor Cabang";
        } else {
            return "Kantor Pusat";
        }
    }

    public function getBranchPrintAttribute()
    {
        if($this->with_branch == true) {
            return "Cabang";
        } else {
            return "Pusat";
        }
    }

    /**
     * Table relationship.
     *
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function branch_city()
    {
        return $this->belongsTo('App\Models\MasterCity', 'branch_province_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\MasterCity', 'province_id');
    }

    public function city_operational()
    {
        return $this->belongsTo('App\Models\MasterCity', 'operational_province_id');
    }

    /** Add By Dandy Firmansyah **/

    public function new_province()
    {
        return $this->belongsTo('App\Models\MasterProvince', 'province_id');
    }

    public function new_branch_province()
    {
        return $this->belongsTo('App\Models\MasterProvince', 'branch_province_id');
    }

    public function new_operational_province()
    {
        return $this->belongsTo('App\Models\MasterProvince', 'operational_province_id');
    }

    public function new_postal_code()
    {
        return $this->belongsTo('App\Models\MasterCity', 'postal_code');
    }

    public function new_branch_postal_code()
    {
        return $this->belongsTo('App\Models\MasterCity', 'branch_postal_code');
    }

    public function new_operational_postal_code()
    {
        return $this->belongsTo('App\Models\MasterCity', 'operational_postal_code');
    }

    /** End Add By Dandy Firmansyah **/

    public function contact()
    {
        return $this->hasOne('App\Models\CompanyContact', 'company_id');
    }

    public function attachment()
    {
        return $this->hasMany('App\Models\Attachment', 'entity_id');
    }

    public function tax()
    {
        return $this->hasOne('App\Models\CompanyTax', 'company_id');
    }

    public function permit()
    {
        return $this->hasOne('App\Models\CompanyPermit', 'company_id');
    }

    public function registration()
    {
        return $this->hasOne('App\Models\CompanyRegistration', 'company_id');
    }

    public function deed()
    {
        return $this->hasOne('App\Models\CompanyDeed', 'company_id');
    }

    public function certificates()
    {
        return $this->hasMany('App\Models\CompanyCertificate', 'company_id');
    }

    public function projects()
    {
        return $this->hasMany('App\Models\CompanyProject', 'company_id');
    }

    public function experiences()
    {
        return $this->hasMany('App\Models\CompanyExperience', 'company_id');
    }

    public function persons()
    {
        return $this->hasMany('App\Models\CompanyPersonnel', 'company_id');
    }

    public function holders()
    {
        return $this->hasMany('App\Models\CompanyStackholder', 'company_id');
    }

    public function employees()
    {
        return $this->hasMany('App\Models\CompanyEmployee', 'company_id');
    }

    public function assessment()
    {
        return $this->hasOne('App\Models\Assessment', 'vendor_id');
    }

    public function enrollments()
    {
        return $this->hasMany('App\Models\Enrollment', 'vendor_id');
    }

    // Company Permits
    public function siup()
    {
        return $this->hasOne('App\Models\PermitSIUP', 'company_id');
    }

    public function iujk()
    {
        return $this->hasOne('App\Models\PermitIUJK', 'company_id');
    }

    public function siui()
    {
        return $this->hasOne('App\Models\PermitSIUI', 'company_id');
    }

    public function sk_kemenkumham()
    {
        return $this->hasOne('App\Models\PermitSKKemenkumham', 'company_id');
    }

    public function skdp()
    {
        return $this->hasOne('App\Models\PermitSKDP', 'company_id');
    }

    // Custom Renderer
    public function render_tabinformation_icon()
    {
        $assessment = $this->assessment;
        if($assessment != null && $assessment->company_data && $assessment->contact_data) {
            return '<i class="fa fa-check-circle fa-lg text-success" data-toggle="tooltip" data-placement="top" title="Terverifikasi"></i>';
        } else {
            return '<i class="fa fa-ban fa-lg text-danger"  data-toggle="tooltip" data-placement="top" title="Belum diverifikasi"></i>';
        }

        // return '<i class="fa fa-exclamation-triangle fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Perlu verifikasi ulang, terdapat perubahan data oleh penyedia"></i>';
    }

    public function render_tabadministration_icon()
    {
        $assessment = $this->assessment;
        $deed = $this->deed;
        if ($this->type_id == '4') {
            if($assessment != null && $assessment->tax && $assessment->spkmp) {
                return '<i class="fa fa-check-circle fa-lg text-success" data-toggle="tooltip" data-placement="top" title="Terverifikasi"></i>';
            } else {
                return '<i class="fa fa-ban fa-lg text-danger"  data-toggle="tooltip" data-placement="top" title="Belum diverifikasi"></i>';
            }
        }else{
            if ($deed->renewal_number) {
                if($assessment != null && $assessment->tax && $assessment->permit && $assessment->registration && $assessment->deed_establishment && $assessment->deed_renewal 
                    && $assessment->balance && $assessment->spkmp) {
                    return '<i class="fa fa-check-circle fa-lg text-success" data-toggle="tooltip" data-placement="top" title="Terverifikasi"></i>';
                } else {
                    return '<i class="fa fa-ban fa-lg text-danger"  data-toggle="tooltip" data-placement="top" title="Belum diverifikasi"></i>';
                }
            }else{
                if($assessment != null && $assessment->tax && $assessment->permit && $assessment->registration && $assessment->deed_establishment && 
                    $assessment->balance && $assessment->spkmp) {
                    return '<i class="fa fa-check-circle fa-lg text-success" data-toggle="tooltip" data-placement="top" title="Terverifikasi"></i>';
                } else {
                    return '<i class="fa fa-ban fa-lg text-danger"  data-toggle="tooltip" data-placement="top" title="Belum diverifikasi"></i>';
                }
            }
            
        }

        // return '<i class="fa fa-exclamation-triangle fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Perlu verifikasi ulang, terdapat perubahan data oleh penyedia"></i>';
    }

    public function render_tabother_icon()
    {
        $assessment = $this->assessment;
        if($assessment != null && $assessment->certificates && $assessment->experiences) {
            return '<i class="fa fa-check-circle fa-lg text-success" data-toggle="tooltip" data-placement="top" title="Terverifikasi"></i>';
        } else {
            return '<i class="fa fa-ban fa-lg text-danger"  data-toggle="tooltip" data-placement="top" title="Belum diverifikasi"></i>';
        }

        // return '<i class="fa fa-exclamation-triangle fa-lg text-warning" data-toggle="tooltip" data-placement="top" title="Perlu verifikasi ulang, terdapat perubahan data oleh penyedia"></i>';
    }
}
