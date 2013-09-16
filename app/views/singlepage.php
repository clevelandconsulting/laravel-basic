<!doctype html>
<html data-ng-app='myApp'>
<head>
	<meta charset="UTF-8">
	 <title>SingePage Version</title>
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
          <span class='navbar-brand active'>Single Page Demo</span>
        </div>
        
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav" data-ng-controller='NavigationController'>
          	<li data-ng-repeat="path in n.getPaths()" class="{{ n.isActive(path.url) }}">
            	<a href="#{{ path.url }}">{{ path.name }}</a>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
        
      </div>
    </div>

	<div style="margin-top: 61px" class="container" data-ng-view>

    </div><!-- end container -->   
    <script type='text/javascript' src='js/vendor/underscore-min.js'></script>
	<script type='text/javascript' src='js/vendor/angular.min.js'></script>
	<script type='text/javascript' src='js/vendor/angular-flash.min.js'></script>
	<script type='text/javascript' src='js/app.js'></script>
	<script type='text/javascript' src='js/services/sessionService.js'></script>
	<script type='text/javascript' src='js/services/authenticationService.js'></script>
	<script type='text/javascript' src='js/services/navigationService.js'></script>
	<script type='text/javascript' src='js/controllers/navigationCtrl.js'></script>
	<script type='text/javascript' src='js/controllers/homeCtrl.js'></script>
	<script type='text/javascript' src='js/controllers/loginCtrl.js'></script>
	<script type='text/javascript' src='js/controllers/profileCtrl.js'></script>
</body>
</html>