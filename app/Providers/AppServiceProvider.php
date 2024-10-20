<?php

namespace App\Providers;

use App\Models\Travel;
use App\Observers\TravelObserver;
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
    protected $observers=[
        Travel::class =>[TravelObserver::class]
            
        ];
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Travel::observe(TravelObserver::class);
    }
}