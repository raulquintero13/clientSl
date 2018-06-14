<?php namespace Core\Services;

use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Core\Kernel\ServiceInterface;

class TwigViewService implements ServiceInterface
{

    /**
     * Service register name
     */
    public function name()
    {
        return 'view';
    }

    /**
     * Register new service on dependency container
     */
    public function register()
    {
        return function ($container) {
            $view = new Twig(
                app_path() . '/Views',
                $container->settings['twig']
            );

            $view->addExtension(
                new TwigExtension(
                    $container->router,
                    $container->request->getUri()
                )
);
            $view->addExtension(new \Core\Libraries\Services\Twig\TwigExtension($container));
            

            $view->getEnvironment()->addGlobal('flash', $container->flash);
            $view->getEnvironment()->addFilter(new \Twig_SimpleFilter('ucfirst', 'ucfirst'));
            $view->getEnvironment()->addFilter(new \Twig_SimpleFilter('ucwords', 'ucwords'));

            $view->getEnvironment()->addGlobal('currentUrl',$container->get('request')->getUri());
            $view->getEnvironment()->addGlobal('currentUri',$container->get('request')->getUri()->getPath());

            $view->getEnvironment()->addGlobal('userLogged1','raul.quintero@server.com');

            
            unset($container);

            return $view;
        };
    }
}
