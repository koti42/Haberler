<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function App\Helpers\helper\CheckDbConnection;
use function App\Helpers\helper\ClearCache;

class PasswordReset
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(CheckDbConnection())
        {
            if (Auth::check() && $request->is('password/reset')) {
                $rols = auth()->user()->roles()->get();
                foreach ($rols as $role) {
                    if (Auth::check() && $role->is_show_admin == 1)
                        return redirect(route('admin.dashboard'));
                    else if (Auth::check() && $role->is_show_admin == 0 && $request->is('admin'))
                        return redirect(route('Admin.login'));
                }
            }
        }

        else if (!CheckDbConnection() && !$request->is('sql/install')) {
            ClearCache();
            return redirect()->route('install');
        }


        return $next($request);
    }
}
