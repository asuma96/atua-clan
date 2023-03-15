<?php

declare(strict_types=1);

namespace App\Transformers\Question;

use App\Models;
use League\Fractal\TransformerAbstract;

class QuestionTransformer extends TransformerAbstract
{
    /**
     * @param  Models\Question  $question
     * @return array
     */
    public function transform(Models\Question $question): array
    {
        $result = [
            'id' => $question->id,
            'file' => $question->file,
            'text' => $question->text,
            'answers' => $question->answers->mapWithKeys(function ($answers) {
                return [
                    $answers->id => [
                        'id' => $answers->id,
                        'question_id' => $answers->question_id,
                        'answer' => $answers->answer,
                        'right_answer' => $answers->right_answer,
                        ],
                ];
            }),
        ];

        return $result;
    }
}
