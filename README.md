# hyperf-xss-filter
Hyperf middleware that relies on anti-xss
```php
    Add App\Middleware\XssFilterMiddleware::class to config/middlewares.php
    
    return [
        'http' => [
            App\Middleware\XssFilterMiddleware::class,
            // ...
        ],
    ];
```