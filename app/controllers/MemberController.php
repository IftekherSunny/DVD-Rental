<?php
use SunHelperClass\DateFormat;
use SunHelperClass\config;

class MemberController extends BaseController 
{
	/**
	 * This function responses to 
	 * the get request of /admin/member/create
	 */
	public function getCreate()
	{
		return View::make('adminArea.member.create');
	}

	/**
	 * This function create member
	 * when data posted from 
	 * /admin/member/create
	 */
	public function postCreate()
	{
		// Check validation
		$validator = Validator::make(Input::all(), Member::$rulesForCreate, Member::$messages);

		// If failed then redirect to member-create-get route with 
		// validation error and input old
		if($validator->fails())
		{
			return Redirect::route('member-create-get')
						->withErrors($validator)
						->withInput();
		}

		// If validation is not failed then create member
		$member = Member::create(array(
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

		// Also create user account for the member
		$user 	= User::create(array(
					'details_id' => $member->id,
					'username' => Input::get('username'),
					'email' => $member->email,
					'user_level' => 'member',
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
			// Send email to the member. 
			// This email contains username,password,activation link
			Mail::send('emails.auth.activation',
				array(					
					'first_name'		=> $member->first_name,
					'last_name'			=> $member->last_name,
					'username' 			=> $user->username,
					'password' 			=> $password,
					'activation_link' 	=> URL::route('activation-get',$code)
				), function($message) use ($user) {
					$message->to($user->email, $user->username)->subject('Confirm Activation');
				}
			);
		}

		return View::make('adminArea.member.create')
					->with('success', 'Activation link has been sent successfully');
	}


	/**
	 *  This function responses to
	 *  the get request of /admin/member
	 *  and show all member as list
	 */
	public function getViewAllMember($msg = null)
	{
		if(!empty($msg) && ($msg == 1))
		{
			return View::make('adminArea.member.view')
					->with('members',Member::orderBy('id','desc')->get())
					->with('success', 'Member has been deleted successfully');
		}
		if(!empty($msg) && ($msg == 'csv-for-mailchimp'))
		{
			$members = Member::select('first_name','last_name','email')
					->get()
					->toArray(); 
			return CSV::fromArray($members)->render('Members CSV for MailChimp.csv');
		}
		if(!empty($msg) && ($msg == 'csv-for-sms-sender'))
		{
			$members = Member::select('mobile_no')
					->get()
					->toArray(); 
			return CSV::fromArray($members)->render('Members CSV for SMS Sender.csv');
		}
		
		return View::make('adminArea.member.view')
					->with('members',Member::orderBy('id','desc')->get());
	}

	/**
	 *  This function responses  to the 
	 *  post request of the /admin/member/action
	 *  then checked which button are pressed in the
	 *  form of member.view.blade.php of the 
	 *  route /admin/member
	 */
	public function postAction()
	{
		// Holding checked row value from member table
		$id = Input::get('checked');

		/**
		 *  Redirected route if Edit button is pressed
		 */
		if(Input::has('Edit'))
			return Redirect::route('member-edit-get',$id);

		/**
		 *  Redirected route if Details button is pressed
		 */
		if(Input::has('Details'))
			return Redirect::route('member-details-get',$id);

		/**
		 *  Redirected route if Print button is pressed
		 */
		if(Input::has('Print'))
		{
			$parameterr = array();
	        $parameter['members'] = Member::all();

			$pdf = PDF::loadView('reports.member.getAllMembers',$parameter)
						->setPaper('a4')
						->setOrientation(config::$MEMBER_REPORT_ORIENTATION)
						->setWarnings(false);

			return $pdf->stream('members.pdf');
			
		}

		/**
		 *  If Delete button button is pressed
		 *  destroy function finds member by id
		 *  and deletes the member from member table
		 */
		if(Input::has('Delete'))
		{
			foreach ($id as $memberId) {				
				$member = Member::find($memberId);
				$member->userDelete($member->id);
				$member->delete();
			}

			return Redirect::route('member-get',1);
		}
				
	}

	/**
	 *  This function responses to
	 *  the get request of /admin/member/edit/{id}/{msg?}
	 *  and show member respect to id
	 */
	public function getEdit($id,$msg = null)
	{
		$member = Member::find($id);
		$member->DOB = DateFormat::show($member->DOB);
		
		if($member)
		{
			if(!empty($msg) && ($msg == 1))
			{
				return View::make('adminArea.member.edit')
						->with('member',$member)
						->with('success', 'Member has been updated successfully');
			}
			
			return View::make('adminArea.member.edit')
						->with('member',$member);
		}

		return View::make('errors/404');
	}


	/**
	 *  This function responses to
	 *  the post request of /admin/member/edit/{id}/{msg?}
	 *  and update member respect to id
	 */
	public function postEdit()
	{
		// Holding id
		$id = Input::get('id');

		// Check validation
		$validator = Validator::make(Input::all(), Member::$rulesForEdit, Member::$messages);

		// If failed the redirect to member-edit-get route with 
		// validation error and input old
		if($validator->fails())
		{
			return Redirect::route('member-edit-get',$id)
						->withErrors($validator)
						->withInput();
		}

		$member = Member::find($id);
		
		$member->first_name 			= Input::get('first_name'); 
		$member->last_name 				= Input::get('last_name'); 
		$member->age 					= Input::get('age');
		$member->gender 				= Input::get('gender');
		$member->DOB 					= DateFormat::store(Input::get('DOB'));
		$member->present_address 		= Input::get('present_address');
		$member->permanent_address		= Input::get('permanent_address');
		$member->city 					= Input::get('city');
		$member->state 					= Input::get('state');
		$member->country 				= Input::get('country');
		$member->mobile_no 				= Input::get('mobile_no');
		$member->save();

		return Redirect::route('member-edit-get',array($id,1));
						
	}


	/**
	 *  This function responses to
	 *  the get request of /admin/member/details/{id}
	 *  and view member respect to id
	 */
	public function getDetails($id, $msg = null)
	{
		$member = Member::find($id);
		$member->DOB = DateFormat::show($member->DOB);

		if(!empty($msg) && ($msg == 1))
		{
			return View::make('adminArea.member.details')
					->with('member',$member)
					->with('orders',Order::orderBy('from','desc')->get())
					->with('success', "Order has been deactivated successfully");
		}


		return View::make('adminArea.member.details')
					->with('member',$member)
					->with('orders',Order::orderBy('from','desc')->get());
	}

	/**
	 *  This function responses to
	 *  the post request of /admin/member/details
	 *  and redirect to member edit route 
	 */
	public function postDetails()
	{
		$id = Input::get('id');

		return Redirect::route('member-edit-get',$id);
	}

	/**
	 *  This function responses to
	 *  the post request of /admin/member/details/{id}
	 *  and deactivated member active order from list
	 */
	public function postMemberOrderDeactive()
	{

		$orderId = Input::get('checked');
		$memberId = Input::get('member_id');

		foreach ($orderId as $id) {
			$order = Order::find($id);
			$order->status = '0';
			$order->save();
		}

		return Redirect::route('member-details-get',array($memberId, 1));
		
	}

}