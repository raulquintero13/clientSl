<?php
namespace Api\Models;


class Roles extends \Illuminate\Database\Eloquent\Model {

    public $timestamps = false;
    
    public function user(){
        return $this->hasOne(Users::class);
    }
    
}