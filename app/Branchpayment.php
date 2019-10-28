<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branchpayment extends Model
{
    //
    public function bill()
    {
        return $this->belongsTo('App\Accountbill','billid','id');
    }
}
