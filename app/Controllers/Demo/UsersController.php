<?php namespace App\Controllers\Demo;

use Core\Kernel\ControllerAbstract;

class UsersController extends ControllerAbstract
{
    private $title = 'Users';
    private $menuActive = '/users';




    /**
     * Index Action
     *
     * @return string
     */
    public function getUserById($id)
    {
        $params = ['user'=>$id];

        try {
            $user = $this->container->curl->post('http://clientsl.local/api/user', $params);
        } catch (\RuntimeException $ex) {
            $this->container->logger->critical("[UserController::getUserById}", [$ex->getMessage(), $ex->getCode()]);
            // die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
        }
        
        
        // var_dump($user);die;
        return $this->render('Demo/user.twig', [
            'title' => $this->title,
            'menuActive' => $this->menuActive,
            'userLogged' => $this->container->cookies->get('user'),
            'user' => $user
        ]);
    }

    /**
     * Index Action
     *
     * @return string
     */
    public function getAllUsers()
    {
        // try {
        //     $curl = $this->container->curl->post('http://clientsl.local/mant/headers', array("params" => $params));
        // } catch (\RuntimeException $ex) {
        //     $this->container->logger->critical("[AuthController::handler}", [$ex->getMessage(), $ex->getCode()]);
        //     // die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
        // }
          
        return $this->render('Demo/users.twig', [
            'title' => $this->title,
            'menuActive' => $this->menuActive,
            'userLogged' => $this->container->cookies->get('user')
        ]);
    }

}
