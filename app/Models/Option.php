<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'options';


    /**
     * Custom Method.
     *
     */
     public static function vendor_registration()
     {
         $option = Option::where('name', 'vendor_registration')->first();
         if($option == null) {
             return true;
         } else {
            return $option->value == 1;
         }
     }
}
