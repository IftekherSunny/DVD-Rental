<?php
use SunHelperClass\DateFormat;
use SunHelperClass\config;
class OrderController extends BaseController 
{
	/**
	 * This function responses to 
	 * the get request of /admin/order/create
	 */
	public function getCreate()
	{
		
		return View::make('adminArea.order.create');
	}

	/**
	 * This function create order
	 * when data is posted from 
	 * /admin/order/create
	 */
	public function postCreate()
	{
		// Check validation
		$validator = Validator::make(Input::all(), Order::$rulesForCreate);

		// If failed the redirect to order-create-get route with 
		// validation error and input old
		if($validator->fails())
		{
			return Redirect::route('order-create-get')
						->withErrors($validator)
						->withInput();
		}

		Order::create(array(
			'member_id' 		=> Input::get('member_id'),
			'movie_id'			=> Input::get('movie_id'),
			'employee_id'		=> Session::get('employee_id'),
			'from'				=> DateFormat::store(Input::get('from')),
			'to'				=> DateFormat::store(Input::get('to')),
			'status'			=> '1'
		));

		return View::make('adminArea.order.create')
					->with('success', 'Order has been created successfully');
	}

	/**
	 *  This function responses to
	 *  the get request of /admin/order
	 *  and show all order as list
	 */
	public function getViewAllOrder($msg = null)
	{
		if(!empty($msg) && ($msg == 1))
		{
			return View::make('adminArea.order.view')
					->with('orders',Order::orderBy('id','desc')->get())
					->with('success', 'Order has been deleted successfully');
		}

		if(!empty($msg) && ($msg === 'active'))
		{
			return View::make('adminArea.order.active')
						->with('orders',Order::orderBy('id','desc')->get());
		}

		if(!empty($msg) && ($msg === 'report'))
		{			
			return View::make('adminArea/order/reports/optionView');
		}
			
		return View::make('adminArea.order.view')
					->with('orders',Order::orderBy('id','desc')->get());
	}

	/**
	 *  This function response  to the 
	 *  post request of the /admin/order/action
	 *  then check which button are pressed in the
	 *  form of order.view.blade.php of the 
	 *  route /admin/order
	 */
	public function postAction()
	{
		// Holding checked row value from order table
		if(Input::get('checked'))
		{
			$id = Input::get('checked');
			$routeRedirect = 'order-get';
			if(Input::has('TO-form'))
			{
				$routeRedirect = 'admin-home-get';
			}
		}
		// Holding dashboard Order Return Date table, column id value
		elseif(Input::get('checked1'))
		{
			$id = Input::get('checked1');
			$routeRedirect = 'admin-home-get';
		}

		/**
		 *  Redirected route if Edit button is pressed
		 */
		if(Input::has('Edit'))
		{
			return Redirect::route('order-edit-get',$id);
		}

		/**
		 *  Redirected route if Details button is pressed
		 */
		if(Input::has('Details'))
		{
			return Redirect::route('order-details-get',$id);
		}

		/**
		 *  Redirected route if Print button is pressed
		 */
		if(Input::has('Print'))
		{
			$parameterr = array();
			$parameter['title'] = "All Orders List";
	        $parameter['orders'] = Order::all();

			$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
						->setPaper('a4')
						->setOrientation(config::$ORDER_REPORT_ORIENTATION)
						->setWarnings(false);

			return $pdf->stream('orders.pdf');
		}

		/**
		 *  If Delete button is pressed
		 *  destroy function finds order by id
		 *  and deletes the order from order table
		 */
		if(Input::has('Delete'))
		{
			foreach ($id as $orderId) {				
				$order = Order::find($orderId);
				$order->delete();
			}

			return Redirect::route($routeRedirect,1);
		}
				
	}

	/**
	 *  This function responses to
	 *  the get request of /admin/order/edit/{id}/{msg?}
	 *  and show order respect to id
	 */
	public function getEdit($id,$msg = null)
	{
		$order = Order::find($id);
		$order->from = DateFormat::show($order->from);
		$order->to = DateFormat::show($order->to);
		
		if($order)
		{
			if(!empty($msg) && ($msg == 1))
			{
				return View::make('adminArea.order.edit')
						->with('order',$order)
						->with('success', 'Order has been updated successfully');
			}
			
			return View::make('adminArea.order.edit')
						->with('order',$order);
		}

		return View::make('errors/404');
	}

