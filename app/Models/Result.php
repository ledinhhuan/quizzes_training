<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Result.
 *
 * @package namespace App\Models;
 */
class Result extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'test_result_id',
        'question_id',
        'selected_answer_id',
    ];

    /**
     * Get user for the result
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Get the question for the result
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id');
    }

    /**
     * Get the test result for the result
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function testResult()
    {
        return $this->belongsTo('App\Models\TestResult', 'test_result_id');
    }
}
