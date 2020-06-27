<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Topic extends Model
{
   const LIMIT_TOPIC = 12;
   const PATH_TOPIC = '/uploads/images/topics/';
   const DEFAULT_PATH_TOPIC = '/uploads/images/topics/default.jpg';

   const STATUS_PUBLIC = 1;
   const STATUS_PRIVATE = 0;

   use SearchTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'picture',
    ];

    /**
     * The columns of the full text index
     *
     * @var array
     */
    protected $searchable = [
        'name',
        'description',
    ];

    /**
     * @var array status of topic
     */
    protected $status = [
        1 => [
            'name' => 'Enable',
            'class'=> ''
        ],
        0 => [
            'name' => 'Disable',
            'class'=> ''
        ],
    ];

    /**
     * Custom created at become diff for humans
     *
     * @return string
     */
    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']))->diffForHumans();
    }

    /**
     * Relationship between topic and question
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('App\Models\Question', 'topic_id', 'id');
    }

    /**
     * Relationship between topic and test result
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function testResults()
    {
        return $this->hasMany('App\Models\TestResult', 'topic_id', 'id');
    }

    /**
     * Set the name and the readable slug.
     *
     * @param string $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->setUniqueSlug($value, Str::random(10));
    }

     /**
     * Set the unique slug.
     *
     * @param $value
     * @param $extra
     */
    public function setUniqueSlug($value, $extra)
    {
        $slug = Str::slug($value . '-' . $extra);
        if (self::whereSlug($slug)->exists()) {
            $this->setUniqueSlug($slug, (int) $extra + 1);
            return;
        }

        $this->attributes['slug'] = $slug;
    }

    /**
     * Get picture
     *
     * @param $value
     * @return \Illuminate\Config\Repository|mixed|string
     */
    public function getPictureAttribute($value)
    {
        if (Str::startsWith($this->attributes['picture'], ['http', 'https'])) {
            return $this->attributes['picture'];
        }

        return isset($value) ? self::PATH_TOPIC . $value : self::DEFAULT_PATH_TOPIC;
    }

    /**
     * Set default picture when not upload image
     *
     * @param $value
     */
    public function setPictureAttribute($value)
    {
        $picture = isset($value) ? $value : '';
        $this->attributes['picture'] = $picture;
    }

    /**
     * function get status of topic
     *
     * @return mixed
     */
    public function getStatus()
    {
        return array_get($this->status, $this->topic_status, '[N\A]');
    }

    /**
     * Get excerpt from description
     *
     * @return string
     */
    public function getExcerptAttribute()
    {
        return Str::words($this->attributes['description'], 20);
    }
}
