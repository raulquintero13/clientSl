<?php

return [
    'displayErrorDetails' => env('APP_DEBUG', false),
    'determineRouteBeforeAppMiddleware' => false,
    // 'routerCacheFile' => storage_path() . '/cache/routes.php',
    'timezone' => 'Europe/Lisbon',
    'session' => [
        'name' => 'app',
        'lifetime' => 7200,
        'path' => '/',
        'domain' => null,
        'secure' => false,
        'httponly' => true,
        'cache_limiter' => 'nocache',
        'filesPath' => STORAGE_PATH.'sessions',
    ],

    'middlewares' => require 'middlewares.php',

    'services' => require 'services.php',

    'serverApi' => require 'serverApi.php',

    'logger' => require 'logger.php',

    'twig' => require 'twig.php',

    'database' => require 'database.php',
    
    'encryption' => require 'encryption.php',

];
