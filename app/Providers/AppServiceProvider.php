<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Stok;
use App\Models\BukuKas;
use App\Models\Piutang;
use App\Observers\StokObserver;
use App\Observers\BukuKasObserver;
use App\Observers\PiutangObserver;
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
        Stok::observe(StokObserver::class);
        BukuKas::observe(BukuKasObserver::class);
        Piutang::observe(PiutangObserver::class);
    }
}
