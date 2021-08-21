<?php

namespace App\Helpers\helper;

use Faker\Core\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\DB;
use Throwable;

if (!function_exists('ClearCache')) {
    function ClearCache()
    {
        Artisan::call('queue:clear', [
            '--force' => true

        ]);
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
    }
}

//ControlEveryWhere'de kullandığımız CheckDbConnection class'ı helper'ın altında yer alıyor yani burada.
//burada veri tabanı kontrolleri yapılıyor bağlantı ve şifre doğru mu diye ve geriye bir değer döndürüyor.
if (!function_exists('CheckDbConnection')) {
    function CheckDbConnection()
    {
        try {
            DB::connection()->getPdo();
            return true;

        } catch (Throwable $exception) {
            return false;
        }


    }
}

if (!function_exists('getVar')) {
    function getVar($list)
    {
//resource_path komutu klasörlere hızlı erişim şansı veriyor uzun uzun yolunu yazmadan resource klasörüne girebiliyorsunuz
//örnek app_path bootstrap_path gibi düşünülebilir
        $file = resource_path('vars/' . $list . '.json');
        if (Facades\File::exists($file)) {

            return json_decode(file_get_contents($file), true);
        }
        return [];
    }
}





