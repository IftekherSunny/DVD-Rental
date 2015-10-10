<?php
 use SunHelperClass\DateFormat;

class UserController extends BaseController 
{
	/**
	 * This function shows user profile
	 */
	public function getUserProfile()
	{
		if(Session::get('admin') == 'admin')
		{
			$user = User::where('username','=',Session::get('username'))->get()->first();
			
			$userProfile = Admin::find($user->details_id);
			$userProfile->DOB = DateFormat::show($userProfile->DOB);

			return View::make('user.profile')
						->with('userProfile',$userProfile);
		}

		if(Session::get('employee') == 'employee')
		{
			$user = User::where('username','=',Session::get('username'))->get()->first();
			
			$userProfile = Employee::find($user->details_id);
			$userProfile->DOB = DateFormat::show($userProfile->DOB);

			return View::make('user.profile')
						->with('userProfile',$userProfile);
		}
		
		if(Session::get('member') == 'member')
		{
			$user = User::where('username','=',Session::get('username'))->get()->first();
			
			$userProfile = Member::find($user->details_id);
			$userProfile->DOB = DateFormat::show($userProfile->DOB);

			return View::make('user.profile')
						->with('userProfile',$userProfile);
		}
	}

	/**
	 *  User Password (GET)
	 *  This function used for changing password
	 */
	public function getChangePassword($userlevel, $username, $msg = null)
	{		
		if($msg == 'error')
			return View::make('user.changePassword')
					->with('cp_error','Your current password does not match');
		elseif($msg == 'success')
			return View::make('user.changePassword')
					->with('success','Password have been changed');
		else
			return View::make('user.changePassword');
	}

	/**
	 *  User Password (POST)
	 *  This function used for changing password
	 */
	public function postChangePassword($userlevel, $username)
	{
		// Check validation
		$validator = Validator::make(Input::all(), User::$rulesForPasswodChange);

		// If failed then redirect to employee-create-get route with 
		// validation error and input old
		if($validator->fails())
		{
			return Redirect::route('user-password-get', array ($userlevel, $username))
						->withErrors($validator);
		}

		$user = User::where('username','=',Session::get('username'))->get()->first();
        
        if (!Hash::check(trim(Input::get('current_password')), $user->password)) 
        {
        	return Redirect::route('user-password-get', array ($userlevel, $username,'error'));
						
        }
        else
        {
           $user->password = Hash::make(trim(Input::get('confirm_password')));
           $user->save();

           return Redirect::route('user-password-get', array ($userlevel, $username,'success'));			
        }
	}


}