<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User','userid','id');
    }
}
