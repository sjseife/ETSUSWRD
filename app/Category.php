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
}
