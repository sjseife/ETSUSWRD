<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'Contact';

    protected $fillable = [
        'firstName','lastName','email','phoneNumber','resourceId',
    ];

    public function resources()
    {
        return $this->belongsTo(Resource::class);
    }
}
