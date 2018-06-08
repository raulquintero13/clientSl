<?php



$app->get('/users', 'App\Actions\Demo\UsersAction:getAllUsers')->setName('users');

$app->get('/user/{id}', 'App\Actions\Demo\UsersAction:getUserById');
$app->post('/user/{id}/edit', 'App\Actions\Demo\UsersAction:editUserById');

$app->post('/users/{id}/save', 'App\Actions\Demo\UsersAction:saveUserById');
