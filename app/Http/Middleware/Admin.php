<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
        // dd(Auth::user()->role);
        // dd($request->all());
        // return $next($request);
        // if (!Auth::check()) {
        //     return redirect()->route('login');
        // }

        // if (Auth::user()->role == 'admin') {
        //     // dd('here');
        //     // return '/admin';
        //     return redirect('/');
        // }

        // if (Auth::user()->role == 'teacher') {
        //     return redirect()->route('teacher_dashboard');
        // }

        // if (Auth::user()->role == 'student') {
        //     return redirect()->route('student_dashboard');
        // }
           // return $next($request);
        if( Auth::check() )
        {
            // if user is not admin take him/her to his dashboard
            if ( Auth::user()->isTeacher() ) {
                 return redirect(route('teacher'));
            }
            if ( Auth::user()->isStudent() ) {
                 return redirect(route('student'));
            }
            // allow admin to proceed with request
            else if ( Auth::user()->isAdmin() ) {
                 return $next($request);
            }
        }

        abort(404);  // for other user throw 404 error
    }
}
