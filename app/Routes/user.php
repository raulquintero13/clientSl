<?php





$app->get('/application/clients', 'App\Controllers\Clients\ClientsController:getAllUsers')->setName('clients');



