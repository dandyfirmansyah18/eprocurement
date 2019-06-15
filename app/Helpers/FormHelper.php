<?php // Form Helper

namespace App\Helpers;

class FormHelper
{
    public static function checked($value = false)
    {
        if($value == true) {
            return 'checked';
        } else {
            return '';
        }
    }

    public static function checked_icon($value = false)
    {
        if($value == true) {
            return '<i class="fa fa-check"></i>';
        } else {
            return '<i class="fa fa-close"></i>';
        }
    }

    public static function file_tag($file_path, $file_name)
    {
        return '<a href="/uploads/' . $file_path . '" target="_blank">' . $file_name . '</a>';
    }
}
