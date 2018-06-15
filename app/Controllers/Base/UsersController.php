<?php namespace App\Controllers\Base;

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
        $messages = $flash->getMessages();

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
                'title' => 'User: '.$user['firstname'].' '.$user['lastname'],
                'menuActive' => $this->menuActive,
                'userLogged' => $this->container->cookies->get('user'),
                'id' => $id,
                'user' => $user,
                'readonly' => 'readonly',
                'messages' => $messages 
            ]);
        }
    }


    public function getProfile($id = 0)
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


        return $this->render('Demo/profile.twig', [
            'title' => $this->title,
            'menuActive' => $this->menuActive,
            'userLogged' => $this->container->cookies->get('user'),
            'id' => $id,
            'user' => $user,
            'readonly' => 'readonly' 
        ]);
    }

    public function menuSettings()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();
        $router = $this->getRouter();
        $flash = $this->getService('flash');


        return $this->render('Demo/settings.twig', [
            'title' => 'Settings',
            'menuActive' => $this->menuActive,
            'userLogged' => $this->container->cookies->get('user'),
            'id' => $id,
            'user' => $user,
            'readonly' => 'readonly' 
        ]);
    }



    public function editUserById($id){

        $request = $this->getRequest();
        $response = $this->getResponse();
        $router = $this->getRouter();
        $flash = $this->getService('flash');

 
        $user = $request->getParams();

        $flash->addMessage('edited','El Registro de '.strtoupper( $user['firstname']).' fue actualizado.');
        
        $message_error = [];
        $readonly = '';     //// null or readonly
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




    public function saveUserById($id){

        $request = $this->getRequest();
        $flash = $this->getService('flash');
        $response = $this->getService('response');
        $router =  $this->getRouter();

        $user = $request->getParams();

        $flash->addMessage('edited','El Registro de '.strtoupper( $user['firstname']).' fue actualizado.');
        return $response->withRedirect($router->pathFor('user',['id' => $id]));
        // $this->router->pathFor('author', ['author_id' => $author->id])
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
