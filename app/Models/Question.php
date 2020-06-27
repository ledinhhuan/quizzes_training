<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    const LIMIT_QUESTION = 10;

    protected $fillable = [
        'topic_id',
        'content',
        'level',
        'plain_text',
    ];

    /**
     * Relationship between question and topic
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic()
    {
        return $this->belongsTo('App\Models\Topic', 'topic_id');
    }

    /**
     * Relationship between question and answer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany('App\Models\Answer', 'question_id', 'id');
    }

    protected $levels = [
        1 => [
            'name' =>'Easy'
        ],
        2 => [
            'name' =>'Medium'
        ],
        3 => [
            'name' =>'Hard'
        ]
    ];

    public function getLevel()
    {
        return array_get($this->levels, $this->level, 'N\A');
    }

    public function getLevels()
    {
        return $this->levels;
    }
}
