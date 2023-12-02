<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // local 환경에서만 Provider 등록
//        if ($this->app->environment("local")) {
//            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
//        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
