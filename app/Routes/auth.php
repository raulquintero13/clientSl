<?php

$app->get( '/login', 'App\Actions\Demo\LoginAction:index')->setName('login');
$app->post('/login', 'App\Actions\Auth\AuthAction:handler');
$app->get('/settings/profile', 'App\Actions\Demo\UsersAction:getProfile');
