<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App;
use SMS;

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

    public function moodboard()
    {
        return $this->hasOne('App\Moodboard');
    }

    public function moodboard_posts()
    {
        return $this->hasMany('App\MoodboardPost');
    }

    protected static function boot() {
        parent::boot();

        static::created(function($project) {
             $project->user_activity()->create([
                 'user_id' => $project->user_id,
                 'activity_type' => 'project'
             ]);
             $project->moodboard()->create([
                 'user_id' => $project->user_id,
                 'client_id' => $project->client_id
             ]);
        });

        static::created(function($project) {
            if (App::environment('production')) {
                $to_notify = User::all()->except($project->user->id);

                foreach ($to_notify as $user) {
                    SMS::send($user->phone_number, 'ClientApp: A new project ('.$project->name.') has been added for '.$project->client->name.'.');
                }
            }
        });

        static::deleting(function($project) {
             $project->user_activity()->delete();
        });
    }
}
