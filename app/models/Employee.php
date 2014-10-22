<?php
/**
 * Created by PhpStorm.
 * User: denethiel
 * Date: 19/10/14
 * Time: 21:27
 */
class Employee extends Eloquent{

    protected $table = "employess";

    public function user(){
        return $this->belongsTo('User');
    }
}