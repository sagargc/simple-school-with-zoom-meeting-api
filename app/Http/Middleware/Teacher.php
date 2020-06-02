<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Teacher
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
        if( Auth::check() )
        {
            // if user is not teacher take him/her to his dashboard
            if ( Auth::user()->isStudent() ) {
                 return redirect(route('student'));
            }
            if ( Auth::user()->isAdmin() ) {
                 return redirect(route('admin'));
            }
            // allow teacher to proceed with request
            else if ( Auth::user()->isTeacher() ) {
                 return $next($request);
            }
        }

        abort(404);  // for other user throw 404 error
    }
}
