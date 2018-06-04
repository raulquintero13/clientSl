<?php
namespace Core\Libraries\Services\Cookies;

class Cookies
{
    protected $req;
    protected $res;

    public function __construct($container)
    {
        $this->req = $container->request;
        $this->res = $container->response;
    }

    public function get($name)
    {
        return $_COOKIE[$name];
    }

    public function set($name, $value = "", $expire = 1)
    {
        setcookie($name, $value, time() + (86400 * 30), "/"); // 86400 = 1 day
        
    }

    public function delete($name){
        setcookie($name, "", time() - 3600);
    }
}
