<?php

declare(strict_types=1);

namespace App\Transformers\Answer;

use App\Models;
use League\Fractal\TransformerAbstract;

class AnswerTransformer extends TransformerAbstract
{
    /**
     * @param  Models\Answer  $answer
     * @return array
     */
    public function transform(Models\Answer $answer): array
    {
        $result = [
            'id' => $answer->id,
            'question_id' => $answer->question_id,
            'answer' => $answer->answer,
            'right_answer' => $answer->right_answer,
        ];

        return $result;
    }
}
