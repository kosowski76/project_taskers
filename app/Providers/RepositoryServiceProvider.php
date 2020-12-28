<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\CustomerProjectContract;
use App\Repositories\CustomerProjectRepository;

class RepositoryServiceProvider extends ServiceProvider
{

    protected $repositories = [
        CustomerProjectContract::class         =>          CustomerProjectRepository::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
