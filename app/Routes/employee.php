<?php



$app->get( '/application/employees',            'App\Controllers\Employees\EmployeesController:getAll')->setName('employees');
$app->get( '/application/employee/{id:[0-9]+}', 'App\Controllers\Employees\EmployeesController:getById')->setName('employee');
$app->post('/application/employees/create', 'App\Controllers\Employees\EmployeesController:create');

$app->get('/application/employee/edit/{id}',   'App\Controllers\Employees\EmployeesController:edit')->setName('employeeEdit');
$app->post('/application/employees/save/{id}',  'App\Controllers\Employees\EmployeesController:save')->setName('employeeSave');
$app->get( '/application/employees/new',       'App\Controllers\Employees\EmployeesController:new')->setName('employeeNew');
