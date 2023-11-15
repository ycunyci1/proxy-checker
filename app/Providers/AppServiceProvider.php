<?php

namespace App\Providers;

use App\Services\HttpClientService;
use App\Services\HttpClientServiceInterface;
use App\Services\ProxyCheckService;
use App\Services\ProxyCheckServiceInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(ProxyCheckServiceInterface::class, ProxyCheckService::class);
        app()->bind(HttpClientServiceInterface::class, HttpClientService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
