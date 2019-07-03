<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\DateHelper;

class PreProcurement extends Model
{
    protected $appends = ['method', 'qualification', 'deliverable'];

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function verificator()
    {
    	return $this->belongsTo('App\Models\User', 'verification_by');
    }

    public function approvals()
    {
    	return $this->hasMany('App\Models\Approval', 'entity_id');
    }

    public function log()
    {
        return $this->hasMany('App\Models\ActivityLog', 'entity_id');
    }

    public function chat()
    {
        return $this->hasMany('App\Models\Chat', 'entity_id');
    }

    public function attachments()
    {
        return $this->hasMany('App\Models\Attachment', 'entity_id');
    }

    public function measurement()
    {
        return $this->hasOne('App\Models\Measurement', 'procurement_id');
    }

    public function schedule()
    {
        return $this->hasOne('App\Models\Schedule', 'procurement_id');
    }

    public function criterions()
    {
        return $this->hasMany('App\Models\Criterion', 'procurement_id');
    }

    public function enrollments()
    {
        return $this->hasMany('App\Models\Enrollment', 'procurement_id');
    }

    public function announcement()
    {
        return $this->hasOne('App\Models\ProcurementAnnouncement', 'procurement_id');
    }

    public function downloads()
    {
        return $this->hasMany('App\Models\StageDownload', 'procurement_id');
    }

    public function pre_downloads()
    {
        return $this->hasMany('App\Models\PreDownload', 'procurement_id');
    }

    public function aanwizing()
    {
        return $this->hasOne('App\Models\StageAanwizing', 'procurement_id');
    }

    public function negotiations()
    {
        return $this->hasMany('App\Models\StageNegotiation', 'procurement_id');
    }

    public function stage_tender()
    {
        return $this->hasOne('App\Models\StageTender', 'procurement_id');
    }

    public function candidate()
    {
        return $this->hasOne('App\Models\StageCandidate', 'procurement_id');
    }

    public function refutal()
    {
        return $this->hasOne('App\Models\StageRefutal', 'procurement_id');
    }

    public function winner()
    {
        return $this->hasOne('App\Models\StageWinner', 'procurement_id');
    }

    public function contract()
    {
        return $this->hasOne('App\Models\ProcurementContract', 'procurement_id');
    }

    public function assurances()
    {
        return $this->hasMany('App\Models\Assurance', 'procurement_id');
    }

    public function invitations()
    {
        return $this->hasMany('App\Models\Invitation', 'procurement_id');
    }

    public function monitoring_contract()
    {
        return $this->hasOne('App\Models\MonitoringContract', 'procurement_id');
    }

    public function monitoring_works()
    {
        return $this->hasMany('App\Models\MonitoringWork', 'procurement_id');
    }

    public function memorandums()
    {
        return $this->hasMany('App\Models\Memorandum', 'procurement_id');
    }

    public function getMethodAttribute()
    {
        if($this->procurement_method == 1) {
            return "Pelelangan/Seleksi Umum";
        } else if($this->procurement_method == 2) {
            return "Pelelangan Selektif/Seleksi Terbatas";
        } else if($this->procurement_method == 3) {
            return "Pemilihan Langsung/Seleksi Langsung";
        } else if($this->procurement_method == 4) {
            return "Penunjukan Langsung";
        } else if($this->procurement_method == 5) {
            return "Pengadaan Langsung";
        } else {
            return "-";
        }
    }

    public function getQualificationAttribute()
    {
        if($this->procurement_qualification == 1) {
            return "Pra-kualifikasi";
        } else if($this->procurement_qualification == 2) {
            return "Kualifikasi";
        } else {
            return "-";
        }
    }

    public function getDeliverableAttribute()
    {
        if($this->delivery_method == 1) {
            return "Satu sampul";
        } else if($this->delivery_method == 2) {
            return "Dua sampul";
        } else if($this->delivery_method == 3) {
            return "Dua tahap";
        } else {
            return "-";
        }
    }

