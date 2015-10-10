<?php
use SunHelperClass\DateFormat;
use SunHelperClass\config;

class EmployeeController extends BaseController 
{
	/**
	 * This function responses to 
	 * the get request of /admin/employee/create
	 */
	public function getCreate()
	{
		return View::make('adminArea.employee.create');
	}

	/**
	 * This function create employee
	 * when data is posted from 
	 * /admin/employee/create
	 */
	public function postCreate()
	{
		// Check validation
		$validator = Validator::make(Input::all(), Employee::$rulesForCreate, Employee::$messages);
		
		// If failed then redirect to employee-create-get route with 
		// validation error and input old
		if($validator->fails())
		{
			return Redirect::route('employee-create-get')
						->withErrors($validator)
						->withInput();
		}


		// If validation is not failed then create employee
		$employee = Employee::create(array(
					'first_name' 		=>	Input::get('first_name'),
					'last_name' 		=> Input::get('last_name'),
					'age'				=> Input::get('age'),
					'gender'			=> Input::get('gender'),
					'DOB' 				=> DateFormat::store(Input::get('DOB')),
					'present_address'	=> Input::get('present_address'),
					'permanent_address' => Input::get('permanent_address'),
					'city'				=> Input::get('city'),
					'state' 			=> Input::get('state'),
					'country'			=> Input::get('country'),
					'mobile_no' 		=> Input::get('mobile_no'),
					'email' 			=> Input::get('email'),
					'created_by' 		=> Session::get('username'),
		));

		// Also create user account for the employee
		$user 	= User::create(array(
					'details_id' => $employee->id,
					'username' => Input::get('username'),
					'email' => $employee->email,
					'user_level' => Input::get('userlevel'),
					'active' => 0
		));


		// generate random code and password
		$password 		= str_random(10);
		$code 			= str_random(60);
		$newHashPassword	= Hash::make($password);


		// Save new password and code 
		$user->password_tmp 		= $newHashPassword;
		$user->activation_code 		= $code;

		if ($user->save())
		{
			// Send email to the employee. 
			// This email contains username,password,activation link
			Mail::send('emails.auth.activation',
				array(
					'first_name'		=> $employee->first_name,
					'last_name'			=> $employee->last_name,
					'username' 			=> $user->username,
					'password' 			=> $password,
					'activation_link' 	=> URL::route('activation-get',$code)
				), function($message) use ($user) {
					$message->to($user->email, $user->username)->subject('Confirm Activation');
				}
			);
		}

		return View::make('adminArea.employee.create')
					->with('success', 'Activation link has been sent successfully');
	}

	/**
	 *  This function responses to
	 *  the get request of /admin/employee
	 *  and shows all employee as list
	 */
	public function getViewAllEmployee($msg = null)
	{
		if(!empty($msg) && ($msg == 1))
		{
			return View::make('adminArea.employee.view')
					->with('employees',Employee::orderBy('id','desc')->get())
					->with('success', 'Employee has been deleted successfully');
		}
		
		return View::make('adminArea.employee.view')
					->with('employees',Employee::orderBy('id','desc')->get());
	}

	/**
	 *  This function responses  to the 
	 *  post request of the /admin/employee/action
	 *  then checked which button is pressed in the
	 *  form of employee.view.blade.php of the 
	 *  route /admin/employee
	 */
	public function postAction()
	{
		// Holding checked row value from employee table
		$id = Input::get('checked');

		/**
		 *  Redirected route if Edit button is pressed
		 */
		if(Input::has('Edit'))
			return Redirect::route('employee-edit-get',$id);

		/**
		 *  Redirected route if Details button is pressed
		 */
		if(Input::has('Details'))
			return Redirect::route('employee-details-get',$id);

		/**
		 *  Redirected route if Print button is pressed
		 */
		if(Input::has('Print'))
		{
			$parameterr = array();
	        $parameter['employees'] = Employee::all();

			$pdf = PDF::loadView('reports.employee.getAllEmployees',$parameter)
						->setPaper('a4')
						->setOrientation(config::$EMPLOYEE_REPORT_ORIENTATION)
						->setWarnings(false);

			return $pdf->stream('employees.pdf');
		}

		/**
		 *  If Delete button is pressed
		 *  destroy function find employee by id
		 *  and deletes the employee from employee table
		 */
		if(Input::has('Delete'))
		{
			foreach ($id as $employeeId) {				
				$employee = Employee::find($employeeId);
				$employee->userDelete($employee->id);
				$employee->delete();
			}

			return Redirect::route('employee-get',1);
		}
				
	}

