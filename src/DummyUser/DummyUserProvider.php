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

    public function retrieveById($identifier)
    {
        $user = $this->cache->get('users.' . $identifier);

        return $user instanceof Authenticatable ? $user : null;
    }

    public function retrieveByToken($identifier, $token)
    {
        // Not implemented yet
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // Not implemented yet
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
