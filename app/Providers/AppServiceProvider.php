<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        Response::macro('api', function ($message, $statusCode = 200, $status = true, $errorNum = null, $data = null) {
            $responseData = [
                'status' => $status,
                'errorNum' => $errorNum,
                'message' => $message,
            ];

            if ($data)
                $responseData = array_merge($responseData, ['data' => $data]);

            return response()->json($responseData, $statusCode);
        });
    }
}
