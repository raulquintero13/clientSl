<?php

return [
    'displayErrorDetails' => env('APP_DEBUG', false),
    'determineRouteBeforeAppMiddleware' => false,
    'routerCacheFile' => storage_path() . '/cache/routes.php',

    'middlewares' => require 'middlewares.php',

    'services' => require 'services.php',

    'logger' => require 'logger.php',

    'twig' => require 'twig.php',

    'database' => require 'database.php',
    
    'encryption' => require 'encryption.php',

];
