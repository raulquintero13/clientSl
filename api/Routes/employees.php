<?php

// $app->get('/api/users', 'Api\Controllers\Users\UsersController:getAll');
$app->post('/api/employee', 'Api\Controllers\Employees\EmployeesController:getById');
$app->get('/api/employee/{id}', 'Api\Controllers\Employees\EmployeesController:getById');

$app->map(['GET','POST'],'/api/employees/save/{id}', 'Api\Controllers\Employees\EmployeesController:saveEmployeeById')->setName('apiemployeeSave');

$app->get('/api/employees', 'Api\Controllers\Employees\EmployeesController:getAll');
$app->map(['GET','POST'],'/api/employees/create', 'Api\Controllers\Employees\EmployeesController:createEmployee');

$app->get('/api/clients', 'Api\Controllers\Clients\ClientsController:getAll');
