<?php

namespace App\Providers;

use App\Services\Implements\ToDoListServiceImplement;
use App\Services\ToDoListService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class ToDoListServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        ToDoListService::class => ToDoListServiceImplement::class
    ];

    /**
     * Register providers.
     * 
     * @return array
     */
    public function provides(): array
    {
        return [ToDoListService::class];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
