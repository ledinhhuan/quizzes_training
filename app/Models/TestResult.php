<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Class TestResult.
 *
 * @package namespace App\Models;
 */
class TestResult extends Model
{
    const EASY = 1;
    const MEDIUM = 2;
    const HARD = 3;

    /**
     * Map level number to string
     *
     * @var array
     */
    protected $typeMap = [
        self::EASY   => 'Easy',
        self::MEDIUM => 'Medium',
        self::HARD => 'Hard',
    ];

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'topic_id',
        'level',
        'result',
        'start_time',
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     * @var string
     */
    public $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    /**
     * Convert string created at to carbon with locale
     *
     * @return mixed
     */
    public function getCreatedAtAttribute()
    {
        $createdAt = $this->attributes['created_at'];

        return \Carbon\Carbon::parse($createdAt)->format('D, d M Y H:i:s');
    }

    /**
     * Get level attribute
     *
     * @param $level
     * @return mixed
     */
    public function getLevelAttribute($level)
    {
        if ($this->attributes['level'] === self::EASY) {
            $level = $this->typeMap[self::EASY];
        }
        if ($this->attributes['level'] === self::MEDIUM) {
            $level = $this->typeMap[self::MEDIUM];
        }
        if ($this->attributes['level'] === self::HARD) {
            $level = $this->typeMap[self::HARD];
        }

        return $level;
    }

    /**
     * Relationship between test result and answers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Relationship between test result and result
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }

    /**
     * Relationship between test result and topic
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic()
    {
        return $this->belongsTo('App\Models\Topic');
    }
}
