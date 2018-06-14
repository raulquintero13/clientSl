<?php namespace App\Actions\Demo;

use Core\Kernel\ControllerAbstract;

class LoginAction extends ControllerAbstract
{

    /**
     * Index Action
     *
     * @return string
     */
    public function index()
    {
        // $this->container->logger->info("myloggernew",[1,2]);

        $this->container->cookies->destroy('user');
            
        // $_COOKIE['user'] = null;
        return $this->render('Demo/Login/index.twig');
    }

}
