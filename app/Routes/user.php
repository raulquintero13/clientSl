<?php



$app->get('/system/users', 'App\Actions\Demo\UsersAction:getAllUsers')->setName('users');

$app->get('/system/user/{id:[0-9]+}', 'App\Actions\Demo\UsersAction:getUserById')->setName('user');
$app->get('/system/users/new', 'App\Actions\Demo\UsersAction:editUserById')->setName('newUser');
$app->post('/system/user/edit/{id}', 'App\Actions\Demo\UsersAction:editUserById')->setName('userEdit');
$app->post('/system/user/save/{id}', 'App\Actions\Demo\UsersAction:saveUserById')->setName('userSave');

$app->get('/eloquent','App\Controllers\EloquentDb\EloquentController:eloquentAction');