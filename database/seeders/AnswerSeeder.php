<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answers = [
            [
                'question_id' => '1',
                'answer' => 'TTM',
                'right_answer' => '1',
            ],
            [
                'question_id' => '1',
                'answer' => 'Thundra',
                'right_answer' => '0',
            ],
            [
                'question_id' => '1',
                'answer' => 'I neva go hard',
                'right_answer' => '0',
            ],
            [
                'question_id' => '1',
                'answer' => 'Пустошь',
                'right_answer' => '0',
            ],
            [
                'question_id' => '2',
                'answer' => 'aggregator-create',
                'right_answer' => '1',
            ],
            [
                'question_id' => '2',
                'answer' => 'aggregator-create',
                'right_answer' => '0',
            ],
            [
                'question_id' => '2',
                'answer' => 'Metal birds',
                'right_answer' => '0',
            ],
            [
                'question_id' => '2',
                'answer' => 'tha-namez',
                'right_answer' => '0',
            ],
            [
                'question_id' => '3',
                'answer' => 'superpowers',
                'right_answer' => '1',
            ],
            [
                'question_id' => '3',
                'answer' => 'lazy boy',
                'right_answer' => '0',
            ],
            [
                'question_id' => '3',
                'answer' => 'vrubel',
                'right_answer' => '0',
            ],
            [
                'question_id' => '3',
                'answer' => 'no letters',
                'right_answer' => '0',
            ]
        ];

        foreach ($answers as $answer) {
            Answer::query()->updateOrCreate($answer);
        }
    }
}
