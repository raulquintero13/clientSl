<?php namespace Core\Services;

use Psr\Http\Message\ResponseInterface as Response;
use Core\Kernel\ServiceInterface;

class NotFoundPageService implements ServiceInterface
{

    /**
     * Service register name
     */
    public function name()
    {
        return 'notFoundHandler';
    }

    /**
     * Register new service on dependency container
     */
    public function register()
    {
        return function ($container) {
            return $container->view->render($container->response->withStatus(404), '404notfound.twig', [
                "myMagic" => "Let's roll"
            ]);
        };
    }
}
