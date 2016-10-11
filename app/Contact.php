<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'firstName','lastName','protectedEmail','protectedPhoneNumber',
    ];

    /**
     * get the resources associated with the current contact through
     * the provider they are both associated with
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function resources()
    {
        return $this->hasManyThrough('App\Resource', 'App\Provider');
    }

    /**
     * get the providers associate with the current contact
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function providers()
    {
        return $this->belongsToMany('App\Provider')->withTimestamps();
    }

    /**
     * get the events associated with the current contact through
     * the provider they are both associated with
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function events()
    {
        return $this->hasManyThrough('App\Event', 'App\Provider');
    }

    /**
     * Allows for the use of Contact->full_name
     * @return string
     */
    public function getFullNameAttribute()
    {
        return ucfirst($this->firstName). ' ' . ucfirst($this->lastName);
    }

    /**
     * Get a list of resource ids associated with the current resource
     * @return array
     */
    public function getProviderListAttribute()
    {
        return $this->providers->lists('id')->all();
    }

    /**
     * Get a list of flags associated with the current contact
     * @return array
     */
    public function flags()
    {
        return $this->hasMany('App\Flag');
    }
}
