<?php namespace Core\Middlewares;

use Core\Kernel\MiddlewareAbstract;
use Slim\Http\Request;
use Slim\Http\Response;


class AuthMiddleware extends MiddlewareAbstract
{

    /**
     * Middleware
     *
     * @param Request $request
     * @param Response $response
     * @param $next
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $next)
    {
        switch ($request->getUri()->getPath()) {
            case '/none':
                $public = true;
                break;
            case '/login':
                $public = true;
                break;
            case '/api/employee':
                $public = true;
                break;
            case '/api/user':
                $public = true;
                break;
            case '/api/users':
                $public = true;
                break;
            case '/auth':
                $public = true;
                break;
            case '/api/auth':
                $public = true;
                break;
            default:
                $public = false;
                break;
        }
        // $response->getBody()->write('-- BEFORE --<br><br>');
        if ($this->_isLogged() || $public){
            $response = $next($request, $response);
            
        } else
        {
            // $response = $response->withRedirect('/login');
            // $response->getBody()->write('<br><br>you are not logged');
            return $response->withRedirect('/login');
        }
        return $response;
    }
    
    private function _isLogged(){
        // dump(isset($_COOKIE['user']));die;
        // $encrypted = $this->container->protector->encrypt("myloggernew");
        if(isset($_COOKIE['user']) ){
            return true;
        } else {
            return false;
        }

    }
}
