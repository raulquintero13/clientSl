<?php



$app->get('/system/users', 'App\Controllers\Base\UsersController:getAllUsers')->setName('users');

$app->get('/system/user/{id:[0-9]+}', 'App\Controllers\Base\UsersController:getUserById')->setName('user');
$app->get('/system/users/new', 'App\Controllers\Base\UsersController:editUserById')->setName('newUser');
$app->post('/system/user/edit/{id}', 'App\Controllers\Base\UsersController:editUserById')->setName('userEdit');
$app->post('/system/user/save/{id}', 'App\Controllers\Base\UsersController:saveUserById')->setName('userSave');

$app->get('/eloquent','App\Controllers\EloquentDb\EloquentController:eloquentAction');