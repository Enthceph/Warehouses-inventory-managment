<?php

namespace App\Http\Middleware;

use Closure;
use DebugBar\DebugBar;
use Illuminate\Http\Request;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {

        $user = $request->user();
        \Barryvdh\Debugbar\Facades\Debugbar::log('debug in checkRole');

        if (! $user || ! in_array($user->load('role'), $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);

    }
}
