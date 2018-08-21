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
                $isPublic = true;
                break;
            case '/login':
                $isPublic = true;
                break;
            case '/api/employee':
                $isPublic = true;
                break;
            case '/api/user':
                $isPublic = true;
                break;
            // case 'api/employees/save/1':
            //     $isPublic = true;
            //     break;
            case '/api/users':
                $isPublic = true;
                break;
            case '/auth':
                $isPublic = true;
                break;
            case '/api/employees/save':
                $isPublic = true;
                break;
            case '/api/employees/create':
                $isPublic = true;
                break;
            case '/api/auth':
                $isPublic = true;
                break;
            default:
                $isPublic = false;
                break;
        }
        // $response->getBody()->write('-- BEFORE --<br><br>');
        if ($this->_isLogged() || $isPublic){
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
