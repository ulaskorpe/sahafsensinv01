<?php

namespace App\Http\Middleware;
//use Illuminate\Support\Facades\Cookie;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
//use App\Models\User;
use App\Models\Role;
class checkAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if(empty(Session::get('admin_code')) || empty(Auth::id())){
            Session::forget('admin_code');
            Auth::logout();
            Cookie::queue('remember_me', '',0);
            return redirect()->route('admin-login');

        }else{
            // echo Auth::id();
            // echo Session::get('admin_code');
            $data = [
                'role'=> Role::find(auth()->user()->role_id)
            ];

             view()->share(['data'=>$data]);
        }


        return $next($request);
        
        if(Auth::user() == null || Session::get('admin_code') == null){
            Auth::logout();
           
             return redirect(route('admin-login'));
         
        }
        view()->share(['product_count'=> Product::whereNull('verified')->count(),'admin_code'=>Auth::user()->admin_code]);
        
        return $next($request);
    }
}
