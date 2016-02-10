<?php

namespace App\Http\Middleware;

use Closure;

use DB;
use Carbon\Carbon;

class LogUserRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $now = Carbon::now()->startOfDay();

        DB::table('request_log')->where('user_id', $user->id)->where('log_date', $now)->increment('request_count');
        
        return $next($request);
    }
}
