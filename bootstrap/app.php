<?php

use \Core\Kernel\App;

require 'kernel.php';

session_start();

$app = new App(['settings' => require config_path() . '/app.php']);


// // database
// use Illuminate\Database\Capsule\Manager as Capsule;
// $setting = require __DIR__ . '/../config/database.php';
// $capsule = new Capsule;
// $capsule->addConnection($setting['db_illuminate']);
// $capsule->setAsGlobal();
// $capsule->bootEloquent();


$app->registerServices();

$app->registerAppMiddlewares();

require app_path() . '/Routes/app.php';
require api_path() . '/Routes/app.php';
require apigw_path() . '/Routes/app.php';

$app->run();
