<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'Contact';
    
    public function resources()
    {
        return $this->belongsTo(Resource::class);
    }
}
