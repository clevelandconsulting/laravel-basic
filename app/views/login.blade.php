@extends('layout.master')

@section('content')
	
    
    <h1>Login</h1>
    
	<!-- check for login error flash var -->
	@if (Session::has('flash_error'))
        <div class='alert alert-danger alert-dismissable'>
        	<!-- check for login error flash var -->
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        	<strong>Doh!</strong> {{ Session::get('flash_error') }}
        </div>
    @endif
    

    {{ Form::open(array('login'), 'POST', array('role' => 'form')) }}

    <!-- username field -->
    <p>
        {{ Form::label('username', 'Username') }}<br/>
        {{ Form::text('username', Input::old('username'), array('class' => 'form-control', 'placeholder'=>'Username')) }}
    </p>

    <!-- password field -->
    <p>
        {{ Form::label('password', 'Password') }}<br/>
        {{ Form::password('password', array('class' => 'form-control', 'placeholder'=>'Password')) }}
    </p>

    <!-- submit button -->
    <p>{{ Form::submit('Login',array('class' => 'btn btn-default')) }}</p>

    {{ Form::close() }}
@stop