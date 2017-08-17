<?php

namespace Longman\LaravelDummyUser;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider as LaravelUserProvider;
use Illuminate\Contracts\Cache\Repository as CacheContract;
use RuntimeException;

class DummyUserProvider implements LaravelUserProvider
{
    /**
     * Application cache repository.
     *
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * Configuration.
     *
     * @var array
     */
    protected $config;

    public function __construct(CacheContract $cache, array $config)
    {
        $this->cache = $cache;
        $this->config = $config;
    }

    protected function getModelName()
    {
        return isset($this->config['model']) ? $this->config['model'] : \App\User::class;
    }

    public function retrieveById($identifier)
    {
        $user_data = $this->cache->get('users.' . $identifier);
        dump('by_id');
        dump($user_data);
        die;
        if (empty($user_data)) {
            return null;
        }

        $model = $this->getModelName();

        return new $model($user_data);
    }

    public function retrieveByToken($identifier, $token)
    {
        throw new RuntimeException('Not implemented yet');
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        throw new RuntimeException('Not implemented yet');
    }

    public function retrieveByCredentials(array $credentials)
    {
        throw new RuntimeException('Not implemented yet');
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        throw new RuntimeException('Not implemented yet');
    }

}
