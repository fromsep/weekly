<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\Middleware\TransformsRequest;
Use Illuminate\Support\Facades\DB;

class CheckGroup
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
        if(Auth::user()['group_id'] === 0) {
            return redirect(route('group.select'));
        }

        return $next($request);
    }
}
