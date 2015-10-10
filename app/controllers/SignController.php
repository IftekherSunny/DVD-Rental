<?php

class SignController extends BaseController 
{
	
	/*
	|--------------------------------------------------------------------------
	| Sign in (GET)
	|--------------------------------------------------------------------------
	|
	| 
	|
	*/
	public function getSignIn() 
	{
		return View::make('userAuthentication.signin');
	}

	

	/*
	|--------------------------------------------------------------------------
	| Sign in (POST)
	|--------------------------------------------------------------------------
	|
	| 
	|
	*/
	public function postSignIn()
	{
		// check validation
		$validator = Validator::make(Input::all(),
			array(
				'username'	=>'required',
				'password' 	=> 'required',
			)
		);

		// if validation is failed it's redirected
		// to sign in page with validation errors
		if($validator->fails())
		{
			return Redirect::route('signin-get')
						->withErrors($validator)
						->withInput();	
		}

		// else check username and password.
		// if valid then redirect to the intended page
		// else redirect to sign in page with invalid 
		// username/password message
		else 
		{
			$remember = Input::has('remember') ? true : false;


			$auth = Auth::attempt(array(
				'username' 	=> Input::get('username'),
				'password' 	=> trim(Input::get('password')),
				'active'	=> 1
			), $remember);		

			if($auth)
			{
				$user = User::where('username','=',Input::get('username'))->get()->first();

				// Holding all important data
				// from database to session 
				// variable
				Session::put('username', $user->username);
				Session::put('user_level', $user->user_level);
				Session::put('user_id', $user->id);
				Session::put('wc_msg',1);

				if($user->user_level === 'admin')
				{
					Session::put('admin', 'admin');
					Session::put('employee_id',Employee::find($user->details_id)->id);

					return Redirect::intended('/admin');
				}
				elseif($user->user_level === 'employee')
				{
					Session::put('employee', 'employee');
					Session::put('employee_id',Employee::find($user->details_id)->id);
					return Redirect::intended('/employee');
				}
				elseif($user->user_level === 'member')
				{
					Session::put('member', 'member');					
					Session::put('member_id',Member::find($user->details_id)->id);
					return Redirect::intended('/member');
				}

			}
			else
			{
				return View::make('userAuthentication.signin')->with('invalid','Invalid Username/Password.');
			}
		}
	}


	

	/*
	|--------------------------------------------------------------------------
	| Sign Out (GET)
	|--------------------------------------------------------------------------
	|
	| 
	|
	*/
	public function getSignOut()
	{
		Session::flush();
		Auth::logout();
		return Redirect::route('signin-get');
	}


	
	/*
	|--------------------------------------------------------------------------
	| Forgot Password (GET)
	|--------------------------------------------------------------------------
	|
	| 
	|
	*/
	public function getForgotPassword()
	{
		return View::make('userAuthentication.forgotpassword');
	}


	

	/*
	|--------------------------------------------------------------------------
	| Forgot Password (POST)
	|--------------------------------------------------------------------------
	|
	| 
	|
	*/
	public function postForgotPassword()
	{
		// Validation email address
		$validator = Validator::make(Input::all(),
			array(
				'email' => 'required|email'
			)
		);

		// if validation is failed it's redirected
		// to forget password page with validation errors
		if($validator->fails())
		{
			return Redirect::route('forgot-password-get')
						->withErrors($validator)
						->withInput();
		}
		// if validation is not failed send new password
		// with confirmation link to the email address
		// of the user
		else
		{
			// check the email is existed
			$user = User::where('email','=',Input::get('email'))->get();

			if($user->count())
			{
				$user = $user->first();
				// generate random code and password
				$password 		= str_random(10);
				$code 			= str_random(60);
				$newHashPassword	= Hash::make($password);


				// Save new password and code 
				$user->password_tmp = $newHashPassword;
				$user->activation_code 		= $code;

				if ($user->save())
				{
					Mail::send('emails.auth.reset_password',
						array(
							'username' 		=> $user->username,
							'newpassword' 	=> $password,
							'code' 			=> URL::route('reset-password-get',$code)
						), function($message) use ($user) {
							$message->to($user->email, $user->username)->subject('Password Reset');
						}
					);


					return View::make('userAuthentication.forgotpassword')
					->with('success', 'New password has been sent successfully.');
				}

				
			}

			return View::make('userAuthentication.forgotpassword')
					->with('error', 'The email address is not registered.');			
		}		
	}


	/*
	|--------------------------------------------------------------------------
	| Reset Password (GET)
	|--------------------------------------------------------------------------
	|
	| This function helps to reset password
	|
	*/
	public function getResetPassword($code)
	{
		$user = User::where('activation_code','=', $code)
					->where('password_tmp','!=','');

		if($user->count())
		{
			$user = $user->first();

			$user->password 				= $user->password_tmp;
			$user->password_tmp 			= '';
			$user->activation_code 			= '';


			if($user->save())
			{
				return View::make('userAuthentication.signin')
							->with('success','Password has been reset successfully');
			}
		}

		return View::make('userAuthentication.signin')
					->with('invalid','Invalid confirmation link');
	}

	/*
	|--------------------------------------------------------------------------
	| Activation (GET)
	|--------------------------------------------------------------------------
	|
	| This function helps to active account
	|
	*/
	public function getActivation($code)
	{
		$user = User::where('activation_code','=', $code)
					->where('password_tmp','!=','');

		if($user->count())
		{
			$user = $user->first();

			$user->password 				= $user->password_tmp;
			$user->password_tmp 			= '';
			$user->activation_code 			= '';
			$user->active  					= 1;


			if($user->save())
			{
				return View::make('userAuthentication.signin')
							->with('success','Your account has been activated successfully');
			}
		}

		return View::make('userAuthentication.signin')
					->with('invalid','Invalid confirmation link');
	}

	
}