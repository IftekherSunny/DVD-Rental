<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ ucfirst($title) }} - DVD Rental</title>
	<link rel="shortcut icon" href="{{ URL::asset('images/favicon.png'); }}" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->   

		{{ HTML::style('css/font-awesome.min.css'); }} 
		{{ HTML::style('css/bootstrap.min.css'); }}
	
@yield('form.css')
@yield('table.css')
@yield('other.css')

		{{ HTML::style('css/style.css'); }}
</head>
<body>

	<div id="wrap">
			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					  <a class="navbar-brand" href="/">
						<b><span class="glyphicon glyphicon-fire"></span> DVD Rental</b>
					  </a>
					</div>
					<!-- nav collapse -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
							@if(Session::get('admin') == 'admin')
							<li {{ ($active=='Dashboard')? 'class="active"' : ' '}}><a href="{{URL::route('admin-home-get')}}"><i class="fa fa-tachometer"></i>Dashboard</a></li>
							<li {{ ($active=='Member')? 'class="active dropdown"' : 'class="dropdown"'}}>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i>Member <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="{{URL::route('member-create-get')}}"><i class="fa fa-user"></i>  Create Member</a></li>
									<li><a href="{{ URL::route('member-get') }}"><i class="fa fa-list"></i> View All Member</a></li>
									<li><a href="{{ URL::route('member-get','csv-for-mailchimp') }}"><i class="fa fa-download"></i> CSV For MailChimp</a></li>	
									<li><a href="{{ URL::route('member-get','csv-for-sms-sender') }}"><i class="fa fa-download"></i> CSV For SMS Sender</a></li>								
								</ul>
							</li>
							<li {{ ($active=='Movie')? 'class="active dropdown"' : 'class="dropdown"'}}>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-film"></span> Movie DVD <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="{{ URL::route('movie-create-get') }}"><span class="glyphicon glyphicon-play"></span> Create Movie DVD</a></li>
									<li><a href="{{ URL::route('movie-get') }}"><i class="fa fa-list"></i> View All Movie DVD</a></li>
									<li><a href="{{ URL::route('category-create-get') }}"><span class="glyphicon glyphicon-play"></span> Create Movie Category</a></li>
									<li><a href="{{ URL::route('category-get') }}"><i class="fa fa-list"></i> View All Category</a></li>
								</ul>
							</li>
							<li {{ ($active=='Order')? 'class="active dropdown"' : 'class="dropdown"'}}>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-book"></span> Order <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="{{URL::route('order-create-get')}}"><i class="fa fa-tag"></i> Create Order</a></li>
									<li><a href="{{URL::route('order-get')}}"><i class="fa fa-list"></i> View All Order</a></li>
									<li><a href="{{URL::route('active-order-get')}}"><i class="fa fa-tags"></i> View All Active Order</a></li>
									<li><a href="{{URL::route('deadline-finished-order-get')}}"><i class="fa fa-tags"></i> Deadline Finished Order</a></li>
									<li><a href="{{URL::route('order-report-get')}}"><i class="fa fa-file-pdf-o"></i> Report On Order</a></li>
								</ul>
							</li>
							<li {{ ($active=='Employee')? 'class="active dropdown"' : 'class="dropdown"'}}>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i>Employee <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="{{URL::route('employee-create-get')}}"><i class="fa fa-user"></i> Create Employee</a></li>
									<li><a href="{{ URL::route('employee-get') }}"><i class="fa fa-list"></i> View All Employee</a></li>
								</ul>
							</li>
							<li {{ ($active=='UserInfo')? 'class="active dropdown"' : 'class="dropdown "'}}>
								<a href="#" class="dropdown-toggle username" data-toggle="dropdown">
									@if (Session::has('username'))
										<span class="glyphicon glyphicon-user"></span> {{Session::get('username')}}
									@endif
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="{{ URL::route('user-profile-get', array( 'admin', Session::get('username') )) }}"><i class="fa fa-cog"></i>Profile</a></li>

									<li><a href="{{ URL::route('user-password-get', array( 'admin', Session::get('username') ) ) }}"><i class="fa fa-cogs"></i>Change Password</a></li>

									<li><a href="{{ URL::route('sign-out') }}"><i class="fa fa-sign-out"></i>Sign Out</a></li>
								</ul>
							</li>
							@endif

							@if(Session::get('employee') == 'employee')
							<li {{ ($active=='Dashboard')? 'class="active"' : ' '}}><a href="{{URL::route('admin-home-get')}}"><i class="fa fa-tachometer"></i>Dashboard</a></li>
							<li {{ ($active=='Member')? 'class="active dropdown"' : 'class="dropdown"'}}>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i>Member <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="{{URL::route('member-create-get')}}"><i class="fa fa-user"></i>  Create Member</a></li>
									<li><a href="{{ URL::route('member-get') }}"><i class="fa fa-list"></i> View All Member</a></li>
									<li><a href="{{ URL::route('member-get','csv-for-mailchimp') }}"><i class="fa fa-download"></i> CSV For MailChimp</a></li>	
									<li><a href="{{ URL::route('member-get','csv-for-sms-sender') }}"><i class="fa fa-download"></i> CSV For SMS Sender</a></li>								
								</ul>
							</li>
							<li {{ ($active=='Movie')? 'class="active dropdown"' : 'class="dropdown"'}}>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-film"></span> Movie DVD <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="{{ URL::route('movie-create-get') }}"><span class="glyphicon glyphicon-play"></span> Create Movie DVD</a></li>
									<li><a href="{{ URL::route('movie-get') }}"><i class="fa fa-list"></i> View All Movie DVD</a></li>
									<li><a href="{{ URL::route('category-create-get') }}"><span class="glyphicon glyphicon-play"></span> Create Movie Category</a></li>
									<li><a href="{{ URL::route('category-get') }}"><i class="fa fa-list"></i> View All Category</a></li>
								</ul>
							</li>
							<li {{ ($active=='Order')? 'class="active dropdown"' : 'class="dropdown"'}}>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-book"></span> Order <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="{{URL::route('order-create-get')}}"><i class="fa fa-tag"></i> Create Order</a></li>
									<li><a href="{{URL::route('order-get')}}"><i class="fa fa-list"></i> View All Order</a></li>
									<li><a href="{{URL::route('active-order-get')}}"><i class="fa fa-tags"></i> View All Active Order</a></li>
									<li><a href="{{URL::route('deadline-finished-order-get')}}"><i class="fa fa-tags"></i> Deadline Finished Order</a></li>
									<li><a href="{{URL::route('order-report-get')}}"><i class="fa fa-file-pdf-o"></i> Report On Order</a></li>
								</ul>
							</li>
							<li {{ ($active=='UserInfo')? 'class="active dropdown"' : 'class="dropdown "'}}>
								<a href="#" class="dropdown-toggle username" data-toggle="dropdown">
									@if (Session::has('username'))
										<span class="glyphicon glyphicon-user"></span> {{Session::get('username')}}
									@endif
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="{{ URL::route('user-profile-get', array( 'employee', Session::get('username') )) }}"><i class="fa fa-cog"></i>Profile</a></li>

									<li><a href="{{ URL::route('user-password-get', array( 'employee', Session::get('username') ) ) }}"><i class="fa fa-cogs"></i>Change Password</a></li>

									<li><a href="{{ URL::route('sign-out') }}"><i class="fa fa-sign-out"></i>Sign Out</a></li>
								</ul>
							</li>
							@endif

							@if(Session::get('member') == 'member')
							<li {{ ($active=='Dashboard')? 'class="active"' : ' '}}><a href="{{URL::route('member-home-get')}}"><i class="fa fa-tachometer"></i>Dashboard</a></li>
							<li {{ ($active=='Movie')? 'class="active"' : ' '}}><a href="{{URL::route('member-movie-get')}}"><span class="glyphicon glyphicon-film"></span> Movie DVD</a></li>
							<li {{ ($active=='Order')? 'class="active"' : ' '}}><a href="{{URL::route('member-order-get')}}"><span class="glyphicon glyphicon-book"></span> My Order</a></li>
							<li {{ ($active=='UserInfo')? 'class="active dropdown"' : 'class="dropdown "'}}>
								<a href="#" class="dropdown-toggle username" data-toggle="dropdown">
									@if (Session::has('username'))
										<span class="glyphicon glyphicon-user"></span> {{Session::get('username')}}
									@endif
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="{{ URL::route('user-profile-get', array( 'member', Session::get('username') )) }}"><i class="fa fa-cog"></i>Profile</a></li>

									<li><a href="{{ URL::route('user-password-get', array( 'member', Session::get('username') ) ) }}"><i class="fa fa-cogs"></i>Change Password</a></li>

									<li><a href="{{ URL::route('sign-out') }}"><i class="fa fa-sign-out"></i>Sign Out</a></li>
								</ul>
							</li>
							@endif
						</ul>
					</div>

					<!-- end nav collapse -->
				</div>		
			</div> 

			
    
    	<div class="container main-container">
			<div class="row wrap-content-padding">	
				
				@yield('content')

			</div>
		</div>
	</div> 
	<!-- End wrap - -->
	


	<div class="container footer_container">
		<div class="row">
			<div class="col-xs-12 footer  footer_area">
				<div class="footer-center">
					<b>Copyright &copy; <a href="http://iftekhersunny.com/fb/">Iftekher Islam Sunny</a></b>
				</div>
			</div>
		</div>
	</div>



		{{ HTML::script('js/jquery-1.8.1.min.js'); }}
		{{ HTML::script('js/bootstrap.min.js'); }}
		{{ HTML::script('js/modernizr.min.js'); }}	

@yield('form.js')
@yield('table.js')
@yield('other.js')	

    	{{ HTML::script('js/main.js'); }}
@yield('script')	
</body>
</html>