<?php
namespace Api\Models;


class Client extends \Illuminate\Database\Eloquent\Model {

    public $timestamps = false;
    public function human(){
        return $this->belongsTo(Human::class);
    }
    
}