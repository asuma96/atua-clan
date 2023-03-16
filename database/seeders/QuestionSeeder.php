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
                'file' => 'AKIMATO80sn90ssnip.mp4',
                'text' => 'test',
            ],
            [
                'file' => 'CJWHOOPTYmobclip.net',
                'text' => 'TTM',
            ],
            [
                'file' => 'YelawolfxCaskeyBeenAProblemmobclip.net',
                'text' => 'TTM',
            ]
        ];

        foreach ($questions as $question) {
            Question::query()->updateOrCreate($question);
        }
    }
}
