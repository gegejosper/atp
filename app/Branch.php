<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //
    public function branchgas()
    {
        return $this->hasMany('App\Branchgases','branchid');
    }
}
