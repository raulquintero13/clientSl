<?php 
namespace Core\Services;

use Core\Kernel\ServiceInterface;
// use \GuzzleHttp\Client;

class GuzzleService implements ServiceInterface
{

    /**
     * Service register name
     */
    public function name()
    {
        return 'guzzle';
    }


    public function register()
    {
        return function($container){
       
            $guzzle = new \GuzzleHttp\Client([
                    'base_uri' => 'http://example.com',
                ]);
            
            unset($container);

            return $guzzle;
        };
    }
}
