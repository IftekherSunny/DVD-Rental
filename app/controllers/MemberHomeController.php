<?php
use SunHelperClass\config;

class MemberHomeController extends BaseController 
{

	/**
	 *  This function responses  to the 
	 *  post request of the /member/action
	 *  then checked which button are pressed in the
	 *  form of member dashboard page of the 
	 *  route /member
	 */
	public function postAction()
	{
		// Holding checked row value from movie table
		if(Input::get('checked'))
			$id = Input::get('checked');
		elseif(Input::get('checked1'))
			$id = Input::get('checked1');

		/**
		 *  Redirected route if Details button is pressed
		 */
		if(Input::has('Details'))
		{
			return Redirect::route('member-movie-details-get',$id);
		}	

		/**
		 *  Redirected route if Print button is pressed
		 */
		if(Input::has('Print'))
		{
			$parameterr = array();
			$parameter['title'] = ucwords(Session::get('username'))."'s Order";
	        $parameter['orders'] = Order::where('member_id','=',Session::get('member_id'))
										->orderBy('id','desc')->get();

			$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
						->setPaper('a4')
						->setOrientation(config::$MEMBER_REPORT_ORIENTATION)
						->setWarnings(false);

			return $pdf->download('orders.pdf');
		}			
	}


	/**
	 *  This function responses to
	 *  the get request of /member/movie/details/{id}
	 *  and view movie respect to id
	 */
	public function getDetails($id)
	{
		$movie = Movie::find($id);

		return View::make('adminArea.movie.memberMovieDetails')
					->with('movie',$movie);
	}

	/**
	 *  This function responses to
	 *  the get request of /member/movie
	 *  and show all movie as list
	 */
	public function getMovie()
	{		
		return View::make('adminArea.movie.view')
					->with('movies',Movie::orderBy('id','desc')->get());
	}

	/**
	 *  This function responses to
	 *  the get request of /member/order
	 *  and show all movie as list
	 */
	public function getOrder()
	{		
		return View::make('adminArea.order.memberOrder')
					->with('orders',Order::where('member_id','=',Session::get('member_id'))
											->orderBy('id','desc')->get());
	}	
}