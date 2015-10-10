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

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><i class="fa fa-user"></i> Order Details</h4>
		</div>
		<div class="panel-body">
			<div class="row panel-body-form">
				
				<form action=" {{ URL::route('order-details-post')}} " method="POST" class="form-horizontal" role="form">						
					<!-- Holding id -->
					<input type="hidden" value="{{ $order->id }}" name="id">

					<!-- start of order id -->
					<div class="form-group">
						<label for="order_id" class="col-sm-2 col-sm-offset-1 control-label">#ID</label>

						<div class="col-sm-5">
							<input type="text" readonly class="form-control app-textbox" value="ORD-{{ $order->id }}" >
						</div>
					</div> <!-- end of order id -->

					<!-- start of member id -->
					<div class="form-group">
						<label for="member_id" class="col-sm-2 col-sm-offset-1 control-label">Member ID</label>

						<div class="col-sm-5">	
							<select disabled id="member_id" name="member_id"> 	
								<option selected value="{{ $order->member_id}}">MEM-{{ $order->member_id }}</option>	
							</select> 
						</div>
					</div> <!-- end of member id -->

					<!-- start of member name -->
					<div class="form-group">
						<label for="member_name" class="col-sm-2 col-sm-offset-1 control-label">Name</label>

						<div class="col-sm-5">	
							<input type="text" readonly class="form-control app-textbox" value="{{ $order->member->first_name}} {{ $order->member->last_name }}" >
						</div>
					</div> <!-- end of member name -->

					<!-- start of member mobile no -->
					<div class="form-group">
						<label for="member_mobile_no" class="col-sm-2 col-sm-offset-1 control-label">Mobile No</label>

						<div class="col-sm-5">	
							<input type="text" readonly class="form-control app-textbox" value="{{ $order->member->mobile_no}}" >
						</div>
					</div> <!-- end of member mobile no -->

					<!-- start of member present address -->
					<div class="form-group">
						<label for="member_address" class="col-sm-2 col-sm-offset-1 control-label">Present Address</label>

						<div class="col-sm-5">	
							<textarea class="form-control app-textbox" readonly rows="5">{{ $order->member->present_address}}</textarea>
						</div>
					</div> <!-- end of member present address -->

					<!-- start of movie id -->
					<div class="form-group">
						<label for="movie_id" class="col-sm-2 col-sm-offset-1 control-label">Movie Name</label>

						<div class="col-sm-5">	
							<select id="movie_id" name="movie_id" disabled> 	
								<option selected value="{{$order->movie_id}}">{{ $order->movie->name }}</option>
							</select> 
						</div>
					</div> <!-- end of movie id -->

					<!-- start of number of discs -->
					<div class="form-group">
						<label for="number_of_discs" class="col-sm-2 col-sm-offset-1 control-label">Number Of Discs</label>

						<div class="col-sm-5">	
							<input type="text" readonly class="form-control app-textbox" value="{{ $order->movie->number_of_discs}}" >
						</div>
					</div> <!-- end of number of discs -->

					<!-- start of date from -->
					<div class="form-group">
						<label for="from" class="col-sm-2 col-sm-offset-1 control-label">From</label>
						<div class="col-sm-5">
							<input type="text" value={{ $order->from }} readonly class="form-control" name="from" placeholder="01-01-2014" data-beatpicker="true" data-beatpicker-format="['DD','MM','YYYY']" data-beatpicker-module="clear">
						</div>
					</div>
					<!-- end of date from -->

					<!-- start of date to -->
					<div class="form-group">
						<label for="to" class="col-sm-2 col-sm-offset-1 control-label">To</label>
						<div class="col-sm-5">
							<input type="text" value="{{ $order->to}}" readonly class="form-control" name="to" placeholder="01-01-2014" data-beatpicker="true" data-beatpicker-format="['DD','MM','YYYY']" data-beatpicker-module="clear">
						</div>
					</div>
					<!-- end of date to -->
						
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


@stop


@section('script')
<script type="text/javascript">
	$("#member_id").select2();	
	$("#movie_id").select2();	
</script>
@stop
		