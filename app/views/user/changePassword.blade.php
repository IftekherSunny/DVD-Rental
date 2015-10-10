@extends('layout.main')

<?php $title='Change Password'; $active = 'UserInfo'; ?>

@section('content')

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><i class="fa fa-cogs"></i> Change Password</h4>
		</div>
		<div class="panel-body">
			<div class="row panel-body-form">
				@if($errors->has() || isset($cp_error)) 
				<div class="row alert-message">
					<div class="">
						<div class="col-sm-7 col-sm-offset-2 col-xs-10 col-xs-offset-1">
							<div role="alert" class="alert alert-danger alert-dismissible">
								<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
								<p><i class="fa fa-info-circle fa-lg"></i> <strong>Please, Insert all information correctly.</strong></p> 
							</div>
						</div>
					</div>
				</div> 
				@endif

				@if(isset($success)) 
				<div class="row alert-message">
					<div class="">
						<div class="col-sm-7 col-sm-offset-2 col-xs-10 col-xs-offset-1">
							<div role="alert" class="alert alert-info alert-dismissible">
								<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
								<p><i class="fa fa-info-circle fa-lg"></i> <strong>{{ $success }}</strong></p> 
							</div>
						</div>
					</div>
				</div> 
				@endif
				
				<form action=" {{ URL::route('user-password-post',  array(Session::get('user_level'), Session::get('username') ))}} " method="POST" class="form-horizontal" role="form">						
					
					<!-- start of current password -->
					<div class="form-group">
						<label for="current_password" class="col-sm-2 col-sm-offset-1 control-label">Current Password</label>
						<div class="col-sm-5">
						  <input type="password" {{ e(Input::old('current_password')) ? ' value="'. Input::old('current_password') .'"' : ' '}} class="form-control app-textbox" name="current_password" placeholder="Current Password">
						</div>

						@if($errors->has('current_password'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('current_password')}} </label>
						</div>
						@endif

						@if(isset($cp_error))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $cp_error }} </label>
						</div>
						@endif
					</div> <!-- end of current password -->

					<!-- start of new password -->
					<div class="form-group">
						<label for="new_password" class="col-sm-2 col-sm-offset-1 control-label">New Password</label>
						<div class="col-sm-5">
						  <input type="password" {{ e(Input::old('new_password')) ? ' value="'. Input::old('new_password') .'"' : ' '}} class="form-control app-textbox" name="new_password" placeholder="New Password">
						</div>

						@if($errors->has('new_password'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('new_password')}} </label>
						</div>
						@endif
					</div> <!-- end of new password -->


					<!-- start of confirm password -->
					<div class="form-group">
						<label for="confirm_password" class="col-sm-2 col-sm-offset-1 control-label">Confirm Password</label>
						<div class="col-sm-5">
						  <input type="password" {{ e(Input::old('confirm_password')) ? ' value="'. Input::old('confirm_password') .'"' : ' '}} class="form-control app-textbox" name="confirm_password" placeholder="Confirm Password">
						</div>

						@if($errors->has('confirm_password'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('confirm_password')}} </label>
						</div>
						@endif
					</div> <!-- end of old password -->


					
					

					<div class="form-group form-btn-group">
						<div class="col-sm-offset-3 col-xs-2 col-sm-2 col-md-1  form-btn-space">
							<button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>Create</button>
						</div>
						<div class="col-xs-2 col-sm-1">
							<button class="btn btn-danger" type="reset"><i class="fa fa-refresh"></i>Clear</button>
						</div>
					</div>
					{{ Form::token()}}
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
		