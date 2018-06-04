<?php 
namespace Core\Services;

use Core\Kernel\ServiceInterface;
use Core\Libraries\Services\Encryption\Openssl;

class EncryptionService implements ServiceInterface
{

    /**
     * Service register name
     */
    public function name()
    {
        return 'encryption';
    }


    public function register()
    {
        return function($container){
        
            $encryption = new Openssl($container->settings['encryption']);
            
            unset($container);

            return $encryption;
        };
    }
}