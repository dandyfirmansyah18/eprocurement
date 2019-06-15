<?php // Aux Helper

namespace App\Helpers;

use Carbon\Carbon;

class AuxHelper
{
    public static function generate_pin()
    {
        return substr(str_shuffle('0123456789'), 0, 4);
    }

    public static function generate_password()
    {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'),0,6);
    }

    public static function render_file_url($file_path, $file_name)
    {
        return '<a href="/uploads/' . $file_path . '" target="_blank">' . $file_name . '</a>';
    }

    public static function render_date($date)
    {
        if($date == null || $date == '00/00/0000') {
            return '';
        } else {
            $parsed_date = Carbon::parse($date);

            $day = $parsed_date->day;
            if($day < 10) {
                $day = '0' . $day;
            }

            $month = $parsed_date->month;
            if($month < 10) {
                $month = '0' . $month;
            }

            return $day . '/' . $month . '/' . $parsed_date->year;
        }
    }

    public static function render_date_long($date)
    {
        if($date == null || $date == '00/00/0000') {
            return '';
        } else {
            $parsed_date = Carbon::parse($date);
            return $parsed_date->format('d F Y');
        }
    }

    public static function render_date_long_adding_days($date, $days)
    {
        if($date == null || $date == '00/00/0000') {
            return '';
        } else {
            $parsed_date = Carbon::parse($date)->addDays($days);
            return $parsed_date->format('d F Y');
        }
    }

    public static function parse_date_adding_days($date, $days)
    {
        if($date == null || $date == '00/00/0000') {
            return '';
        } else {
            $parsed_date = Carbon::parse($date)->addDays($days);
            return $parsed_date;
        }
    }

    public static function render_date_time($date)
    {
        if($date == null || $date == '00/00/0000') {
            return '';
        } else {
            $parsed_date = Carbon::parse($date);
            return $parsed_date->format('d F Y H:i');
        }
    }

    public static function render_boolean_checked($value = false)
    {
        if($value == true) {
            return 'checked';
        } else {
            return '';
        }
    }

    public static function render_boolean_value($value = false)
    {
        if($value == true) {
            return '<i class="fa fa-check"></i>';
        } else {
            return '<i class="fa fa-close"></i>';
        }
    }
}
