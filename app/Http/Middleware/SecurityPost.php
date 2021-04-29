<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Post;

class SecurityPost
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
        if(Post::where('id',$request->id)->where('user_id',auth()->user()->id)->exists()){
            return $next($request);
        }else{
            //return redirect('home');
            return abort(403);
        }
    }
}
