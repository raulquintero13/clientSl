<?php 
namespace Core\Services;

use Core\Kernel\ServiceInterface;
use Core\Libraries\Services\Cookies\Cookies;

class CookiesService implements ServiceInterface
{

    /**
     * Service register name
     */
    public function name()
    {
        return 'cookies';
    }


    public function register()
    {
        return function($container){
        
            $cookies = new Cookies($container);

            unset($container);
            return $cookies;
        };
    }
}