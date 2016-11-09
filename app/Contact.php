<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'firstName','lastName','protectedEmail','protectedPhoneNumber','archived'
    ];

    /**
     * get the resources associated with the current contact through
     * the provider they are both associated with
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function resources()
    {
        return $this->belongsToMany('App\Resource')->withTimestamps();
    }

    /**
     * get the providers associate with the current contact
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events()
    {
        return $this->belongsToMany('App\Event')->withTimestamps();
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
    public function getResourceListAttribute()
    {
        return $this->resources->lists('id')->all();
    }

    /**
     * Get a list of event ids associated with the current resource
     * @return array
     */
    public function getEventListAttribute()
    {
        return $this->events->lists('id')->all();
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
