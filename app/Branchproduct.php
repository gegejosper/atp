<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branchproduct extends Model
{
    //
    public function product()
    {
        return $this->belongsTo('App\Product','productid','id');
    }
}
