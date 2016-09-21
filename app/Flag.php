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
        'date', 'level', 'comments', 'resolved', 'submitted_by', 'user_id', 'resource_id', 'contact_id'
    ];

    /**
     * Get a list of resource associated with the current flag
     * @return array
     */
    public function resource()
    {
        return $this->belongsTo('App\Resource');
    }

    /**
     * Get a list of contact associated with the current flag
     * @return array
     */
    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }

    /**
     * Get a list of user associated with the current flag
     * NOTE: This is the user that is being flagged
     * @return array
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get a list of user associated with the current flag
     * NOTE: This is the user that submitted the flag
     * @return array
     */
    public function submitter()
    {
        return $this->belongsTo('App\User', 'submitted_by');
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
     * Allows for the use of Flag->userIdNumber
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
}
