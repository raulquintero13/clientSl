<?php

// $app->get('/api/users', 'Api\Controllers\Users\UsersController:getAll');
$app->map(['GET','POST'],'/api/employee', 'Api\Controllers\Employees\EmployeesController:getById');

$app->map(['GET','POST'],'/api/employees/save/{id}', 'Api\Controllers\Employees\EmployeesController:saveUserById')->setName('apiemployeeSave');

$app->get('/api/employees', 'Api\Controllers\Employees\EmployeesController:getAll');
