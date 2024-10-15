<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        if(Auth::check() && Auth::user()->status == 'غير مفعل'){
            Auth::logout();
            return redirect('/')->withErrors('your account not active');
            //return response('not allowed');

        }else{
            return $next($request);
        }



    }
}
