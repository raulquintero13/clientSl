<?php
namespace Core\Services;

use Core\Kernel\ServiceInterface;
use Core\Libraries\Services\Database\SimplePDO;

class DatabaseService implements ServiceInterface
{

    /**
     * Service register name
     */
    public function name()
    {
        return 'simplePdo';
    }

    public function register()
    {
        return function ($container) {

            // register connections
            $simplePdo = new SimplePDO($container->settings['database'][env('APP_ENV')]);

            unset($container);

            return $simplePdo;
        };
    }
}
