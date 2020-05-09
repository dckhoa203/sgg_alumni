<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use App\Models\Permission;
use App\Models\Route;
use Request;
//use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Route;
class PermissionMiddleware
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
        if(Auth::check()){
            //lay id nguoi dung

            //checkroute=false;
            
            $id = Auth::user()->user_id;
            $urll = Request::path();
            
            //lay id cua nguoi phan quyen
            $permission = permission::where('role_id','=',$id)->get();
                foreach($permission as $per)
                    $route[] = $per->route_id;

                //echo $route[1];

            //lay route thuoc quyen   
                if (isset($route))
                    foreach($route as $rou)
                        $routes[] = route::where('route_id','=',$rou)->get();

            //so sanh de lay quyen 
               //echo $routes[0];
                if (isset($routes))
                    foreach($routes as $rous){
                        foreach($rous as $r)
                        //echo $r->route_id;
                            if ($urll == $r->route_link)
                                return $next($request);
                }
            return redirect('error');

        }
        else
            return redirect('login');
    
    }
}
