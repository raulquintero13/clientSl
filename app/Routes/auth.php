<?php

<<<<<<< HEAD
$app->get( '/login', 'App\Controllers\Base\LoginController:LoginAction')->setName('login');
$app->post('/login', 'App\Controllers\Base\LoginController:attempAction');
$app->get('/settings/profile', 'App\Controllers\Base\LoginController:showProfileAction');
=======
$app->get( '/login', 'App\Actions\Demo\LoginAction:index')->setName('login');
$app->post('/login', 'App\Actions\Auth\AuthAction:handler');
$app->get('/settings/profile', 'App\Actions\Demo\UsersAction:getProfile');
$app->post('/settings/profile', 'App\Actions\Demo\UsersAction:getProfile');

$app->get('/settings', 'App\Actions\Demo\UsersAction:menuSettings');
>>>>>>> 34b162e0fa1d4521b2d4dbc81e7103d98a9f0d4f
