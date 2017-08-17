# laravel-dummyuser

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
