<?php namespace App\Controllers\Demo;

use Core\Kernel\ControllerAbstract;
// use Core\Libraries\Database\SimplePDO;

class HeadersController extends ControllerAbstract
{
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
        // dump($_SERVER);
$params = array();

        try {
    $curl = $this->container->curl->post('http://clientsl.local/mant/headers', array("params" => $params));
} catch (\RuntimeException $ex) {
    $this->container->logger->critical("[AuthController::handler}", [$ex->getMessage(), $ex->getCode()]);
    // die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
}

var_dump($curl);die;
die;
    }

}
