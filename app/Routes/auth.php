<?php

$app->get('/login', 'App\Controllers\Demo\LoginController:index')->setName('login');
$app->post('/login', 'App\Controllers\Auth\AuthController:handler');
