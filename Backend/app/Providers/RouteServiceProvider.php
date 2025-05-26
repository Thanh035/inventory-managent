<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::middleware('api')
            ->group(base_path('routes/collection.php'));

        Route::middleware('api')
            ->group(base_path('routes/auth.php'));

        Route::middleware('api')
            ->group(base_path('routes/product.php'));

        Route::middleware('api')
            ->group(base_path('routes/public.php'));

        Route::middleware('api')
            ->group(base_path('routes/user.php'));

            Route::middleware('api')
                        ->group(base_path('routes/group.php'));
    }
}
