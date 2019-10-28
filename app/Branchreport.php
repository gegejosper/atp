<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branchreport extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User','userid','id');
    }
}
