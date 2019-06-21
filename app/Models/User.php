<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';
    protected $fillable = [
        'name', 'pin', 'taxpayer_number', 'email', 'password', 'role_level', 'state', 'verification_time', 'registration_time', 'remember_token', 'verification_by', 
        'pinrequest_time', 'rating', 'notes', 'unit_id', 'penalty_end', 'penalty_start', 'nip', 'telp', 'user_last_login', 'session_id', 'password_reset_code',
        'password_reset_expired'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    protected $appends = ['verified', 'verifier', 'role'];

    // Models Relationship
    public function company()
    {
        return $this->hasOne('App\Models\Company', 'user_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\UserUnit', 'unit_id', 'id');
    }

    // Custom Data Rendering
    public function render_registration_status()
    {
        if($this->verified == true) {
            return '<span class="btn btn-success">Rekanan Terverifikasi</span>';
        } else {
            if($this->verification_time == null) {
                return '<span class="btn btn-info">Pengisian data pendaftaran rekanan</span>';
            } else {
                return '<span class="btn btn-warning">Proses verifikasi oleh PT Multi Terminal Indonesia</span>';
            }
        }
    }

    // Custom Data Getter
    public function getVerifiedAttribute()
    {
        return $this->state == 1;
    }

    public function getVerifierAttribute()
    {
        if($this->verification_by != null) {
            $verifier = \DB::table('users')->select('name')->where('id', $this->verification_by)->take(1)->first();
            return $verifier->name;
        } else {
            return '';
        }
    }

    public function getRoleAttribute()
    {
        $text = "";

        switch ($this->role_level) {
            case 0:
                $text = "Admin";
                break;
            case 1:
                $text = "Penyedia";
                break;
            case 2:
                $text = "Staff Perencana";
                break;
            case 3:
                $text = "Staff Pengadaan";
                break;
            case 4:
                $text = "Manajer";
                break;
            case 5:
                $text = "Kepala Divisi";
                break;
            case 6:
                $text = "Direksi";
                break;
            default:
                break;
        }

        return $text;
    }
}
