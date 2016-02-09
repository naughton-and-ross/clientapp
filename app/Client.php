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

    public function user_activity()
    {
        return $this->hasOne('App\UserActivity');
    }

    protected static function boot() {
        parent::boot();

        static::created(function($client) {
             $client->user_activity()->create([
                 'user_id' => $client->user_id,
                 'activity_type' => 'client'
             ]);
        });

        static::deleting(function($client) {
             $client->user_activity()->delete();
        });
    }
}
