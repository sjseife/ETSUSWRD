<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    protected $table = 'flag';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Date', 'Level', 'Comments', 'user_id', 'resource_id', 'submitted_by', 'contacts_id'
    ];

}
