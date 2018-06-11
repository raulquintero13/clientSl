<?php

$app->get('/api/users', 'Api\Controllers\Users\UsersController:getAll');


$app->get('/cart/add/product/{id}', 'Api\Controllers\Cart\CartController:addItem');


// $app->get('/cart/add/product/{id}', function (Request $request, Response $response, array $args) {
    
//     $products = require 'products.php';
//     $product = $products[$args['id']];
//     if (!$product) {
//         $error = true; 
//         $code =200;
//         $typeCode = 'F';
//     }   
//         else {
//             $error = false;
//             $code = 200;
//         }
//     return $response->withJson([
//         'product' => $product,
//         'code' => 200,
//         'error' => $error,
//         'typeCode'=> $typeCode,
//         'message' => 'mensaje'
//     ], $code);
// });

// $app->get('/cart/remove/{id}', function (Request $request, Response $response, array $args) {
//     $this->logger->addInfo('add to cart');
//     return $response->withJson([
//         'code' => 200,
//         'typeCode' => '0',
//         'error' => 'successful'
//     ], 200);
// });