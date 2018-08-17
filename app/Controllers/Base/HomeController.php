<?php namespace App\Controllers\Base;

use Core\Kernel\ControllerAbstract;

class HomeController extends ControllerAbstract
{
    private $title = 'Home';
    private $menuActive = '/home';
    /**
     * Index Action
     *
     * @return string
     */
    public function homeAction()
    {
        $flash = $this->getService('flash');
        // $this->container->logger->info("HomeController",[1,23]);

        // $env = $this->getRequest()->getServerParams();
        // dump($env['APP_ENV']);die;
        // $message = $flash->getFirstMessage('home');
        $messages = $flash->getMessages();
        // dump ($messages);die;
        // dump($request->getAttributre('ip_address'));die;
        return $this->render('Demo/Home/index.twig',[
            'title' => $this->title,
            'menuActive' => $this->menuActive,
            'userLogged' => $this->container->cookies->get('user'),
            'messages' => $messages
        ]);
    }

   
    public function dashboardAction()
    {
        $environment = [
            'environment' => env('APP_ENV'),
            'client_name' => env('HTTP_CLIENT_NAME'),
            'app_role' => env('APP_ROLE'),
            'debug' => env('APP_DEBUG'),
        ];

        $flash = $this->getService('flash');
        // $this->container->logger->info("HomeController",[1,23]);

        // $env = $this->getRequest()->getServerParams();
        // dump($env['APP_ENV']);die;
        // $message = $flash->getFirstMessage('home');
        $messages = $flash->getMessages();
        // dump ($messages);die;
        // dump($request->getAttributre('ip_address'));die;
        return $this->render('Demo/dashboard.twig',[
            'title' => $this->title,
            'menuActive' => $this->menuActive,
            'userLogged' => $this->container->cookies->get('user'),
            'messages' => $messages,
            'info' => $environment,
        ]);
    }
}
