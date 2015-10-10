<?php


class Admin extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'employees';
	public $timestamps = false;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array( 'id');

	/**
	 * Fillable
	 */
	protected $fillable =  array('first_name','last_name','age','gender','DOB','present_address','parmanent_address','city','state','country','mobile_no','email');


	/**
	 * Validation rules
	 */
	
	public static $rulesForCreate = array (

			'first_name' 			=> 'required|min:3|max:30',
			'last_name' 			=> 'required|min:3|max:30',
			'age' 					=> 'required|numeric|min:1|max:100',
			'gender' 				=> 'required',
			'DOB'					=> 'required',
			'present_address' 		=> 'required|min:10|max:200',
			'permanent_address'		=> 'min:10|max:200',
			'state'					=> 'max:30',
			'city' 					=> 'required|max:30',
			'country' 				=> 'required|max:30',
			'mobile_no' 			=> 'required|numeric',
			'email' 				=> 'required|email|max:50|unique:users',
			'username' 				=> 'required|min:5|max:20|unique:users',
			'userlevel' 			=> 'required'
	);

	public static $rulesForEdit = array (

			'first_name' 			=> 'required|min:3|max:30',
			'last_name' 			=> 'required|min:3|max:30',
			'age' 					=> 'required|numeric|min:1|max:100',
			'gender' 				=> 'required',
			'DOB'					=> 'required',
			'present_address' 		=> 'required|min:10|max:200',
			'permanent_address'		=> 'min:10|max:200',
			'state'					=> 'max:30',
			'city' 					=> 'required|max:30',
			'country' 				=> 'required|max:30',
			'mobile_no' 			=> 'required|numeric',
			'user_level' 			=> 'required'
	);


	/**
	 *  Validation Messages
	 */
	public static $messages = array(
		    'DOB.required' => 'The DOB field is required.',
		    'mobile_no.numeric' => 'This is not a valid mobile number.',
		    'userlevel.required' => 'The user level field is required. '
	);

	/**
	 * 
	 */
	public function user()
	{
		return User::where('details_id','=',$this->id)
					->where('user_level','=','admin')
					->get()->first();
	}

	/**
	 * int 1 represent user is active and 0 represent user need to confirm
	 * @return Return Active employee
	 */
	public function userActive($id)
	{
		return User::where('details_id','=',$id)
					->where('user_level','=','admin')
					->where('active','=',1)
					->get()->first();
	}

	/**
	 * This function deletes user by employee id
	 * @param  [int] $id [Need employee id]
	 */
	public function userDelete($id)
	{
		User::where('details_id','=',$id)
				->where('user_level','=','admin')
				->delete();
	}
}



