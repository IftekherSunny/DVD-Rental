<?php


class Category extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';
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
	protected $fillable =  array('name');


	/**
	 * Validation rules
	 */
	
	public static $rulesForCreate = array (

			'name' 			=> 'required|min:3|max:30',
	);

	
}