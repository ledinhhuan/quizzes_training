<?php

namespace App\Services;

use Illuminate\Http\Request;

class QuizzService
{
    /**
     * Save question to array data
     *
     * @param Request $request
     * @param $questions
     * @param $testResult
     * @return array
     */
    public function dataQuestions(Request $request, $questions, $testResult)
    {
        $data = [];
        if (is_array($questions) && count($questions)) {
            foreach ($questions as $question)
            {
                $answer = $request->input('answers.' . $question);
                $data[] = [
                    'test_result_id' => $testResult['id'],
                    'question_id' => $question,
                    'selected_answer_id' => is_null($answer) ? null : $answer,
                    'created_at' => \now(),
                    'updated_at' => \now(),
                ];
            }
        }

        return $data;
    }

    /**
     * Calculate Result when submit
     *
     * @param $answers
     * @return int
     */
    public function calculateResult($answers)
    {
        $result = 0;
        if (!is_null($answers) && count($answers)) {
            foreach ($answers as $answer)
            {
                $result = $answer->isCorrect() ? $result + 1 : $result;
            }
        }

        return $result;
    }
}