	/**
	 *  This function responses to
	 *  the post request of /admin/order/edit/{id}/{msg?}
	 *  and update order respect to id
	 */
	public function postEdit()
	{
		// Holding id
		$id = Input::get('id');

		// Check validation
		$validator = Validator::make(Input::all(), Order::$rulesForEdit);

		// If failed then redirect to order-edit-get route with 
		// validation error and input old
		if($validator->fails())
		{
			return Redirect::route('order-edit-get',$id)
						->withErrors($validator)
						->withInput();
		}

		$order = Order::find($id);
		
		$order->movie_id		= Input::get('movie_id');
		$order->employee_id		= Session::get('employee_id');
		$order->from			= DateFormat::store(Input::get('from'));
		$order->to				= DateFormat::store(Input::get('to'));
		$order->save();

		return Redirect::route('order-edit-get',array($id,1));
						
	}

	/**
	 *  This function responses to
	 *  the get request of /admin/order/details/{id}
	 *  and view order respect to id
	 */
	public function getDetails($id, $msg = null)
	{
		$order 			= Order::find($id);
		$order->from	= DateFormat::show($order->from);
		$order->to 		= DateFormat::show($order->to);

		if(!empty($msg) && ($msg == 1))
		{
			return View::make('adminArea.order.details')
					->with('order',$order);
		}


		return View::make('adminArea.order.details')
					->with('order',$order);
	}

	/**
	 *  This function responses to
	 *  the post request of /admin/order/details
	 *  and redirect to order edit route 
	 */
	public function postDetails()
	{
		$id = Input::get('id');

		return Redirect::route('order-edit-get',$id);
	}


	/**
	 *  This function responses to
	 *  the get request of /admin/order/active
	 *  and show all active order as list
	 */
	public function getAllActiveOrder($msg = null)
	{
		if(!empty($msg) && ($msg == 1))
		{
			return View::make('adminArea.order.active')
					->with('orders',Order::orderBy('id','desc')->get())
					->with('success', 'Order has been deactivated successfully');
		}
	}

	/**
	 *  This function responses to
	 *  the post request of /admin/order/active
	 *  and deactivated all active order from list
	 */
	public function postOrderDeactive()
	{
		/**
		 *  If Print button press 
		 *  shows active order report
		 */
		if(Input::has('Print'))
		{
			$parameterr = array();
			$parameter['title'] = "Active Orders";
	        $parameter['orders'] = Order::all();

			$pdf = PDF::loadView('reports.order.getAllActiveOrders',$parameter);
			return $pdf->stream('Active Orders.pdf');
		}

		$orderId = Input::get('checked');

		foreach ($orderId as $id) {
			$order = Order::find($id);
			$order->status = '0';
			$order->save();
		}

		return Redirect::route('active-order-get',1);
		
	}

	/**
	 *  This function responses to
	 *  the get request of /admin/order/deadline/finished
	 *  and show all deadline finished active order as list
	 */
	public function getAllDeadlineFinishedOrder()
	{
		date_default_timezone_set(config::$timezone);
		$today = date("Y-m-d");

		$orders = Order::where('to','<',$today)
					->where('status','=',1)
					->orderBy('id','desc')->get();

		return View::make('adminArea/order/deadlineFinished')
					->with('orders', $orders);
	}

	/**
	 *  This function responses to
	 *  the post request of /admin/order/deadline/finished
	 */
	public function postAllDeadlineFinishedOrder()
	{
		/**
		 *  If Print button is pressed
		 *  shows deadline finished active order report
		 */
		if(Input::has('Print'))
		{
			date_default_timezone_set(config::$timezone);
			$today = date("Y-m-d");

			$orders = Order::where('to','<',$today)
						->where('status','=',1)->get();

			$parameterr = array();
			$parameter['title'] = "Deadline Finished Active Orders";
	        $parameter['orders'] = $orders;

			$pdf = PDF::loadView('reports.order.getAllActiveOrders',$parameter);
			return $pdf->stream('Deadline Finished Active Orders.pdf');
		}

		/**
		 *  Redirected route if Details button is pressed
		 */
		if(Input::has('Details'))
		{
			$id = Input::get('checked');
			return Redirect::route('order-details-get',$id);
		}

	}

	/**
	 *  This function responses to
	 *  the get request of /admin/order/report
	 *  and shows all order report options
	 */
	public function getOrderReport()
	{
		return View::make('adminArea/order/reports/optionView');
	}

