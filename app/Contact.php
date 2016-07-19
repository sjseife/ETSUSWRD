<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function resources()
    {
        return $this->belongsTo(Resource::class);
    }
}
