@extends('layout.main')

<?php $title='Category'; $active = 'Movie'; ?>

@section('table.css')
		{{ HTML::style('css/dataTables.bootstrap.min.css'); }}
@stop
@section('table.js')
		{{ HTML::script('js/jquery.dataTables.min.js'); }}
		{{ HTML::script('js/dataTables.bootstrap.min.js'); }}
		{{ HTML::script('js/checkedAll.min.js'); }}
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


	<form action="{{ URL::route('category-action-post')}}" method="post">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><i class="fa fa-list"></i> All Category List</h4> 
		</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr>
							<th>
								<input type="checkbox" id="checkedAll"/>
							</th>
							<th>Category&nbsp;Name</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>	
					@foreach ($categories as $category)
							<tr class="capitalize">
								<td><input type="checkbox" name="checked[]" id="checked" value="{{ $category->id }}"/></td>
								<td >{{ $category->name }}</td>	
								<td ></td>	
								<td ></td>	
								<td ></td>	
								<td ></td>	
								<td ></td>	
								<td ></td>
								<td ></td>	
								<td ></td>		
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
				<button class="btn btn-sm btn-primary" type="submit" name="Add" value="Add" >
				<i class="fa fa-plus-square"></i><b>Add</b> </button>

				@if(Session::get('admin') == 'admin')
				<button class="btn btn-sm btn-info" type="submit" name="Edit" value="Edit" disabled id="btnEdit">
				<span class="glyphicon glyphicon-pencil"></span><b> Edit</b> </button>  

	            <button class="btn btn-sm btn-danger" type="button" id="btnDelete" disabled data-toggle="modal" data-target="#myModal">
				<span class="glyphicon glyphicon-trash"></span><b> Delete</b> </button>	
				@endif
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
		</div>
	</div> <!-- End Table --> 
	{{ Form::token()}}
	</form>

@stop