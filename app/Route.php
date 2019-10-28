<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    //
	protected $fillable = [
        'departure_id', 'destination_id', 'fare'
    ];

    public function departure()
    {
        return $this->belongsTo('App\EndPoint');
    }

    public function destination()
    {
        return $this->belongsTo('App\EndPoint');
    }

    public function buses()
    {
        return $this->hasMany('App\Bus');
    }

    public function trips()
    {
        return $this->hasMany('App\Trip');
    }
}
