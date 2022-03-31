# hyperf-xss-filter
Hyperf middleware that relies on anti-xss
# Install via "composer require"
```shell script
    composer require voku/anti-xss
```
# Modify the Hyperf project configuration file
```php
    Add App\Middleware\XssFilterMiddleware::class to config/middlewares.php
    
    return [
        'http' => [
            App\Middleware\XssFilterMiddleware::class,
            // ...
        ],
    ];
```