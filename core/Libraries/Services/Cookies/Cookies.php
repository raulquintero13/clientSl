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

    public static function exists($key)
    {
        return (isset($_COOKIE[$key])) ? true : false;
    }

    public function get($key)
    {
        return $_COOKIE[$key];
    }

    public function set($key, $value = "", $expire = 1, $path ='/', $domain = null, $secure = false, $http = true)
    {
        setcookie($key, $value, time() + (86400 * 30), $path, $domain, $secure, $http); // 86400 = 1 day
        
    }

    public static function destroy($key)
    {
        self::set($key, '', time() - 1);
    }
}
