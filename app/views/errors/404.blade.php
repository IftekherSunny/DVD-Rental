<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Page Not Found - DVD Rental</title>
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
	<div class="container-fluid">
		<div class="row">     
			<div style="padding-top: 8%">
				<center>
					<img src="{{ URL::asset('images/404.png'); }}" alt="" style="width: 50%; height: 280px" />
					<p>
						<a href="{{ URL::route('home'); }}" class="btn btn-lg btn-success">Go Back To Home</a>
					</p>
				</center>    
		    </div> 
		</div>
	</div>
    {{ HTML::script('js/jquery-1.8.1.min.js'); }}
	{{ HTML::script('js/bootstrap.min.js'); }}
	{{ HTML::script('js/modernizr.min.js'); }}	
    
</body>
</html>
