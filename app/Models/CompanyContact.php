<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    // Custom Data Rendering
    public function render_contractsignin_check()
    {
        if($this->contract_signin == true) {
            return 'checked';
        } else {
            return "";
        }
    }

    public function render_inbankrupt_check()
    {
        if($this->in_bankrupt == true) {
            return 'checked';
        } else {
            return "";
        }
    }

    public function render_realdata_check()
    {
        if($this->real_data == true) {
            return 'checked';
        } else {
            return "";
        }
    }

    public function render_contractsignin_icon()
    {
        if($this->contract_signin == true) {
            return '<i class="fa fa-check fa-lg text-success"></i>';
        } else {
            return '<i class="fa fa-close fa-lg text-danger"></i>';
        }
    }

    public function render_inbankrupt_icon()
    {
        if($this->in_bankrupt == true) {
            return '<i class="fa fa-check fa-lg text-success"></i>';
        } else {
            return '<i class="fa fa-close fa-lg text-danger"></i>';
        }
    }

    public function render_realdata_icon()
    {
        if($this->real_data == true) {
            return '<i class="fa fa-check fa-lg text-success"></i>';
        } else {
            return '<i class="fa fa-close fa-lg text-danger"></i>';
        }
    }
}
