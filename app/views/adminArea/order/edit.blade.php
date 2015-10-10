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
			<h4><i class="fa fa-tag"></i> Order Edit</h4>
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
				
				<form action=" {{ URL::route('order-edit-post')}} " method="POST" class="form-horizontal" role="form">						
					<!-- Holding id -->
					<input type="hidden" value="{{ $order->id }}" name="id">

					
					<!-- start of movie id -->
					<div class="form-group">
						<label for="movie_id" class="col-sm-2 col-sm-offset-1 control-label">Movie Name<b class="star"> *</b></label>

						<div class="col-sm-5">	
							<select id="movie_id" name="movie_id"> 	
							 <option value="" selected>Select your option</option>
								@foreach(Movie::all() as $movie)
									@if(e(Input::old('movie_id')))
										<option {{ e(Input::old('movie_id') == $movie->id) ? 'selected' : ' '}} value="{{$movie->id}}">{{ $movie->name}}</option>				
									@else										
										<option {{ ($order->movie_id == $movie->id) ? 'selected' : ''}} value="{{$movie->id}}">{{ $movie->name}}</option>	
									@endif										
								@endforeach
							</select> 
						</div>

						@if($errors->has('movie_id'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('movie_id')}} </label>
						</div>
						@endif
					</div> <!-- end of movie id -->

					<!-- start of date from -->
					<div class="form-group">
						<label for="from" class="col-sm-2 col-sm-offset-1 control-label">From<b class="star"> *</b></label>
						<div class="col-sm-5">
							<input type="text" {{ e(Input::old('from')) ? ' value="'. Input::old('from') .'"' : '  value="'. $order->from .'" '}} class="form-control" name="from" placeholder="01-01-2014" data-beatpicker="true" data-beatpicker-format="['DD','MM','YYYY']" data-beatpicker-module="clear">
						</div>
						@if($errors->has('from'))
						<div class="col-sm-4 form-error-msg">
							<label for="inputEmail3" class="label label-danger"> {{ $errors->first('from')}} </label>
						</div>
						@endif
					</div>
					<!-- end of date from -->

					<!-- start of date to -->
					<div class="form-group">
						<label for="to" class="col-sm-2 col-sm-offset-1 control-label">To<b class="star"> *</b></label>
						<div class="col-sm-5">
							<input type="text" {{ e(Input::old('to')) ? ' value="'. Input::old('to') .'"' : '  value="'. $order->to .'" '}} class="form-control" name="to" placeholder="01-01-2014" data-beatpicker="true" data-beatpicker-format="['DD','MM','YYYY']" data-beatpicker-module="clear">
						</div>
						@if($errors->has('to'))
						<div class="col-sm-4 form-error-msg">
							<label for="inputEmail3" class="label label-danger"> {{ $errors->first('to')}} </label>
						</div>
						@endif
					</div>
					<!-- end of date to -->
					

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
	$("#member_id").select2();	
	$("#movie_id").select2();	
</script>
@stop
		