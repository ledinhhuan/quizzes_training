<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    const CORRECT = 1;

    protected $fillable = [
        'question_id',
        'answer',
        'is_correct',
    ];

    /**
     * Relationship between answer and question
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id');
    }

    /**
     * check user choice question is correct
     *
     * @return bool
     */
    public function isCorrect()
    {
        return $this->is_correct == self::CORRECT;
    }
}
