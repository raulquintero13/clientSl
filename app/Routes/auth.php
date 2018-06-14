<?php

$app->get( '/login', 'App\Controllers\Base\LoginController:LoginAction')->setName('login');
$app->post('/login', 'App\Controllers\Base\LoginController:attempAction');
$app->get('/settings/profile', 'App\Controllers\Base\LoginController:showProfileAction');
