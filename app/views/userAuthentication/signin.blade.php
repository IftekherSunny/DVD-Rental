<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In - DVD Rental</title>
	<link rel="shortcut icon" href="{{ URL::asset('images/favicon.png'); }}" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	{{ HTML::style('css/font-awesome.min.css'); }}
	{{ HTML::style('css/bootstrap.min.css'); }}
	{{ HTML::style('css/style.css'); }}

	
</head>
<body class="signin-body">


	<div class="col-sm-4 col-sm-offset-4 col-xs-10 col-xs-offset-1">
		<a href="#">
			<center class="logo">
				<span class="glyphicon glyphicon-fire"></span>
			</center>
		</a>
	</div>
	
	<div class="col-sm-4 col-sm-offset-4 col-xs-10 col-xs-offset-1 signin-form">
		@if(isset($invalid))
			<div role="alert" class="alert-signin alert-danger fade in">
				<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<p><strong>{{ $invalid }}</strong></p>			  
			</div>		
		@endif

		@if(isset($success))
			<div role="alert" class="alert-signin alert-success fade in">
				<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<p><strong>{{ $success }}</strong></p>			  
			</div>		
		@endif

		@if($errors->has('username'))
			<div role="alert" class="alert-signin alert-danger fade in">
				<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<p><strong>{{ $errors->first('username')}}</strong></p>			  
			</div>		
		@elseif($errors->has('password'))
			<div role="alert" class="alert-signin alert-danger fade in">
				<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<p><strong>{{ $errors->first('password')}}</strong></p>			  
			</div>			
		@endif
		<form action="{{ URL::route('signin-post')}}" method="post">
			<div class="form-group">
				<label class="signin-label">Username:</label>
				<input type="text" autofocus class="signin-input" name="username" {{ e(Input::old('username')) ? ' value="'. Input::old('username') .'"' : ' '}}/>						
			</div>
			<div class="form-group">
				<label class="signin-label">Password:</label>
				<input type="password" class="signin-input" name="password"/>						
			</div>
			<div class="form-group">
                <input type="checkbox" name="remember"> <label for="remember">Remember Me</label>
            </div>
			<div class="form-group">				
					<button type="submt" name="signin" class="btn btn-info btn-block signin-button" ><i class="fa-button fa-key"></i>Sign In</button>
			</div>
			<div class="form-group signin-footer">
				<a href="{{ URL::route('forgot-password-get')}}" class="text-muted"><i class="fa fa-arrow-left"></i>Forgot Your Password?</a>
			</div>

			{{ Form::token() }}
		</form>
		
	</div>


	{{ HTML::script('js/jquery-1.8.1.min.js'); }}
	{{ HTML::script('js/bootstrap.min.js'); }}
	{{ HTML::script('js/modernizr.min.js'); }}
</body>
</html>
