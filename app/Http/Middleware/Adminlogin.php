<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use App\Admin;
use Closure;
use Illuminate\Support\Facades\Session;

class Adminlogin
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
        if(empty(Session::has('adminSession'))){
            return redirect('/admin');
        }else{
            //Get Admin/Sub Admin Details
            $adminDetails = Admin::where('username',Session::get('adminSession'))->first();
            $adminDetails = json_decode(json_encode($adminDetails),true);
            if($adminDetails['type']=="Admin"){
                $adminDetails['categories_full_access']=1;
                $adminDetails['categories_view_access']=1;
                $adminDetails['categories_edit_access']=1;
                $adminDetails['products_access']=1;
                $adminDetails['orders_access']=1;
                $adminDetails['users_access']=1;
            }
            Session::put('adminDetails',$adminDetails);
        }
        return $next($request);
    }
}
