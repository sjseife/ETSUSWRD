<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyHours extends Model
{
    protected $fillable = [
            'day', 'openTime', 'closeTime', 'resource_id', 'event_id'
    ];

    /**
     * Gets the resource associated with the current hours
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function resource()
    {
        return $this->belongsTo('App\Resource');
    }

    /**
     * Gets the event associated with the current hours
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
