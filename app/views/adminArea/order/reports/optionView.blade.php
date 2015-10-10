@extends('layout.main')

<?php $title='Order'; $active = 'Order'; ?>

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

		@if($errors->has()) 
		<div class="row alert-message">
			<div class="">
				<div class="col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
					<div role="alert" class="alert alert-danger alert-dismissible">
						<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
						<p><i class="fa fa-info-circle fa-lg"></i> <strong>Please, Insert all information correctly.</strong></p> 
					</div>
				</div>
			</div>
		</div> 
				@endif

	<!-- ###########################################################################
	###################### Report on Todays Created Order  ###################################
	############################################################################# -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><i class="fa fa-file-pdf-o"></i> Report on Today&#39;s Created Order </h4>
		</div>
		<div class="panel-body">
			<div class="row panel-body-form">
				
				<form action=" {{ URL::route('order-created-report-post')}} " method="POST" class="form-horizontal" role="form">

					<!-- start of status -->
					<div class="form-group">
						<label for="tc-status" class="col-sm-2 col-sm-offset-1 control-label">Status<b class="star"> *</b></label>
						<div class="col-sm-5">	
							<select id="reportOnTodayCreatedOrder" name="tc-status"> 	
							  <option value="" selected>Select your option</option>
							  @if(e(Input::old('tc-status')) == '1')
							  	<option selected value="1">Active</option>
							  @else
							  	<option value="1">Active</option>
							  @endif
							  @if(e(Input::old('tc-status')) == '0')
							  	<option selected value="0">Inactive</option>
							  @else
							  	<option value="0">Inactive</option>
							  @endif
							    @if(e(Input::old('tc-status')) == '-1')
							  	<option selected value="-1">Active & Inactive</option>
							  @else
							  	<option value="-1">Active & Inactive</option>
							  @endif
							</select> 
						</div>

						@if($errors->has('tc-status'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('tc-status')}} </label>
						</div>
						@endif
					</div> <!-- end of status -->

					<div class="form-group form-btn-group">
						<div class="col-sm-offset-3 col-xs-2 col-sm-2 col-md-1  form-btn-space">
							<button class="btn btn-primary" type="submit" name="reportOnTodayCreatedOrder" value="reportOnTodayCreatedOrder" id="btnPrint">
								<span class="glyphicon glyphicon-print"></span><b> Print</b> 
							</button> 
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
	<!-- ##################################################################### -->

	<!-- ###########################################################################
	###################### Report on Today Return Date  ###################################
	############################################################################# -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><i class="fa fa-file-pdf-o"></i> Report on Today&#39;s Return Date </h4>
		</div>
		<div class="panel-body">
			<div class="row panel-body-form">
				
				<form action=" {{ URL::route('order-created-report-post')}} " method="POST" class="form-horizontal" role="form">

					<!-- start of status -->
					<div class="form-group">
						<label for="tr-status" class="col-sm-2 col-sm-offset-1 control-label">Status<b class="star"> *</b></label>
						<div class="col-sm-5">	
							<select id="reportOnTodayReturnDate" name="tr-status"> 	
							  <option value="" selected>Select your option</option>
							  @if(e(Input::old('tr-status')) == '1')
							  	<option selected value="1">Active</option>
							  @else
							  	<option value="1">Active</option>
							  @endif
							  @if(e(Input::old('tr-status')) == '0')
							  	<option selected value="0">Inactive</option>
							  @else
							  	<option value="0">Inactive</option>
							  @endif
							    @if(e(Input::old('tr-status')) == '-1')
							  	<option selected value="-1">Active & Inactive</option>
							  @else
							  	<option value="-1">Active & Inactive</option>
							  @endif
							</select> 
						</div>

						@if($errors->has('tr-status'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('tr-status')}} </label>
						</div>
						@endif
					</div> <!-- end of status -->

					<div class="form-group form-btn-group">
						<div class="col-sm-offset-3 col-xs-2 col-sm-2 col-md-1  form-btn-space">
							<button class="btn btn-primary" type="submit" name="reportOnTodayReturnDate" value="reportOnTodayReturnDate" id="btnPrint">
								<span class="glyphicon glyphicon-print"></span><b> Print</b> 
							</button> 
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
	<!-- ##################################################################### -->

	<!-- ###########################################################################
	###################### Report on Order Created Date  ###################################
	############################################################################# -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><i class="fa fa-file-pdf-o"></i> Report On Order Creation Date </h4>
		</div>
		<div class="panel-body">
			<div class="row panel-body-form">
				
				<form action=" {{ URL::route('order-created-report-post')}} " method="POST" class="form-horizontal" role="form">

					<!-- start of from -->
					<div class="form-group">
						<label for="ocd-from" class="col-sm-2 col-sm-offset-1 control-label">From<b class="star"> *</b></label>
						<div class="col-sm-5">
							<input type="text" {{ e(Input::old('ocd-from')) ? ' value="'. Input::old('ocd-from') .'"' : ' '}} class="form-control" name="ocd-from" placeholder="01-01-2014" data-beatpicker="true" data-beatpicker-format="['DD','MM','YYYY']" data-beatpicker-module="clear">
						</div>
						@if($errors->has('ocd-from'))
						<div class="col-sm-4 form-error-msg">
							<label for="inputEmail3" class="label label-danger"> {{ $errors->first('ocd-from')}} </label>
						</div>
						@endif
					</div>
					<!-- end of from -->

					<!-- start of to -->
					<div class="form-group">
						<label for="ocd-to" class="col-sm-2 col-sm-offset-1 control-label">To<b class="star"> *</b></label>
						<div class="col-sm-5">
							<input type="text" {{ e(Input::old('ocd-to')) ? ' value="'. Input::old('ocd-to') .'"' : ' '}} class="form-control" name="ocd-to" placeholder="01-01-2014" data-beatpicker="true" data-beatpicker-format="['DD','MM','YYYY']" data-beatpicker-module="clear">
						</div>
						@if($errors->has('ocd-to'))
						<div class="col-sm-4 form-error-msg">
							<label for="inputEmail3" class="label label-danger"> {{ $errors->first('ocd-to')}} </label>
						</div>
						@endif
					</div>
					<!-- end of to -->

					<!-- start of status -->
					<div class="form-group">
						<label for="ocd-status" class="col-sm-2 col-sm-offset-1 control-label">Status<b class="star"> *</b></label>
						<div class="col-sm-5">	
							<select id="reportOnOrderCreatedDate" name="ocd-status"> 	
							  <option value="" selected>Select your option</option>
							  @if(e(Input::old('ocd-status')) == '1')
							  	<option selected value="1">Active</option>
							  @else
							  	<option value="1">Active</option>
							  @endif
							  @if(e(Input::old('ocd-status')) == '0')
							  	<option selected value="0">Inactive</option>
							  @else
							  	<option value="0">Inactive</option>
							  @endif
							    @if(e(Input::old('ocd-status')) == '-1')
							  	<option selected value="-1">Active & Inactive</option>
							  @else
							  	<option value="-1">Active & Inactive</option>
							  @endif
							</select> 
						</div>
						@if($errors->has('ocd-status'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('ocd-status')}} </label>
						</div>
						@endif
					</div> <!-- end of status -->

					<div class="form-group form-btn-group">
						<div class="col-sm-offset-3 col-xs-2 col-sm-2 col-md-1  form-btn-space">
							<button class="btn btn-primary" type="submit" name="reportOnOrderCreatedDate" value="reportOnOrderCreatedDate" id="btnPrint">
								<span class="glyphicon glyphicon-print"></span><b> Print</b> 
							</button> 
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
	<!-- ##################################################################### -->

	<!-- ###########################################################################
	###################### Report on DVD Return Date  ###################################
	############################################################################# -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><i class="fa fa-file-pdf-o"></i> Report On Order Return Date </h4>
		</div>
		<div class="panel-body">
			<div class="row panel-body-form">
				
				<form action=" {{ URL::route('order-created-report-post')}} " method="POST" class="form-horizontal" role="form">

					<!-- start of from -->
					<div class="form-group">
						<label for="drd-from" class="col-sm-2 col-sm-offset-1 control-label">From<b class="star"> *</b></label>
						<div class="col-sm-5">
							<input type="text" {{ e(Input::old('drd-from')) ? ' value="'. Input::old('drd-from') .'"' : ' '}} class="form-control" name="drd-from" placeholder="01-01-2014" data-beatpicker="true" data-beatpicker-format="['DD','MM','YYYY']" data-beatpicker-module="clear">
						</div>
						@if($errors->has('drd-from'))
						<div class="col-sm-4 form-error-msg">
							<label for="inputEmail3" class="label label-danger"> {{ $errors->first('drd-from')}} </label>
						</div>
						@endif
					</div>
					<!-- end of from -->

					<!-- start of to -->
					<div class="form-group">
						<label for="drd-to" class="col-sm-2 col-sm-offset-1 control-label">To<b class="star"> *</b></label>
						<div class="col-sm-5">
							<input type="text" {{ e(Input::old('drd-to')) ? ' value="'. Input::old('drd-to') .'"' : ' '}} class="form-control" name="drd-to" placeholder="01-01-2014" data-beatpicker="true" data-beatpicker-format="['DD','MM','YYYY']" data-beatpicker-module="clear">
						</div>
						@if($errors->has('drd-to'))
						<div class="col-sm-4 form-error-msg">
							<label for="inputEmail3" class="label label-danger"> {{ $errors->first('drd-to')}} </label>
						</div>
						@endif
					</div>
					<!-- end of to -->

					<!-- start of status -->
					<div class="form-group">
						<label for="drd-status" class="col-sm-2 col-sm-offset-1 control-label">Status<b class="star"> *</b></label>
						<div class="col-sm-5">	
							<select id="reportOnDvdReturnDate" name="drd-status"> 	
							  <option value="" selected>Select your option</option>
							  @if(e(Input::old('drd-status')) == '1')
							  	<option selected value="1">Active</option>
							  @else
							  	<option value="1">Active</option>
							  @endif
							  @if(e(Input::old('drd-status')) == '0')
							  	<option selected value="0">Inactive</option>
							  @else
							  	<option value="0">Inactive</option>
							  @endif
							    @if(e(Input::old('drd-status')) == '-1')
							  	<option selected value="-1">Active & Inactive</option>
							  @else
							  	<option value="-1">Active & Inactive</option>
							  @endif
							</select> 
						</div>
						@if($errors->has('drd-status'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('drd-status')}} </label>
						</div>
						@endif
					</div> <!-- end of status -->

					<div class="form-group form-btn-group">
						<div class="col-sm-offset-3 col-xs-2 col-sm-2 col-md-1  form-btn-space">
							<button class="btn btn-primary" type="submit" name="reportOnDvdReturnDate" value="reportOnDvdReturnDate" id="btnPrint">
								<span class="glyphicon glyphicon-print"></span><b> Print</b> 
							</button> 
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
	<!-- ##################################################################### -->

	<!-- ###########################################################################
	###################### Report on Order by employee id  ###################################
	############################################################################# -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><i class="fa fa-file-pdf-o"></i> Report On Order Created By Employee</h4>
		</div>
		<div class="panel-body">
			<div class="row panel-body-form">
				
				<form action=" {{ URL::route('order-created-report-post')}} " method="POST" class="form-horizontal" role="form">

					<!-- start of employee id -->
					<div class="form-group">
						<label for="employee_id" class="col-sm-2 col-sm-offset-1 control-label">Employee ID<b class="star"> *</b></label>
						<div class="col-sm-5">	
							<select id="reportOnOrderByEmployeeId" name="employee_id"> 	
							  <option value="" selected>Select your option</option>
							  @foreach(Employee::all() as $employee)
								@if(e(Input::old('employee_id')) == $employee->id)
								  	<option selected value="{{$employee->id}}">EMP-{{$employee->id}}</option>
								  @else
								  	<option value="{{$employee->id}}">EMP-{{$employee->id}}</option>
								  @endif
							  @endforeach
							</select> 
						</div>

						@if($errors->has('employee_id'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('employee_id')}} </label>
						</div>
						@endif
					</div> <!-- end of employee id -->

					<!-- start of from -->
					<div class="form-group">
						<label for="ei-from" class="col-sm-2 col-sm-offset-1 control-label">From<b class="star"> *</b></label>
						<div class="col-sm-5">
							<input type="text" {{ e(Input::old('ei-from')) ? ' value="'. Input::old('ei-from') .'"' : ' '}} class="form-control" name="ei-from" placeholder="01-01-2014" data-beatpicker="true" data-beatpicker-format="['DD','MM','YYYY']" data-beatpicker-module="clear">
						</div>
						@if($errors->has('ei-from'))
						<div class="col-sm-4 form-error-msg">
							<label for="inputEmail3" class="label label-danger"> {{ $errors->first('ei-from')}} </label>
						</div>
						@endif
					</div>
					<!-- end of from -->

					<!-- start of to -->
					<div class="form-group">
						<label for="ei-to" class="col-sm-2 col-sm-offset-1 control-label">To<b class="star"> *</b></label>
						<div class="col-sm-5">
							<input type="text" {{ e(Input::old('ei-to')) ? ' value="'. Input::old('ei-to') .'"' : ' '}} class="form-control" name="ei-to" placeholder="01-01-2014" data-beatpicker="true" data-beatpicker-format="['DD','MM','YYYY']" data-beatpicker-module="clear">
						</div>
						@if($errors->has('ei-to'))
						<div class="col-sm-4 form-error-msg">
							<label for="inputEmail3" class="label label-danger"> {{ $errors->first('ei-to')}} </label>
						</div>
						@endif
					</div>
					<!-- end of to -->

					<!-- start of status -->
					<div class="form-group">
						<label for="ei-status" class="col-sm-2 col-sm-offset-1 control-label">Status<b class="star"> *</b></label>
						<div class="col-sm-5">	
							<select id="ei-status" name="ei-status"> 	
							  <option value="" selected>Select your option</option>
							  @if(e(Input::old('ei-status')) == '1')
							  	<option selected value="1">Active</option>
							  @else
							  	<option value="1">Active</option>
							  @endif
							  @if(e(Input::old('ei-status')) == '0')
							  	<option selected value="0">Inactive</option>
							  @else
							  	<option value="0">Inactive</option>
							  @endif
							    @if(e(Input::old('ei-status')) == '-1')
							  	<option selected value="-1">Active & Inactive</option>
							  @else
							  	<option value="-1">Active & Inactive</option>
							  @endif
							</select> 
						</div>
						@if($errors->has('ei-status'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('ei-status')}} </label>
						</div>
						@endif
					</div> <!-- end of status -->

					<div class="form-group form-btn-group">
						<div class="col-sm-offset-3 col-xs-2 col-sm-2 col-md-1  form-btn-space">
							<button class="btn btn-primary" type="submit" name="reportOnOrderByEmployeeId" value="reportOnOrderByEmployeeId" id="btnPrint">
								<span class="glyphicon glyphicon-print"></span><b> Print</b> 
							</button> 
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
	<!-- ##################################################################### -->

	<!-- ###########################################################################
	###################### Report on Order by member id  ###########################
	############################################################################# -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><i class="fa fa-file-pdf-o"></i> Report On Order Created For Member</h4>
		</div>
		<div class="panel-body">
			<div class="row panel-body-form">
				
				<form action=" {{ URL::route('order-created-report-post')}} " method="POST" class="form-horizontal" role="form">

					<!-- start of member id -->
					<div class="form-group">
						<label for="member_id" class="col-sm-2 col-sm-offset-1 control-label">Member ID<b class="star"> *</b></label>
						<div class="col-sm-5">	
							<select id="member_id" name="member_id"> 	
							  <option value="" selected>Select your option</option>
							  @foreach(Member::all() as $member)
								@if(e(Input::old('member_id')) == $member->id)
								  	<option selected value="{{$member->id}}">MEM-{{$member->id}}</option>
								  @else
								  	<option value="{{$member->id}}">MEM-{{$member->id}}</option>
								  @endif
							  @endforeach
							</select> 
						</div>

						@if($errors->has('member_id'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('member_id')}} </label>
						</div>
						@endif
					</div> <!-- end of member id -->

					<!-- start of from -->
					<div class="form-group">
						<label for="mi-from" class="col-sm-2 col-sm-offset-1 control-label">From<b class="star"> *</b></label>
						<div class="col-sm-5">
							<input type="text" {{ e(Input::old('mi-from')) ? ' value="'. Input::old('mi-from') .'"' : ' '}} class="form-control" name="mi-from" placeholder="01-01-2014" data-beatpicker="true" data-beatpicker-format="['DD','MM','YYYY']" data-beatpicker-module="clear">
						</div>
						@if($errors->has('mi-from'))
						<div class="col-sm-4 form-error-msg">
							<label for="inputEmail3" class="label label-danger"> {{ $errors->first('mi-from')}} </label>
						</div>
						@endif
					</div>
					<!-- end of from -->

					<!-- start of to -->
					<div class="form-group">
						<label for="mi-to" class="col-sm-2 col-sm-offset-1 control-label">To<b class="star"> *</b></label>
						<div class="col-sm-5">
							<input type="text" {{ e(Input::old('mi-to')) ? ' value="'. Input::old('mi-to') .'"' : ' '}} class="form-control" name="mi-to" placeholder="01-01-2014" data-beatpicker="true" data-beatpicker-format="['DD','MM','YYYY']" data-beatpicker-module="clear">
						</div>
						@if($errors->has('mi-to'))
						<div class="col-sm-4 form-error-msg">
							<label for="inputEmail3" class="label label-danger"> {{ $errors->first('mi-to')}} </label>
						</div>
						@endif
					</div>
					<!-- end of to -->

					<!-- start of status -->
					<div class="form-group">
						<label for="mi-status" class="col-sm-2 col-sm-offset-1 control-label">Status<b class="star"> *</b></label>
						<div class="col-sm-5">	
							<select id="mi-status" name="mi-status"> 	
							  <option value="" selected>Select your option</option>
							  @if(e(Input::old('mi-status')) == '1')
							  	<option selected value="1">Active</option>
							  @else
							  	<option value="1">Active</option>
							  @endif
							  @if(e(Input::old('mi-status')) == '0')
							  	<option selected value="0">Inactive</option>
							  @else
							  	<option value="0">Inactive</option>
							  @endif
							    @if(e(Input::old('mi-status')) == '-1')
							  	<option selected value="-1">Active & Inactive</option>
							  @else
							  	<option value="-1">Active & Inactive</option>
							  @endif
							</select> 
						</div>
						@if($errors->has('mi-status'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('mi-status')}} </label>
						</div>
						@endif
					</div> <!-- end of status -->

					<div class="form-group form-btn-group">
						<div class="col-sm-offset-3 col-xs-2 col-sm-2 col-md-1  form-btn-space">
							<button class="btn btn-primary" type="submit" name="reportOnOrderByMemberId" value="reportOnOrderByMemberId" id="btnPrint">
								<span class="glyphicon glyphicon-print"></span><b> Print</b> 
							</button> 
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
	<!-- ##################################################################### -->



@stop


@section('script')
<script type="text/javascript">
	$("#reportOnOrderCreatedDate").select2();	
	$("#reportOnDvdReturnDate").select2();	
	$("#reportOnTodayCreatedOrder").select2();	
	$("#reportOnTodayReturnDate").select2();
	$("#reportOnOrderByEmployeeId").select2();
	$("#ei-status").select2();		
	$("#member_id").select2();	
	$("#mi-status").select2();	
</script>
@stop
		