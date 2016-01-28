<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = ['id', 'public_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function projects() {
        return $this->hasMany('App\Project');
    }

    public function invoices() {
        return $this->hasMany('App\Invoice');
    }

    public function quotes() {
        return $this->hasMany('App\Quote');
    }
}
