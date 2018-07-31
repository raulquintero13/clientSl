<?php namespace App\Controllers\Employees;

use Core\Kernel\ControllerAbstract;

class EmployeesController extends ControllerAbstract
{
    private $title = 'Users';
    private $menuActive = '/users';
    private $flash;


    public function __construct(\Interop\Container\ContainerInterface $container)
    {
        $this->flash = $container->flash;

        parent::__construct($container);
        
    }

    /**
     * Index Action
     *
     * @return string
     */
    public function getById($id)
    {
        $request = $this->getRequest();
        $response = $this->getResponse();
        $router = $this->getRouter();
        $flash = $this->getService('flash');
        $messages = $flash->getMessages();
        $params = ['id'=>$id];
        try {
            // $employee = $this->container->curl->post('http://serversl.local/api/user', $params);
            $employee = $this->container->curl->post('http://serversl.local/api/employee', $params);
        } catch (\RuntimeException $ex) {
            $this->container->logger->critical("[EmployeeController::getById}", [$ex->getMessage(), $ex->getCode()]);
            // die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
        }
        // dump($employee);
        // die;

        $edited = $request->getParam('edit');

        if (!$employee){
            // die('no encontro empleado');
            $flash->addMessage('edited','El Registro no existe');
            return $response->withRedirect($router->pathFor('employees'));

        }

        if($edited){
            $firstname = $request->getParam('firstname');
            // var_dump($_POST);die;
            return $response->withRedirect($router->pathFor('users'));
        }else{
            // var_dump($request->getParam('edit'));die;
            $employee['startdate'] = str_replace(" ","T",$employee['startdate']);
            return $this->render('Employees/employee.twig', [
                'title' => 'Employee: '.$employee['human']['first_name'].' '.$employee['human']['middle_name'],
                'menuActive' => $this->menuActive,
                'userLogged' => $this->container->cookies->get('user'),
                'id' => $id,
                'employee' => $employee,
                'readonly' => 'disabled',
                'messages' => $messages 
            ]);
        }
    }


    public function getProfile($id = 0)
    {
        $request = $this->getRequest();
        $response = $this->getResponse();
        $router = $this->getRouter();
        $flash = $this->getService('flash');
        $params = ['id'=>$id];
        
        try {
            $user = $this->container->curl->post('http://serversl.local/api/employee', $params);
        } catch (\RuntimeException $ex) {
            $this->container->logger->critical("[UserController::getUserById}", [$ex->getMessage(), $ex->getCode()]);
            // die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
        }


        return $this->render('Demo/profile.twig', [
            'title' => $this->title,
            'menuActive' => $this->menuActive,
            'userLogged' => $this->container->cookies->get('user'),
            'id' => $id,
            'user' => $user,
            'readonly' => 'readonly' 
        ]);
    }

    public function menuSettings()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();
        $router = $this->getRouter();
        $flash = $this->getService('flash');


