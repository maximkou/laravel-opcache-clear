# Clear OPcache with ease
This Laravel 5 package allows you to clear OPcache, solving a common problem related to cache invalidation during atomic deployments (also called "zero downtime deploy").

_Originally copied from michelecurletta/laravel-opcache-clear, because it is abandoned and now removed._

## Getting Started

These instructions allows you to install the package into an existing Laravel app.

### Prerequisities

Laravel 5 up&running installation.


### Installation

You can install this package via Composer using:

```bash
composer require maximkou/laravel-opcache-clear
```

You must also install this service provider.

```php
// config/app.php
'providers' => [
    ...
    Maximkou\LaravelOpcacheClear\OpcacheClearServiceProvider::class,
    ...
];
```

Check that `url` and `key` options is right defined in your `config/app.php`, example:

```php
// config/app.php
'url' => env('APP_URL', 'http://my-app-url'),
'key' => env('APP_KEY'),
```
### Usage

Once you have installed the package, you can run the following command (usually after deploy):

```bash
php artisan opcache:clear
```
All done! Your OPcache is resetted!

### Customizations

Publish package config, if not published:
```bash
php artisan vendor:publish --provider="Maximkou\LaravelOpcacheClear\OpcacheClearServiceProvider"
```

All settings is placed in `config/laravel-opcache-clear.php`

* Change uri of cleaner action by editing `uri_slug` option (by default is `opcache-clear`).
* Change guzzle client options by editing `guzzle_options` options, to example, for disabling ssl verification:

```php
'guzzle_options' => [
    'verify' => false,
]
```

