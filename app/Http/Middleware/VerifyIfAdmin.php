<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class VerifyIfAdmin
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
        if (!Auth::guard('admin')->check()) {
            if ($request->wantsJson()) {
                return response()->json(['Message', 'You do not access to this module.'], 403);
            }
            return redirect()->route('admin.login');
            //abort(403, 'You do not access to this module.');
        }
        return $next($request);
    }
}
