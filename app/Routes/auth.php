<?php

$app->get( '/login', 'App\Controllers\Base\LoginController:LoginAction')->setName('login');
$app->post('/login', 'App\Controllers\Base\LoginController:attemptAction');
$app->map(['GET','POST'],'/settings/profile', 'App\Controllers\Base\LoginController:showProfileAction');
