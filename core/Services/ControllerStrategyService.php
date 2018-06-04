<?php namespace Core\Services;

use Core\Kernel\ServiceInterface;
use Core\Kernel\ControllerStrategy;

class ControllerStrategyService implements ServiceInterface
{

    /**
     * Service register name
     */
    public function name()
    {
        return 'foundHandler';
    }

    /**
     * Register new service on dependency container
     */
    public function register()
    {
        return function () {
            return new ControllerStrategy();
        };
    }
}
