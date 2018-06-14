<?php namespace Apigw\Controllers;

use Core\Kernel\ControllerAbstract;

class CartController  extends ControllerAbstract
{
   
    public function addItem(){


        $logger = $this->getService('logger');

        // $logger->info("apigw_server " . print_r($_SERVER,1));
        $code=200;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://server.local/api/cart/add/'.$args['id'],
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/13537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36'
        ));
        $resp = curl_exec($curl);


        curl_close($curl);


        // $resp = base64_decode($resp);

// $resp = json_decode(Protector::decrypt($resp));
var_dump($resp);die;
        // return $response->withStatus($code)->withJson($resp);

    }


    // public function removeItem($container, Request $request, Response $response, $args){

       
        
    //     return $response->withStatus($code)->withJson([
    //         'product' => $product,
    //         'message' => $error,
    //         'typeCode' => $code
    //     ]);
    // }
    
   
}