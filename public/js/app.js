var app = angular.module("myApp",['angular-flash.service', 'angular-flash.flash-alert-directive']).config(function($routeProvider, $locationProvider, flashProvider) {

 
  flashProvider.errorClassnames.push('alert-danger'); 
  //$locationProvider.html5Mode(true);

  $routeProvider.when('/home', {
    templateUrl: 'templates/home.html',
    controller: 'HomeController'
  });
  
  $routeProvider.when('/login', {
    templateUrl: 'templates/login.html',
    controller: 'LoginController'
  });
  
  $routeProvider.when('/404', {
	  templateUrl: 'templates/404.html',
	  resolve: {
	    "expiry": function($http) {
		    return $http.get('/expiry');
	    }
    }
  });

  $routeProvider.otherwise({ 
  	redirectTo: '/404' 
  });

});

angular.module("myApp").config(function($httpProvider) {
	var logsOutUserOn401 = function($location, $q, SessionService, flash) {
		var success = function(response) {
			return response;	
		};
		
		var error = function(response) {
			if(response.status === 401) {
				//debugger;
				//indicates the session has expired
				SessionService.unset('authenticated');
				$location.path('/login');
				flash.clean();
				flash.error = response.data.flash;
				debugger;
				return $q.reject(response);
				
			} else {
			
				return $q.reject(response);
			}
		};
		
		
		return function(promise) {
			return promise.then(success,error);
		}
	};
	
	$httpProvider.responseInterceptors.push(logsOutUserOn401);
})

angular.module("myApp").run(function($rootScope,$location,AuthenticationService,flash) {
	var routesWithoutAuth = ['/login'];
	
	// Determine if the user is authenticated to access parts of the system
	
	$rootScope.$on('$routeChangeStart', function(event, next, current) {
		if(!_(routesWithoutAuth).contains($location.path()) && !AuthenticationService.isLoggedIn()) {
			flash.error = 'You need to login!';
			$rootScope.flashHeader = 'Doh!';
			$location.path('/login');
		}
		else {
			//if ( $location.path() === '/login' && AuthenticationService.isLoggedIn()) {
			//	flash.error = 'You\'re logged in!';
			//	$location.path('/home');
			//}
		}
	});
	
});

//service that handles client side session storage
angular.module("myApp").factory("SessionService", function() {
	return {
		set: function(key,value) {
			return sessionStorage.setItem(key,value);
		},
		get: function(key) {
			return sessionStorage.getItem(key);
		},
		unset: function(key) {
			return sessionStorage.removeItem(key);
		}
	}
});

//service to handle authentication
angular.module("myApp").factory("AuthenticationService", function($http, flash, SessionService) {
	var cacheSession = function() {
		SessionService.set('authenticated',true);
	};
	var unCacheSession = function() {
		SessionService.unset('authenticated');
	};
	var checkSession = function() {
		return SessionService.get('authenticated') == "true";
	}
	
	return {
		login: function(credentials) {
			var p = $http.post('api/v1/auth/login',credentials)
			.success(function(data) {
				cacheSession();
				flash.success = data.flash;
			})
			.error(function(data) {
				flash.error = data.flash;
				
			});
			return p;
		},
		logout: function() {
			
			var p = $http.get('api/v1/auth/logout')
			.success(unCacheSession);
			
			return p;
		},
		isLoggedIn: function() {
			return checkSession();
		}
	}
});


//service to provide the navigation paths
angular.module("myApp").factory("NavigationService", function($location,AuthenticationService) {
	var LoggedInPaths = [{ name: 'Auth Demo', url: '/home' }, { name: 'Profile', url: '/profile'}];
	var GuestPaths = [{ name: 'Login', url: '/login'} ];
	
	var obj = {
		isActive: function(current) { 
					return ( $location.path() === current ? 'active' : '' ); 
					},
		getPaths: function() {
						return AuthenticationService.isLoggedIn() ? LoggedInPaths : GuestPaths;
					}
	};
	
	return obj;

});

angular.module("myApp").controller("NavigationController", function($scope,NavigationService) {
	$scope.n = NavigationService;
});


angular.module("myApp").controller('HomeController', function($scope, $location, AuthenticationService) {
  $scope.title = "Home";
  
  $scope.logout = function() {
	  AuthenticationService.logout().success( function() {
	  
	  	$location.path('/login');
	  
	  });
  }

});

angular.module("myApp").controller('LoginController', function($scope, $location, AuthenticationService, flash) {
  $scope.title = "Login";
  $scope.credentials = { username: '', password: '' };
  
  $scope.login = function(cred) {

  	  // START HACK 
  	  // to handle the browser autocompletes (angularjs doesn't read these into the scope's model)
  	  
  	  if ( cred.username === '' ) {
  	    var un = document.querySelector('#username');
  	  	cred.username = angular.element(un).val();
  	  }
  	  if ( cred.password === '' ) {
  	  	var pw = document.querySelector('#password');
  	  	cred.password = angular.element(pw).val();
  	  }
  	  
  	  // END HACK
  	  
  	  if ( ( cred.username !== '' && cred.username !== undefined ) && ( cred.password !== '' && cred.password !== undefined ) ) {

		  var r = AuthenticationService.login(cred);
	  
		  r.success(function(data){
		  	$scope.flashHeader = 'Yeah!';
			$location.path('/home');
		  });
		  r.error(function(data) {
		  	$scope.flashHeader = 'Doh!';
		  });
		  return r;
		  
	  } else {

	  	  $scope.flashHeader = 'Hey!';
		  flash.error = "You must fill out both a username and a password.";
		  return null;
		  
	  }
	  
  }
});