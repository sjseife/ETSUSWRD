<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function resources()
    {
        return $this->belongsToMany(Resouce::class);
    }

    protected $table = 'category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Name',
    ];

}
