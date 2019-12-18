<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public function subscriber() {
        return $this->belongsTo('App\Subscriber');
    }
}
