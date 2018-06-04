<?php namespace Api\Controllers\Mant;

use Core\Kernel\ControllerAbstract;

// use Core\Libraries\Database\SimplePDO;

class MantController extends ControllerAbstract
{


    /**
     * Index Action
     *
     * @return string
     */
    public function headers()
    {
        $response = $this->getResponse();
        $request = $this->getRequest();

        // dump($_SERVER);die;


        $data = $request->getParam('params');

        // var_dump($result);
        $this->container->logger->info("api-auth:decrypted", [$data]);

        $result = [
            'user' => $result['email'],
            'status' => true,
        ];

        $this->container->logger->info("api-auth:responding", [$result]);
        return $response->withJson($result);

        die;
        // $results = $this->container->simplePdo->get_results("SELECT * FROM users ");
        // foreach ($results as $user) {
        //     echo $user['firstname'] . ' ' . $user['email'] . '<br />';
        // }

    }
}
