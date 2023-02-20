<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

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
        Response::macro('base_response', function ($data = "", $responseCode = "200", $responseStatus = "OK", $responseMassage = "Success")
        {
            return response()->json([
                "responseCode" => $responseCode,
                "responseStatus" => $responseStatus,
                "responseMassage" => $responseMassage,
                "data" => $data,
            ], $responseCode);
        });
    }
}
