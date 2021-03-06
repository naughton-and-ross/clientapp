<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectActivity extends Model
{
    protected $fillable= ['activity_title', 'activity_desc', 'activity_icon_code', 'activity_type'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function user_activity()
    {
        return $this->hasOne('App\UserActivity');
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    protected static function boot() {
        parent::boot();

        static::created(function($project_activity) {
             $project_activity->user_activity()->create([
                 'user_id' => $project_activity->user_id,
                 'activity_type' => 'project_activity'
             ]);
        });

        static::deleting(function($project_activity) {
             $project_activity->user_activity()->delete();
        });
    }
}
