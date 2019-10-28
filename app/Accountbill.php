<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accountbill extends Model
{
    //
    public function account()
    {
        return $this->belongsTo('App\Account','accountid','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','userid','id');
    }
}
