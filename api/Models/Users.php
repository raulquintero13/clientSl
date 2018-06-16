<?php
namespace Api\Models;

class Users extends \Illuminate\Database\Eloquent\Model {

    public $timestamps = false;
    
    
    public function employee(){
        return $this->belongsTo(Employees::class);
    }
    public function role(){
        return $this->belongsTo(Roles::class);
    }
}