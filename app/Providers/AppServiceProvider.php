<?php

namespace App\Providers;

use App\Models\EjercicioParticipanteFase;
use App\Observers\EjercicioParticipanteFaseObserver;
use Illuminate\Support\ServiceProvider;

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
        EjercicioParticipanteFase::observe(EjercicioParticipanteFaseObserver::class);

    }
}
