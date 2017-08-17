<?php

namespace Longman\LaravelDummyUser;

use Illuminate\Auth\AuthManager;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Cache\Repository as CacheContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class DummyUserServiceProvider extends ServiceProvider
{
    public function boot(AuthManager $auth)
    {
        $auth->provider('dummy', function (Application $app, array $config) {
            /** @var \Illuminate\Contracts\Cache\Repository $cache */
            $cache = $app->make(CacheContract::class);

            $this->app['events']->listen(Login::class, function ($event) use ($config, $cache) {
                if (! $event->user instanceof Authenticatable) {
                    return false;
                }

                $id = $event->user->id;
                if (! $id) {
                    return false;
                }
                $cache->put('users.' . $id, $event->user, $config['lifetime']);
            });

            $this->app['events']->listen(Logout::class, function ($event) use ($config, $cache) {
                if (! $event->user instanceof Authenticatable) {
                    return false;
                }

                $id = $event->user->id;
                if (! $id) {
                    return false;
                }
                $cache->forget('users.' . $id);
            });

            return new DummyUserProvider($cache, $config);
        });
    }

}
