<?php namespace Api\Controllers\Employees;

use Core\Kernel\ControllerAbstract;
use Core\Libraries\Database\SimplePDO;
use Api\Models\{Employees,Genders,Roles};
// use Api\Models\;

class EmployeesController extends ControllerAbstract
{


    public function getById(){

      $request = $this->getRequest();
      $response = $this->getResponse();

      $employee = Employees::find(1);
      $genders = Genders::all();
      $roles = Roles::all();
      if($employee->human) {  }

      if($employee->user) { 


       }


      $employee = (array_merge(json_decode($employee,1),['genders'=>json_decode($genders,1)]));

      $id =$request->getParam('id');
      $this->container->logger->info("api-auth:agent", [$id,$request->getUri()]);
      
      return $response->withJson($employee,200);
    }



    /**
     * getAll
     *
     * @return string
     */
    public function getAll()
    {
      $response = $this->getResponse();

      $users = require 'users.php';
      
      $logger = $this->getService('logger');
      $logger->info("users::", [$_GET]);
      
      $code = 200;
      
      $users[$_GET['start']]['data'] = $this->_arrayToLinks($users[$_GET['start']]['data']);
      
      $users[$_GET['start']]['draw']=$_GET['draw'];

      //  echo json_encode($users[$_GET['start']]);

      return $response->withJson($users[$_GET['start']], $code);

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