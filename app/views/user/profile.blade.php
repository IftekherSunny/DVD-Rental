@extends('layout.main')

<?php $title = Session::get('username'); $active = 'UserInfo'; ?>

@section('form.css')
		{{ HTML::style('css/BeatPicker.min.css'); }}
		{{ HTML::style('css/select2.min.css'); }}
@stop
@section('form.js')
		{{ HTML::script('js/jquery.dataTables.min.js'); }}
		{{ HTML::script('js/BeatPicker.min.js'); }}
		{{ HTML::script('js/select2.min.js'); }}
@stop

@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><i class="fa fa-cog"></i> About </h4>
		</div>
		<div class="panel-body">
			<div class="row panel-body-form">
				
				<form action="" method="" class="form-horizontal" role="form">						
					<!-- Holding id -->
					<input type="hidden" value="{{ $userProfile->id }}" name="id">
					<!-- start of first name -->
					<div class="form-group">
						<label for="First_Name" class="col-sm-2 col-sm-offset-1 control-label">First Name</label>
						<div class="col-sm-5">
						  <input type="text" value="{{ $userProfile->first_name }}"  readonly class="form-control app-textbox" name="first_name">
						</div>
					</div> <!-- end of first name -->

					<!-- start of last name -->
					<div class="form-group">
						<label for="last_name" class="col-sm-2 col-sm-offset-1 control-label">Last Name</label>
						<div class="col-sm-5">
						  <input type="text" value="{{$userProfile->last_name}}" readonly class="form-control app-textbox" name="last_name">
						</div>
					</div> <!-- end of last name -->

					<!-- start of age -->
					<div class="form-group">
						<label for="age" class="col-sm-2 col-sm-offset-1 control-label">Age</label>
						<div class="col-sm-5">
						  <input type="text" value="{{$userProfile->age}}" readonly class="form-control app-textbox" name="age">
						</div>
					</div> <!-- end of age -->

					<!-- start of gender -->
					<div class="form-group">
						<label for="gender" class="col-sm-2 col-sm-offset-1 control-label">Gender</label>
						<div class="col-sm-5">	
							<select id="gender" disabled name="gender">
							  @if($userProfile->gender=='Male')
							  	<option selected value="Male">Male</option>
							  @else
							  	<option selected value="Female">Female</option>
							  @endif		  
							 
							</select> 
						</div>
					</div> <!-- end of gender -->

					<!-- start of DOB -->
					<div class="form-group">
						<label for="dob" class="col-sm-2 col-sm-offset-1 control-label">DOB</label>
						<div class="col-sm-5">
							<input type="text" value="{{$userProfile->DOB}}" readonly class="form-control" name="DOB">
						</div>
					</div>
					<!-- end of DOB -->

					<!-- start of Present Address -->
					<div class="form-group">
						<label for="present_address" class="col-sm-2 col-sm-offset-1 control-label">Present Address</label>
						<div class="col-sm-5">
							<textarea class="form-control app-textbox" readonly rows="5">{{$userProfile->present_address}}</textarea>						  
						</div>
					</div> <!-- end of Present Address -->

					<!-- start of permanent Address -->
					<div class="form-group">
						<label for="permanent_address" class="col-sm-2 col-sm-offset-1 control-label">Permanent Address</label>
						<div class="col-sm-5">
						  <textarea class="form-control app-textbox" readonly rows="5">{{$userProfile->permanent_address}}</textarea>	
						</div>
					</div> <!-- end of Permanent Address -->

					<!-- start of city -->
					<div class="form-group">
						<label for="city" class="col-sm-2 col-sm-offset-1 control-label">City</label>
						<div class="col-sm-5">
						  <input type="text" value="{{$userProfile->city}}" readonly  class="form-control app-textbox" name="city">
						</div>
					</div> <!-- end of city -->

					<!-- start of state -->
					<div class="form-group">
						<label for="state" class="col-sm-2 col-sm-offset-1 control-label">state</label>
						<div class="col-sm-5">
						  <input type="text" value="{{$userProfile->state}}" readonly  class="form-control app-textbox" name="state">
						</div>
					</div> <!-- end of state -->


					<!-- start of country -->
					<div class="form-group">
						<label for="country" class="col-sm-2 col-sm-offset-1 control-label">Country</label>
						<div class="col-sm-5">	
							<select id="country" disabled name="country"> 									
								 <option value="{{ $userProfile->country }}">{{ $userProfile->country }}</option>
							</select> 
						</div>
					</div> <!-- end of country -->

					<!-- start of mobile no -->
					<div class="form-group">
						<label for="mobile_no" class="col-sm-2 col-sm-offset-1 control-label">Mobile No</label>
						<div class="col-sm-5">
						  <input type="text" value="{{$userProfile->mobile_no}}" readonly  class="form-control app-textbox" name="mobile_no" size="30">
						</div>
					</div> <!-- end of moblie no -->

					<!-- start of email -->
					<div class="form-group">
						<label for="email" class="col-sm-2 col-sm-offset-1 control-label">Email</label>
						<div class="col-sm-5">
						  <input type="text" value="{{$userProfile->email}}" readonly  class="form-control app-textbox" name="eamil">
						</div>
					</div> <!-- end of email -->

					<!-- start of username -->
					<div class="form-group">
						<label for="username" class="col-sm-2 col-sm-offset-1 control-label">Username</label>
						<div class="col-sm-5">
						  <input type="text" value="{{$userProfile->user()->username}}" readonly  class="form-control app-textbox" name="username">
						</div>
					</div> <!-- end of username -->
				</form>	
			</div>
		</div>
		<div class="panel-footer">
			<div class="row">
				<div class="col-xs-10 ">
					<button onClick="javascript:window.history.back();" class="btn btn-default btn-md"><i class="fa fa-arrow-left"></i>Back</button>
				</div>
			</div>
		</div>
	</div>

@stop


@section('script')
<script type="text/javascript">
	$("#gender").select2();	
	$("#country").select2();	
</script>
@stop
		