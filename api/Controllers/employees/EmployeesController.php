<?php namespace Api\Controllers\Employees;

use Core\Kernel\ControllerAbstract;
use Core\Libraries\Database\SimplePDO;
use Api\Models\{Human,User,Employee,Gender,Role};
// use Api\Models\;

class EmployeesController extends ControllerAbstract
{


    public function getById(){
      $request = $this->getRequest();
      $response = $this->getResponse();

      $employee = Employee::find(1);
      $genders = Gender::all();
      $roles = Role::all();
      if($employee->human) {  }
      
      if($employee->user) { 
        $employee->user->role;
        
      }
      // echo $roles;die;
      
      $employee = (array_merge(json_decode($employee,1),['genders'=>json_decode($genders,1)]));
      $employee = (array_merge($employee,['roles'=>json_decode($roles,1)]));
      // $employee = (array_merge(json_decode($employee,1),['user'=>json_decode(User::where('employee_id',1)->get(),1)]));
      
      // dump($employee);die;

      $id =$request->getParam('id');
      $this->container->logger->info("api-auth:agent", [$id,User::find(2)]);
      
      return $response->withJson($employee,200);
    }


    public function saveUserById($id){

      $request = $this->getRequest();
      $flash = $this->getService('flash');
      $response = $this->getService('response');
      $router =  $this->getRouter();

      $empData = $request->getParams();
      $employee = Employee::find($empData['employee']['id']);

      $human = $employee->human;
      $user = $employee->user;
      // $role = $employee->user->role;

      $employee->nss = isset($empData['employee']['nss'])?$empData['employee']['nss']:$employee->nss;
      $employee->status = isset($empData['employee']['status'])?$empData['employee']['status']:$employee->status;
      $employee->sucursal = isset($empData['employee']['sucursal'])?$empData['employee']['sucursal']:$employee->sucursal;
      $employee->position_id = isset($empData['employee']['position_id'])?$empData['employee']['position']:$employee->position_id;
      $employee->salary = isset($empData['employee']['salary'])?$empData['employee']['salary']:$employee->salary;
      $employee->startdate = isset($empData['employee']['startdate'])?$empData['employee']['startdate']:$employee->startdata;
      $employee->user_active = isset($empData['employee']['user_active'])?$empData['employee']['user_active']:$employee->user_active;

      $human->curp = isset($empData['human']['curp'])?$empData['human']['curp']:$human->curp;
      $human->first_name = isset($empData['human']['first_name'])?$empData['human']['first_name']:$human->first_name;
      $human->middle_name = isset($empData['human']['middle_name'])?$empData['human']['middle_name']:$human->middle_name; 
      $human->last_name = isset($empData['human']['last_name'])?$empData['human']['last_name']:$human->last_name;
      $human->email = isset($empData['human']['email'])?$empData['human']['email']:$human->email;
      $human->zipcode = isset($empData['human']['zipcode'])?$empData['human']['zipcode']:$human->zipcode;
      $human->address = isset($empData['human']['address'])?$empData['human']['address']:$human->address;
      $human->birthdate = isset($empData['human']['birthdate'])?$empData['human']['birthdate']:$human->birthdate;
      $human->address_id = isset($empData['human']['address_id'])?$empData['human']['address_id']:$human->address_id;
      $human->gender_id = isset($empData['human']['gender_id'])?$empData['human']['gender_id']:$human->gender_id;

      $user->password = isset($empData['user']['gender_id'])?$empData['user']['gender_id']:$user->password_id;
      $user->rights = isset($empData['user']['gender_id'])?$empData['user']['gender_id']:$user->rights_id;
      $user->role_id = isset($empData['user']['role_id'])?$empData['user']['role_id']:$user->role_id;

      $employee->save();
      $human->save();
      $user->save();

      // echo "<pre>";
      //     echo $human;      
      // echo "<pre>";
          
          // echo $employee->id;die;

      
      $flash->addMessage('edited','El Registro de '.strtoupper( $user['firstname']).' fue actualizado.');
      return $response->withRedirect($router->pathFor('employee',['id' => $employee->id]));
      // $this->router->pathFor('author', ['author_id' => $author->id])
  }



    /**
     * getAll
     *
     * @return string
     */
    public function getAll()
    {
      $response = $this->getResponse();

      // $users = require 'users.php';
      
      $employeesObj = Employee::with('human')->skip(0)->take(10 )->get();
      // $employeesObj->human;

    /*   '0'=>[
        "draw" => $_GET['draw'],
        "recordsTotal" => 30,
        "recordsFiltered" => 30,
        'data' => [     
            ["Airi", "Satou", "Accountant", "Tokyo", "28th Nov 08", "$162,700"],
            ["Angelica","Ramos","chief executive officer (CEO)","London","9th Oct 09","$1,200,000"],
            [ "Ashton","Cox","Junior Technical Author","San Francisco","12th Jan 09","$86,000"],
            ["Bradley","Greer","Software Engineer","London","13th Oct 12","$132,000"],
            ["Brenden","Wagner","Software Engineer","San Francisco","7th Jun 11","$206,850"],
            ["Brielle","Williamson","Integration Specialist","New York","2nd Dec 12","$372,000"],
            [ "Bruno","Nash", "Software Engineer", "London","3rd May 11","$163,500"],
            ["Caesar","Vance", "Pre-Sales Support","New York", "12th Dec 11", "$106,450"],
            ["Cara", "Stevens","Sales Assistant","New York","6th Dec 11", "$145,600"],
            ["Cedric","Kelly","Senior Javascript Developer","Edinburgh", "29th Mar 12", "$433,060"]
        ]
      ]*/

      $employees = [
        "draw" => $_GET['draw'],
        "recordsTotal" => Employee::count(),
        "recordsFiltered" => 1,
        'data' => $employeesObj->toArray()
      ];

      // $employees = $employeesObj->toArray();

      $logger = $this->getService('logger');
      $logger->info("users::", [$_GET,$employees]);
      
      $code = 200;
      
      // $users[$_GET['start']]['data'] = $this->_arrayToLinks($users[$_GET['start']]['data']);
      
      $employees['draw']=$_GET['draw'];

      //  echo json_encode($users[$_GET['start']]);

      return $response->withJson($employees, $code);

    }

    
    private function _arrayToLinks($array){

      foreach($array as $key=>$value){
        foreach($value as $k=>$v){
          $value[$k] = '<a href="/application/employee/'.$key.'">'.ucwords($v).'</a>';
        }
        $array[$key] = $value;
      }

      return  $array;

    }



    
}