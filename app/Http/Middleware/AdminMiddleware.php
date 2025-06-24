<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
        if(!auth()->check()){
            return redirect('/admin/login');
        }
        if($request->isMethod('post')){
            return redirect('/admin/login');
        }
        // $admin = auth()->user()->role;
        if(auth()->user()->role === "admin"){
            return $next($request);
        }else{
            return redirect('/admin/login');
        }
    }
}
