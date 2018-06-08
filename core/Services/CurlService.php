<?php 
namespace Core\Services;

use Core\Kernel\ServiceInterface;
use Core\Libraries\Services\Curl\{CurlPhp,ApiClient};

class CurlService implements ServiceInterface
{

    /**
     * Service register name
     */
    public function name()
    {
        return 'curl';
    }


    public function register()
    {
        return function($container){
                
            $curl = new CurlPhp($container);

            unset($container);
            
            return $curl;
        };
    }
}
