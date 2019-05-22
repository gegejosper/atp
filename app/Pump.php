<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pump extends Model
{
    //
    public function gastype()
    {
        return $this->belongsTo('App\Gastype','gasid','id');
    }
}
