<?php

namespace App\Providers;

use App\Services\Implements\UserServiceImplement;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public array $singletons = [
        UserService::class => UserServiceImplement::class
    ];

    /**
     * Register providers.
     * 
     * @return array
     */
    public function provides(): array
    {
        return [UserService::class];
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
