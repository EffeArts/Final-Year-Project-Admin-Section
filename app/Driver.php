<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    //
    protected $fillable = [
        'fname', 'lname', 'dob', 'gender', 'nid', 'contact', 'address', 'email', 'driver_lic_number', 'status'
    ];

    public function bus()
    {
        return $this->hasOne('App\Bus');
    }

    public function trips()
    {
        return $this->hasMany('App\Trip');
    }
}
