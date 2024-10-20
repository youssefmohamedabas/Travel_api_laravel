<?php

namespace App\Providers;

use App\Models\Travel;
use App\Observers\TravelObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $observers = [
        Travel::class => [TravelObserver::class],
    ];

    public function boot()
    {
        parent::boot();
    }
}