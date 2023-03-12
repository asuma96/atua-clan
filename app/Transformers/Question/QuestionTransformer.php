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
        ];

        return $result;
    }
}
