<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function App\Helpers\helper\CheckDbConnection;
use function App\Helpers\helper\ClearCache;

class DataControl
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
            //tarayıcıdan gelen link isteğin de sql/install var mı diye kontrol ediyoruz
            //var ise ve veri bağlantısı var ise admin.login sayfasına yönlendirme yapıyoruz.
            if ($request->is('sql/install')) {
                if (auth()->check()) {
                    $rols = auth()->user()->roles()->get();

                    foreach ($rols as $role) {
                        if (Auth::check() && $role->is_show_admin == 1)
                            return redirect(route('admin.dashboard'));
                        else
                            return redirect(route('Admin.login'));
                    }

                } else {
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
