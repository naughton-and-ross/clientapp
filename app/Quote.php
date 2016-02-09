<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = ['is_accepted', 'is_rejected'];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function user_activity()
    {
        return $this->hasOne('App\UserActivity');
    }
}
