<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $fillable = ['user_id', 'activity_type'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function client()
    {
        return $this->hasOne('App\Client');
    }

    public function invoice()
    {
        return $this->hasOne('App\Invoice');
    }

    public function quote()
    {
        return $this->hasOne('App\Quote');
    }

    public function project_update()
    {
        return $this->hasOne('App\ProjectUpdate');
    }

    public function project_activity()
    {
        return $this->hasOne('App\ProjectActivity');
    }
}
