<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accountcredit extends Model
{
    //
    public function productdetails()
    {
        return $this->belongsTo('App\Product','product','id');
    }
    public function gas()
    {
        return $this->belongsTo('App\Gastype','product','id');
    }
}
