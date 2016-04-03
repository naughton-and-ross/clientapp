<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moodboard extends Model
{
    protected $fillable = ['user_id', 'client_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function client() {
        return $this->belongsTo('App\Client');
    }

    public function project() {
        return $this->belongsTo('App\Project');
    }

    public function moodboard_posts() {
        return $this->hasMany('App\MoodboardPost');
    }
}
