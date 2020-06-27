<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    const IS_ADMIN = 0;
    const IS_USER = 1;
    const LIMIT_USER = 10;

    const STATUS_PUBLIC = 1;
    const STATUS_PRIVATE = 0;

    use Notifiable, SearchTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'user_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var array that show level of user
     * Admin can add, update and delete but can't delete itself
     * User just can test online
     */
    protected $levels = [
        0 => [
            'role' =>'Admin'
        ],
        1 => [
            'role' =>'User'
        ],
    ];

    /**
     * @var array status of user
     */
    protected $status = [
        1 => [
            'name' => 'Active',
            'class'=> ''
        ],
        0 => [
            'name' => 'Non-active',
            'class'=> ''
        ],
    ];

    protected $searchable = [
        'name',
        'email',
    ];

    /**
     * Hash password to database when user input at the form
     *
     * @param $password
     * @return mixed
     */
    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = \Hash::make($password);
    }

    /**
     * Check user is a admin if true
     *
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->role === self::IS_ADMIN;
    }

    /**
     * Check user active
     *
     * @return mixed
     */
    public function isActive()
    {
        return $this->user_status === self::STATUS_PUBLIC;
    }

    /**
     * Relationship user and test result
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function testResults()
    {
        return $this->hasMany('App\Models\TestResult');
    }

    /**
     * get level user to show on index page
     * @return mixed
     */
    public function getLevelUser()
    {
        return array_get($this->levels, $this->role, 'N\A');
    }

    /**
     * get all level user to show on create or update page
     * @return array
     */
    public function getLevels()
    {
        return $this->levels;
    }

    /**
     * function get status of user
     * @return mixed
     */
    public function getStatus() {
        return array_get($this->status, $this->user_status, '[N\A]');
    }
}
