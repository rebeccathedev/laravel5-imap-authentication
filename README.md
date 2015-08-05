# laravel5-imap-authentication
An authentication provider for Laravel 5 that allows you to authenticate via IMAP.

## Installation

Add the following line to the `require` section of your `composer.json`:

```json
{
    "require": {
        "peckrob/laravel5-imap-authentication": "dev-master"
    }
}
```

Update your packages with ```composer update``` or install with ```composer install```.

## Laravel 5

### Setup

Add the ServiceProvider to the `providers` array in `app/config/app.php`.

```
        App\Providers\AppServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        ...
        peckrob\Laravel5ImapAuthentication\ImapAuthServiceProvider::class,
```

In your `app/config/auth.php`, set the authentication driver to `imap`.

```
    'driver' => 'imap',
```

### Configuration

By default it will attempt to connect to localhost. If you want something different, add `IMAP_AUTH_SERVER` to the **.env** file:

```
IMAP_AUTH_SERVER=mail.example.com
```

## Contribute

Contributions are welcome. :)

https://github.com/peckrob/laravel5-imap-authentication