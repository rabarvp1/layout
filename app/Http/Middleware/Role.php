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

        if (DB::table('roles')->where('name', $role)->where('user_id', Auth::user()?->id)->doesntExist()) {
            abort(403);
        }

        return $next($request);
    }
}
