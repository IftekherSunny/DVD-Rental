@extends('layout.main')

<?php $title='Member'; $active = 'Member'; ?>

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
			<h4><i class="fa fa-user"></i> Member Edit</h4>
		</div>
		<div class="panel-body">
			<div class="row panel-body-form">
				@if($errors->has()) 
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
				
				<form action=" {{ URL::route('member-edit-post')}} " method="POST" class="form-horizontal" role="form">						
					<!-- Holding id -->
					<input type="hidden" value="{{ $member->id }}" name="id">
					<!-- start of first name -->
					<div class="form-group">
						<label for="First_Name" class="col-sm-2 col-sm-offset-1 control-label">First Name<b class="star"> *</b></label>
						<div class="col-sm-5">
						  <input type="text" {{ e(Input::old('first_name')) ? ' value="'. Input::old('first_name') .'"' : 'value="'. $member->first_name .'"'}} class="form-control app-textbox" name="first_name" placeholder="First Name">
						</div>

						@if($errors->has('first_name'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('first_name')}} </label>
						</div>
						@endif
					</div> <!-- end of first name -->

					<!-- start of last name -->
					<div class="form-group">
						<label for="last_name" class="col-sm-2 col-sm-offset-1 control-label">Last Name<b class="star"> *</b></label>
						<div class="col-sm-5">
						  <input type="text" {{ e(Input::old('last_name')) ? ' value="'. Input::old('last_name') .'"' : 'value="'. $member->last_name .'"'}} class="form-control app-textbox" name="last_name" placeholder="Last Name">
						</div>
						@if($errors->has('last_name'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('last_name')}} </label>
						</div>
						@endif
					</div> <!-- end of last name -->

					<!-- start of age -->
					<div class="form-group">
						<label for="age" class="col-sm-2 col-sm-offset-1 control-label">Age<b class="star"> *</b></label>
						<div class="col-sm-5">
						  <input type="text" {{ e(Input::old('age')) ? ' value="'. Input::old('age') .'"' : 'value="'. $member->age .'"'}} class="form-control app-textbox" name="age" placeholder="Age">
						</div>
						@if($errors->has('age'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('age')}} </label>
						</div>
						@endif
					</div> <!-- end of age -->

					<!-- start of gender -->
					<div class="form-group">
						<label for="gender" class="col-sm-2 col-sm-offset-1 control-label">Gender<b class="star"> *</b></label>
						<div class="col-sm-5">	
							<select id="gender" name="gender">
							  	<option value="" {{ e(Input::old('gender') == '') ? 'selected' : 'selected'}} >Select your option</option>						  
							  	
							  @if(e(Input::old('gender')))
							  	<option {{ e(Input::old('gender') == 'Male') ? 'selected' : ''}} value="Male">Male</option>
							  @elseif( ($member->gender=='Male') && (e(Input::old('gender') !== '')))
							  	<option {{ ($member->gender=='Male') ? 'selected' : ''}} value="Male">Male</option>
							  @else
							  	<option value="Male">Male</option>
							  @endif

							  @if(e(Input::old('gender')))
							  	<option {{ e(Input::old('gender') == 'Female') ? 'selected' : ''}} value="Female">Female</option>
							  @elseif( ($member->gender=='Female') && (e(Input::old('gender') !== '')))
							  	<option {{ ($member->gender=='Female') ? 'selected' : ''}} value="Female">Female</option>
							  @else
							  	<option value="Female">Female</option>
							  @endif							  
							 
							</select> 
						</div>
						@if($errors->has('gender'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('gender')}} </label>
						</div>
						@endif
					</div> <!-- end of gender -->

					<!-- start of DOB -->
					<div class="form-group">
						<label for="dob" class="col-sm-2 col-sm-offset-1 control-label">DOB<b class="star"> *</b></label>
						<div class="col-sm-5">
							<input type="text" {{ e(Input::old('DOB')) ? ' value="'. Input::old('DOB') .'"' : 'value="'. $member->DOB .'"'}} class="form-control" name="DOB" placeholder="01-01-2014" data-beatpicker="true" data-beatpicker-format="['DD','MM','YYYY']" data-beatpicker-module="clear">
						</div>
						@if($errors->has('DOB'))
						<div class="col-sm-4 form-error-msg">
							<label for="inputEmail3" class="label label-danger"> {{ $errors->first('DOB')}} </label>
						</div>
						@endif
					</div>
					<!-- end of DOB -->

					<!-- start of Present Address -->
					<div class="form-group">
						<label for="present_address" class="col-sm-2 col-sm-offset-1 control-label">Present Address<b class="star"> *</b></label>
						<div class="col-sm-5 create">
							<textarea class="form-control app-textbox" name="present_address" placeholder="Present Address" rows="3">{{ e(Input::old('present_address')) ? Input::old('present_address') : $member->present_address }}</textarea>
						</div>
						@if($errors->has('present_address'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('present_address')}} </label>
						</div>
						@endif
					</div> <!-- end of Present Address -->

					<!-- start of permanent Address -->
					<div class="form-group">
						<label for="permanent_address" class="col-sm-2 col-sm-offset-1 control-label">Permanent Address</label>
						<div class="col-sm-5 create">
							<textarea class="form-control app-textbox" name="permanent_address" placeholder="Permanent Address" rows="3">{{ e(Input::old('permanent_address')) ? Input::old('permanent_address') : $member->permanent_address }}</textarea>
						</div>
						@if($errors->has('permanent_address'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('permanent_address')}} </label>
						</div>
						@endif
					</div> <!-- end of Permanent Address -->

					<!-- start of city -->
					<div class="form-group">
						<label for="city" class="col-sm-2 col-sm-offset-1 control-label">City<b class="star"> *</b></label>
						<div class="col-sm-5">
						  <input type="text" {{ e(Input::old('city')) ? ' value="'. Input::old('city') .'"' : 'value="'. $member->city .'"'}} class="form-control app-textbox" name="city" placeholder="City">
						</div>
						@if($errors->has('city'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('city')}} </label>
						</div>
						@endif
					</div> <!-- end of city -->

					<!-- start of state -->
					<div class="form-group">
						<label for="state" class="col-sm-2 col-sm-offset-1 control-label">state</label>
						<div class="col-sm-5">
						  <input type="text" {{ e(Input::old('state')) ? ' value="'. Input::old('state') .'"' : 'value="'. $member->state .'"'}} class="form-control app-textbox" name="state" placeholder="state">
						</div>
					</div> <!-- end of state -->


					<!-- start of country -->
					<div class="form-group">
						<label for="country" class="col-sm-2 col-sm-offset-1 control-label">Country<b class="star"> *</b></label>
						<div class="col-sm-5">	
							<select id="country" name="country"> 	
							 <option value="" selected>Select your option</option>
								@foreach(Country::$country_list as $country)
									@if(e(Input::old('country')))
					  					<option {{ e(Input::old('country') == $country) ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>
								  	@else
								  		<option {{ ($member->country== $country) ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>
								  	@endif
								@endforeach
							</select> 
						</div>
						@if($errors->has('country'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('country')}} </label>
						</div>
						@endif
					</div> <!-- end of country -->

					<!-- start of mobile no -->
					<div class="form-group">
						<label for="mobile_no" class="col-sm-2 col-sm-offset-1 control-label">Mobile No<b class="star"> *</b></label>
						<div class="col-sm-5">
						  <input type="text" {{ e(Input::old('mobile_no')) ? ' value="'. Input::old('mobile_no') .'"' : 'value="'. $member->mobile_no .'"'}} class="form-control app-textbox" name="mobile_no" size="30" placeholder="Mobile No">
						</div>
						@if($errors->has('mobile_no'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('mobile_no')}} </label>
						</div>
						@endif
					</div> <!-- end of moblie no -->

					<div class="form-group form-btn-group">
						<div class="col-sm-offset-3 col-xs-2 col-sm-2 col-md-1  form-btn-space">
							<button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>Update</button>
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


@section('script')
<script type="text/javascript">
	$("#gender").select2();	
	$("#country").select2();	
</script>
@stop
		