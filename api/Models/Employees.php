<?php
namespace Api\Models;


class Employees extends \Illuminate\Database\Eloquent\Model {

    public $timestamps = false;
    public function human(){
        return $this->belongsTo(Humans::class);
    }
    public function user(){
        return $this->hasOne(User::class);
    }
}