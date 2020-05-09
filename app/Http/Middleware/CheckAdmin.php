<?php

namespace App\Http\Middleware;

use App\Models\User as AppUser;
use App\User;
use Closure;
use App\Models\Permission;
use App\Models\Route;
use App\RoleUser;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        
        if (Auth::guard($guard)->check()) {
            
            $userRoles = Auth::user()->roles->pluck('role_name');
            // dd($userRoles);
            if(!$userRoles->contains('Admin'))
            {
                if(Auth::guard($guard)->check()){
                    return \redirect()->route('error');
                } 
            }
        }
        return $next($request);
 
    }
}


