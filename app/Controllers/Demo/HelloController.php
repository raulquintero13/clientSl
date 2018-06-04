<?php namespace App\Controllers\Demo;

use Core\Kernel\ControllerAbstract;

class HelloController extends ControllerAbstract
{

    /**
     * Index Action
     *
     * @param string $name
     * @return string
     */
    public function index($name)
    {
        return $this->render('Demo/Hello/index.twig', ['name' => $name]);
    }
}
