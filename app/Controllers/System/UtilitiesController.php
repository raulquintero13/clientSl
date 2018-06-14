<?php namespace App\Controllers\System;

use Core\Kernel\ControllerAbstract;
use Core\Libraries\Database\SimplePDO;

class UtilitiesController extends ControllerAbstract
{
   
    /**
     * Index Action
     *
     * @return string
     */
    public function environmentAction()
    {
        $title = 'BlankPage';
        $menuActive = '/home';
        

        $settings = $this->getService('settings');
        $response = $this->getResponse();
        $request = $this->getRequest();
        $router = $this->getRouter();
        $flash = $this->getService('flash');

        

        // debug functions available
        // dump($_SERVER);
        // $this->container->logger->info("myloggernew",[1,2]);

        $env = $this->getRequest()->getServerParams();
        $environment = print_r($env,1);

        return $this->render('Demo/blank.twig',[
            'title' => $title,
            'menuActive' => $menuActive,
            'environment' => $environment
            // defined globally in twig
            // 'userLogged' => $this->container->cookies->get('user')
            ]);
    }

}
