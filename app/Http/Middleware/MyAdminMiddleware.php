<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MyAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->is_admin){
            return $next($request);
        }else{
            return response('No eres admin para poder usar estas funcciones',403);
        }
    }
}
