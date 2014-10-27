<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	public static $rules = array(
		'firstname'=>'required|min:2',
		'lastname'=>'required|min:2',
		'email'=>'required|email|unique:users',
		'password'=>'required|alpha_num|between:6,12|confirmed',
		'password_confirmation'=>'required|alpha_num|between:6,12',
        'matricula'=>'required|alpha_num|min:2',
        'type_description'=>'required|alpha_num'
		);
	/**
	 * The database table used by the model.
	 *
	 * @var string
     *
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    public function delete()
    {
        if(is_null($this->student)){
            $this->employee()->delete();
        }else{
            $this->student()->delete();
        }
        return parent::delete();
    }

	protected $hidden = array('password', 'remember_token');

    public function employee(){
        return $this->hasOne('Employee');
    }


    public function isAdmin(){
        return $this->admin;
    }

    public function student(){
        return $this->hasOne('Student');
    }

}
