<?php

namespace App\Providers;

use App\Filament\MyLogoutResponse;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
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

     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        $this->app->bind(LogoutResponseContract::class, MyLogoutResponse::class);
    }


}
