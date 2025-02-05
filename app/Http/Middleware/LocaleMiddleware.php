<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the session has a 'locale' value, otherwise default to 'en'
        $locale = Session::get('locale', 'en');

        // Set the locale for the application
        App::setLocale($locale);

        return $next($request);
    }
}
