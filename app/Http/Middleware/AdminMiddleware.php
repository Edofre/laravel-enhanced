<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Make sure we have a user
        if (!is_null(Auth::user())) {
            // And that that user is an admin
            //            if (Auth::user()->isAdmin()) { // TODO
            return $next($request);
            //            }
        }

        // todo
        // Better UX might be to flash the user and redirect him back to the /home?

        return abort(401, 'Unauthorized');
    }
}