<?php namespace Api\Controllers\Auth;

use Core\Kernel\ControllerAbstract;
// use Core\Libraries\Database\SimplePDO;

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
        // $params = $_POST;
        
        // var_dump($result);
        $this->container->logger->info("api-auth:decrypted", [$params]);
        
        
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