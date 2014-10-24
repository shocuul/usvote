<?php
/**
 * Created by PhpStorm.
 * User: denethiel
 * Date: 19/10/14
 * Time: 21:43
 */
class Student extends Eloquent{

    protected $table = "students";

    public function user(){
        return $this->belongsTo('User');
    }

    public function competitions(){
        return $this->belongsToMany('Competition')->withPivot('votes');
    }
}