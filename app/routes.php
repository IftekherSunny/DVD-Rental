<?php
/**
 * ****************************************************
 * This route only used for Cron Jobs
 * ****************************************************
 */
Route::get('/dead-line-finished-order-mail',function(){
  OrderMail::DeadLineFinished();
});

/*********************************************************
 ***************  Unauthenticated Group
 *********************************************************/
Route::group(array('before' => 'guest'), function() {
	
	/*********************************************************
	 ***************  CSRF protection group
	 *********************************************************/
	Route::group(array('before' => 'csrf'), function() {

		/*
		|--------------------------------------------------------------------------
		| Sign In (POST)
		|--------------------------------------------------------------------------
		|
		|
		|
		*/
		Route::post('/signin', array (
				'as' => 'signin-post',
				'uses' => 'SignController@postSignIn'

			)
		);


		/*
		|--------------------------------------------------------------------------
		| Forgot Password (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/forgot_password', array(
			'as'   => 'forgot-password-post',
			'uses' => 'SignController@postForgotPassword'

		));

		
		/*
		|--------------------------------------------------------------------------
		| Reset Password (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/reset_password', array(
			'as'   => 'reset-password-post',
			'uses' => 'SignController@postResetPassword'

		));


	});


	/*********************************************************
	 ***************  All get method group here
	 *********************************************************/


		/*
		|--------------------------------------------------------------------------
		| Sign In (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/signin', array (
				'as'   => 'signin-get',
				'uses' => 'SignController@getSignIn'

			)
		);

		
		/*
		|--------------------------------------------------------------------------
		| Forgot Password (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/forgot_password', array(
			'as'   => 'forgot-password-get',
			'uses' => 'SignController@getForgotPassword'

		));

		

		/*
		|--------------------------------------------------------------------------
		| Reset Password (GET)
		|--------------------------------------------------------------------------
		|	
		| Need a confirm code as parameter
		|
		*/
		Route::get('/reset_password/{code}', array(
			'as'   => 'reset-password-get',
			'uses' => 'SignController@getResetPassword'

		));

		/*
		|--------------------------------------------------------------------------
		| Activation Account (GET)
		|--------------------------------------------------------------------------
		|	
		| Need a confirm code as parameter
		|
		*/
		Route::get('/activation/{code}', array(
			'as'   => 'activation-get',
			'uses' => 'SignController@getActivation'

		));

});




/*********************************************************
 ***************  Authenticated Group ********************
 *********************************************************/
Route::group(array('before' => 'auth'), function() {


	/*********************************************************
	 ***************  CSRF protection group
	 *********************************************************/
	Route::group(array('before' => 'csrf'), function() {

		/*
		|--------------------------------------------------------------------------
		| User Profile Route (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/{userLevel}/user/{username}', array(

				'as' 	=> 'user-profile-post',
				'uses' 	=> 'UserController@postUserProfile'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| User Password Change Route (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/{userLevel}/{username}/password', array(

				'as' 	=> 'user-password-post',
				'uses' 	=> 'UserController@postChangePassword'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Create Employee Route (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/employee/create', array(
				'as'	=> 'employee-create-post',
				'uses'	=> 'EmployeeController@postCreate'
			)
		);

		
		/*
		|--------------------------------------------------------------------------
		| Action For Employee (POST)
		|--------------------------------------------------------------------------
		| This function select action 
		| then redirect route to this action
		| 
		|
		*/
		Route::post('/admin/employee/action', array(
				'as'	=> 'employee-action-post',
				'uses'	=> 'EmployeeController@postAction'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Employee Edit (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/employee/edit/{id}', array(
				'as'	=> 'employee-edit-post',
				'uses'	=> 'EmployeeController@postEdit'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Employee Details (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/employee/details', array(
				'as'	=> 'employee-details-post',
				'uses'	=> 'EmployeeController@postDetails'
			)
		);

		/*
		|--------------------------------------------------------------------------
		|  Order Deactive followed by employee (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/employee/order/deactive', array(
				'as'	=> 'employee-order-deactive-post',
				'uses'	=> 'EmployeeController@postEmployeeOrderDeactive'
			)
		);


		/*
		|--------------------------------------------------------------------------
		| Member Create (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/member/create', array(
				'as'	=> 'member-create-post',
				'uses'	=> 'MemberController@postCreate'
			)
		);

		
		/*
		|--------------------------------------------------------------------------
		| Action For Member (POST)
		|--------------------------------------------------------------------------
		| This function select action 
		| then redirect route to this action
		| 
		|
		*/
		Route::post('/admin/member/action', array(
				'as'	=> 'member-action-post',
				'uses'	=> 'MemberController@postAction'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Member Edit (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/member/edit/{id}', array(
				'as'	=> 'member-edit-post',
				'uses'	=> 'MemberController@postEdit'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Member Details (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/member/details', array(
				'as'	=> 'member-details-post',
				'uses'	=> 'MemberController@postDetails'
			)
		);


		/*
		|--------------------------------------------------------------------------
		| Order Deactive followed by member (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/member/order/deactive', array(
				'as'	=> 'member-order-deactive-post',
				'uses'	=> 'MemberController@postMemberOrderDeactive'
			)
		);


		/*
		|--------------------------------------------------------------------------
		| Create Category (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/category/create', array(
				'as'	=> 'category-create-post',
				'uses'	=> 'CategoryController@postCreate'
			)
		);


		/*
		|--------------------------------------------------------------------------
		| Action For Category (POST)
		|--------------------------------------------------------------------------
		| This function select action 
		| then redirect route to this action
		| 
		|
		*/
		Route::post('/admin/category/action', array(
				'as'	=> 'category-action-post',
				'uses'	=> 'CategoryController@postAction'
			)
		);


		/*
		|--------------------------------------------------------------------------
		| Category Edit (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/category/edit/{id}', array(
				'as'	=> 'category-edit-post',
				'uses'	=> 'CategoryController@postEdit'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Movie Create (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/movie/create', array(
				'as'	=> 'movie-create-post',
				'uses'	=> 'MovieController@postCreate'
			)
		);

		
		/*
		|--------------------------------------------------------------------------
		| Action For Movie (POST)
		|--------------------------------------------------------------------------
		| This function select action 
		| then redirect route to this action
		| 
		|
		*/
		Route::post('/admin/movie/action', array(
				'as'	=> 'movie-action-post',
				'uses'	=> 'MovieController@postAction'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Movie Edit (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/movie/edit', array(
				'as'	=> 'movie-edit-post',
				'uses'	=> 'MovieController@postEdit'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Movie Details (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/movie/details', array(
				'as'	=> 'movie-details-post',
				'uses'	=> 'MovieController@postDetails'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Movie Order Deactive (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/movie/order/deactive', array(
				'as'	=> 'movie-order-deactive-post',
				'uses'	=> 'MovieController@postMovieOrderDeactive'
			)
		);


		/*
		|--------------------------------------------------------------------------
		| Order Create (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/order/create', array(
				'as'	=> 'order-create-post',
				'uses'	=> 'OrderController@postCreate'
			)
		);

		
		/*
		|--------------------------------------------------------------------------
		| Action For Order (POST)
		|--------------------------------------------------------------------------
		| This function selects action 
		| then redirects route to this action
		| 
		|
		*/
		Route::post('/admin/order/action', array(
				'as'	=> 'order-action-post',
				'uses'	=> 'OrderController@postAction'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Order Edit (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/order/edit/{id}', array(
				'as'	=> 'order-edit-post',
				'uses'	=> 'OrderController@postEdit'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Order Details (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/order/details', array(
				'as'	=> 'order-details-post',
				'uses'	=> 'OrderController@postDetails'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Order Deactive (POST)
		|--------------------------------------------------------------------------
		| This function deactivated active order
		| 
		|
		*/
		Route::post('/admin/order/active', array(
				'as'	=> 'order-deactive-post',
				'uses'	=> 'OrderController@postOrderDeactive'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| View All Deadline Finished Order (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/admin/order/deadline/finished', array(
				'as'	=> 'deadline-finished-order-post',
				'uses'	=> 'OrderController@postAllDeadlineFinishedOrder'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Report on Order Created (POST)
		|--------------------------------------------------------------------------
		| This function shows report on order created date
		| 
		|
		*/
		Route::post('/admin/order/report', array(
				'as'	=> 'order-created-report-post',
				'uses'	=> 'OrderController@postOrderCreatedReport'
			)
		);

/******************************************************************************************************
*********************************** Employee Area ****************************************************
******************************************************************************************************/
		
	if(Session::get('employee') == 'employee')
	{
		/*
		|--------------------------------------------------------------------------
		| Member Create (POST)
		|
		| 
		|
		*/
		Route::post('/employee/member/create', array(
				'as'	=> 'member-create-post',
				'uses'	=> 'MemberController@postCreate'
			)
		);

		
		/*
		|--------------------------------------------------------------------------
		| Action For Member (POST)
		|--------------------------------------------------------------------------
		| This function select action 
		| then redirect route to this action
		| 
		|
		*/
		Route::post('/employee/member/action', array(
				'as'	=> 'member-action-post',
				'uses'	=> 'MemberController@postAction'
			)
		);


		/*
		|--------------------------------------------------------------------------
		| Order Deactive followed by member (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/employee/member/order/deactive', array(
				'as'	=> 'member-order-deactive-post',
				'uses'	=> 'MemberController@postMemberOrderDeactive'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Category Create (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/employee/category/create', array(
				'as'	=> 'category-create-post',
				'uses'	=> 'CategoryController@postCreate'
			)
		);


		/*
		|--------------------------------------------------------------------------
		| Action For Category (POST)
		|--------------------------------------------------------------------------
		| This function select action 
		| then redirect route to this action
		| 
		|
		*/
		Route::post('/employee/category/action', array(
				'as'	=> 'category-action-post',
				'uses'	=> 'CategoryController@postAction'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Movie Create (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/employee/movie/create', array(
				'as'	=> 'movie-create-post',
				'uses'	=> 'MovieController@postCreate'
			)
		);

		
		/*
		|--------------------------------------------------------------------------
		| Action For Movie (POST)
		|--------------------------------------------------------------------------
		| This function selects action 
		| then redirects route to this action
		| 
		|
		*/
		Route::post('/employee/movie/action', array(
				'as'	=> 'movie-action-post',
				'uses'	=> 'MovieController@postAction'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Movie Deactive (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/employee/movie/order/deactive', array(
				'as'	=> 'movie-order-deactive-post',
				'uses'	=> 'MovieController@postMovieOrderDeactive'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Order Create (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/employee/order/create', array(
				'as'	=> 'order-create-post',
				'uses'	=> 'OrderController@postCreate'
			)
		);

		
		/*
		|--------------------------------------------------------------------------
		| Action For Order (POST)
		|--------------------------------------------------------------------------
		| This function selects action 
		| then redirects route to this action
		| 
		|
		*/
		Route::post('/employee/order/action', array(
				'as'	=> 'order-action-post',
				'uses'	=> 'OrderController@postAction'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Order Deactive (POST)
		|--------------------------------------------------------------------------
		| This function deactivated active order
		| 
		|
		*/
		Route::post('/employee/order/active', array(
				'as'	=> 'order-deactive-post',
				'uses'	=> 'OrderController@postOrderDeactive'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| View All Deadline Finished Order (POST)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::post('/employee/order/deadline/finished', array(
				'as'	=> 'deadline-finished-order-post',
				'uses'	=> 'OrderController@postAllDeadlineFinishedOrder'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Report on Order Created (POST)
		|--------------------------------------------------------------------------
		| This function shows report on order created date
		| 
		|
		*/
		Route::post('/employee/order/report', array(
				'as'	=> 'order-created-report-post',
				'uses'	=> 'OrderController@postOrderCreatedReport'
			)
		);
	}
	
/**************************** END OF Employee Area POST METHODS *******************************/


/******************************************************************************************************
*********************************** Member Area ****************************************************
******************************************************************************************************/

	if(session::get('member') == 'member')
	{
		/*
		|--------------------------------------------------------------------------
		| Member Action (POST)
		|--------------------------------------------------------------------------
		| This function takes action depanding on 
		| which button is pressed
		| 
		|
		*/
		Route::post('/member/action', array(
				'as'	=> 'member-action-post',
				'uses'	=> 'MemberHomeController@postAction'
			)
		);
	}
	
/**************************** END OF Member Area POST METHODS *******************************/

	});		
		/*********************************************************
		 ***************  All get method group here
		 *********************************************************/
		

		/*
		|--------------------------------------------------------------------------
		| Home Route (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/', array(

				'as' 	=> 'home',
				'uses' 	=> 'HomeController@getHome'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| User Profile Route (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/{userLevel}/user/{username}', array(

				'as' 	=> 'user-profile-get',
				'uses' 	=> 'UserController@getUserProfile'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| User Password Change Route (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/{userLevel}/{username}/password/{msg?}', array(

				'as' 	=> 'user-password-get',
				'uses' 	=> 'UserController@getChangePassword'
			)
		);


		/*
		|--------------------------------------------------------------------------
		| Admin Home Page (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/{msg?}', array(
				'as'	=> 'admin-home-get',
				'uses'	=> 'HomeController@getAdminHome'
			)
		)->where('msg','\d+');

		/*
		|--------------------------------------------------------------------------
		| Quick Create Report (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/quick-create-report', array(
				'as'	=> 'admin-quick-create-report',
				'uses'	=> 'HomeController@getquickCreateReport'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Quick Return Report (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/quick-return-report', array(
				'as'	=> 'admin-quick-return-report',
				'uses'	=> 'HomeController@getquickReturnReport'
			)
		);


		/*
		|--------------------------------------------------------------------------
		| Employee Create (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/employee/create', array(
				'as'	=> 'employee-create-get',
				'uses'	=> 'EmployeeController@getCreate'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| View All Employee (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/employee/{msg?}', array(
				'as'	=> 'employee-get',
				'uses'	=> 'EmployeeController@getViewAllEmployee'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Employee Edit (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/employee/edit/{id}/{msg?}', array(
				'as'	=> 'employee-edit-get',
				'uses'	=> 'EmployeeController@getEdit'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Employee Details (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/employee/details/{id}/{msg?}', array(
				'as'	=> 'employee-details-get',
				'uses'	=> 'EmployeeController@getDetails'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Member Create (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/member/create', array(
				'as'	=> 'member-create-get',
				'uses'	=> 'MemberController@getCreate'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| View All Member (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/member/{msg?}', array(
				'as'	=> 'member-get',
				'uses'	=> 'MemberController@getViewAllMember'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Member Edit (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/member/edit/{id}/{msg?}', array(
				'as'	=> 'member-edit-get',
				'uses'	=> 'MemberController@getEdit'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Member Details (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/member/details/{id}/{msg?}', array(
				'as'	=> 'member-details-get',
				'uses'	=> 'MemberController@getDetails'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Category Create (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/category/create', array(
				'as'	=> 'category-create-get',
				'uses'	=> 'CategoryController@getCreate'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| View All Category (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/category/{msg?}', array(
				'as'	=> 'category-get',
				'uses'	=> 'CategoryController@getViewAllCategory'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Category Edit (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/category/edit/{id}/{msg?}', array(
				'as'	=> 'category-edit-get',
				'uses'	=> 'CategoryController@getEdit'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Movie Create (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/movie/create', array(
				'as'	=> 'movie-create-get',
				'uses'	=> 'MovieController@getCreate'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| View All Movie (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/movie/{msg?}', array(
				'as'	=> 'movie-get',
				'uses'	=> 'MovieController@getViewAllMovie'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Movie Edit (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/movie/edit/{id}/{msg?}', array(
				'as'	=> 'movie-edit-get',
				'uses'	=> 'MovieController@getEdit'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Movie Details (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/movie/details/{id}/{msg?}', array(
				'as'	=> 'movie-details-get',
				'uses'	=> 'MovieController@getDetails'
			)
		);


		/*
		|--------------------------------------------------------------------------
		| Order Create (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/order/create', array(
				'as'	=> 'order-create-get',
				'uses'	=> 'OrderController@getCreate'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| View All Order (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/order/{msg?}', array(
				'as'	=> 'order-get',
				'uses'	=> 'OrderController@getViewAllOrder'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Order Edit (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/order/edit/{id}/{msg?}', array(
				'as'	=> 'order-edit-get',
				'uses'	=> 'OrderController@getEdit'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Order Details (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/order/details/{id}/{msg?}', array(
				'as'	=> 'order-details-get',
				'uses'	=> 'OrderController@getDetails'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| View All Active Order (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/order/active/{msg?}', array(
				'as'	=> 'active-order-get',
				'uses'	=> 'OrderController@getAllActiveOrder'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| View All Deadline Finished Order (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/order/deadline/finished', array(
				'as'	=> 'deadline-finished-order-get',
				'uses'	=> 'OrderController@getAllDeadlineFinishedOrder'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Report on Order (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/admin/order/report', array(
				'as'	=> 'order-report-get',
				'uses'	=> 'OrderController@getOrderReport'
			)
		);

/*************************************************************************************************
*************************** Employee Area ********************************************************
*************************************************************************************************/
		/*
		|--------------------------------------------------------------------------
		| Employee Home Page (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/employee', array(
				'as'	=> 'employee-home-get',
				'uses'	=> 'HomeController@getEmployeeHome'
			)
		);


	if(Session::get('employee') == 'employee')
	{
		
		/*
		|--------------------------------------------------------------------------
		| Quick Create Report (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/employee/quick-create-report', array(
				'as'	=> 'admin-quick-create-report',
				'uses'	=> 'HomeController@getquickCreateReport'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Quick Return Report (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/employee/quick-return-report', array(
				'as'	=> 'admin-quick-return-report',
				'uses'	=> 'HomeController@getquickReturnReport'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Member Create (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/employee/member/create', array(
				'as'	=> 'member-create-get',
				'uses'	=> 'MemberController@getCreate'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| View All Member (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/employee/member/{msg?}', array(
				'as'	=> 'member-get',
				'uses'	=> 'MemberController@getViewAllMember'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Member Details (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/employee/member/details/{id}/{msg?}', array(
				'as'	=> 'member-details-get',
				'uses'	=> 'MemberController@getDetails'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Category Create (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
6		*/
		Route::get('/employee/category/create', array(
				'as'	=> 'category-create-get',
				'uses'	=> 'CategoryController@getCreate'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| View All Category (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/employee/category/{msg?}', array(
				'as'	=> 'category-get',
				'uses'	=> 'CategoryController@getViewAllCategory'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Movie Create (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/employee/movie/create', array(
				'as'	=> 'movie-create-get',
				'uses'	=> 'MovieController@getCreate'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| View All Movie (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/employee/movie/{msg?}', array(
				'as'	=> 'movie-get',
				'uses'	=> 'MovieController@getViewAllMovie'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Movie Details (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/employee/movie/details/{id}/{msg?}', array(
				'as'	=> 'movie-details-get',
				'uses'	=> 'MovieController@getDetails'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Order Create (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/employee/order/create', array(
				'as'	=> 'order-create-get',
				'uses'	=> 'OrderController@getCreate'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| View All Order (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/employee/order/{msg?}', array(
				'as'	=> 'order-get',
				'uses'	=> 'OrderController@getViewAllOrder'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Order Details (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/employee/order/details/{id}/{msg?}', array(
				'as'	=> 'order-details-get',
				'uses'	=> 'OrderController@getDetails'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| View All Active Order (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/employee/order/active/{msg?}', array(
				'as'	=> 'active-order-get',
				'uses'	=> 'OrderController@getAllActiveOrder'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| View All Deadline Finished Order (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/employee/order/deadline/finished', array(
				'as'	=> 'deadline-finished-order-get',
				'uses'	=> 'OrderController@getAllDeadlineFinishedOrder'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Report on Order (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/employee/order/report', array(
				'as'	=> 'order-report-get',
				'uses'	=> 'OrderController@getOrderReport'
			)
		);


	} /** END OF ROUTE EMPLOYEE SESSION **/


		/*
		|--------------------------------------------------------------------------
		| Member Home Page (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/member', array(
				'as'	=> 'member-home-get',
				'uses'	=> 'HomeController@getMemberHome'
			)
		);

	if(Session::get('member') == 'member')
	{	

		/*
		|--------------------------------------------------------------------------
		| Movie Details (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/member/movie/details/{id}', array(
				'as'	=> 'member-movie-details-get',
				'uses'	=> 'MemberHomeController@getDetails'
			)
		);

		/*
		|--------------------------------------------------------------------------
		| Member Move (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/member/movie', array(
				'as'	=> 'member-movie-get',
				'uses'	=> 'MemberHomeController@getMovie'
			)
		);
		/*
		|--------------------------------------------------------------------------
		| Member Order (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/member/order', array(
				'as'	=> 'member-order-get',
				'uses'	=> 'MemberHomeController@getOrder'
			)
		);
	} /* End Of Member GET */

		/*
		|--------------------------------------------------------------------------
		| Sign Out (GET)
		|--------------------------------------------------------------------------
		|
		| 
		|
		*/
		Route::get('/signout', array (
					'as' => 'sign-out',
					'uses' => 'SignController@getSignOut'

			)
		);
});

	

