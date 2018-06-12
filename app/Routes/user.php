<?php



$app->get('/users', 'App\Actions\Demo\UsersAction:getAllUsers')->setName('users');

$app->get('/user/{id}', 'App\Actions\Demo\UsersAction:getUserById');
$app->get('/users/new', 'App\Actions\Demo\UsersAction:editUserById')->setName('newUser');
$app->post('/user/edit/{id}', 'App\Actions\Demo\UsersAction:editUserById');
$app->post('/users/save/{id}', 'App\Actions\Demo\UsersAction:saveUserById');
