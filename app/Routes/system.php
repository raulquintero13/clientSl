<?php

$app->get('/system/utilities/environment', 'App\Controllers\System\UtilitiesController:environmentAction')->setName('system/environment');