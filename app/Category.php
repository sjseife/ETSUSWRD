<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];
    
    public function resources()
    {
        return $this->belongsToMany('App\Resource', 'category_resource')->withTimestamps();
    }

    /**
     * Get a list of resource ids associated with the current resource
     * @return array
     */
    public function getResourceListAttribute()
    {
        return $this->resources->lists('id')->all();
    }
}
