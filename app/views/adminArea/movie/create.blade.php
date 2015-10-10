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
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><span class="glyphicon glyphicon-play"></span> Movie Create</h4>
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
				
				<form action=" {{ URL::route('movie-create-post')}} " method="POST" class="form-horizontal" role="form">						
					
					<!-- start of name -->
					<div class="form-group">
						<label for="name" class="col-sm-2 col-sm-offset-1 control-label">Movie Name<b class="star"> *</b></label>
						<div class="col-sm-5">
						  <input type="text" {{ e(Input::old('name')) ? ' value="'. Input::old('name') .'"' : ' '}} class="form-control app-textbox" name="name" placeholder="Movie Name">
						</div>

						@if($errors->has('name'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('name')}} </label>
						</div>
						@endif
					</div> <!-- end of name -->

					<!-- start of actor -->
					<div class="form-group">
						<label for="actor" class="col-sm-2 col-sm-offset-1 control-label">Actor<b class="star"> *</b></label>
						<div class="col-sm-5 create">
							<textarea class="form-control app-textbox" name="actor" placeholder="Actor" rows="3">{{ e(Input::old('actor')) ? Input::old('actor')  : ''}}</textarea>
						</div>
						@if($errors->has('actor'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('actor')}} </label>
						</div>
						@endif
					</div> <!-- end of actor -->

					<!-- start of director -->
					<div class="form-group">
						<label for="director" class="col-sm-2 col-sm-offset-1 control-label">Director<b class="star"> *</b></label>
						<div class="col-sm-5">
						  <input type="text" {{ e(Input::old('director')) ? ' value="'. Input::old('director') .'"' : ' '}} class="form-control app-textbox" name="director" placeholder="Director">
						</div>
						@if($errors->has('director'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('director')}} </label>
						</div>
						@endif
					</div> <!-- end of director -->

					<!-- start of category_id -->
					<div class="form-group">
						<label for="category_id" class="col-sm-2 col-sm-offset-1 control-label">Category<b class="star"> *</b></label>
						<div class="col-sm-5">	
							<select id="category_id" name="category_id"> 	
								<option value="" selected>Select your option</option>	
							    @foreach(Category::orderBy('name','asc')->get() as $category)
									<option {{ e(Input::old('category_id') == $category['id']) ? 'selected' : ' '}} value="{{$category['id']}}">{{$category['name']}}</option>
								@endforeach
							</select> 
						</div>
						@if($errors->has('category_id'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('category_id')}} </label>
						</div>
						@endif
					</div> <!-- end of category_id -->
					

					<!-- start of main_language -->
					<div class="form-group">
						<label for="main_language" class="col-sm-2 col-sm-offset-1 control-label">Main Language<b class="star"> *</b></label>
						<div class="col-sm-5">
						  <input type="text" {{ e(Input::old('main_language')) ? ' value="'. Input::old('main_language') .'"' : ' '}} class="form-control app-textbox" name="main_language" placeholder="Main Language">
						</div>
						@if($errors->has('main_language'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('main_language')}} </label>
						</div>
						@endif
					</div> <!-- end of main_language -->

					<!-- start of number_of_discs -->
					<div class="form-group">
						<label for="number_of_discs" class="col-sm-2 col-sm-offset-1 control-label">Number Of Discs<b class="star"> *</b></label>
						<div class="col-sm-5">
							<select id="number_of_discs" name="number_of_discs"> 	
							 <option value="" selected>Select your option</option>
								@for($i=1; $i<21; $i++)
										<option {{ e(Input::old('number_of_discs') == $i) ? 'selected' : ' '}} value="{{$i}}">{{$i}}</option>
								@endfor
							</select>
						</div>
						@if($errors->has('number_of_discs'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('number_of_discs')}} </label>
						</div>
						@endif
					</div> <!-- end of number_of_discs -->

					<!-- start of series -->
					<div class="form-group">
						<label for="series" class="col-sm-2 col-sm-offset-1 control-label">Series</label>
						<div class="col-sm-5">
						  <input type="text" {{ e(Input::old('series')) ? ' value="'. Input::old('series') .'"' : ' '}} class="form-control app-textbox" name="series" placeholder="Series">
						</div>
						@if($errors->has('series'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('series')}} </label>
						</div>
						@endif
					</div> <!-- end of series -->

					<!-- start of run_time -->
					<div class="form-group">
						<label for="run_time" class="col-sm-2 col-sm-offset-1 control-label">Run Time</label>
						<div class="col-sm-5">
						  <input type="text" {{ e(Input::old('run_time')) ? ' value="'. Input::old('run_time') .'"' : ' '}} class="form-control app-textbox" name="run_time" placeholder="Run Time">
						</div>
					</div> <!-- end of run_time -->

					<!-- start of release_year -->
					<div class="form-group">
						<label for="release_year" class="col-sm-2 col-sm-offset-1 control-label">Release Year<b class="star"> *</b></label>
						<div class="col-sm-5">	
							<select id="release_year" name="release_year"> 	
							  <option value="" selected>Select your option</option>							  
							  	@for($year = 1970; $year<2100; $year++)
									<option {{ e(Input::old('release_year') == $year) ? 'selected' : ' '}} value="{{$year}}">{{$year}}</option>
								@endfor

							</select> 
						</div>
						@if($errors->has('release_year'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('release_year')}} </label>
						</div>
						@endif
					</div> <!-- end of release_year -->

					<div class="form-group form-btn-group">
						<div class="col-sm-offset-3 col-xs-2 col-sm-2 col-md-1  form-btn-space">
							<button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>Create</button>
						</div>
						<div class="col-xs-2 col-sm-1">
							<button class="btn btn-danger" type="reset"><i class="fa fa-refresh"></i>Clear</button>
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
	$("#category_id").select2();	
	$("#release_year").select2();
	$("#number_of_discs").select2();		
</script>
@stop
		