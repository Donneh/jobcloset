<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\AdyenSettings;
use App\Policies\AdyenSettingsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        AdyenSettings::class => AdyenSettingsPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
