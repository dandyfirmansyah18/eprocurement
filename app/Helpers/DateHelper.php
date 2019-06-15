<?php // Date Helper

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function parse_from_datepicker($date_raw)
    {
      $result = null;

      $date_arr = explode('/', $date_raw);
      if(count($date_arr) > 1){
          $year   = $date_arr[2];
          $month  = $date_arr[1];
          $day    = $date_arr[0];
          $result   = Carbon::create($year, $month, $day, 0, 0, 0);
      }

      return $result;
    }

    public static function datepicker($date)
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

    public static function long_format($date)
    {
        if($date == null || $date == '00/00/0000') {
            return '';
        } else {
            $parsed_date = Carbon::parse($date);
            return $parsed_date->format('d F Y');
        }
    }

    public static function tahun_format($date)
    {
        if($date == null || $date == '00/00/0000') {
            return '';
        } else {
            $parsed_date = Carbon::parse($date);
            return $parsed_date->format('Y');
        }
    }

    public static function time_format($date)
    {
        if($date == null || $date == '00/00/0000') {
            return '';
        } else {
            $parsed_date = Carbon::parse($date);
            return $parsed_date->format('d F Y H:i');
        }
    }

    public static function datetime_picker($date)
    {
        if($date == null || $date == '00/00/0000') {
            return '';
        } else {
            $next_date      = clone $date;
            $next_date->addDay();

            $day_names      = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            $month_names    = ['Januari', 'Februari', 'Maret', 'April', 'Mei',
                                'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                                'November', 'Desember'];
            $current_day    = $day_names[$date->dayOfWeek] . ', ' . $date->day . ' ' .
                                $month_names[$date->month - 1] . ' ' .
                                $date->format('Y \p\u\k\u\l H:i');
            $next_day       = $day_names[$next_date->dayOfWeek] . ', ' . $next_date->day . ' ' .
                                $month_names[$next_date->month - 1] . ' ' .
                                $next_date->addDay()->format('Y \p\u\k\u\l H:i');

            return $current_day . ' - ' . $next_day;
        }
    }

    public static function end_date($date_text)
    {
        return explode(' - ', $date_text)[1];
    }

    public static function end_date_diff($date_text)
    {
        $month_names    = ['Januari', 'Februari', 'Maret', 'April', 'Mei',
                            'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                            'November', 'Desember'];
        $end_date_text  = explode('-', $date_text)[1];
        $end_date_text  = explode(', ', $end_date_text)[1];
        $end_dates      = explode(' ', $end_date_text);
        $month_index    = intval(array_search($end_dates[1], $month_names));
        $day_index      = intval($end_dates[0]);

        $now            = Carbon::now();
        $current_month  = $now->month;
        $current_day    = $now->day;

        $month_diff     = ($current_month - $month_index - 1) * 30;
        $day_diff       = ($current_day - $day_index);
        $date_diff      = $month_diff + $day_diff;
        return $date_diff;
    }
}
