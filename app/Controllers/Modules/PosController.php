<?php namespace App\Controllers\Modules;

use Core\Kernel\ControllerAbstract;

class PosController extends ControllerAbstract
{
    private $titlte = 'Home';
    private $menuActive = '/home';
    /**
     * Index Action
     *
     * @return string
     */
    public function posAction()
    {
        $title = 'POS Module';
        $menuActive = 'home';
       
        return $this->render('Demo/Pos/index.twig', [
            'title' => $title,
            'menuActive' => $menuActive,
        ]);
    }

}
