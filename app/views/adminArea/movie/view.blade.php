@extends('layout.main')

<?php $title='Movie'; $active = 'Movie'; ?>

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
	@if(isset($success)) 
				<div class="row">
					<div class="container">
						<div class="col-sm-8 col-sm-offset-2 col-xs-12">
							<div role="alert" class="alert-view alert-success alert-dismissible">
								<button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
								<p><i class="fa fa-info-circle fa-lg"></i> <strong>{{ $success }}</strong></p> 
							</div>
						</div>
					</div> 
				</div>
				@endif

	@if(Session::get('member') != 'member')
		<form action="{{ URL::route('movie-action-post')}}" method="post">
	@else
		<form action="{{ URL::route('member-action-post')}}" method="post">
	@endif

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><i class="fa fa-list"></i> All Movie List</h4> 
		</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr>
							@if(Session::get('member') == 'member')
								<th>
									<center>#</center><input type="hidden" id="checkedAll"/>
								</th>
							@else
								<th>
									<input type="checkbox" id="checkedAll"/>
								</th>
							@endif
							<th>Movie&nbsp;Name</th>
							<th style="width: 50px">Actor</th>
							<th>Director</th>
							<th>Category</th>
							<th>Main&nbsp;Language</th>
							<th>Number&nbsp;Of&nbsp;Discs</th>
							<th>Series</th>
							<th>Run&nbsp;Time</th>
							<th>Release&nbsp;Year</th>
						</tr>
					</thead>
					<tbody>	
					@foreach ($movies as $movie)
							<tr class="capitalize">
								<td><input type="checkbox" name="checked[]" id="checked" value="{{ $movie->id }}"/></td>
								<td>{{ $movie->name }}</td>
								<td>{{ substr($movie->actor, 0, 15) }}</td>
								<td>{{ $movie->director }}</td>
								<td>{{ $movie->category->name }}</td>
								<td>{{ $movie->main_language }}</td>
								<td>{{ $movie->number_of_discs }}</td>
								<td>{{ $movie->series }}</td>
								<td>{{ $movie->run_time }}</td>
								<td>{{ $movie->release_year }}</td>
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

					@if(Session::get('member') != 'member')
					<button class="btn btn-sm btn-warning" type="submit" name="Print" value="Print" id="btnPrint">
					<span class="glyphicon glyphicon-print"></span><b> Print</b> </button>  
					@endif
				</div>
			</div>
		</div>
			@if(Session::get('admin') == 'admin')
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
			@endif
	</div> <!-- End Table --> 
	{{ Form::token()}}
	</form>


@stop