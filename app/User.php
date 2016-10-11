<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get a list of flags associated with the current user
     * NOTE: These are the flags on the user
     * @return array
     */
    public function flags()
    {
        return $this->hasMany('App\Flag');
    }

    /**
     * Get a list of flag associated with the current user
     * NOTE: These are the flags that the user has submitted.
     * @return array
     */
    public function submittedFlags()
    {
        return $this->hasMany('App\Flag', 'submitted_by');
    }

    /**
     * Get a list of resources associated with the current user. Used for Worklist.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resources()
    {
        return $this->BelongsToMany('App\Resource')->withTimestamps();
    }

    /**
     * Get a list of events associated with the current user. Used for WorkList
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events()
    {
        return $this->BelongsToMany('App\Event')->withTimestamps();
    }
}
