<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $fillable = ['is_complete'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function client() {
        return $this->belongsTo('App\Client');
    }

    public function project_updates()
    {
        return $this->hasMany('App\ProjectUpdate');
    }

    public function project_activity()
    {
        return $this->hasMany('App\ProjectActivity');
    }

    public function project_hours()
    {
        return $this->hasMany('App\ProjectHour');
    }

    public function user_activity()
    {
        return $this->hasOne('App\UserActivity');
    }

    protected static function boot() {
        parent::boot();

        static::created(function($project) {
             $project->user_activity()->create([
                 'user_id' => $project->user_id,
                 'activity_type' => 'project'
             ]);
        });

        static::deleting(function($project) {
             $project->user_activity()->delete();
        });
    }
}
