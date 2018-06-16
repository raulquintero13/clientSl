<?php
namespace Api\Models;

class Human extends \Illuminate\Database\Eloquent\Model {

    public $timestamps = false;


    public function employee(){
        return $this->hasOne(Employee::class);
    }
}

// return $this->hasOne(Employee::class,'people_id');