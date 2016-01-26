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


        return $next($request);
    }
}
