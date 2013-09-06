<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	@if(isset($title)) 
	 <title>{{ $title }}</title>
	@else 
	 <title>Auth Demo</title>
	@endif
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<!--<link href="//netdna.bootstrapcdn.com/bootswatch/3.0.0/simplex/bootstrap.min.css" rel="stylesheet">-->
	
</head>
<body>

	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          {{ HTML::link('/', 'Auth Demo', array('class'=>'navbar-brand')) }}
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            @if(Auth::check())
            	@if (Request::is('myNotes'))
                <li class='active'>
                @else
                <li>
                @endif
                {{ HTML::link('myNotes', 'My Notes' ) }}</li>
            	@if (Request::is('profile'))
                <li class='active'>
                @else
                <li>
                @endif
                {{ HTML::link('profile', 'Profile' ) }}</li>
                <li>{{ HTML::link('logout', 'Logout ('.Auth::user()->username.')') }}</li>
            @else
                @if (Request::is('login'))
                <li class='active'>
                @else
                <li>
                @endif
                {{ HTML::link('login', 'Login') }}</li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<div style="margin-top: 61px" class="container">
		
	        <!-- check for flash notification message -->
	        @if(Session::has('flash_notice'))
	            <div class='alert alert-dismissable alert-info'>
		        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		        	{{ Session::get('flash_notice') }}
		        </div>
	        @endif
	
	        @yield('content')
		
    </div><!-- end container -->
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script>
	if (!window.jQuery) {
	    document.write('<script src="/js/jquery.min.js"><\/script>');
	}
	</script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</body>
</html>