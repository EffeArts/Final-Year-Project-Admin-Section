<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EndPoint extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function route_departure()
    {
        return $this->hasMany('App\Route');
    }

    public function route_destination(){
    	return $this->hasMany('App\Route');
    }

}
