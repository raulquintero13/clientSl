<?php namespace Api\Controllers\Users;

use Core\Kernel\ControllerAbstract;
use Core\Libraries\Database\SimplePDO;

class UsersController extends ControllerAbstract
{


    public function getById(){

      $request = $this->getRequest();
      $response = $this->getResponse();

      $users = require 'users.php';
      $users = array_merge($users['0']['data'],$users['10']['data']);

      $id =$request->getParam('user');
      $user = [
        'firstname' => $users[$id][0],
        'lastname' => $users[$id][1],
        'position' => $users[$id][2],
        'city' => $users[$id][3],
        'startdate' => $users[$id][4],
        'salary' => $users[$id][5],

      ];
      
      // ToDo enable for production  /////
      // $User->set($user);      
      // $user = $User->toArray();

      $this->container->logger->info("api-auth:agent", [$id]);
      // echo json_encode($users[0]);
      // echo "hola desde api";die;
      
      return $response->withJson($user,200);

    }
    /**
     * getAll
     *
     * @return string
     */
    public function getAll()
    {

      $users = require 'users.php';
      // $request = $this->getRequest();
      // $email = $request->getParam('email');
      // $password = $request->getParam('password');
      $logger = $this->getService('logger');
      $logger->info("users::", [$_GET]);
      
      
      
      $users[$_GET['start']]['data'] = $this->_arrayToLinks($users[$_GET['start']]['data']);
      
      $users[$_GET['start']]['draw']=$_GET['draw'];

      echo json_encode($users[$_GET['start']]);
        

        // $results = $this->container->simplePdo->get_results("SELECT * FROM users ");
        // foreach ($results as $user) {
        //     echo $user['firstname'] . ' ' . $user['email'] . '<br />';
        // }



    }

    private function _arrayToLinks($array){

      foreach($array as $key=>$value){
        foreach($value as $k=>$v){
          $value[$k] = '<a href="/user/'.$key.'">'.$v.'</a>';
        }
        $array[$key] = $value;
      }

      return  $array;

    }



    
}