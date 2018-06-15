<?php
namespace App\Controllers\EloquentDb;

class Eloquentcontroller {


    public function eloquentAction(){

        $data= Person::find(1);

        $employee=  new Employee();
        $employee->active= 0;
        
        // $data->employee()->save($employee);
        
        if($data->employee) {
            $data->employee->user;
            if ($data->employee->user) {
                $data->employee->user->role;
                if($data->employee->user->role)
                {
                    $data->employee->user->role->rights;
                }
            }
        }
        echo $data; die;
        
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


