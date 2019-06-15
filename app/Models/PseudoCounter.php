<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PseudoCounter extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pseudo_counters';


    /**
     * Custom Method.
     *
     */
    public static function generate($purpose)
    {
        $item           = new PseudoCounter;
        $item->purpose  = $purpose;
        $item->save();

        return $item->id;
    }
}
