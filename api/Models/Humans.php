<?php
namespace Api\Models;

class Humans extends \Illuminate\Database\Eloquent\Model {

    public $timestamps = false;


    public function employee(){
        return $this->hasOne(Employee::class);
    }
}

// return $this->hasOne(Employee::class,'people_id');