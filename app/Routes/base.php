<?php

$app->get('/', 'App\Controllers\Base\HomeController:homeAction')->setName('home');
$app->get('/dashboard', 'App\Controllers\Base\HomeController:dashboardAction')->setName('dashboard');

$app->get('/pos', 'App\Controllers\Modules\PosController:posAction');

// $app->map(['GET','POST'],'/users', 'App\Actions\Demo\UsersAction:getAllUsers')->setName('users');

// $app->map(['GET','POST'],'/user/{id}', 'App\Actions\Demo\UsersAction:getUserById');
// $app->map(['GET','POST'],'/user/{id}/edit', 'App\Actions\Demo\UsersAction:editUserById');
// $app->map(['GET','POST'],'/user/{id}/save', 'App\Actions\Demo\UsersAction:editUserById');

// $app->get('/user/{id}', 'App\Actions\Demo\UsersAction:getUserById');
// $app->post('/user/{id}', 'App\Actions\Demo\UsersAction:editUserById');
