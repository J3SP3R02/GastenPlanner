<?php

namespace App\Providers;

use App\Models\Guestlist;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Database\Factories\GuestlistFactory;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(GuestlistFactory::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request): void
    {
    }
}

