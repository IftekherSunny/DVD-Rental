@extends('layout.main')

<?php $title='Dashboard'; $active = 'Dashboard'; use SunHelperClass\DateFormat; ?>

@section('table.css')
		{{ HTML::style('css/dataTables.bootstrap.min.css'); }}
@stop
@section('table.js')
		{{ HTML::script('js/jquery.dataTables.min.js'); }}
		{{ HTML::script('js/dataTables.bootstrap.min.js'); }}
	@if(Session::get('admin') == 'admin')
		{{ HTML::script('js/checkedAll.min.js'); }}
	@elseif(Session::get('employee') == 'employee')
		{{ HTML::script('js/employee-checkedAll.min.js'); }}
	@endif		
@stop

@section('content')
	<div class="page-header">
		<div class="page-header-icon">
			<i class="fa fa-tachometer"></i>				
		</div>
		<div class="page-header-title">Dashboard</div>
	</div>
		
	@if(Session::pull('wc_msg'))
	<div role="alert" class="alert alert-success fade in dashboard-welcome">
		<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
		<p><i class="fa fa-info-circle fa-lg"></i> Welcome Back, <b>{{ ucfirst(Session::get('username')) }}</b></p>			  
	</div>
	@endif 

	@if(isset($success))
	<div role="alert" class="alert alert-success fade in dashboard-welcome">
		<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
		<p><i class="fa fa-check fa-lg"></i> <b>{{ $success }}</b></p>			  
	</div>
	@endif
					

	<div class="row quick_dashboard">
		<div class="col-lg-6 col-sm-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<strong>Quick Create</strong> 
				</div>
				<div class="panel-body">
					<a href="{{URL::route('member-create-get')}}" class="btn btn-primary sm-margin"><i class="fa fa-users fa-lg"></i> <b>Create Member</b></a>						  
					<span style="padding-left: 5px"></span>
					<a href="{{URL::route('order-create-get')}}" class="btn btn-primary"><i class="fa fa-tags fa-lg"></i> <b>Create Order</b></a>
				</div>
			</div>			
		</div>
		<div class="col-lg-6 col-sm-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<strong>Quick Today&#39;s Report</strong> 
				</div>
				<div class="panel-body">
					<a href="{{ URL::route('admin-quick-create-report') }}" class="btn btn-primary sm-margin"><i class="fa fa-file-pdf-o fa-lg"></i> <b>Create Report</b></a>
					<span style="padding-left: 5px"></span>
					<a href="{{ URL::route('admin-quick-return-report') }}" class="btn btn-primary"><i class="fa fa-file-pdf-o fa-lg"></i> <b>Return Report</b></a>
				</div>
			</div>			
		</div>
	</div>
		
		<h2 class="dashboard-sub-header"><i class="fa fa-th-large"></i> Today&#39;s Order Overview</h2>
		
		<div class="row">
			<div class="col-md-12">
				<form action="{{ URL::route('order-action-post')}}" method="post">
					<input type="hidden" name="TO-form" value="TO-form">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<strong><i class="fa fa-list"></i> Created Order</strong> 
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
										<th>Member&nbsp;Name</th>
										<th>Movie Name</th>
										<th>From</th>
										<th>To</th>
										<th>Employee&nbsp;ID</th>
										<th>Employee&nbsp;Name</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>	
								@foreach ($createdOrders as $order)
										<?php $statusActive = $order->status ?>
										<tr class="capitalize">
											<td><input type="checkbox" name="checked[]" id="checked" value="{{ $order->id }}"/></td>
											<td>ORD-{{ $order->id }}</td>
											<td>MEM-{{ $order->member_id }}</td>
											<td>{{ $order->member->first_name }} {{ $order->member->last_name }}</td>
											<td>{{ $order->movie->name }}</td>
											<td>{{ DateFormat::show($order->from) }}</td>
											<td>{{ DateFormat::show($order->to) }}</td>
											<td>EMP-{{ $order->employee_id }}</td>
											<td>{{ $order->employee->first_name }} {{ $order->employee->last_name }}</td>
											<td>
												@if($statusActive)
													<label class="label label-success">							
															<strong class="status-level"> Active </strong>
													</label>
												@else 
													<label class="label label-danger">							
														<strong class="status-level"> Inactive </strong>
													</label>
														
												@endif
												
											</td>
										</tr>									
								@endforeach										
								</tbody>
							</table>			   
						</div>
					<!-- /.panel-body -->
					<div class="panel-footer-info" >
						<div class="row" style="padding-left: 15px; padding-right: 15px">
							<div class="pull-left">
								<button onClick="javascript:window.history.back();" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i>Back</button>		
							</div>
							<div class="pull-right">
								@if(Session::get('admin') == 'admin')
								<button class="btn btn-sm btn-info" type="submit" name="Edit" value="Edit" disabled id="btnEdit">
								<span class="glyphicon glyphicon-pencil"></span><b> Edit</b> </button> 
								@endif

								<button class="btn btn-sm btn-primary" type="submit" name="Details" value="Details" disabled id="btnDetails">
								<span class="glyphicon glyphicon-th"></span><b> Details</b> </button>

								@if(Session::get('admin') == 'admin')
					            <button class="btn btn-sm btn-danger" type="button" id="btnDelete" disabled data-toggle="modal" data-target="#myModal">
								<span class="glyphicon glyphicon-trash"></span><b> Delete</b> </button>
								@endif

								<a href="{{ URL::route('admin-quick-create-report') }}" class="btn btn-sm btn-warning" type="submit"  id="btnPrint">
								<span class="glyphicon glyphicon-print"></span><b> Print</b> </a>  	
							</div>
						</div>
					</div>
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header delete-modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
							  </div>
							  <div class="modal-body">
								Are you sure want to delete record?
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
			</div> <!-- Todays created order -->

			<div class="col-md-12" style="margin-top: 30px">
				<form action="{{ URL::route('order-action-post')}}" method="post">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<strong><i class="fa fa-list"></i> Order Return Date</strong> 
					</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<table class="table table-striped table-bordered table-hover" id="returnDate">
								<thead>
									<tr>
										<th>
											<input type="checkbox" id="checkedAll1"/>
										</th>
										<th>#ID</th>
										<th>Member&nbsp;ID</th>
										<th>Member&nbsp;Name</th>
										<th>Movie Name</th>
										<th>From</th>
										<th>To</th>
										<th>Employee&nbsp;ID</th>
										<th>Employee&nbsp;Name</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>	
								@foreach ($returnDate as $order)
										<?php $statusActive = $order->status ?>
										<tr class="capitalize">
											<td><input type="checkbox" name="checked1[]" id="checked1" value="{{ $order->id }}"/></td>
											<td>ORD-{{ $order->id }}</td>
											<td>MEM-{{ $order->member_id }}</td>
											<td>{{ $order->member->first_name }} {{ $order->member->last_name }}</td>
											<td>{{ $order->movie->name }}</td>
											<td>{{ DateFormat::show($order->from) }}</td>
											<td>{{ DateFormat::show($order->to) }}</td>
											<td>EMP-{{ $order->employee_id }}</td>
											<td>{{ $order->employee->first_name }} {{ $order->employee->last_name }}</td>
											<td>
												@if($statusActive)
													<label class="label label-success">							
															<strong class="status-level"> Active </strong>
													</label>
												@else 
													<label class="label label-danger">							
														<strong class="status-level"> Inactive </strong>
													</label>
														
												@endif
												
											</td>
										</tr>									
								@endforeach										
								</tbody>
							</table>			   
						</div>
					<!-- /.panel-body -->
					<div class="panel-footer-info" >
						<div class="row" style="padding-left: 15px; padding-right: 15px">
							<div class="pull-left">
								<button onClick="javascript:window.history.back();" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i>Back</button>		
							</div>
							<div class="pull-right">
								@if(Session::get('admin') == 'admin')
								<button class="btn btn-sm btn-info" type="submit" name="Edit" value="Edit" disabled id="btnEdit1">
								<span class="glyphicon glyphicon-pencil"></span><b> Edit</b> </button> 
								@endif

								<button class="btn btn-sm btn-primary" type="submit" name="Details" value="Details" disabled id="btnDetails1">
								<span class="glyphicon glyphicon-th"></span><b> Details</b> </button>

								@if(Session::get('admin') == 'admin')
					            <button class="btn btn-sm btn-danger" type="button" id="btnDelete1" disabled data-toggle="modal" data-target="#myModal1">
								<span class="glyphicon glyphicon-trash"></span><b> Delete</b> </button>
								@endif

								<a href="{{ URL::route('admin-quick-return-report') }}" class="btn btn-sm btn-warning" type="submit"  id="btnPrint1">
								<span class="glyphicon glyphicon-print"></span><b> Print</b> </a>  	
							</div>
						</div>
					</div>
						<!-- Modal -->
						<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header delete-modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
							  </div>
							  <div class="modal-body">
								Are you sure want to delete record?
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
			</div>
			<div class="col-md-12">
					
			</div>
		</div>
	




@stop
@section('script')
	@if(Session::get('admin') == 'admin')
		{{ HTML::script('js/admin-dashboard.js'); }}
	@elseif(Session::get('employee') == 'employee')
		{{ HTML::script('js/employee-dashboard.js'); }}
	@endif
@stop

