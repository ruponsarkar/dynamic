<?php

namespace App\Http\Middleware;

use Closure;
// use Session;
use Illuminate\Http\Request;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       if(!session()->has('LoggedUser') && ($request->path() != 'login' && $request->path() != 'register' )){
           return redirect('login')->with('message', 'You must be Logged in');
       }

       if(session()->has('LoggedUser') && ($request->path() == 'login' || $request->path() == 'register')){
           return redirect('admin_index');
       }


        return $next($request);
    }
}
