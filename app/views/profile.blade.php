@extends('layout.master')

@section('content')
  <h1>Welcome "{{ Auth::user()->username }}" to the protected page!</h1>
  <p>Your user ID is: {{ Auth::user()->id }}</p>
@stop