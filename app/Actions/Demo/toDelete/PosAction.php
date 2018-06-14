<?php namespace App\Actions\Demo;

use Core\Kernel\ControllerAbstract;

class PosAction extends ControllerAbstract
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
        // $this->container->logger->info("HomeController",[1,23]);

        // $env = $this->getRequest()->getServerParams();
        // dump($env);die;

        return $this->render('Demo/Pos/index.twig', [
            'title' => $this->title,
            'menuActive' => $this->menuActive,
            'userLogged' => $this->container->cookies->get('user'),
        ]);
    }

}
