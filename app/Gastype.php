<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gastype extends Model
{
    //

    public function branchgas()
    {
        return $this->hasMany('App\Branchgases','gasid');
    }
}
