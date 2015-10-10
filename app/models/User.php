<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	public $timestamps = false;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array( 'passsword','password_tmp','activation_code','remember_token');

	/**
	 * Fillable
	 */
	protected $fillable =  array('details_id','username','password','email','user_level','active','remember_token','password_tmp','activation_code');


	/**
	 * Validation rules
	 */
	
	public static $rules = array (

		'id' 				=> 'required',
		'details_id' 		=> 'required',
		'username' 			=>'required|min:5|max:20|unique:users',
		'password' 			=> 'required',
		'confirm_password'	=> 'required|same:password',
		'user_level' 		=> 'required|max:8',
		'email' 			=> 'required|email|max:50|unique:users',
		'password_tmp' 		=> 'max:60',
		'activation_code' 	=> 'max:60'

	);

	public static $rulesForPasswodChange = array (
		
		'current_password' 	=> 'required|min:8|max:20',
		'new_password' 		=> 'required|min:8|max:20',
		'confirm_password'	=> 'required|same:new_password',
	);

}
