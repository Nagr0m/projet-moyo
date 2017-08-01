<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Controls the shown back-office with role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {   
        if ($role === 'student')
        {
            if ($request->user()->role === 'teacher')
                return redirect('/teacher/home');
        }
        else
        {
            if ($request->user()->role !== 'teacher')
                return redirect('/student/home');
        }

        return $next($request);
    }
}
