@extends('layout.main')

<?php $title='Dashboard'; $active = 'Dashboard'; use SunHelperClass\DateFormat; ?>

@section('table.css')
		{{ HTML::style('css/dataTables.bootstrap.min.css'); }}
@stop
@section('table.js')
		{{ HTML::script('js/jquery.dataTables.min.js'); }}
		{{ HTML::script('js/dataTables.bootstrap.min.js'); }}
		{{ HTML::script('js/member-dashboard.js'); }}
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
		
		<div class="row" style="margin-top: 50px">
			<div class="col-md-12">
				<form action="{{ URL::route('member-action-post')}}" method="post">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4><i class="fa fa-th-large"></i> New Movies</h4>
					</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<table class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr>
										<th>
											<center>#</center><input type="hidden" id="checkedAll"/>
										</th>
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
								@foreach ($newMovies as $movie)
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
								<button class="btn btn-sm btn-primary" type="submit" name="Details" value="Details" disabled id="btnDetails">
								<span class="glyphicon glyphicon-th"></span><b> Details</b> </button>
							</div>
						</div>
					</div>
				</div> <!-- End Table --> 
				{{ Form::token()}}
				</form>	
			</div> <!-- End Of New Movies -->

			<div class="col-md-12" style="margin-top: 50px">
				<form action="{{ URL::route('member-action-post')}}" method="post">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4><i class="fa fa-th-large"></i> Watched Movies</h4>
					</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<table class="table table-striped table-bordered table-hover" id="watchedMovie">
								<thead>
									<tr>
										<th>
											<center>#</center><input type="hidden" id="checkedAll1"/>
										</th>
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
								@foreach ($watchedMovies as $movie)
									<tr class="capitalize">
										<td><input type="checkbox" name="checked1[]" id="checked1" value="{{ $movie->id }}"/></td>
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
								<button class="btn btn-sm btn-primary" type="submit" name="Details" value="Details" disabled id="btnDetails1">
								<span class="glyphicon glyphicon-th"></span><b> Details</b> </button>
							</div>
						</div>
					</div>
				</div> <!-- End Table --> 
				{{ Form::token()}}
				</form>	
			</div> <!-- End Of Watched Movies -->
			


		</div>

@stop