    public function render_stage_icon($stage_number)
    {
        // $date_diff  = DateHelper::end_date_diff($this->schedule->a_p_explanation);
        // print_r($date_diff);die();
        if($stage_number==1){
            if($this->schedule->a_p_explanation!=null){
                $date_diff  = DateHelper::end_date_diff($this->schedule->a_p_explanation);
                if($date_diff > 0){
                    return '<i class="fa fa-circle" style=color:orange></i>&nbsp;';
                }else{
                    return '<i class="far fa-circle text-info"></i>&nbsp;';
                }
            }else{
                return '<i class="far fa-circle text-info"></i>&nbsp;';
            }
        }else if($stage_number==2){
            if($this->schedule->a_announcement!=null){
                $date_diff  = DateHelper::end_date_diff($this->schedule->a_announcement);
                if($date_diff > 0){
                    return '<i class="fa fa-circle" style=color:orange></i>&nbsp;';
                }else{
                    return '<i class="far fa-circle text-info"></i>&nbsp;';
                }
            }else{
                return '<i class="far fa-circle text-info"></i>&nbsp;';
            }
        }else if($stage_number==3){
            if($this->schedule->a_download!=null){
                $date_diff  = DateHelper::end_date_diff($this->schedule->a_download);
                if($date_diff > 0){
                    return '<i class="fa fa-circle" style=color:orange></i>&nbsp;';
                }else{
                    return '<i class="far fa-circle text-info"></i>&nbsp;';
                }
            }else{
                return '<i class="far fa-circle text-info"></i>&nbsp;';
            }
        }else if($stage_number==4){
            if($this->schedule->a_aanwizing!=null){
                $date_diff  = DateHelper::end_date_diff($this->schedule->a_aanwizing);
                if($date_diff > 0){
                    return '<i class="fa fa-circle" style=color:orange></i>&nbsp;';
                }else{
                    return '<i class="far fa-circle text-info"></i>&nbsp;';
                }
            }else{
                return '<i class="far fa-circle text-info"></i>&nbsp;';
            }
        }else if($stage_number==5){
            if($this->schedule->a_negotiation!=null){
                $date_diff  = DateHelper::end_date_diff($this->schedule->a_negotiation);
                if($date_diff > 0){
                    return '<i class="fa fa-circle" style=color:orange></i>&nbsp;';
                }else{
                    return '<i class="far fa-circle text-info"></i>&nbsp;';
                }
            }else{
                return '<i class="far fa-circle text-info"></i>&nbsp;';
            }
        }else if($stage_number==6){
            if($this->schedule->a_candidate!=null){
                $date_diff  = DateHelper::end_date_diff($this->schedule->a_candidate);
                if($date_diff > 0){
                    return '<i class="fa fa-circle" style=color:orange></i>&nbsp;';
                }else{
                    return '<i class="far fa-circle text-info"></i>&nbsp;';
                }
            }else{
                return '<i class="far fa-circle text-info"></i>&nbsp;';
            }
        }else if($stage_number==7){
            if($this->schedule->a_winner!=null){
                $date_diff  = DateHelper::end_date_diff($this->schedule->a_winner);
                if($date_diff > 0){
                    return '<i class="fa fa-circle" style=color:orange></i>&nbsp;';
                }else{
                    return '<i class="far fa-circle text-info"></i>&nbsp;';
                }
            }else{
                return '<i class="far fa-circle text-info"></i>&nbsp;';
            }
        }else if($stage_number==8){
            if($this->schedule->a_consultation!=null){
                $date_diff  = DateHelper::end_date_diff($this->schedule->a_consultation);
                if($date_diff > 0){
                    return '<i class="fa fa-circle" style=color:orange></i>&nbsp;';
                }else{
                    return '<i class="far fa-circle text-info"></i>&nbsp;';
                }
            }else{
                return '<i class="far fa-circle text-info"></i>&nbsp;';
            }
        }else if($stage_number==9){
            if($this->schedule->a_contract!=null){
                $date_diff  = DateHelper::end_date_diff($this->schedule->a_contract);
                if($date_diff > 0){
                    return '<i class="fa fa-circle" style=color:orange></i>&nbsp;';
                }else{
                    return '<i class="far fa-circle text-info"></i>&nbsp;';
                }
            }else{
                return '<i class="far fa-circle text-info"></i>&nbsp;';
            }
        }
    }

    public function render_work_day_difference()
    {
        if($this->monitoring_contract != null) {
            $now          = Carbon::now();
            $start_date   = Carbon::parse($this->monitoring_contract->start_date);
            $end_date     = Carbon::parse($this->monitoring_contract->end_date);

            $ongoing_days       = $now->diffInDays($start_date);
            $total_days         = $start_date->diffInDays($end_date) + $ongoing_days;

            return $ongoing_days . ' / ' . $total_days;
        }

        return '';
    }

    public function render_work_end()
    {
        $result           = '';
        if($this->monitoring_contract != null) {
            $end_date     = Carbon::parse($this->monitoring_contract->end_date);
            $result       = $result . $end_date->format('d F Y') . ' / ';

            if($this->monitoring_works != null && count($this->monitoring_works) > 0) {
                $result   = $result . $this->monitoring_works->max('percentage');
            } else {
                $result   = $result . '-';
            }
        }

        return $result;
    }

    /*
        State Explanation
        0 -> Perencanaan Pengadaan
        1 -> Pengadaan Aktif -> Ketika sudah masuk ke list pengadaan (Klik tombol mulai pengadaan dari detail draft pengadaan)
        2 -> Pengadaan Selesai -> Pengadaan dimulai (kontrak kerja sudah di-upload dan tombol mulai pekerjaan di-klik)

        Stage Explanation (Hanya Ketika Sudah Menjadi Pengadaan, akan di-update oleh background worker)
        0 -> - (Ketika Belum Menjadi Pengadaan)
        1 -> Pengumuman
        2 -> Pengumuman Pemenang Pengadaan
    */

}
