<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use SMS;

class ProjectUpdate extends Model
{
    protected $table = 'project_updates';

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
        return $query->orderBy('created_at', 'DESC');
    }

    protected static function boot() {
        parent::boot();

        static::created(function($project_update) {
             $project_update->user_activity()->create([
                 'user_id' => $project_update->user_id,
                 'activity_type' => 'project_update'
             ]);
        });

        static::created(function($project_update) {
            if (App::environment('production')) {
                $to_notify = User::all()->except($project_update->user->id);

                foreach ($to_notify as $user) {
                    SMS::send($user->phone_number, 'ClientApp: There\'s new project update for '.$project_update->project->name.' ('.$project_update->project->client->name.'): '.$project_update->comment);
                }
            }
        });

        static::deleting(function($project_update) {
             $project_update->user_activity()->delete();
        });
    }
}
