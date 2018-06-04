<?php namespace App\Controllers\Demo;

use Core\Kernel\ControllerAbstract;

class LoginController extends ControllerAbstract
{

    /**
     * Index Action
     *
     * @return string
     */
    public function index()
    {
        // $this->container->logger->info("myloggernew",[1,2]);

        $this->container->cookies->delete('user');
            
        // $_COOKIE['user'] = null;
        return $this->render('Demo/Login/index.twig');
    }

}
