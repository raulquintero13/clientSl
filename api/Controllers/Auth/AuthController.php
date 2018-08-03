<?php namespace Api\Controllers\Auth;

use Core\Kernel\ControllerAbstract;
// use Core\Libraries\Database\SimplePDO;

use Api\Controllers \{
    Human, User, Employee, Gender, Role
  };

class AuthController extends ControllerAbstract
{

    protected $EncryptorService; 

    /**
     * Index Action
     *
     * @return string
     */
    public function handler()
    {   
        $response = $this->getResponse();
        $request = $this->getRequest();

        
        $params = $request->getParams();
        // $params = $this->EncryptorService->edecode($request->getParams());
        // $params = $_POST;
        
        $this->container->logger->info("api-auth:decrypted", [$params]);
        

        // get info from de database to validate this user

        
        $result = [
            'user' => $params['email'],
            'status' => true
        ];
        // $result = $this->EncryptorService->encode($result);
        
        $this->container->logger->info("api-auth:responding",[$result]);
        return $response->withJson($result);

       



        die;
        // $results = $this->container->simplePdo->get_results("SELECT * FROM users ");
        // foreach ($results as $user) {
        //     echo $user['firstname'] . ' ' . $user['email'] . '<br />';
        // }



    }
}