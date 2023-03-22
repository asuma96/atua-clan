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
                'answer' => 'HATIN',
                'right_answer' => '1',
            ],
            [
                'question_id' => '1',
                'answer' => 'Impulse',
                'right_answer' => '0',
            ],
            [
                'question_id' => '1',
                'answer' => 'Sparks',
                'right_answer' => '0',
            ],
            [
                'question_id' => '1',
                'answer' => 'Superpowers',
                'right_answer' => '0',
            ],

            [
                'question_id' => '2',
                'answer' => 'I NEVA GO HARD',
                'right_answer' => '0',
            ],
            [
                'question_id' => '2',
                'answer' => 'SENJU',
                'right_answer' => '0',
            ],
            [
                'question_id' => '2',
                'answer' => 'MIRROR TALK',
                'right_answer' => '1',
            ],
            [
                'question_id' => '2',
                'answer' => 'POKE',
                'right_answer' => '0',
            ],

            [
                'question_id' => '3',
                'answer' => 'LAST ONE',
                'right_answer' => '0',
            ],
            [
                'question_id' => '3',
                'answer' => 'I NEVA GO HARD',
                'right_answer' => '1',
            ],
            [
                'question_id' => '3',
                'answer' => 'BORED',
                'right_answer' => '0',
            ],
            [
                'question_id' => '3',
                'answer' => 'WICKED',
                'right_answer' => '0',
            ],

            [
            'question_id' => '4',
            'answer' => 'OOLONG',
            'right_answer' => '1',
            ],
            [
                'question_id' => '4',
                'answer' => 'COMSI',
                'right_answer' => '0',
            ],
            [
                'question_id' => '4',
                'answer' => 'SET IT FREE',
                'right_answer' => '0',
            ],
            [
                'question_id' => '4',
                'answer' => 'THUNDAWIND',
                'right_answer' => '0',
            ],

            [
                'question_id' => '5',
                'answer' => 'NOX',
                'right_answer' => '0',
            ],
            [
                'question_id' => '5',
                'answer' => 'SENJU',
                'right_answer' => '0',
            ],
            [
                'question_id' => '5',
                'answer' => 'SLIPPERS',
                'right_answer' => '0',
            ],
            [
                'question_id' => '5',
                'answer' => 'POKE',
                'right_answer' => '1',
            ],

            [
                'question_id' => '6',
                'answer' => 'TTM',
                'right_answer' => '0',
            ],
            [
                'question_id' => '6',
                'answer' => 'QUALITY',
                'right_answer' => '0',
            ],
            [
                'question_id' => '6',
                'answer' => 'ITAMI',
                'right_answer' => '0',
            ],
            [
                'question_id' => '6',
                'answer' => 'ROOKIE',
                'right_answer' => '1',
            ],

            [
                'question_id' => '7',
                'answer' => 'NO LETTERS',
                'right_answer' => '0',
            ],
            [
                'question_id' => '7',
                'answer' => 'IDU',
                'right_answer' => '0',
            ],
            [
                'question_id' => '7',
                'answer' => 'SENJU',
                'right_answer' => '1',
            ],
            [
                'question_id' => '7',
                'answer' => 'THOMPSON',
                'right_answer' => '0',
            ],

            [
                'question_id' => '8',
                'answer' => 'RAID',
                'right_answer' => '0',
            ],
            [
                'question_id' => '8',
                'answer' => 'THUNDAWIND',
                'right_answer' => '1',
            ],
            [
                'question_id' => '8',
                'answer' => 'ENERGY',
                'right_answer' => '0',
            ],
            [
                'question_id' => '8',
                'answer' => 'OSAKA CRY',
                'right_answer' => '0',
            ],

            [
                'question_id' => '9',
                'answer' => 'TORII',
                'right_answer' => '0',
            ],
            [
                'question_id' => '9',
                'answer' => 'TWOX',
                'right_answer' => '1',
            ],
            [
                'question_id' => '9',
                'answer' => 'NOMAD',
                'right_answer' => '0',
            ],
            [
                'question_id' => '9',
                'answer' => 'OBLIVION',
                'right_answer' => '0',
            ],

            [
                'question_id' => '10',
                'answer' => 'VRUBEL',
                'right_answer' => '0',
            ],
            [
                'question_id' => '10',
                'answer' => 'CRUISIN',
                'right_answer' => '0',
            ],
            [
                'question_id' => '10',
                'answer' => 'I GET DOWN',
                'right_answer' => '0',
            ],
            [
                'question_id' => '10',
                'answer' => 'UNCLE DECOY',
                'right_answer' => '1',
            ],
        ];

        foreach ($answers as $answer) {
            Answer::query()->updateOrCreate($answer);
        }
    }
}
