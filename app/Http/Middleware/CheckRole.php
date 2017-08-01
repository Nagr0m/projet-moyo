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
        if ($request->user()->role !== $role)
        {
            if ($request->user()->role === 'teacher')
                return redirect()->route('teacher/home');
            else
                return redirect()->route('student/home');
        }

        return $next($request);
    }
}
