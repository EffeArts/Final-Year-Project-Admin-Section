<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    //
    public function route()
    {
        return $this->belongsTo('App\Route');
    }

    public function card()
    {
        return $this->belongsTo('App\Card');
    }

    public function bus()
    {
        return $this->belongsTo('App\Bus');
    }

    public function driver()
    {
        return $this->belongsTo('App\Driver');
    }
}
