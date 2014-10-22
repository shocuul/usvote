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
        'type_description'=>'required|alpha|min:2'
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
	protected $hidden = array('password', 'remember_token');

    public function employee(){
        return $this->hasOne('Employee');
    }

    public function student(){
        return $this->hasOne('Student');
    }

}
