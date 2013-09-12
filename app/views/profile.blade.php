@extends('layout.master')

@section('content')
  <h1>Profile for "{{ Auth::user()->username }}"</h1>
  <div class="container">
	<div class="row">
		{{ Form::open(array('route'=>'updateuser', 'method'=>'PUT', 'role'=>'form')) }}
		<div class="form-group">
			{{ Form::label('firstName', 'First Name') }} {{ Form::text('firstName', Auth::user()->first_name, array('class'=>'form-control', 'placeholder'=>'First Name')) }}
		</div>
		<div class="form-group">
			{{ Form::label('lastName', 'Last Name') }} {{ Form::text('lastName', Auth::user()->last_name, array('class'=>'form-control', 'placeholder'=>'Last Name')) }}
		</div>
		<div class="form-group">
			{{ Form::label('email', 'Email') }} {{ Form::text('email', Auth::user()->email, array('class'=>'form-control', 'placeholder'=>'Email')) }}
		</div>
		
		{{ Form::button('Update Profile', array('type'=>'submit','class'=>'btn btn-primary')) }}
		<a href="{{ URL::route('home') }}" class='btn btn-default'>Cancel</a>
		{{ Form::close() }}
	</div>
</div>
@stop