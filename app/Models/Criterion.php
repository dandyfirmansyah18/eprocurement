<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'criterions';


    /**
     * Custom Data.
     *
     */
    public function score()
    {
        $evaluated = TechnicalEvaluation::where('evaluation_id', $this->evaluation_id)
                      ->where('criterion_id', $this->id)->first();
        if($evaluated != null) {
          return $evaluated->score;
        }

        return 0;
    }
}
