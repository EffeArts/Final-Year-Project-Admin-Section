<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //
    protected $fillable = [
        'unique_id', 'balance', 'user_id', 'passcode', 'status'
    ];

    public function commuter()
    {
        return $this->hasOne('App\Commuter');
    }

    public function trips()
    {
        return $this->hasMany('App\Trip');
    }
}
