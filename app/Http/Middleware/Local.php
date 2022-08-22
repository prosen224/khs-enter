<?php

namespace App\Http\Middleware;
use App;
use Closure;
use Session;
class Local
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
        $available_local = ['en','bn'];
        $locale = session('APP_LOCALE');
        $locale = is_array($available_local) ? $locale : config('app.locale');
        app()->setLocale($locale);

        return $next($request);
    }
}
