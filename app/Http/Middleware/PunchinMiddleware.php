<?php

namespace App\Http\Middleware;

use App\Helpers\Helper;
use App\Models\SalesEmployee;
use Closure;
use Illuminate\Support\Facades\Session;

class PunchinMiddleware
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
        $role_id = Helper::role_id('admin');
        $employee = SalesEmployee::where('id', Session::get('sales_employee_id'))->first();

        if ($role_id != $employee->role_id) {
            if(Helper::check_punch_in() == NULL) {
                $url = url('punch-in');
                return redirect($url);
            }
        }
        return $next($request);
    }
}
