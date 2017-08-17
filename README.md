# Laravel 5.x dummy user provider

[![Code Quality](https://img.shields.io/scrutinizer/g/akalongman/laravel-dummyuser.svg?style=flat-square)](https://scrutinizer-ci.com/g/akalongman/laravel-dummyuser/?branch=master)
[![Latest Stable Version](https://img.shields.io/github/release/akalongman/laravel-dummyuser.svg?style=flat-square)](https://github.com/akalongman/laravel-dummyuser/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/Longman/laravel-dummyuser.svg)](https://packagist.org/packages/longman/laravel-dummyuser)
[![Downloads Month](https://img.shields.io/packagist/dm/Longman/laravel-dummyuser.svg)](https://packagist.org/packages/longman/laravel-dummyuser)
[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

Dummy (without database) user authorization for Laravel 5.x

## Installation

Install this package through [Composer](https://getcomposer.org/).

Edit your project's `composer.json` file to require `longman/laravel-dummyuser`

Create *composer.json* file:
```json
{
    "name": "yourproject/yourproject",
    "type": "project",
    "require": {
        "longman/laravel-dummyuser": "~1.0"
    }
}
```
And run composer update

**Or** run a command in your command line:

    composer require longman/laravel-dummyuser


After updating composer, add the DummyUserServiceProvider to the providers array in config/app.php

```php
Longman\LaravelDummyUser\DummyUserServiceProvider::class,
```

In the `config/auth.php` file you should add dummy guard in the `guards` array:

```php
'guards' => [
    . . .

    'dummy' => [
        'driver' => 'session',
        'provider' => 'dummy',
    ],
]
```

and provider in the `providers` array

```php
'providers' => [
    . . .

    'dummy' => [
        'driver' => 'dummy',
        'lifetime' => 3600, // Cache lifetime in minutes
    ],
]
```

Now you can specify default guard `dummy` or use like `Auth::guard('dummy')->login($user)`

