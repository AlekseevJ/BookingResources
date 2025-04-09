<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Cache\CachingModelService;
use App\Interfaces\IModelService;

class ModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IModelService::class, function ($app, $parameters) {
            return new $parameters['service']();
        });

        foreach (\App\Enums\ServiceBinding::cases() as $binding) {
            $this->app->when($binding->getControllerClass())
                ->needs(IModelService::class)
                ->give(fn() => $this->app->make(IModelService::class, [
                    'service' => $binding->getServiceClass(),
                ]));
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
