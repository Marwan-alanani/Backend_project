<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OnlyAdmins
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
        if(auth()->user()!==null){
            $Role=auth()->user()->Role;
            if($Role == "Admin"){
                return $next($request);
            }
            else{
                abort(403);
            }
        }
        else{
            abort(403);
        }
    }
}
