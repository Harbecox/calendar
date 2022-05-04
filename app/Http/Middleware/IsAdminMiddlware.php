<?php


namespace App\Http\Middleware;

use Closure;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdminMiddlware
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if(!Auth::user()->admin){
            return redirect("/");
        }

        return $next($request);
    }
}
