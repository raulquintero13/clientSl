<?php namespace App\Controllers\Base;

use Core\Kernel\ControllerAbstract;
use Core\Libraries\Database\SimplePDO;

class BlankController extends ControllerAbstract
{
   
    /**
     * Index Action
     *
     * @return string
     */
    public function nameAction()
    {
        $title = 'BlankPage';
        $menuActive = '/home';
        

        $settings = $this->getService('settings');
        $response = $this->getResponse();
        $request = $this->getRequest();
        $router = $this->getRouter();
        $flash = $this->getService('flash');

        
        $flash->addMessage('home', 'Welcome Back');

        // debug functions available
        // dump($_SERVER);
        // $this->container->logger->info("myloggernew",[1,2]);

        // $env = $this->getRequest()->getServerParams();
        // dump($env);die;

        return $this->render('Base/blank.twig',[
            'title' => $title,
            'menuActive' => $menuActive
            // defined globally in twig
            // 'userLogged' => $this->container->cookies->get('user')
            ]);
    }

}
