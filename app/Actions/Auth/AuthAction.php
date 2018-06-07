<?php namespace App\Actions\Auth;

use Core\Kernel\ControllerAbstract;
use Core\Libraries\Database\SimplePDO;

class AuthAction extends ControllerAbstract
{
    protected $encryptorService; 

    /**
     * Index Action
     *
     * @return string
     */
    public function handler()
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
        $this->container->logger->info("app-auth:receiving",[ $curl ]);
        
        if ($curl['status']){
            $flash->addMessage('home','Welcome Back');
            $this->container->cookies->set('user', $curl['user']);
        }
        return $response->withRedirect($router->pathFor('home'));

        die;

        
        
    }
    
}



// $password_hash = password_hash($password, PASSWORD_BCRYPT);
// $results = $this->container->simplePdo->get_results("SELECT * FROM users WHERE email LIKE ? AND password = ? LIMIT 10", array('%some%', 'you@magic.com'));
// foreach ($results as $user) {
//     echo $user['firstname'] . ' ' . $user['email'] . '<br />';
// }



