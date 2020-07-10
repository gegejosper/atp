<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branchdipping extends Model
{
    //
    public function branchgas()
    {
        return $this->belongsTo('App\Branchgases','gasid','id');
    }
    
}
