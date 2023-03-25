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
                'file' => 'uncledecoy.mp4',
                'text' => 'UNCLE DECOY',
            ],
            [
                'file' => 'anubis.mp4',
                'text' => 'Anubis',
            ],
            [
                'file' => 'FUCKLOVE.mp4',
                'text' => 'FUCK LOVE',
            ],
            [
                'file' => 'jaguar.mp4',
                'text' => 'jaguar',
            ],
            [
                'file' => 'metalbirds.mp4',
                'text' => 'metalbirds',
            ],
            [
                'file' => 'NOX.mp4',
                'text' => 'NOX',
            ],
            [
                'file' => 'packonahunt.mp4',
                'text' => 'PACK ON NA HUNT',
            ],
            [
                'file' => 'playstay.mp4',
                'text' => 'playstay',
            ],
            [
                'file' => 'rts.mp4',
                'text' => 'rts',
            ],
            [
                'file' => 'ttm.mp4',
                'text' => 'ttm',
            ],
            [
                'file' => 'uglyevrythang.mp4',
                'text' => 'uglyevrythang',
            ],
            [
                'file' => 'idu.mp4',
                'text' => 'idu',
            ],
            [
                'file' => 'vrubel.mp4',
                'text' => 'vrubel',
            ]
        ];

        foreach ($questions as $question) {
            Question::query()->updateOrCreate($question);
        }
    }
}
