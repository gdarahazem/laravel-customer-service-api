<?php

namespace App\Providers;

use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use App\Repositories\Service\ServiceRepository;
use App\Repositories\Interfaces\Service\ServiceRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Customer Repository Binding
        $this->app->bind(
            CustomerRepositoryInterface::class,
            CustomerRepository::class
        );

        // Service Repository Binding
        $this->app->bind(
            ServiceRepositoryInterface::class,
            ServiceRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
