<?php

use Illuminate\Database\Seeder;
use App\Models\Answer;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('answers')->delete();
        $json = \File::get('database/data/answer.json');
        $answers = json_decode($json);
        foreach ($answers as $answer)
        {
            Answer::create([
                'question_id' => $answer->question_id,
                'answer' => $answer->answer,
                'is_correct' => $answer->is_correct,
            ]);
        }
    }
}
