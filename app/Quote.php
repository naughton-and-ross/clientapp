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

    protected static function boot() {
        parent::boot();

        static::created(function($quote) {
             $quote->user_activity()->create([
                 'user_id' => $quote->user_id,
                 'activity_type' => 'quote'
             ]);
        });

        static::deleting(function($quote) {
             $quote->user_activity()->delete();
        });
    }
}
