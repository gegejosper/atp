<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pumplog extends Model
{
    //
    public function pump()
    {
        return $this->belongsTo('App\Pump','pumpid','id');
    }
}
