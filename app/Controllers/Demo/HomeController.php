<?php namespace App\Controllers\Demo;

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
    public function index()
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

   
}
