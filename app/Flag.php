<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'level', 'comments', 'resolved', 'submitted_by',
        'user_id', 'resource_id', 'contact_id', 'event_id', 'provider_id', 'archived'
    ];

    /**
     * Get the resource associated with the current flag
     * @return array
     */
    public function resource()
    {
        return $this->belongsTo('App\Resource');
    }

    /**
     * Get the contact associated with the current flag
     * @return array
     */
    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }

    /**
     * Get the user associated with the current flag
     * NOTE: This is the user that is being flagged
     * @return array
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Gets the user associated with the current flag
     * NOTE: This is the user that submitted the flag
     * @return array
     */
    public function submitter()
    {
        return $this->belongsTo('App\User', 'submitted_by');
    }

    /**
     * Gets the Event associated with the current flag
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    /**
     * Gets the provider associated with the current flag
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo('App\Provider');
    }

    /**
     * Allows for the use of Flag->userIdNumber
     * @return null if not set
     * @return integer if set
     */
    public function getUserIdNumberAttribute()
    {
        if(!isSet($this->user))
        {
            return Null;
        }
        return $this->user->id;
    }

    /**
     * Allows for the use of Flag->resourceIdNumber
     * @return null if not set
     * @return integer if set
     */
    public function getResourceIdNumberAttribute()
    {
        if(!isSet($this->resource))
        {
            return Null;
        }
        return $this->resource->id;
    }

    /**
     * Allows for the use of Flag->contactIdNumber
     * @return null if not set
     * @return integer if set
     */
    public function getContactIdNumberAttribute()
    {
        if(!isSet($this->contact))
        {
            return Null;
        }
        return $this->contact->id;
    }

    /**
     * Allows for the use of Flag->eventIdNumber
     * @return null if not set
     * @return integer if set
     */
    public function getEventIdNumberAttribute()
    {
        if(!isSet($this->event))
        {
            return Null;
        }
        return $this->event->id;
    }

    /**
     * Allows for the use of Flag->providerIdNumber
     * @return null if not set
     * @return integer if set
     */
    public function getProviderIdNumberAttribute()
    {
        if(!isSet($this->provider))
        {
            return Null;
        }
        return $this->provider->id;
    }
}
