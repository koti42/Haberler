<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            $response  = Http::get("https://api.openweathermap.org/data/2.5/forecast/daily?",[
                'id'=>'323786',
                'cnt'=>'1',
                'units'=>'metric',
                'lang'=>'tr',
                'appid'=>'7cea0f49b58f43aea3bcc39310955a52',
            ]);

            $results= $response->json();
            $city_name=$results['city']['name'];
            //Arr Metodu nereden türüyor bir documention'ı incele
            $status_weather= Arr::get($results, 'list.0.weather.0.description');
            $temp=Arr::get($results, 'list.0.temp.day');

            View::share('city_name',$city_name);
            View::share('status_weather',$status_weather);
            View::share('temp',$temp);

        }
        catch (Throwable $exception)
        {
            return $exception;
        }
    }
}
