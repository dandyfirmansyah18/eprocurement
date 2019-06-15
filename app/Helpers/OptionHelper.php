<?php // Option Helper

namespace App\Helpers;

use App\Models\Option;

class OptionHelper
{

    public static function save_registration($value)
    {
    	$item           = Option::where('name', 'vendor_registration')->first();

        if($item == null) {
            $item       = new Option;
            $item->name = 'vendor_registration';
        }

        $item->value    = $value;

    	$item->save();

    	return $item->id;
    }
}
