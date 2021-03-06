<?php

use \Core\Kernel\App;
use Illuminate\Database\Capsule\Manager as Capsule;
use Tracy\Debugger;

define('DS', DIRECTORY_SEPARATOR);
define('STORAGE_PATH', realpath(__DIR__.'/storage/').DS);
Debugger::enable(Debugger::DEVELOPMENT);
require 'kernel.php';

session_start();

$app = new App(['settings' => require config_path() . '/app.php','mode' => 'production']);


// // database
$setting = require __DIR__ . '/../config/database.php';
$capsule = new Capsule;
$capsule->addConnection($setting['db_illuminate']);
$capsule->setAsGlobal();
$capsule->bootEloquent();


$app->registerServices();

$app->registerAppMiddlewares();

require app_path() . '/Routes/app.php';
require api_path() . '/Routes/app.php';
require apiDesktop_path() . '/Routes/app.php';

$app->run();
