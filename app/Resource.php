<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends  Model
{
    protected $table = 'Resource';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    public $timestamps = false;
    
    protected $fillable = [
        'Name', 'StreetAddress', 'StreetAddress2', 'City', 'County', 'State', 'Zipcode', 'OpeningHours','ClosingHours','Comments'
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
