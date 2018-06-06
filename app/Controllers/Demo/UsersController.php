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
            $user = $this->container->curl->post('http://serversl.local/api/user', $params);
        } catch (\RuntimeException $ex) {
            $this->container->logger->critical("[UserController::getUserById}", [$ex->getMessage(), $ex->getCode()]);
            // die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
        }
        
        $edited = $request->getParam('edit');

        if (!$user){
            $flash->addMessage('edited','El Registro no existe');
            return $response->withRedirect($router->pathFor('users'));

        }

        if($edited){
            $firstname = $request->getParam('firstname');
            // var_dump($_POST);die;
            return $response->withRedirect($router->pathFor('users'));
        }else{
            // var_dump($request->getParam('edit'));die;
            return $this->render('Demo/user.twig', [
                'title' => $this->title,
                'menuActive' => $this->menuActive,
                'userLogged' => $this->container->cookies->get('user'),
                'id' => $id,
                'user' => $user,
                'readonly' => 'readonly'
            ]);
        }
    }

    public function editUserById($id){

        $request = $this->getRequest();
        $response = $this->getResponse();
        $router = $this->getRouter();
        $flash = $this->getService('flash');


        $user = $request->getParams();

        $flash->addMessage('edited','El Registro de '.strtoupper( $firstname).' fue actualizado.');
        
        $message_error = [];
        $readonly = 'readonly';
        if ($readonly){
            $message_error [] = 'No tienes permiso par editar este registro.';
        }

        return $this->render('Demo/user.twig', [
            'title' => $this->title,
            'menuActive' => $this->menuActive,
            'userLogged' => $this->container->cookies->get('user'),
            'id' => $id,
            'user' => $user,
            'readonly' => $readonly,
            'message_error' => $message_error
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
