<?php
namespace Api\Models;


class Role extends \Illuminate\Database\Eloquent\Model {

    public $timestamps = false;
    
    public function user(){
        return $this->hasOne(User::class);
    }
    
}