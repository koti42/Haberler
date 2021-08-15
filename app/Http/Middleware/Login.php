<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function App\Helpers\helper\CheckDbConnection;
use function App\Helpers\helper\ClearCache;

class Login
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next)
    {
        //burada giriş yapıldıysa ve veri tabanı bağlantısında sıkıntı yok ise sql/install sayfasına giriş izni vermiyoruz
        //ama quest için bir düzenleme yapılmadı henüz giriş yapılmamış iken quest olanlar sql/install'a erişebiliyor.
        if (CheckDbConnection()) {

            //giriş yapmış kullanıcıların login ekranına tekrar dönmesini engellemek için.
            if (Auth::check() && $request->is('/')) {
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
