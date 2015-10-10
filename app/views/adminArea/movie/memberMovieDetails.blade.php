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
				<div class="form-horizontal">
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
							<textarea class="form-control app-textbox" readonly rows="4">{{$movie->actor}}</textarea>						  
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
				</div>
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
	$("#category_id").select2();	
	$("#release_year").select2();	
</script>
@stop
		