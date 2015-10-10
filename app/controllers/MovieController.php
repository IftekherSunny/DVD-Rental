<?php
use SunHelperClass\config;

class MovieController extends BaseController 
{
	/**
	 * This function responses to 
	 * the get request of /admin/movie/create
	 */
	public function getCreate()
	{
		
		return View::make('adminArea.movie.create');
	}

	/**
	 * This function create movie
	 * when data is posted from 
	 * /admin/movie/create
	 */
	public function postCreate()
	{
		// Check validation
		$validator = Validator::make(Input::all(), Movie::$rulesForCreate);

		// If failed then redirect to movie-create-get route with 
		// validation error and input old
		if($validator->fails())
		{
			return Redirect::route('movie-create-get')
						->withErrors($validator)
						->withInput();
		}

		Movie::create(array(
			'name' 				=> Input::get('name'),
			'actor'				=> Input::get('actor'),
			'director'			=> Input::get('director'),
			'category_id'		=> Input::get('category_id'),
			'main_language'		=> Input::get('main_language'),
			'number_of_discs'	=> Input::get('number_of_discs'),
			'series'			=> Input::get('series'),
			'run_time'			=> Input::get('run_time'),
			'release_year'		=> Input::get('release_year'),
		));
		

		return View::make('adminArea.movie.create')
					->with('success', 'Movie has been created successfully');		
	}

	/**
	 *  This function responses to
	 *  the get request of /admin/movie
	 *  and show all movie as list
	 */
	public function getViewAllMovie($msg = null)
	{
		if(!empty($msg) && ($msg == 1))
		{
			return View::make('adminArea.movie.view')
					->with('movies',Movie::orderBy('id','desc')->get())
					->with('success', 'Movie has been deleted successfully');
		}
		
		return View::make('adminArea.movie.view')
					->with('movies',Movie::orderBy('id','desc')->get());
	}

	/**
	 *  This function responses  to the 
	 *  post request of the /admin/movie/action
	 *  then checked which button is pressed in the
	 *  form of movie.view.blade.php of the 
	 *  route /admin/movie
	 */
	public function postAction()
	{
		// Holding checked row value from movie table
		$id = Input::get('checked');

		/**
		 *  Redirected route if Edit button is pressed
		 */
		if(Input::has('Edit'))
			return Redirect::route('movie-edit-get',$id);

		/**
		 *  Redirected route if Details button is pressed
		 */
		if(Input::has('Details'))
			return Redirect::route('movie-details-get',$id);

		/**
		 *  Redirected route if Print button is pressed
		 */
		if(Input::has('Print'))
		{
			$parameterr = array();
	        $parameter['movies'] = Movie::orderBy('id','desc')->get();

			$pdf = PDF::loadView('reports.movie.getAllMovies',$parameter)
						->setPaper('a4')
						->setOrientation(config::$MOVIE_REPORT_ORIENTATION)
						->setWarnings(false);

			return $pdf->stream('movies.pdf');
		}

		/**
		 *  If Delete button is pressed
		 *  destroy function finds movie by id
		 *  and deletes the movie from movie table
		 */
		if(Input::has('Delete'))
		{
			foreach ($id as $movieId) {				
				$movie = Movie::find($movieId);
				$movie->delete();
			}

			return Redirect::route('movie-get',1);
		}
				
	}

	/**
	 *  This function responses to
	 *  the get request of /admin/movie/edit/{id}/{msg?}
	 *  and show movie respect to id
	 */
	public function getEdit($id,$msg = null)
	{
		$movie = Movie::find($id);
		
		if($movie)
		{
			if(!empty($msg) && ($msg == 1))
			{
				return View::make('adminArea.movie.edit')
						->with('movie',$movie)
						->with('success', 'Movie has been updated successfully');
			}
			
			return View::make('adminArea.movie.edit')
						->with('movie',$movie);
		}
		return View::make('errors/404');
	}


	/**
	 *  This function responses to
	 *  the post request of /admin/movie/edit/{id}/{msg?}
	 *  and update movie respect to id
	 */
	public function postEdit()
	{
		// Holding id
		$id = Input::get('id');

		// Check validation
		$validator = Validator::make(Input::all(), Movie::$rulesForCreate);

		// If failed then redirect to movie-create-get route with 
		// validation error and input old
		if($validator->fails())
		{
			return Redirect::route('movie-edit-get',$id)
						->withErrors($validator)
						->withInput();
		}

		$movie = Movie::find($id);
		
		$movie->name 				= Input::get('name');
		$movie->actor 				= Input::get('actor');
		$movie->director 			= Input::get('director');
		$movie->category_id 		= Input::get('category_id');
		$movie->main_language 		= Input::get('main_language');
		$movie->number_of_discs 	= Input::get('number_of_discs');
		$movie->series 				= Input::get('series');
		$movie->run_time 			= Input::get('run_time');
		$movie->release_year 		= Input::get('release_year');
		$movie->save();

		return Redirect::route('movie-edit-get',array($id,1));
						
	}
		

	/**
	 *  This function responses to
	 *  the get request of /admin/movie/details/{id}
	 *  and view movie respect to id
	 */
	public function getDetails($id, $msg = null)
	{
		$movie = Movie::find($id);

		if(!empty($msg) && ($msg == 1))
		{
			return View::make('adminArea.movie.details')
					->with('movie',$movie)
					->with('orders',Order::orderBy('from','desc')->get())
					->with('success', "Order has been deactivated successfully");
		}


		return View::make('adminArea.movie.details')
					->with('movie',$movie)
					->with('orders',Order::orderBy('from','desc')->get());
	}

	/**
	 *  This function responses to
	 *  the post request of /admin/movie/details
	 *  and redirect to movie edit route 
	 */
	public function postDetails()
	{
		$id = Input::get('id');

		return Redirect::route('movie-edit-get',$id);
	}

	/**
	 *  This function responses to
	 *  the post request of /admin/movie/details/{id}
	 *  and deactivated movie active order from list
	 */
	public function postMovieOrderDeactive()
	{

		$orderId = Input::get('checked');
		$movieId = Input::get('movie_id');

		foreach ($orderId as $id) {
			$order = Order::find($id);
			$order->status = '0';
			$order->save();
		}

		return Redirect::route('movie-details-get',array($movieId, 1));
		
	}

}