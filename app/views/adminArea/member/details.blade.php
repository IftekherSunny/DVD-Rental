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

	@if(isset($success)) 
	<div class="row">
		<div class="container">
			<div class="col-sm-8 col-sm-offset-2 col-xs-12">
				<div role="alert" class="alert-view alert-danger alert-dismissible">
					<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<p><i class="fa fa-info-circle fa-lg"></i> <strong>{{ $success }}</strong></p> 
				</div>
			</div>
		</div> 
	</div>
	@endif

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><i class="fa fa-user"></i> Member Details</h4>
		</div>
		<div class="panel-body">
			<div class="row panel-body-form">
				
				<form action=" {{ URL::route('member-details-post')}} " method="POST" class="form-horizontal" role="form">						
					<!-- Holding id -->
					<input type="hidden" value="{{ $member->id }}" name="id">

					<!-- start of id -->
					<div class="form-group">
						<label for="member_id" class="col-sm-2 col-sm-offset-1 control-label">#ID</label>
						<div class="col-sm-5">
						  <input type="text" value="MEM-{{ $member->id }}"  readonly class="form-control app-textbox" name="member_id">
						</div>
					</div> <!-- end of id -->

					<!-- start of first name -->
					<div class="form-group">
						<label for="First_Name" class="col-sm-2 col-sm-offset-1 control-label">First Name</label>
						<div class="col-sm-5">
						  <input type="text" value="{{ $member->first_name }}"  readonly class="form-control app-textbox" name="first_name">
						</div>
					</div> <!-- end of first name -->

					<!-- start of last name -->
					<div class="form-group">
						<label for="last_name" class="col-sm-2 col-sm-offset-1 control-label">Last Name</label>
						<div class="col-sm-5">
						  <input type="text" value="{{$member->last_name}}" readonly class="form-control app-textbox" name="last_name">
						</div>
					</div> <!-- end of last name -->

					<!-- start of age -->
					<div class="form-group">
						<label for="age" class="col-sm-2 col-sm-offset-1 control-label">Age</label>
						<div class="col-sm-5">
						  <input type="text" value="{{$member->age}}" readonly class="form-control app-textbox" name="age">
						</div>
					</div> <!-- end of age -->

					<!-- start of gender -->
					<div class="form-group">
						<label for="gender" class="col-sm-2 col-sm-offset-1 control-label">Gender</label>
						<div class="col-sm-5">	
							<select id="gender" disabled name="gender">
							  @if($member->gender=='Male')
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
							<input type="text" value="{{$member->DOB}}" readonly class="form-control" name="DOB">
						</div>
					</div>
					<!-- end of DOB -->

					<!-- start of Present Address -->
					<div class="form-group">
						<label for="present_address" class="col-sm-2 col-sm-offset-1 control-label">Present Address</label>
						<div class="col-sm-5">
							<textarea class="form-control app-textbox" readonly rows="5">{{$member->present_address}}</textarea>						  
						</div>
					</div> <!-- end of Present Address -->

					<!-- start of permanent Address -->
					<div class="form-group">
						<label for="permanent_address" class="col-sm-2 col-sm-offset-1 control-label">Permanent Address</label>
						<div class="col-sm-5">
						  <textarea class="form-control app-textbox" readonly rows="5">{{$member->permanent_address}}</textarea>	
						</div>
					</div> <!-- end of Permanent Address -->

					<!-- start of city -->
					<div class="form-group">
						<label for="city" class="col-sm-2 col-sm-offset-1 control-label">City</label>
						<div class="col-sm-5">
						  <input type="text" value="{{$member->city}}" readonly  class="form-control app-textbox" name="city">
						</div>
					</div> <!-- end of city -->

					<!-- start of state -->
					<div class="form-group">
						<label for="state" class="col-sm-2 col-sm-offset-1 control-label">state</label>
						<div class="col-sm-5">
						  <input type="text" value="{{$member->state}}" readonly  class="form-control app-textbox" name="state">
						</div>
					</div> <!-- end of state -->


					<!-- start of country -->
					<div class="form-group">
						<label for="country" class="col-sm-2 col-sm-offset-1 control-label">Country</label>
						<div class="col-sm-5">	
							<select id="country" disabled name="country"> 									
								 <option value="{{ $member->country }}">{{ $member->country }}</option>
							</select> 
						</div>
					</div> <!-- end of country -->

					<!-- start of mobile no -->
					<div class="form-group">
						<label for="mobile_no" class="col-sm-2 col-sm-offset-1 control-label">Mobile No</label>
						<div class="col-sm-5">
						  <input type="text" value="{{$member->mobile_no}}" readonly  class="form-control app-textbox" name="mobile_no" size="30">
						</div>
					</div> <!-- end of moblie no -->

					<!-- start of email -->
					<div class="form-group">
						<label for="email" class="col-sm-2 col-sm-offset-1 control-label">Email</label>
						<div class="col-sm-5">
						  <input type="text" value="{{$member->email}}" readonly  class="form-control app-textbox" name="eamil">
						</div>
					</div> <!-- end of email -->

					<!-- start of username -->
					<div class="form-group">
						<label for="username" class="col-sm-2 col-sm-offset-1 control-label">Username</label>
						<div class="col-sm-5">
						  <input type="text" value="{{$member->user()->username}}" readonly  class="form-control app-textbox" name="username">
						</div>
					</div> <!-- end of username -->

					@if(Session::get('admin') == 'admin')
					<div class="form-group form-btn-group">
						<div class="col-sm-offset-3 col-xs-2 col-sm-2 col-md-1  form-btn-space">
							<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
						</div>
					</div>
					@endif

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


