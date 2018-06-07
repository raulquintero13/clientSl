<?php namespace App\Controllers\Demo;

use Core\Kernel\ControllerAbstract;
// use Core\Libraries\Database\SimplePDO;

class ListController extends ControllerAbstract
{
    const VIEW = '10';
    const EDIT = '11';
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
        var_export($username);
        $results = $this->container->simplePdo->get_results("SELECT * FROM humans "); //WHERE email LIKE ? AND password = ? LIMIT 10", array('%some%', 'you@magic.com'));
        foreach ($results as $user) {
            echo $user['firstname'] . ' ' . $user['email'] . '<br />';
        }

        
        // $this->container->logger->info("myloggernew",[1,2]);
        // return $this->render('Demo/Login/index.twig');
    }

}