	/**
	 *  This function responses to
	 *  the get request of /admin/employee/edit/{id}/{msg?}
	 *  and show employee respect to id
	 */
	public function getEdit($id,$msg = null)
	{
		$employee = Employee::find($id);
		$employee->DOB = DateFormat::show($employee->DOB);
		
		if($employee)
		{
			if(!empty($msg) && ($msg == 1))
			{
				return View::make('adminArea.employee.edit')
						->with('employee',$employee)
						->with('success', 'Employee has been updated successfully');
			}
			
			return View::make('adminArea.employee.edit')
						->with('employee',$employee);
		}

		return View::make('errors/404');
	}


	/**
	 *  This function responses to
	 *  the post request of /admin/employee/edit/{id}/{msg?}
	 *  and update employee respect to id
	 */
	public function postEdit()
	{
		// Holding id
		$id = Input::get('id');

		// Check validation
		$validator = Validator::make(Input::all(), Employee::$rulesForEdit, Employee::$messages);

		// If failed then redirect to employee-create-get route with 
		// validation error and input old
		if($validator->fails())
		{
			return Redirect::route('employee-edit-get',$id)
						->withErrors($validator)
						->withInput();
		}

		$employee = Employee::find($id);
		
		$employee->first_name 			= Input::get('first_name'); 
		$employee->last_name 			= Input::get('last_name'); 
		$employee->age 					= Input::get('age');
		$employee->gender 				= Input::get('gender');
		$employee->DOB 					= DateFormat::store(Input::get('DOB'));
		$employee->present_address 		= Input::get('present_address');
		$employee->permanent_address	= Input::get('permanent_address');
		$employee->city 				= Input::get('city');
		$employee->state 				= Input::get('state');
		$employee->country 				= Input::get('country');
		$employee->mobile_no 			= Input::get('mobile_no');
		$employee->save();

		return Redirect::route('employee-edit-get',array($id,1));
						
	}

	/**
	 *  This function responses to
	 *  the get request of /admin/employee/details/{id}
	 *  and view employee respect to id
	 */
	public function getDetails($id, $msg = null)
	{
		$employee = Employee::find($id);
		$employee->DOB = DateFormat::show($employee->DOB);

		if(!empty($msg) && ($msg == 1))
		{
			return View::make('adminArea.employee.details')
					->with('employee',$employee)
					->with('orders',Order::orderBy('from','desc')->get())
					->with('success', "Order has been deactivated successfully");
		}


		return View::make('adminArea.employee.details')
					->with('employee',$employee)
					->with('orders',Order::orderBy('from','desc')->get());
	}

	/**
	 *  This function responses to
	 *  the post request of /admin/employee/details
	 *  and redirect to employee edit route 
	 */
	public function postDetails()
	{
		$id = Input::get('id');

		return Redirect::route('employee-edit-get',$id);
	}

	/**
	 *  This function responses to
	 *  the post request of /admin/employee/details/{id}
	 *  and deactivated employee active order from list
	 */
	public function postEmployeeOrderDeactive()
	{

		$orderId = Input::get('checked');
		$employeeId = Input::get('employee_id');

		foreach ($orderId as $id) {
			$order = Order::find($id);
			$order->status = '0';
			$order->save();
		}

		return Redirect::route('employee-details-get',array($employeeId, 1));
		
	}
	
}