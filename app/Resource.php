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
    protected $fillable = [
        'Name', 'StreetAddress', 'StreetAddress2', 'City', 'County', 'State', 'Zipcode', 'ContactFirstName', 'ContactLastName', 'ContactPhone','OpeningHours','ClosingHours','Comments'
    ];

    public $timestamps = false;
}
