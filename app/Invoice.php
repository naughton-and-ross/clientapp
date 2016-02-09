<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Invoice extends Model
{
    protected $fillable = ['is_paid', 'summary'];

    public function client() {
        return $this->belongsTo('App\Client');
    }

    public function user_activity()
    {
        return $this->hasOne('App\UserActivity');
    }

    public function scopePaid($query)
    {
        return $query->where('is_paid', '1');
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
        $month_ago = Carbon::now()->subDays(30);

        return $query->paid()
                     ->where('paid_at', '>', $month_ago);
    }

    public function scopePaidInPreviousThirtyDays($query)
    {
        $month_ago = Carbon::now()->subDays(30);
        $two_months_ago = Carbon::now()->subDays(60);

        return $query->paid()
                     ->where('paid_at', '>=', $two_months_ago)
                     ->where('paid_at', '<=', $month_ago);
    }

    public function scopePaidThisCalenderYear($query)
    {
        $start_of_year = Carbon::now()->startOfYear();

        return $query->paid()
                     ->where('paid_at', '>=', $start_of_year);
    }

    public function scopePaidLastCalenderYear($query)
    {
        $start_of_year = Carbon::now()->startOfYear()->subYear(1);
        $end_of_year = Carbon::now()->endOfYear()->subYear(1);

        return $query->paid()
                     ->where('paid_at', '>=', $start_of_year)
                     ->where('paid_at', '<=', $end_of_year);
    }

    public function scopePaidThisFinancialYear($query)
    {
        $start_of_year = Carbon::now()->startOfYear()->subMonths(5);

        return $query->paid()
                     ->where('paid_at', '>=', $start_of_year);
    }

    public function scopePaidLastFinancialYear($query)
    {
        $start_of_year = Carbon::now()->startOfYear()->subYears(1)->subMonths(5);
        $end_of_year = Carbon::now()->startOfYear()->subMonths(5);


        return $query->paid()
                     ->where('paid_at', '>=', $start_of_year)
                     ->where('paid_at', '<=', $end_of_year);
    }

    public function HumanDueDate($due_date)
    {
        $due_date = Carbon::parse($due_date);
        return $due_date->diffForHumans();
    }
}
