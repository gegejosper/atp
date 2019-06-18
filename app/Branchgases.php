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

    public function branchpump()
    {
        return $this->hasMany('App\Pump','branchid');
    }
    public function branchdipping()
    {
        return $this->belongsTo('App\Branchdipping','gasid', 'gasid');
    }
    // public function pumps()
    // {
    //     return $this->belongsTo('App\Pump','gasid','id');
    // }


}
