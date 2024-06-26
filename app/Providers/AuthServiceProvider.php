<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Passport::routes();
        Passport::tokensCan([
            'admin'    => 'Access Admin Backend',
            'staff'    => 'Access Staff Backend',
            'customer' => 'Access Customer App',
            'role'     => 'Description for role',
        ]);

        Passport::setDefaultScope([
            'customer',
        ]);
    }
}
