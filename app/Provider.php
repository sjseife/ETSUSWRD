<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
            'name', 'publicPhoneNumber', 'publicEmail', 'website', 'description', 'comments', 'archived'
    ];

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function resources()
    {
        return $this->hasMany('App\Resource');
    }

    public function contacts()
    {
        return $this->belongsToMany('App\Contact')->withTimestamps();
    }

    public function flags()
    {
        return $this->hasMany('App\Flag');
    }

    /**
     * Get a list of contact ids associated with the current resource
     * Mainly used to populate edit fields
     * @return array
     */
    public function getContactListAttribute()
    {
        return $this->contacts()->lists('id')->all();
    }
}
