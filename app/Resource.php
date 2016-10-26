<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'name', 'streetAddress', 'streetAddress2', 'city', 'county', 'state', 'zipCode', 'publicPhoneNumber',
        'publicEmail', 'website', 'description', 'comments', 'provider_id', 'archived'
    ];

    /**
     * Get the categories associated with a given resource
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_resource')->withTimestamps();
    }

    /**
     * Get a list of category ids associated with the current resource
     * @return array
     */
    public function getCategoryListAttribute()
    {
        return $this->categories->lists('id')->all();
    }

    /**
     * get the contacts associated with the current resource through
     * the provider they are both associated with
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasManyThrough('App\Contact', 'App\Provider');
    }

    /**
     * Get a list of contact ids associated with the current resource
     * @return array
     */
    public function getContactListAttribute()
    {
        return $this->contacts->lists('id')->all();
    }

    /**
     * Get the flags associated with the current resource
     * @return array
     */
    public function flags()
    {
        return $this->hasMany('App\Flag');
    }

    /**
     * Get the users associates with the current resource.
     * Used for work lists
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    /**
     * Get the provider associated with the resource
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo('App\Provider');
    }

    /**
     * Get the DailyHours associated with the current resource.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hours()
    {
        return $this->hasMany('App\DailyHours');
    }
}
