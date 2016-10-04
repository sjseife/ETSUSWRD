<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'Name', 'StreetAddress', 'StreetAddress2', 'City', 'County', 'State', 'Zipcode', 'PhoneNumber', 'OpeningHours','ClosingHours','Comments'
    ];

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

    /**
     * Get the contacts associated with a given resource
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->belongsToMany('App\Contact', 'contact_resource')->withTimestamps();
    }

    /**
     * Get a list of contact ids associated with the current resource
     * @return array
     */
    public function getContactListAttribute()
    {
        return $this->contacts->lists('id')->all();
    }

    /**
     * Get a list of flags associated with the current resource
     * @return array
     */
    public function flags()
    {
        return $this->hasMany('App\Flag');
    }

    /**
     * Get a list of users associates with the current resource.
     * Used for reports.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
