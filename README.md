# Laravel 5.x dummy user provider

[![Code Quality](https://img.shields.io/scrutinizer/g/akalongman/laravel-dummyuser.svg?style=flat-square)](https://scrutinizer-ci.com/g/akalongman/laravel-dummyuser/?branch=master)
[![Latest Stable Version](https://img.shields.io/github/tag/akalongman/laravel-dummyuser.svg?style=flat-square)](https://github.com/akalongman/laravel-dummyuser/tags)
[![Total Downloads](https://img.shields.io/packagist/dt/Longman/laravel-dummyuser.svg)](https://packagist.org/packages/longman/laravel-dummyuser)
[![Downloads Month](https://img.shields.io/packagist/dm/Longman/laravel-dummyuser.svg)](https://packagist.org/packages/longman/laravel-dummyuser)
[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

Dummy (without database) user authorization for Laravel 5.x

## Table of Contents
- [Installation](#installation)
- [Usage](#usage)

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

## Usage

You can specify default guard `dummy` in the `config/auth.php` file (`defaults` array) and use just `Auth::` calls, or use `Auth::guard('dummy')`, like `Auth::guard('dummy')->login($user)`

For authenticating users, you need some unique identifier. You can use remote id or something like `md5('some-unique-mail@mail.com')`

In User model you need to add `id` in fillable array. And if you use string `id` also add `protected $keyType = 'string';` field.

Usage example:

```php
<?php
// get some user data from Restful service
$user_data = get_user_data_from_service();
$email = $user_data['email'];

$user = new User(['id' => md5($email), 'name' => $user_data['name'], ...]);

// Log in user
Auth::login($user);

```


## TODO

write tests

## Troubleshooting

If you like living on the edge, please report any bugs you find on the
[laravel-dummyuser issues](https://github.com/akalongman/laravel-dummyuser/issues) page.

## Contributing

Pull requests are welcome.
See [CONTRIBUTING.md](CONTRIBUTING.md) for information.

## License

Please see the [LICENSE](LICENSE.md) included in this repository for a full copy of the MIT license,
which this project is licensed under.

## Credits

- [Avtandil Kikabidze aka LONGMAN](https://github.com/akalongman)
