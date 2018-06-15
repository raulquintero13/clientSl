<?php
namespace App\Controllers\EloquentDb;

class Eloquentcontroller {


    public function eloquentAction(){

        $person= Person::find(1);

     
        if($person->employee) {
            if ($person->employee->user) {
                if($person->employee->user->role)
                {
                    $person->employee->user->role->rights;
                }
            }
        }
        $result[] =  $person; 
       
        /*******************************/
        // update active status 
        //
       
        if($person->employee) {
            $person->employee->active= 0;
            $person->employee->save();
        }
       
       
        // $employee=  new Employee();
        // $employee->active= 0;
        
        // $person->employee()->save($employee);
        
        // $result[] = $employee; 
        
        //******************************** */


        $person= Person::find(1);

     
        if($person->employee) {
            if ($person->employee->user) {
                $person->employee->user->role;
            //     if($person->employee->user->role)
            //     {
            //         $person->employee->user->role->rights;
            //     }
            }
        }
        $result[] =  $person; 


        echo json_encode($result);
        
        die;
        
    }
}



class Person extends \Illuminate\Database\Eloquent\Model {

    public $timestamps = false;
    public function employee(){
        return $this->hasOne(Employee::class,'people_id');
    }
}

class Employee extends \Illuminate\Database\Eloquent\Model {

    public $timestamps = false;
    public function person(){
        return $this->belongsTo(Person::class);
    }
    public function user(){
        return $this->hasOne(User::class);
    }
}

class User extends \Illuminate\Database\Eloquent\Model {

    public $timestamps = false;
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }
}

class Role extends \Illuminate\Database\Eloquent\Model {

    public $timestamps = false;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function  rights(){
        return $this->hasMany(Rights::class);
    }
}

class Rights extends \Illuminate\Database\Eloquent\Model {}


