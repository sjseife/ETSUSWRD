<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'startDate', 'endDate', 'streetAddress', 'streetAddress2', 'city', 'county',
        'state', 'zipCode', 'publicPhoneNumber', 'publicEmail', 'website', 'description', 'comments',
        'provider_id'
    ];

    /**
     * Get the users associates with the current event.
     * Used for work lists
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    /**
     * Get the categories associated with a given event
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_event')->withTimestamps();
    }

    /**
     * Get a list of category ids associated with the current event
     * @return array
     */
    public function getCategoryListAttribute()
    {
        return $this->categories->lists('id')->all();
    }

    /**
     * Get the provider associated with the event
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo('App\Provider');
    }

    /**
     * Get the DailyHours associated with the current event
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hours()
    {
        return $this->hasMany('App\DailyHours');
    }

    /**
     * Get the flags associated with the current event
     * @return array
     */
    public function flags()
    {
        return $this->hasMany('App\Flag');
    }
}

