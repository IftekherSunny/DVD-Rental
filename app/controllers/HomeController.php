<?php
use SunHelperClass\config;

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example of controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getHome()
	{
		if(Session::get('admin') == 'admin')
			return Redirect::route('admin-home-get');
		
		if(Session::get('member') == 'member')
			return Redirect::route('member-home-get');

		if(Session::get('employee') == 'employee')
			return Redirect::route('employee-home-get');

		return View::make('errors/404');
	}

	/*
	|--------------------------------------------------------------------------
	| Showing Dashboard
	|--------------------------------------------------------------------------
	|
	| 
	|
	*/
	public function getAdminHome($msg = null)
	{
		if( !empty($msg) && ($msg == 1))
		{
			date_default_timezone_set(config::$timezone);
			$today = date("Y-m-d");

			return View::make('adminArea/home/dashboard')
						->with('createdOrders',Order::where('from','=', $today)->orderBy('id','desc')->get())
						->with('returnDate',Order::where('to','=', $today)->orderBy('id','desc')->get())
						->with('success','Order has been deleted successfully');
		}
		else
		{
			date_default_timezone_set(config::$timezone);
			$today = date("Y-m-d");

			return View::make('adminArea/home/dashboard')
						->with('createdOrders',Order::where('from','=', $today)->orderBy('id','desc')->get())
						->with('returnDate',Order::where('to','=', $today)->orderBy('id','desc')->get());
		}
	}

	public function getEmployeeHome()
	{
		if( !empty($msg) && ($msg == 1))
		{
			date_default_timezone_set(config::$timezone);
			$today = date("Y-m-d");

			return View::make('adminArea/home/dashboard')
						->with('createdOrders',Order::where('from','=', $today)->orderBy('id','desc')->get())
						->with('returnDate',Order::where('to','=', $today)->orderBy('id','desc')->get())
						->with('success','Order has been deleted successfully');
		}
		else
		{
			date_default_timezone_set(config::$timezone);
			$today = date("Y-m-d");

			return View::make('adminArea/home/dashboard')
						->with('createdOrders',Order::where('from','=', $today)->orderBy('id','desc')->get())
						->with('returnDate',Order::where('to','=', $today)->orderBy('id','desc')->get());
		}
	}
	public function getMemberHome()
	{
		date_default_timezone_set(config::$timezone);
		$today = date("Y-m-d");

		// Holding watched movies id
		$watchedMovies =  Order::where('member_id','=',Session::get('member_id'))
						->select('movie_id')
						->get()->toArray();

		// Building query whare id = ? or id = ? so on
		$ids = 'id = ?';
		for($i=1;$i< count($watchedMovies); $i++)
			$ids .= ' or id = ?';
		
		$memberWatchedMovies = Movie::orWhereRaw($ids,$watchedMovies)->get();

		return View::make('adminArea/home/member-dashboard')
					->with('newMovies',Movie::orderBy('id','desc')->get()->take(20))
					->with('watchedMovies',$memberWatchedMovies);
	}

	

	/*
	|--------------------------------------------------------------------------
	| Admin Dashboard Functionality
	|--------------------------------------------------------------------------
	|
	| 
	|
	*/

	/**
	 * Generate today's active created report
	 */
	public function getquickCreateReport()
	{
		date_default_timezone_set(config::$timezone);
		$today = date("Y-m-d");
		$parameterr = array();
		$parameter['title'] = 'Today\'s Created Orders';
        $parameter['orders'] = Order::where('from','=', $today)
        								->get();

		$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
					->setPaper('a4')
					->setOrientation(config::$ORDER_REPORT_ORIENTATION)
					->setWarnings(false);

		return $pdf->stream('Report On Today\'s Created Orders.pdf');
		
	}

	/**
	 * Generate today's active return report
	 */
	public function getquickReturnReport()
	{
		date_default_timezone_set(config::$timezone);
		$today = date("Y-m-d");
		$parameterr = array();
		$parameter['title'] = 'Today\'s Return Date Orders';
        $parameter['orders'] = Order::where('to','=', $today)
        								->get();

		$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
					->setPaper('a4')
					->setOrientation(config::$ORDER_REPORT_ORIENTATION)
					->setWarnings(false);

		return $pdf->stream('Report On Today\'s Return Date Orders.pdf');
		
	}

}
