@extends('layout.main')

<?php $title='Movie'; $active = 'Movie'; ?>

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
			<h4><span class="glyphicon glyphicon-play"></span> Movie Details</h4>
		</div>
		<div class="panel-body">
			<div class="row panel-body-form">
				
				<form action=" {{ URL::route('movie-details-post')}} " method="POST" class="form-horizontal" role="form">						
					<!-- Holding id -->
					<input type="hidden" value="{{ $movie->id }}" name="id">
					<!-- start of movie name -->
					<div class="form-group">
						<label for="name" class="col-sm-2 col-sm-offset-1 control-label">Movie Name</label>
						<div class="col-sm-5">
						  <input type="text" value="{{ $movie->name }}" readonly class="form-control app-textbox" name="name">
						</div>
					</div> <!-- end of movie name -->

					<!-- start of actor -->
					<div class="form-group">
						<label for="actor" class="col-sm-2 col-sm-offset-1 control-label">Actor</label>
						<div class="col-sm-5">
							<textarea class="form-control app-textbox" readonly rows="3">{{ $movie->actor }}</textarea>	
						</div>
					</div> <!-- end of actor -->

					<!-- start of director -->
					<div class="form-group">
						<label for="director" class="col-sm-2 col-sm-offset-1 control-label">Director</label>
						<div class="col-sm-5">
						  <input type="text"  value="{{ $movie->director }}" readonly class="form-control app-textbox" name="director">
						</div>
					</div> <!-- end of director -->


					
					<!-- start of category_id -->
					<div class="form-group">
						<label for="category_id" class="col-sm-2 col-sm-offset-1 control-label">Category</label>
						<div class="col-sm-5">	
							<select disabled id="category_id" name="category_id"> 	
								<option value="{{ $movie->category->name }}" selected >{{ $movie->category->name }}</option>	
							</select> 
						</div>
					</div> <!-- end of category_id -->

					<!-- start of main language -->
					<div class="form-group">
						<label for="main_language" class="col-sm-2 col-sm-offset-1 control-label">Main Language</label>
						<div class="col-sm-5">
						  <input type="text" value="{{ $movie->main_language }}" readonly  class="form-control app-textbox" name="main_language">
						</div>
					</div> <!-- end of main language -->

					<!-- start of Number of discs -->
					<div class="form-group">
						<label for="number_of_discs" class="col-sm-2 col-sm-offset-1 control-label">Number Of Discs</label>
						<div class="col-sm-5">
						  <input type="text" value="{{ $movie->number_of_discs }}" readonly  class="form-control app-textbox" name="number_of_discs">
						</div>
					</div> <!-- end of Number of discs -->

					<!-- start of series -->
					<div class="form-group">
						<label for="series" class="col-sm-2 col-sm-offset-1 control-label">Series</label>
						<div class="col-sm-5">
						  <input type="text" value="{{ $movie->series }}" readonly class="form-control app-textbox" name="series">
						</div>
					</div> <!-- end of series -->

					<!-- start of run_time -->
					<div class="form-group">
						<label for="run_time" class="col-sm-2 col-sm-offset-1 control-label">Run Time</label>
						<div class="col-sm-5">
						  <input type="text" value="{{ $movie->run_time }}" readonly  class="form-control app-textbox" name="run_time">
						</div>
					</div> <!-- end of run_time -->

					<!-- start of release_year -->
					<div class="form-group">
						<label for="release_year" class="col-sm-2 col-sm-offset-1 control-label">Release Year</label>
						<div class="col-sm-5">	
							<select disabled id="release_year" name="release_year"> 
								<option value="{{ $movie->release_year }}" >{{ $movie->release_year }}</option>	
							</select> 
						</div>
					</div> <!-- end of release_year -->

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


<!-- Active order by this movie -->
<?php  use SunHelperClass\DateFormat?>

@section('table.css')
		{{ HTML::style('css/dataTables.bootstrap.min.css'); }}
@stop
@section('table.js')
		{{ HTML::script('js/jquery.dataTables.min.js'); }}
		{{ HTML::script('js/dataTables.bootstrap.min.js'); }}
		{{ HTML::script('js/checkedAll.min.js'); }}
@stop


	<form action="{{ URL::route('movie-order-deactive-post')}}" method="post">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><i class="fa fa-list"></i> {{ $movie->name }}'s Active Order</h4> 
			<input type="hidden" name="movie_id" value="{{$movie->id}}" />
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
							@if($statusActive && ($order->movie_id == $movie->id))
							<tr class="capitalize">
								<td><input type="checkbox" name="checked[]" id="checked" value="{{ $order->id }}"/></td>
								<td>ORD-{{ $order->id }}</td>
								<td>MEM-{{ $order->member_id }}</td>
								<td>{{ $order->member->first_name }} {{ $order->member->last_name }}</td>
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
	$("#category_id").select2();	
	$("#release_year").select2();	
</script>
@stop
		