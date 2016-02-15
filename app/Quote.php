<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

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

    public function scopeActive($query)
    {
        return $query->where('is_accepted', '0')
                     ->where('is_rejected', '0');
    }

    public function scopeAccepted($query)
    {
        return $query->where('is_accepted', '1');
    }

    public function scopeIssuedThisFinancialYear($query)
    {
        $start_of_year = Carbon::now()->startOfYear()->subMonths(5);

        return $query->where('issue_date', '>=', $start_of_year);
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
