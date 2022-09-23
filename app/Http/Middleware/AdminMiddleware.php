<?php

namespace App\Http\Middleware;

use App\Models\SalesRole;
use Closure;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
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
        if(Session::has('sales_employee_id')) {

            $sales_employee_role_id = Session::get('sales_employee_role_id');
            $role = SalesRole::where('id', $sales_employee_role_id)->first();

            if($role->name == 'admin') {
                return $next($request);
            } else {
                return redirect(url('/'));
            }
        } else {
            return redirect(url('/'));
        }
    }
}
