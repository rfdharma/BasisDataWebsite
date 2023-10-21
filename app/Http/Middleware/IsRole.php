<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsRole
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */
	public function handle(Request $request, Closure $next)
	{
        if ($request->user()->roles == 'OWNER') {
            return $next($request);
        } elseif (auth()->check() && auth()->user()->roles === 'ADMIN') {
            return redirect()->route('admin.dashboard');
        }
		return redirect()->route('front.index');
	}
}
