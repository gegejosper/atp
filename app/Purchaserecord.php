<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchaserecord extends Model
{
    //
    public function gasdetail()
    {
        return $this->belongsTO('App\Gastype', 'itemid', 'id');
    }
}
