<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$pemissions)
    {
        if (! Auth::guard('staff')->user()->hasPermission($pemissions)) {
            return redirect()->back()->withErrors(['message' => implode(', ', $pemissions) . ' の権限がありません。']);
        }
        return $next($request);
    }
}
