<?php

namespace App;

namespace App;


use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{

    protected $table = 'resource';
    protected $fillable = [
        'Name', 'StreetAddress', 'StreetAddress2', 'City', 'County', 'State', 'Zipcode', 'PhoneNumber', 'OpeningHours','ClosingHours','Comments'
    ];

    public $timestamps = false;
    
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Get the categories associated with a given resource
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_resource')->withTimestamps();
    }

    /**
     * Get a list of category ids associated with the current resource
     * @return array
     */
    public function getCategoryListAttribute()
    {
        return $this->categories->lists('id')->all();
    }
}
