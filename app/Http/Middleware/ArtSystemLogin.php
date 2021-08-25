<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use function App\Helpers\helper\CheckDbConnection;
use function App\Helpers\helper\ClearCache;

class ArtSystemLogin
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
        if (CheckDbConnection()) {
            if (auth()->check()) {
                $roles = auth()->user()->roles()->get();
                foreach ($roles as $role) {
                    if ($role->name == "System-Admin") {
                        return $next($request);
                    } else {
                        return back()->with('error', 'Bu Sayfaya Erişim Yetkiniz Yok!');
                    }
                }
            } else if (auth()->guest()) {
                return redirect(route('Admin.login'))->with('error', 'Bilinmeyen Bir Kullanıcı Veya Yetkisiz Erişim!');
            }


        } else if (!CheckDbConnection() && !$request->is('sql/install')) {
            ClearCache();
            return redirect()->route('install');
        }
    }
}
