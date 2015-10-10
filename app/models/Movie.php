<?php


class Movie extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'movies';
	/**
	*	Return Table Name
	*/
	public static function getTableName()
	{
		return 'movies';
	}

	/**
	* Timestamps
	*/
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
	protected $fillable =  array('name','actor','director','category_id','main_language','number_of_discs','series','run_time','release_year');


	/**
	 * Validation rules
	 */
	
	public static $rulesForCreate = array (

			'name' 				=> 'required|min:2|max:60',
			'actor'				=> 'required',
			'director'			=> 'required|min:3|max:30',
			'category_id'		=> 'required',
			'main_language'		=> 'required|min:2|max:15',
			'number_of_discs'	=> 'required|numeric|between:1,10',
			'series'			=> 'min:2|max:30',
			'run_time'			=> 'max:30',
			'release_year'		=> 'required|numeric|digits:4',

	);


	/**
	 *  Return category name by movie id
	 */
	public function category() 
	{
		return $this->hasOne('Category','id','category_id');
	}	

	
}