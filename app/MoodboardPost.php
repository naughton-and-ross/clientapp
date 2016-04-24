<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoodboardPost extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function client() {
        return $this->belongsTo('App\Client');
    }

    public function moodboard() {
        return $this->belongsTo('App\Moodboard');
    }

    public function scopeLatest($query) {
        return $query->orderBy('created_at', 'desc');
    }
}
