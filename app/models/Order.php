<?php


class Order extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'orders';
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
	protected $fillable =  array('member_id','movie_id','employee_id','from','to','status');


	/**
	 * Validation rules
	 */
	
	public static $rulesForCreate = array (

			'member_id' 	=> 'required',
			'movie_id'		=> 'required',
			'from'			=> 'required',
			'to'			=> 'required',
	);

	public static $rulesForEdit = array (

			'movie_id'		=> 'required',
			'from'			=> 'required',
			'to'			=> 'required',
	);

	public static $rulesForOrderCreated = array (

			'ocd-from'				=> 'required',
			'ocd-to'				=> 'required',
			'ocd-status'			=> 'required',
	);
	public static $rulesForDvdReturnDate = array (

			'drd-from'				=> 'required',
			'drd-to'				=> 'required',
			'drd-status'			=> 'required',
	);
	public static $rulesForTodayCreated = array (

			'tc-status'			=> 'required',
	);
	public static $rulesForTodayReturn = array (

			'tr-status'			=> 'required',
	);
	public static $rulesForOrderByEmployeeId = array (

			'ei-from'			=> 'required',
			'ei-to'				=> 'required',
			'ei-status'			=> 'required',
			'employee_id' 		=> 'required',
	);
	public static $rulesForOrderByMemberId = array (

			'mi-from'			=> 'required',
			'mi-to'				=> 'required',
			'mi-status'			=> 'required',
			'member_id' 		=> 'required',
	);
	public static $messages = array(
		    'ocd-from.required'		 => 'The form field is required.',
		    'ocd-to.required'		 => 'The to field is required.',
		    'ocd-status.required'	 => 'Select your option.',
		    'drd-from.required'		 => 'The form field is required.',
		    'drd-to.required'		 => 'The to field is required.',
		    'drd-status.required'	 => 'Select your option.',
		    'tc-status.required'	 => 'Select your option.',
		    'tr-status.required'	 => 'Select your option.',
		    'ei-from.required'		 => 'The form field is required.',
		    'ei-to.required'		 => 'The to field is required.',
		    'ei-status.required'	 => 'Select your option.',
		    'employee_id.required' 	 => 'Employee ID is required.',		    
		    'mi-from.required'		 => 'The form field is required.',
		    'mi-to.required'		 => 'The to field is required.',
		    'mi-status.required'	 => 'Select your option.',
		    'member_id.required' 	 => 'Member ID is required.',
	);



	/**
	 *  Return member details by order id
	 */
	public function member() 
	{
		return $this->hasOne('Member','id','member_id');
	}

	/**
	 *  Return Movie details by order id
	 */
	public function movie() 
	{
		return $this->hasOne('Movie','id','movie_id');
	}

	/**
	 *  Return employee details by order id
	 */
	public function employee() 
	{
		return $this->hasOne('Employee','id','employee_id');
	}

}