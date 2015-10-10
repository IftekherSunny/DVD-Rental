@extends('layout.main')
 

@section('form.css')
		{{ HTML::style('css/BeatPicker.min.css'); }}
		{{ HTML::style('css/select2.min.css'); }}
@stop
@section('form.js')
		{{ HTML::script('js/jquery.dataTables.min.js'); }}
		{{ HTML::script('js/BeatPicker.min.js'); }}
		{{ HTML::script('js/select2.min.js'); }}
@stop



@section('table.css')
		{{ HTML::style('css/dataTables.bootstrap.min.css'); }}
@stop
@section('table.js')
		{{ HTML::script('js/jquery.dataTables.min.js'); }}
		{{ HTML::script('js/dataTables.bootstrap.min.js'); }}
		{{ HTML::script('js/checkedAll.min.js'); }}
@stop





@section('other.css')
		{{ HTML::style('css/BeatPicker.min.css'); }}
		{{ HTML::style('css/select2.min.css'); }}
		{{ HTML::style('css/dataTables.bootstrap.min.css'); }}
@stop
@section('other.js')
	{{ HTML::script('js/jquery.dataTables.min.js'); }}
	{{ HTML::script('js/BeatPicker.min.js'); }}
	{{ HTML::script('js/select2.min.js'); }}
@stop	
