<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Student
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
            // if user is not student take him/her to his dashboard
            if ( Auth::user()->isTeacher() ) {
                 return redirect(route('teacher'));
            }
            if ( Auth::user()->isAdmin() ) {
                 return redirect(route('admin'));
            }
            // allow student to proceed with request
            else if ( Auth::user()->isStudent() ) {
                 return $next($request);
            }
        }

        abort(404);  // for other user throw 404 error
    }
}
