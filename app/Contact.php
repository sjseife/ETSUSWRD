<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'firstName','lastName','email','phoneNumber',
    ];
    
    public function resources()
    {
        return $this->belongsToMany('App\Resource', 'contact_resource')->withTimestamps();
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
     * Get a list of flags associated with the current contact
     * @return array
     */
    public function flags()
    {
        return $this->hasMany('App\Flag');
    }
}
