<?php


namespace App\Http\Middleware;

use App\Models\Task;
use Closure;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskOvnerMiddleware
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $task_id = $request->get("task_id");
        return Task::find($task_id)->isOwner() ? $next($request) : back();
    }
}
