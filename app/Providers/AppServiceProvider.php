<?php

namespace App\Providers;

use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Log;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Paginator::useBootstrap();
    }
}
