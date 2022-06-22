<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data, $message = 'Success') {
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => $message,
                'type' => 'success',
            ]);
        });

        Response::macro('error', function ($error, $status_code = 500) {
            return response()->json([
                'success' => false,
                'error' => $error,
                'message' => $error,
                'type' => 'error',
            ], $status_code);
        });
    }
}
