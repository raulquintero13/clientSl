<?php namespace App\Actions\Demo;

use Core\Kernel\ControllerAbstract;
use Core\Libraries\Database\SimplePDO;

class BlankAction extends ControllerAbstract
{
    private $titlte = 'Home';
    private $menuActive = '/home';
    /**
     * Index Action
     *
     * @return string
     */
    public function index()
    {

        $request = $this->getRequest();
        $username = $request->getParam('username');
        $password = $request->getParam('password');
        dump($_SERVER);
        // $this->container->logger->info("myloggernew",[1,2]);
        return $this->render('Demo/blank.twig',[
            'title' => $this->title,
            'menuActive' => $this->menuActive,
            'userLogged' => $this->container->cookies->get('user')
            ]);
    }

}