	/**
	 *  This function responses to
	 *  the post request of /admin/order/report
	 *  and shows all order report options
	 */
	public function postOrderCreatedReport()
	{
		if(Input::has('reportOnOrderCreatedDate'))
		{
			// Check validation
			$validator = Validator::make(Input::all(), Order::$rulesForOrderCreated, Order::$messages);

			// If failed then redirect to order-edit-get route with 
			// validation error and input old
			if($validator->fails())
			{
				return Redirect::back()
								->withErrors($validator)
								->withInput();
			}

			if(Input::get('ocd-status') == 1)
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Order Creation Date";
		        $parameter['orders'] = Order::where('from','>=',DateFormat::store(Input::get('ocd-from')))
			 								->where('from','<=',DateFormat::store(Input::get('ocd-to')))
			 								->where('status','=',1)->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);

				return $pdf->stream('Report On Order Creation Date.pdf');
			}
			elseif(Input::get('ocd-status') == 0) 
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Order Creation Date";
		        $parameter['orders'] = Order::where('from','>=',DateFormat::store(Input::get('ocd-from')))
			 								->where('from','<=',DateFormat::store(Input::get('ocd-to')))
			 								->where('status','=',0)->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);
				return $pdf->stream("Report On Order Creation Date");
			}
			else
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Order Creation Date";
		        $parameter['orders'] = Order::where('from','>=',DateFormat::store(Input::get('ocd-from')))
			 								->where('from','<=',DateFormat::store(Input::get('ocd-to')))
			 								->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)				
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);
				return $pdf->stream('Report On Order Creation Date.pdf');
			}
			
		}
		elseif(Input::has('reportOnDvdReturnDate'))
		{
			// Check validation
			$validator = Validator::make(Input::all(), Order::$rulesForDvdReturnDate, Order::$messages);

			// If failed then redirect to order-edit-get route with 
			// validation error and input old
			if($validator->fails())
			{
				return Redirect::back()
								->withErrors($validator)
								->withInput();
			}

			if(Input::get('drd-status') == 1)
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Dvd Return Date";
		        $parameter['orders'] = Order::where('to','>=',DateFormat::store(Input::get('drd-from')))
			 								->where('to','<=',DateFormat::store(Input::get('drd-to')))
			 								->where('status','=',1)->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);

				return $pdf->stream('Report On Dvd Return Date.pdf');
			}
			elseif(Input::get('drd-status') == 0) 
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Dvd Return Date";
		        $parameter['orders'] = Order::where('to','>=',DateFormat::store(Input::get('drd-from')))
			 								->where('to','<=',DateFormat::store(Input::get('drd-to')))
			 								->where('status','=',0)->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);

				return $pdf->stream('Report On Dvd Return Date.pdf');
			}
			else
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Dvd Return Date";
		        $parameter['orders'] = Order::where('to','>=',DateFormat::store(Input::get('drd-from')))
			 								->where('to','<=',DateFormat::store(Input::get('drd-to')))
			 								->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);

				return $pdf->stream('Report On Dvd Return Date.pdf');
			}
		}
		elseif(Input::has('reportOnTodayCreatedOrder'))
		{
			// Check validation
			$validator = Validator::make(Input::all(), Order::$rulesForTodayCreated, Order::$messages);

			// If failed then redirect to order-edit-get route with 
			// validation error and input old
			if($validator->fails())
			{
				return Redirect::back()
								->withErrors($validator)
								->withInput();
			}

			date_default_timezone_set(config::$timezone);
			$today = date("Y-m-d");

			if(Input::get('tc-status') == 1)
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Today's Created Order";
		        $parameter['orders'] = Order::where('from','=', $today)
		        							->where('status','=',1)->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);

				return $pdf->stream("Report On Today's Created Order.pdf");
			}
			elseif(Input::get('tc-status') == 0) 
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Today's Created Order";
		        $parameter['orders'] = Order::where('from','=', $today)
		        							->where('status','=',0)->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);
							
				return $pdf->stream("Report On Today's Created Order.pdf");
			}
			else
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Today's Created Order";
		        $parameter['orders'] = Order::where('from','=', $today)
		        							  ->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);
							
				return $pdf->stream("Report On Today's Created Order.pdf");
			}
		}
		elseif(Input::has('reportOnTodayReturnDate'))
		{
			// Check validation
			$validator = Validator::make(Input::all(), Order::$rulesForTodayReturn, Order::$messages);

			// If failed then redirect to order-edit-get route with 
			// validation error and input old
			if($validator->fails())
			{
				return Redirect::back()
								->withErrors($validator)
								->withInput();
			}

			date_default_timezone_set(config::$timezone);
			$today = date("Y-m-d");

			if(Input::get('tr-status') == 1)
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Today's Return Date";
		        $parameter['orders'] = Order::where('to','=', $today)
		        							->where('status','=',1)->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);
							
				return $pdf->stream("Report On Today's Return Date.pdf");
			}
			elseif(Input::get('tr-status') == 0) 
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Today's Return Date";
		        $parameter['orders'] = Order::where('to','=', $today)
		        							->where('status','=',0)->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);
							
				return $pdf->stream("Report On Today's Return Date.pdf");
			}
			else
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Today's Return Date";
		        $parameter['orders'] = Order::where('to','=', $today)
		        							  ->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);
							
				return $pdf->stream("Report On Today's Return Date.pdf");
			}
		}
		elseif(Input::has('reportOnOrderByEmployeeId'))
		{
			// Check validation
			$validator = Validator::make(Input::all(), Order::$rulesForOrderByEmployeeId, Order::$messages);

			// If failed then redirect to order-edit-get route with 
			// validation error and input old
			if($validator->fails())
			{
				return Redirect::back()
								->withErrors($validator)
								->withInput();
			}

			if(Input::get('ei-status') == 1)
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Order Created By Employee";
		        $parameter['orders'] = Order::where('from','>=',DateFormat::store(Input::get('ei-from')))
			 								->Where('from','<=',DateFormat::store(Input::get('ei-to')))
			 								->where('employee_id','=',Input::get('employee_id'))
			 								->where('status','=',1)->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);
							
				return $pdf->stream('Report On Order Created By Employee.pdf');
			}
			elseif(Input::get('ei-status') == 0) 
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Order Created By Employee";
		        $parameter['orders'] = Order::where('from','>=',DateFormat::store(Input::get('ei-from')))
			 								->where('from','<=',DateFormat::store(Input::get('ei-to')))
			 								->where('employee_id','=',Input::get('employee_id'))
			 								->where('status','=',0)->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);
							
				return $pdf->stream('Report On Order Created By Employee.pdf');
			}
			else
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Order Created By Employee";
		        $parameter['orders'] = Order::where('from','>=',DateFormat::store(Input::get('ei-from')))
			 								->where('from','<=',DateFormat::store(Input::get('ei-to')))
			 								->where('employee_id','=',Input::get('employee_id'))
			 								->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);
							
				return $pdf->stream('Report On Order Created By Employee.pdf');
			}
		}
		elseif(Input::has('reportOnOrderByMemberId'))
		{
			// Check validation
			$validator = Validator::make(Input::all(), Order::$rulesForOrderByMemberId, Order::$messages);

			// If failed then redirect to order-edit-get route with 
			// validation error and input old
			if($validator->fails())
			{
				return Redirect::back()
								->withErrors($validator)
								->withInput();
			}

			if(Input::get('mi-status') == 1)
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Order Created For Member";
		        $parameter['orders'] = Order::where('from','>=',DateFormat::store(Input::get('mi-from')))
			 								->Where('from','<=',DateFormat::store(Input::get('mi-to')))
			 								->where('member_id','=',Input::get('member_id'))
			 								->where('status','=',1)->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);
							
				return $pdf->stream('Report On Order Created For Member.pdf');
			}
			elseif(Input::get('mi-status') == 0) 
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Order Created For Member";
		        $parameter['orders'] = Order::where('from','>=',DateFormat::store(Input::get('mi-from')))
			 								->where('from','<=',DateFormat::store(Input::get('mi-to')))
			 								->where('member_id','=',Input::get('member_id'))
			 								->where('status','=',0)->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);
							
				return $pdf->stream('Report On Order Created For Member.pdf');
			}
			else
			{
				$parameterr = array();				
				$parameter['title'] = "Report On Order Created For Member";
		        $parameter['orders'] = Order::where('from','>=',DateFormat::store(Input::get('mi-from')))
			 								->where('from','<=',DateFormat::store(Input::get('mi-to')))
			 								->where('member_id','=',Input::get('member_id'))
			 								->get();

				$pdf = PDF::loadView('reports.order.getAllOrders',$parameter)
							->setPaper('a4')
							->setOrientation(config::$ORDER_REPORT_ORIENTATION)
							->setWarnings(false);
							
				return $pdf->stream('Report On Order Created For Member.pdf');
			}
		}
		else
		{
			return View::make('adminArea/order/reports/optionView');
		}		
		
	}

}