<?php

return [
  		// default db connection settings
    'dev' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'pos',
        'user' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => ''
    ],
    'prod' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'pos',
        'user' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => ''
    ],
    'db_illuminate' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'store',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ]
];