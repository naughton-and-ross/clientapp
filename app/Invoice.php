<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['is_paid'];

    public function client() {
        return $this->belongsTo('App\Client');
    }
}
