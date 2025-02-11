<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    public function handle(Request $request, Closure $next, string $role = null): Response
    {
        if (Auth::user()->is_super === 'SUPER' || DB::table('roles')->where('name', $role)->where('user_id', Auth::user()?->id)->exists()) {
            return $next($request);
        }

        abort(403);
    }
}
