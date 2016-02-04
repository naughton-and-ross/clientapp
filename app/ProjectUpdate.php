<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function scopeDesc($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }
}
