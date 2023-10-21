<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $role)
    {
        if ($request->user() && $request->user()->roles === $role) {
            return $next($request);
        }

        // Redirect unauthorized users
        return redirect()->route('front.index')->with('error', 'You do not have permission to access this page.');
    }
}
