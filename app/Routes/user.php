<?php



$app->get('/system/users', 'App\Controllers\Base\UsersController:getAllUsers')->setName('users');

$app->get('/system/user/{id:[0-9]+}', 'App\Controllers\Base\UsersController:getUserById')->setName('user');
$app->get('/system/users/new', 'App\Controllers\Base\UsersController:newUser')->setName('newUser');

$app->post('/system/user/edit/{id}', 'App\Controllers\Base\UsersController:editUserById')->setName('userEdit');
$app->post('/system/user/save/{id}', 'App\Controllers\Base\UsersController:saveUserById')->setName('userSave');

$app->get('/eloquent','App\Controllers\EloquentDb\EloquentController:eloquentAction');


$app->get('/application/clients', 'App\Controllers\Clients\ClientsController:getAllUsers')->setName('clients');


$app->get('/application/employees',            'App\Controllers\Employees\EmployeesController:getAllUsers')->setName('employees');
$app->get('/application/employee/{id:[0-9]+}', 'App\Controllers\Employees\EmployeesController:getEmployeeById')->setName('employee');
$app->post('/application/employee/edit/{id}',  'App\Controllers\Employees\EmployeesController:editUserById')->setName('employeeEdit');
$app->post('/application/employees/save/{id}', 'App\Controllers\Employees\EmployeesController:saveUserById')->setName('employeeSave');
