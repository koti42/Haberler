<?php

namespace App\Http\Middleware;

use app\Helpers\Helpers\Helper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function App\Helpers\helper\CheckDbConnection;
use function App\Helpers\helper\ClearCache;

class ControlEveryWhere
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
        //Kernel'ın altına ControlEveryWhere isimli middleware'imizi tanımlıyoruz çalışması için
        //burada ise ENV dosyamızı kontrol ediyoruz şifresi doğru mu yada herhangi bir sorunu var mı diye
        //eğer sorun var veya bağlantı kurulamıyor ise 'sql/install' sayfasına yönlendirme yapıyoruz.

        if (!CheckDbConnection() && !$request->is('sql/install'))
        {
            ClearCache();
            return redirect()->route('install');
        }
        if (CheckDbConnection()&&!$request->is('admin')) {
            DB::connection()->disableQueryLog();
            //Helper class'ının altında ki getRoles fonksiyonu çalışıyor eğer veri tabanın da default olarak
            //veri yok ise otomatik ekleme işlemini gerçekleştiriyor.
            Helper::getRoles();

        }


        return $next($request);
    }





}
