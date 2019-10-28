<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    //
    protected $fillable = [
        'driver_id', 'route_id', 'model', 'number_plate',
    ];

    public function driver()
    {
        return $this->belongsTo('App\Driver');
    }

    public function route()
    {
        return $this->belongsTo('App\Route');
    }
}
