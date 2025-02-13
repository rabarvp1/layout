<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        if (blank(session('locale'))) {
            session([
                'locale'    => 'ku',
                'direction' => 'rtl',
            ]);
        }

        App::setLocale(session('locale'));

        return $next($request);
    }
}
