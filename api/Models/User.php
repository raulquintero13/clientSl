<?php
namespace Api\Models;

class User extends \Illuminate\Database\Eloquent\Model {

    public $timestamps = false;
    
    
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }
}