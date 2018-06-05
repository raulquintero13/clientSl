<?php

$app->get('/', 'App\Controllers\Demo\HomeController:index')->setName('home');
$app->get('/hello/{name}', 'App\Controllers\Demo\HelloController:index');
$app->get('/pos', 'App\Controllers\Demo\PosController:index');
$app->get('/list', 'App\Controllers\Demo\ListController:index');
$app->get('/blank', 'App\Controllers\Demo\blankController:index');
$app->get('/headers', 'App\Controllers\Demo\HeadersController:index');

$app->get('/users', 'App\Controllers\Demo\UsersController:getAllUsers')->setName('users');
$app->map(['GET','POST'],'/user/{id}', 'App\Controllers\Demo\UsersController:getUserById');
