<?php namespace Core\Kernel;

use Slim\Http\Request;
use Slim\Http\Response;
use Interop\Container\ContainerInterface;

abstract class ServiceAbstract
{

    /**
     * Slim Container
     *
     * @var ContainerInterface
     */
    protected $container;


    /**
     * Controller constructor
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        unset($container);
    }

   
    /**
     * Get Slim Container
     *
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->container;
    }

    /**
     * Get Service From Container
     *
     * @param string $service
     * @return mixed
     */
    protected function getService($service)
    {
        return $this->container->{$service};
    }

    protected function getLogger(){
        return $this->container->logger;
    }
}
