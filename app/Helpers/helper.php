<?php

namespace App\Helpers\helper;

use Faker\Core\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades;

if (!function_exists('ClearCache')) {
    function ClearCache()
    {
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('key:generate');
    }
}

//ControlEveryWhere'de kullandığımız CheckDbConnection class'ı helper'ın altında yer alıyor yani burada.
//burada veri tabanı kontrolleri yapılıyor bağlantı ve şifre doğru mu diye ve geriye bir değer döndürüyor.
if (!function_exists('CheckDbConnection')) {
    function CheckDbConnection()
    {
        $dbControl = @mysqli_connect(
            //env metodunun altında DB_CONNECTION METODUNU KULLANDIĞIMIZI BELİRTMEK İÇİN DB_CONNECTİON YAZIYORUZ
        //ENV DOSYASINDA KI ADINI ALIYORUZ YANİ KISACANASI
        //BAŞKA BİR İSME ERİŞMEK İSTESEYDİK ONU DA KULLANABİLİRDİK MESELA ENV DOSYASINI AÇARAK ORADAN 'MAIL_MAILER' YAZARAK MAİL_HOST'U NA ERİŞMEK İSTEDİĞİMİZİ BELİRTEBİLİRDİM.
        //CONFİG'İN DE DATABASE.CONNECTİONS'I BİR ÖZELLİK OLARAK GEÇİYOR.
            config('database.connections.' . env('DB_CONNECTION') . '.host'),
            config('database.connections.' . env('DB_CONNECTION') . '.username'),
            config('database.connections.' . env('DB_CONNECTION') . '.password')
        );
        if ($dbControl)
            return mysqli_select_db($dbControl, config('database.connections.' . env('DB_CONNECTION') . '.database'));
        return false;

    }
}

if (!function_exists('getVar')) {
    function getVar($list)
    {
//resource_path komutu klasörlere hızlı erişim şansı veriyor uzun uzun yolunu yazmadan resource klasörüne girebiliyorsunuz
//örnek app_path bootstrap_path gibi düşünülebilir
 $file=resource_path('vars/'.$list.'.json');
 if (Facades\File::exists($file)){

     return json_decode(file_get_contents($file),true);
 }
 return [];
    }
}





