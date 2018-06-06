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
                $exclude = true;
                break;
            case '/login':
                $exclude = true;
                break;
            case '/api/user':
                $exclude = true;
                break;
            case '/api/users':
                $exclude = true;
                break;
            case '/auth':
                $exclude = true;
                break;
            case '/api/auth':
                $exclude = true;
                break;
            default:
                $exclude = false;
                break;
        }
        // $response->getBody()->write('-- BEFORE --<br><br>');
        if ($this->_isLogged() || $exclude){
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
