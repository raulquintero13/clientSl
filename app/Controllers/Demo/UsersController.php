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
        $request = $this->getRequest();
        $response = $this->getResponse();
        $router = $this->getRouter();
        $flash = $this->getService('flash');
        $params = ['user'=>$id];

        try {
            $user = $this->container->curl->post('http://clientsl.local/api/user', $params);
        } catch (\RuntimeException $ex) {
            $this->container->logger->critical("[UserController::getUserById}", [$ex->getMessage(), $ex->getCode()]);
            // die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
        }
        
        $edited = $request->getParam('edit');

        if($edited){
            $flash->addMessage('edited','El Registro fue actualizado');
            return $response->withRedirect($router->pathFor('users'));
        }else{
            // var_dump($request->getParam('edit'));die;
            return $this->render('Demo/user.twig', [
                'title' => $this->title,
                'menuActive' => $this->menuActive,
                'userLogged' => $this->container->cookies->get('user'),
                'user' => $user
            ]);
        }
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
        $flash = $this->getService('flash');

        $messages = $flash->getMessages();
        return $this->render('Demo/users.twig', [
            'title' => $this->title,
            'menuActive' => $this->menuActive,
            'userLogged' => $this->container->cookies->get('user'),
            'messages' => $messages
        ]);
    }

}
