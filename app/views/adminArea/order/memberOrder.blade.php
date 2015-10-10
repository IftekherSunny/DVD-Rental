@extends('layout.main')

<?php $title='My Order'; $active = 'Order'; use SunHelperClass\DateFormat;?>

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
	@else
		{{ HTML::script('js/member-dashboard.js'); }}
	@endif
@stop

@section('content')


	<form action="{{ URL::route('member-action-post')}}" method="post">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><i class="fa fa-list"></i> My Order</h4> 
		</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr>
							<th>
								<center>#</center><input type="hidden" id="checkedAll"/>
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
					@foreach ($orders as $order)
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

					<button class="btn btn-sm btn-warning" type="submit" name="Print" value="Print"  id="btnPrint">
					<span class="glyphicon glyphicon-print"></span><b> Print</b> </button>  	
				</div>
			</div>
		</div>
	</div> <!-- End Table --> 
	{{ Form::token()}}
	</form>


@stop