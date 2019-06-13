<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branchdipping extends Model
{
    //
    public function gas()
    {
        return $this->belongsTo('App\Gastype','gasid','id');
    }
}
