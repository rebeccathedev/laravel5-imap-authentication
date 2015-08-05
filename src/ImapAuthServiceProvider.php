<?php

namespace peckrob\Laravel5ImapAuthentication;

use App\Auth\ImapUserProvider;
use Illuminate\Support\ServiceProvider;

class ImapAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->extend('imap', function ($app)
        {   
           $model = $app['config']['auth.model'];

           return new ImapUserProvider(new $model, $app["config"]['imap']);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

    protected function registerAuthEvents()
    {
        $app = $this->app;
        $app->after(function ($request, $response) use ($app) {
            // If the authentication service has been used, we'll check for any cookies
            // that may be queued by the service. These cookies are all queued until
            // they are attached onto Response objects at the end of the requests.
            if (isset($app['auth.loaded'])) {
                foreach ($app['auth']->getDrivers() as $driver) {
                    foreach ($driver->getQueuedCookies() as $cookie) {
                        $response->headers->setCookie($cookie);
                    }
                }
            }
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['auth'];
    }
}
