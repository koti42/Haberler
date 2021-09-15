<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function App\Helpers\helper\CheckDbConnection;
use function App\Helpers\helper\ClearCache;

class Adminn
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


        if (CheckDbConnection()) {
            if (auth()->check()) {
                $roles = auth()->user()->roles()->get();
                foreach ($roles as $role) {
                    if ($role->is_show_admin == 1) {
                        return $next($request);
                    } else {
                        return back()->with('error', 'Bu Sayfaya Erişim Yetkiniz Yok!');
                    }
                }
            } else if (auth()->guest()) {
                //çıkış yapan kullanıcılar ile hiç giriş yapmamış kullanıcıların admin panele erişmesi durumunda ayırt etmek için ek bir kod yazılacak
                return redirect(route('Admin.login'))->with('error', 'Böyle Bir Kullanıcı Bulunamadı!');
            }


        } else if (!CheckDbConnection() && !$request->is('sql/install')) {
            ClearCache();
            return redirect()->route('install');
        }

        return $next($request);

    }


}
