<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
            'name', 'publicPhoneNumber', 'publicEmail', 'website'
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
}
