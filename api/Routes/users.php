<?php

// $app->get('/api/users', 'Api\Controllers\Users\UsersController:getAll');
$app->map(['GET','POST'],'/api/user', 'Api\Controllers\Users\UsersController:getById');
