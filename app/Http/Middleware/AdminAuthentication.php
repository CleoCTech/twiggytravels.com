<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthentication
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
        // info(Auth::user()->user_category);
        // info( 'profile->profile_category: ' .Auth::user()->profile->profile_category );
        if(Auth::user()->user_category == 100 && Auth::user()->profile != null && Auth::user()->profile->profile_category == 'Administrator' || Auth::user()->profile->profile_category == 'administrator' || Auth::user()->profile->profile_category == 'admin'){
           // info('YES');
            return $next($request);
        }else{
            return redirect()->back()->with('error','Permission Denied');
        }
    }
}