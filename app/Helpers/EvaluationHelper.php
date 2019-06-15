<?php // Evaluation Helper

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\StageEvaluation;
use App\Models\TechnicalEvaluation;

class EvaluationHelper
{
    public static function touch($enrollment_id)
    {
        $item               = StageEvaluation::where('enrollment_id', $enrollment_id)->first();

        if($item == null) {
            $item                   = new StageEvaluation;
            $item->enrollment_id    = $enrollment_id;
        }

        $item->save();

        return $item->id;
    }

    public static function save_monev($enrollment_id, $criterion, $score)
    {
        $max_tech_score     = $criterion * 5;
        $max_score          = $max_tech_score + 5;

        $item               = StageEvaluation::where('enrollment_id', $enrollment_id)->first();

        if($item == null) {
            $item                   = new StageEvaluation;
            $item->enrollment_id    = $enrollment_id;
        }

        $item->monev_score  = $score;
        $item->max_score    = $max_score;
        $item->save();

        return $item->id;
    }

    public static function save_techev($evaluation_id, $data)
    {
        $result         = false;
        $final_score    = 0;

        if(count($data['counter_id']) > 0) {
            foreach ($data['counter_id'] as $index) {
                $item   = TechnicalEvaluation::where('evaluation_id', $evaluation_id)->where('criterion_id', $index)->first();

                if($item == null) {
                    $item                   = new TechnicalEvaluation;
                    $item->evaluation_id    = $evaluation_id;
                    $item->criterion_id     = $index;
                }

                if(array_key_exists($index, $data['mark'])) {
                    $score          = intval($data['mark'][$index]);
                    $final_score    = $final_score + $score;
                    $item->score    = $score;
                    $item->save();
                }

                $result         = true;
            }

            $evaluation                 = StageEvaluation::find($evaluation_id);
            $evaluation->techev_score   = $final_score;
            $evaluation->notes          = $data['notes'];
            $evaluation->save();
        }

        return $result;
    }
    
    public static function save_nonscoring($evaluation_id, $data)
    {
        $result                     = false;

        $evaluation                 = StageEvaluation::find($evaluation_id);
        $evaluation->pass_adm       = array_key_exists('adm', $data);
        $evaluation->pass_doc       = array_key_exists('doc', $data);
        $evaluation->pass_second    = array_key_exists('second', $data);
        $evaluation->notes          = $data['notes'];
        $evaluation->save();

        return $result;
    }
}
