<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'firstName','lastName','email','phoneNumber','resource_id',
    ];

    public function resources()
    {
        return $this->belongsTo(Resource::class);
    }
}
