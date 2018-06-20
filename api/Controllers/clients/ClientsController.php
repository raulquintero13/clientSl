<?php namespace Api\Controllers\Clients;

use Core\Kernel\ControllerAbstract;
use Core\Libraries\Database\SimplePDO;
use Api\Models\{Human,Client,Gender};

// use Illuminate\Support\Facades\DB as DB;
use Illuminate\Database\Capsule\Manager as DB;

class ClientsController extends ControllerAbstract
{


    public function getById(){
      $request = $this->getRequest();
      $response = $this->getResponse();
      $id = $request->getParam('id');


      $employee = Client::find($id);
      $genders = Gender::all();
      $roles = Role::all();
      if($employee->human) {  }
      
      if($employee->user) { 
        $employee->user->role;
        
      }
      // echo $roles;die;

      $employee = $employee->toArray();

      
      
      $employee = (array_merge($employee,['genders'=>json_decode($genders,1)]));
      $employee = (array_merge($employee,['roles'=>json_decode($roles,1)]));
      // dd($employee);
      // $employee = (array_merge(json_decode($employee,1),['user'=>json_decode(User::where('employee_id',1)->get(),1)]));
      

      $id =$request->getParam('id');
      $this->container->logger->info("api-auth:agent", [$id,Employee::find(1)]);
      
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

      $user->password = isset($empData['user']['password'])?$empData['user']['password']:$user->password_id;
      $user->rights = isset($empData['user']['rights'])?$empData['user']['rights']:$user->rights_id;
      $user->role_id = isset($empData['user']['role_id'])?$empData['user']['role_id']:$user->role_id;

      $employee->save();
      $human->save();
      $user->save();

          
      $flash->addMessage('edited','El Registro de '.strtoupper( $human->first_name).' fue actualizado.');
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
      $request = $this->getRequest();
      $response = $this->getResponse();

      // $users = require 'users.php';

      $fields = [
          0=>'humans.id',
          1=>'humans.first_name',
          2=>'humans.middle_name',
          3=>'humans.last_name',
          5=>'clients.status_id',
      ];
      
      // $employeesArr = Employee::with('human')->skip(0)->take(10)->get()->toArray();

      // dd( $employeesArr);

      $search = $request->getParam('search');
      $order = ['column'=>0,'dir'=>'asc']; //$request->getParam('order')[0];
      $skip = 0; //$request->getParam('start');
      $take = 10; //$request->getParam('length');

      $column = $fields[$order['column']];
      // var_dump($search);die;

      // if ($search['value']){
      //   die($search);
      // }
      // where('humans.first_name', 'like', '\'%' . $search['value'] . '%\'')->
      $clientsObj =  Client::where(DB::raw("CONCAT(humans.first_name,' ',humans.middle_name,' ',humans.last_name)"), 'like', '%' . $search['value'] . '%')->
        orWhere(DB::raw("CONCAT(humans.middle_name,' ',humans.last_name,' ',humans.first_name)"), '%' . $search['value'] . '%')->
        join('humans','humans.id','=','clients.human_id' )->
        // select('employees.id','humans.first_name','humans.middle_name','humans.last_name','employees.startdate','employees.status')->
        orderBy($column,$order['dir'])->
        take($take)->skip($skip)->get(['clients.id','humans.first_name','humans.middle_name','humans.last_name','clients.status_id']);
        // orderBy($column,$order['dir'])->
        // dd($employeesObj->toArray());


      $this->container->logger->info("api-auth:agent", [$clientsObj->toArray(),$order]);


      $clients = [
        "draw" => $_GET['draw'],
        "recordsTotal" => Client::count(),
        "recordsFiltered" => count($this->_arrayToLinks($clientsObj->toArray())),
        'data' => $this->_arrayToLinks($clientsObj->toArray())
      ];


      // $employeesArr = $this->_arrayToLinks($employeesArr); 
      // $data =  Human::where('humans.id',1)->join('employees','humans.id','=','employees.human_id' )->
      //    select('humans.first_name','humans.middle_name','humans.last_name','employees.startdate','employees.status')->get();

      $logger = $this->getService('logger');
      $logger->info("clients::", [$_GET,$clients]);
      
      $code = 200;
      
      $clients['draw']=$_GET['draw'];

      
      if(!$clients['data']) {
        $clients['data'] = [];
        $this->container->logger->info("api-auth:agent-clients", [$clients]);
      }
      return $response->withJson($clients, $code);

    }

    
    private function _arrayToLinks($array){
      
      // moviendo el indice del arreglo asociativo
      foreach($array as $key=>$value){
        $employees[] = [
          $value['id'],
          $value['first_name'],
          $value['middle_name'],
          $value['last_name'],
          $value['status_id']
        ];
        
      }
      
      // dd($employees);
      $array = $employees;
      
      foreach($array as $key=>$value){

          foreach($value as $k=>$v){
            $client[] = '<a href="/application/clients/'.$value[0].'">'.ucwords($v).'</a>';
          }
          $clients[$key] = $client;
          $client = [];
          }
          // dd($employees);
      return  $clients;

    }



    
}