<!-- Active order by this member -->
<?php  use SunHelperClass\DateFormat?>

@section('table.css')
		{{ HTML::style('css/dataTables.bootstrap.min.css'); }}
@stop
@section('table.js')
		{{ HTML::script('js/jquery.dataTables.min.js'); }}
		{{ HTML::script('js/dataTables.bootstrap.min.js'); }}
		{{ HTML::script('js/checkedAll.min.js'); }}
@stop


	<form action="{{ URL::route('member-order-deactive-post')}}" method="post">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="username"><i class="fa fa-list"></i> {{ $member->user()->username }}'s Active Order</h4> 
			<input type="hidden" name="member_id" value="{{$member->id}}" />
		</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr>
							<th>
								<input type="checkbox" id="checkedAll"/>
							</th>
							<th>#ID</th>
							<th>Member&nbsp;ID</th>
							<th>Movie Name</th>
							<th>From</th>
							<th>To</th>
							<th>Employee&nbsp;ID</th>
							<th>Employee&nbsp;Name</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>	
					@foreach ($orders as $order)
							<?php $statusActive = $order->status ?>
							@if($statusActive && ($order->member_id == $member->id))
							<tr class="capitalize">
								<td><input type="checkbox" name="checked[]" id="checked" value="{{ $order->id }}"/></td>
								<td>ORD-{{ $order->id }}</td>
								<td>MEM-{{ $order->member_id }}</td>
								<td>{{ $order->movie->name }}</td>
								<td>{{ DateFormat::show($order->from) }}</td>
								<td>{{ DateFormat::show($order->to) }}</td>
								<td>EMP-{{ $order->employee_id }}</td>
								<td>{{ $order->employee->first_name }} {{ $order->employee->last_name }}</td>
								<td>
									<label class="label label-success">							
										<strong class="status-level"> Active </strong>
									</label>	
								</td>
							</tr>	
							@endif									
					@endforeach										
					</tbody>
				</table>			   
			</div>
		<!-- /.panel-body -->
		<div class="panel-footer-info" >
			<div class="row" style="padding-left: 15px; padding-right: 15px">
				<div class="pull-left">
					<button onClick="javascript:window.history.back();" class="btn btn-default"><i class="fa fa-arrow-left"></i>Back</button>		
				</div>
				<div class="pull-right">					

		           <button class="btn btn-danger" type="button" id="btnDelete" disabled data-toggle="modal" data-target="#myModal">
						<b>Deactive</b>
					</button>	
				</div>
			</div>
		</div>
			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header delete-modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Confirm Deactive</h4>
				  </div>
				  <div class="modal-body">
					Are you sure want to deactive record?
				  </div>
				  <div class="modal-footer">
					<button type="submit" name="Delete" value="Delete" class="btn btn-default">Yes</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				  </div>
				</div>
			  </div>
			</div>
	</div> <!-- End Table --> 
	{{ Form::token()}}
	</form>





	<!-- ####################################### -->
@stop


@section('script')
<script type="text/javascript">
	$("#gender").select2();	
	$("#country").select2();	
</script>
@stop
		