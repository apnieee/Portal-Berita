<?php

namespace App\Providers;

use App\Http\Responses\FilamentLogoutResponse;
use Filament\Auth\Http\Responses\Contracts\LogoutResponse;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            LogoutResponse::class,
            FilamentLogoutResponse::class
        );
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
