<?php
namespace Api\Models;


class Employee extends \Illuminate\Database\Eloquent\Model {

    public $timestamps = false;
    public function human(){
        return $this->belongsTo(Human::class);
    }
    public function user(){
        return $this->hasOne(User::class);
    }
}