        return $this->render('Demo/settings.twig', [
            'title' => 'Settings',
            'menuActive' => $this->menuActive,
            'userLogged' => $this->container->cookies->get('user'),
            'id' => $id,
            'user' => $user,
            'readonly' => 'readonly' 
        ]);
    }

    public function new(){

        $request = $this->getRequest();
        $response = $this->getResponse();
        $router = $this->getRouter();
        $flash = $this->getService('flash');
        // $flash->addMessage('edited','El Registro de '.strtoupper( $user['firstname']).' fue actualizado.');
 
        $params = $request->getParams();

        $messages = $flash->getMessages();
        // dd($messages);
     return $this->render('Employees/employeeNew.twig', [
            'title' => $this->title,
            'menuActive' => $this->menuActive,
            'action' => '/application/employees/create',
            'data' => $params,
            'messages' => $messages,
            
        ]);
    }

    
    public function create(){

        $url = 'http://clientsl.local/api/employees/create';
        $request = $this->getRequest();
        $response = $this->getResponse();
        $router = $this->getRouter();
        $flash = $this->getService('flash');
        // $flash->addMessage('form_create','El Registro se hacreado satisfactoriamente.');
 
        $params = $request->getParams();
        $validator = $this->_validate($params);
        // dd($params);        
        if ($validator){
            return $response->withRedirect($router->pathFor('employeeNew',['data' => $params]));
        }


        try {
            $resp = $this->container->curl->post($url, $params);
            dd ([$url,$resp]);
        } catch (\RuntimeException $ex) {
            $this->container->logger->critical("[EmployeeController::getEdit}", [$ex->getMessage(), $ex->getCode()]);
            // die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
        }

        return $response->withRedirect($router->pathFor('user',['id' => 1]));
    }

    public function edit($id){

        $request = $this->getRequest();
        $response = $this->getResponse();
        $router = $this->getRouter();
        $flash = $this->getService('flash');

 
        $employee = $request->getParam('employee');
        $params = [];
        try {
            $employee = $this->container->curl->post('http://serversl.local/api/employee?id='.$id, $params);
        } catch (\RuntimeException $ex) {
            $this->container->logger->critical("[EmployeeController::getEdit}", [$ex->getMessage(), $ex->getCode()]);
            // die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
        }

        $flash->addMessage('edited','El Registro de '.strtoupper( $user['firstname']).' fue actualizado.');
        
        $message_error = [];
        $readonly = '';     //// null or readonly
        if ($readonly){
            $message_error [] = 'No tienes permiso par editar este registro.';
        }
        $employee['startdate'] = str_replace(" ","T",$employee['startdate']);

        return $this->render('Employees/employee.twig', [
            'title' => 'Employee: '.$user['firstname'].' '.$user['lastname'],
            'menuActive' => $this->menuActive,
            'userLogged' => $this->container->cookies->get('user'),
            'id' => $id,
            'employee' => $employee,
            'readonly' => $readonly,
            'message_error' => $message_error
        ]);
    }

    public function save($id){

        $request = $this->getRequest();
        $flash = $this->getService('flash');
        $response = $this->getService('response');
        $router =  $this->getRouter();

        $employee = $request->getParams();

            // dump($employee);die;

            try {
                $employee = $this->container->curl->post('http://serversl.local/api/employees/save/'.$id, $_POST);
            } catch (\RuntimeException $ex) {
                $this->container->logger->critical("[EmployeeController::getEdit}", [$ex->getMessage(), $ex->getCode()]);
                // die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
            }
        
        $flash->addMessage('edited','El Registro de '.strtoupper( $user['firstname']).' fue actualizado.');
        return $response->withRedirect($router->pathFor('employee',['id' => $id]));
        // $this->router->pathFor('author', ['author_id' => $author->id])
    }

    /**
     * Index Action
     *
     * @return string
     */
    public function getAll()
    {
        // try {
        //     $curl = $this->container->curl->post('http://clientsl.local/mant/headers', array("params" => $params));
        // } catch (\RuntimeException $ex) {
        //     $this->container->logger->critical("[AuthController::handler}", [$ex->getMessage(), $ex->getCode()]);
        //     // die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
        // }
        $flash = $this->getService('flash');

        $messages = $flash->getMessages();
        return $this->render('Employees\employees.twig', [
            'title' => $this->title,
            'menuActive' => $this->menuActive,
            'userLogged' => $this->container->cookies->get('user'),
            'messages' => $messages
            ]);
    }

    private function _validate($elements){
        $error = false;
        foreach($elements as $element){
            if (is_array($element)){
                foreach($element as $field=>$value){
                    if(empty($value)){
                        $this->flash->addMessage('form_employee_new_'.$field, '* campo requerido');
                        // $this->flash->addMessage('form_employee_new_'.$field, '* debe ser un curp valido');
                        $error = true;
                    } 
                    // else {
                    //     $this->flash->addMessage('form_employee_new_'.$field, null);
                    // }
                }
            }
        }
        
        // dd($error);
        return $error;

    }

}
