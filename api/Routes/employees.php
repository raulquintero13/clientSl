<?php

// $app->get('/api/users', 'Api\Controllers\Users\UsersController:getAll');
$app->map(['GET','POST'],'/api/employee', 'Api\Controllers\Employees\EmployeesController:getById');
