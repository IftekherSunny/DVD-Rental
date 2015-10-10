@extends('layout.main')

<?php $title='Category'; $active = 'Movie'; ?>

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
			<h4><span class="glyphicon glyphicon-play"></span> Category Create</h4>
		</div>
		<div class="panel-body">
			<div class="row panel-body-form">

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
				
				<form action=" {{ URL::route('category-create-post')}} " method="POST" class="form-horizontal" role="form">	

					<!-- start of category -->
					<div class="form-group">
						<label for="category" class="col-sm-2 col-sm-offset-1 control-label">Category<b class="star"> *</b></label>
						<div class="col-sm-5">
						  <input type="text" {{ e(Input::old('name')) ? ' value="'. Input::old('name') .'"' : ' '}} class="form-control app-textbox" name="name" placeholder="Category name">
						</div>

						@if($errors->has('name'))
						<div class="col-sm-4 form-error-msg">
							<label class="label label-danger"> {{ $errors->first('name')}} </label>
						</div>
						@endif
					</div> 
					<!-- end of category -->

					
					<div class="form-group form-btn-group">
						<div class="col-sm-offset-3 col-xs-2 col-sm-2 col-md-1  form-btn-space">
							<button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>Create</button>
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
	$("#category").select2();		
</script>
@stop
		