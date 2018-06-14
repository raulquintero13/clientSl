<?php namespace App\Controllers\Base;

use Core\Kernel\ControllerAbstract;

class LoginController extends ControllerAbstract
{
    protected $encryptorService;

    /**
     * Index Action
     *
     * @return string
     */
    public function LoginAction()
    {
        // $this->container->logger->info("myloggernew",[1,2]);

        $this->container->cookies->destroy('user');

        // $_COOKIE['user'] = null;
        return $this->render('Demo/Login/index.twig');
    }

    /**
     * Index Action
     *
     * @return string
     */
    public function attempAction()
    {
        $settings = $this->getService('settings');
        $response = $this->getResponse();
        $request = $this->getRequest();
        $router = $this->getRouter();
        $flash = $this->getService('flash');

        $this->EncryptorService = $this->getService('encryption');

        $params['email'] = $request->getParam('email');
        $password = $request->getParam('password');
        $params['password'] = password_hash($password, PASSWORD_BCRYPT);

        $this->container->logger->info("app-auth:data", [$params]);
        // $params = $this->EncryptorService->encode($params);
        $this->container->logger->info("app-auth:encrypted", $params);

        try {
            $curl = $this->container->curl->post('http://clientsl.local/api/auth', $params);
        } catch (\RuntimeException $ex) {
            $this->container->logger->critical("[AuthController::handler}", [$ex->getMessage(), $ex->getCode()]);
            // die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
        }

        // dump(str_replace('%40', chr(64), $curl['user']));die;
        $this->container->logger->info("app-auth:receiving", [$curl]);

        if ($curl['status']) {
            $flash->addMessage('home', 'Welcome Back');
            $this->container->cookies->set('user', $curl['user']);
        }
        return $response->withRedirect($router->pathFor('home'));

        die;

    }

    public function showProfileAction()
    {
        $id=0;
        $request = $this->getRequest();
        $response = $this->getResponse();
        $router = $this->getRouter();
        $flash = $this->getService('flash');
        $params = ['user' => $id];

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
            'readonly' => 'readonly',
        ]);

    }

    
}

// $password_hash = password_hash($password, PASSWORD_BCRYPT);
// $results = $this->container->simplePdo->get_results("SELECT * FROM users WHERE email LIKE ? AND password = ? LIMIT 10", array('%some%', 'you@magic.com'));
// foreach ($results as $user) {
//     echo $user['firstname'] . ' ' . $user['email'] . '<br />';
// }
