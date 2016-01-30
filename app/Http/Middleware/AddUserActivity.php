<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use App\User;

class AddUserActivity
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
        $user = Auth::user();

        // set date, if row with current date and user id exists, increment counter by one, if not create row with counter of 1
        //
        // DB::table('user_activity')->increment('votes');
        //
        //
        return $next($request);
    }
}
