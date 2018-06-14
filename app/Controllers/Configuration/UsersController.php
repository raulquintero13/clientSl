<?php 
namespace App\Controllers\Configuration;

use Core\Kernel\ControllerAbstract;

class UsersController extends ControllerAbstract
{
    private $title = 'Home';
    private $menuActive = '/home';
    /**
     * Index Action
     *
     * @return string
     */
    public function allUsersAction()
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