<?php

$app->get('/', 'App\Actions\Demo\HomeAction:index')->setName('home');
$app->get('/hello/{name}', 'App\Actions\Demo\HelloAction:index');
$app->get('/pos', 'App\Actions\Demo\PosAction:index');
$app->get('/list', 'App\Actions\Demo\ListAction:index');
$app->get('/blank', 'App\Actions\Demo\blankAction:index');
$app->get('/headers', 'App\Actions\Demo\HeadersAction:index');

// $app->map(['GET','POST'],'/users', 'App\Actions\Demo\UsersAction:getAllUsers')->setName('users');

// $app->map(['GET','POST'],'/user/{id}', 'App\Actions\Demo\UsersAction:getUserById');
// $app->map(['GET','POST'],'/user/{id}/edit', 'App\Actions\Demo\UsersAction:editUserById');
// $app->map(['GET','POST'],'/user/{id}/save', 'App\Actions\Demo\UsersAction:editUserById');

// $app->get('/user/{id}', 'App\Actions\Demo\UsersAction:getUserById');
// $app->post('/user/{id}', 'App\Actions\Demo\UsersAction:editUserById');
