<?php

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('questions')->delete();
        $json = \File::get('database/data/question.json');
        $questions = json_decode($json);
        foreach ($questions as $question)
        {
            Question::create([
                'id' => $question->id,
                'topic_id' => $question->topic_id,
                'content' => $question->content,
                'level' => $question->level,
                'created_at' => $question->created_at,
                'updated_at' => $question->updated_at,
            ]);
        }
    }
}
