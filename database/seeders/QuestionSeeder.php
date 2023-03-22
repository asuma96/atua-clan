<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'file' => 'hatin360h.mp4',
                'text' => 'Akimato hatin',
            ],
            [
                'file' => 'mirrortalk1.mp4',
                'text' => 'Mirror talk',
            ],
            [
                'file' => 'nevagohard.mp4',
                'text' => 'I neva go hard',
            ],

            [
                'file' => 'oolong.mp4',
                'text' => 'O loong',
            ],
            [
                'file' => 'poke.mp4',
                'text' => 'Poke',
            ],
            [
                'file' => 'rookie.mp4',
                'text' => 'rookie',
            ],
            [
                'file' => 'senju360.mp4',
                'text' => 'senju',
            ],
            [
                'file' => 'thundawind.mp4',
                'text' => 'Thundavind',
            ],
            [
                'file' => 'twox.mp4',
                'text' => 'twox',
            ],
            [
                'file' => 'uncledecoy',
                'text' => 'UNCLE DECOY',
            ]
        ];

        foreach ($questions as $question) {
            Question::query()->updateOrCreate($question);
        }
    }
}
