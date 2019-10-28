<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commuter extends Model
{
    //
    protected $fillable = [
        'user_id', 'contact', 'card_id'
    ];

    public function card()
    {
        return $this->belongsTo('App\Card');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
