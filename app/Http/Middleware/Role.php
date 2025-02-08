<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{

    public function handle(Request $request, Closure $next, string $role = null): Response
    {
        $user = auth::check() && Auth::user()->role === $role;
        if ($user) {
           

            return $next($request);


        }

        return redirect('/');
    }
}
