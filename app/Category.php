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
        return $this->belongsToMany(Resource::class, 'category_resource')->withTimestamps();
    }
}
