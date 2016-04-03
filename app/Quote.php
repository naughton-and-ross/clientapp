<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App;
use Carbon\Carbon;
use SMS;

class Quote extends Model
{
    protected $fillable = ['is_accepted', 'is_rejected'];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
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

        static::created(function($quote) {
            if (App::environment('production')) {
                $quote_amount = '$'.number_format($quote->amount);
                $to_notify = User::all()->except($quote->user->id);

                foreach ($to_notify as $user) {
                    SMS::send($user->phone_number, 'ClientApp: A new quote for '.$quote_amount.' has been issued to '.$quote->client->name.'.');
                }
            }
        });

        static::deleting(function($quote) {
             $quote->user_activity()->delete();
        });
    }
}
