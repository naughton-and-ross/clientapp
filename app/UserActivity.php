<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class UserActivity extends Model
{
    protected $fillable = ['user_id', 'activity_type'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    public function quote()
    {
        return $this->belongsTo('App\Quote');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function project_update()
    {
        return $this->belongsTo('App\ProjectUpdate');
    }

    public function project_activity()
    {
        return $this->belongsTo('App\ProjectActivity');
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('id', 'desc')->take(8);
    }

    public function read_status()
    {
        $read_status = DB::table('user_activities_read_status')->where('activity_id', $this->id)->pluck('is_read');

        return $read_status;
    }
}
