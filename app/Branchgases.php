<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branchgases extends Model
{
    //
    public function gas()
    {
        return $this->belongsTo('App\Gastype','gasid','id');
    }
}
