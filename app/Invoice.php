<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Invoice extends Model
{
    protected $fillable = ['is_paid'];

    public function client() {
        return $this->belongsTo('App\Client');
    }

    public function scopeActive($query)
    {
        return $query->where('is_paid', '0');
    }

    public function scopeOverdue($query)
    {
        $now = Carbon::now()->toDateTimeString();

        return $query->where('is_paid', '0')
                     ->where('due_date', '<', $now);
    }

    public function scopePaidInLastThirtyDays($query)
    {
        $month_ago = Carbon::now()->subDays(29);

        return $query->where('is_paid', '1')
                     ->where('paid_at', '>', $month_ago);
    }
}
