<?php

namespace OmgGame\Providers;

use OmgGame\Models\Auth\User\User;
use OmgGame\Policies\Backend\BackendPolicy;
use OmgGame\Policies\Models\User\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        /**
         * Models Policies
         */
        User::class => UserPolicy::class,
        /**
         * Without models policies
         */
        'backend' => BackendPolicy::class
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
    }
}
